<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Inquiry;
use App\Models\Program;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request as HttpClientRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GiecPortalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_public_pages_render_successfully_with_seeded_content(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Your Trusted Partner for')
            ->assertSee('Global Education Opportunities')
            ->assertSee('Start Your Global Education Journey with GIEC')
            ->assertSee('images/logo.webp')
            ->assertSee('caro1.jpg')
            ->assertSee('caro2.webp')
            ->assertSee('caro3.jpeg')
            ->assertDontSee('Staff Portal')
            ->assertDontSee('Staff Admin Portal');
        $this->get('/about')
            ->assertOk()
            ->assertSee('Gordon International Eduventures College (GIEC) is a leading education and professional development institution')
            ->assertSee('leading hub for global education', false)
            ->assertSee('over 8 years of industry expertise');
        $this->get('/admissions')->assertOk()->assertSee('4 Simple Steps to Enroll at GIEC');
        $this->get('/contact')->assertOk()->assertSee('No. 408, 3rd Floor, Galle Road');

        $directoryResponse = $this->get('/programs?level=Diploma&format=Online&q=English');
        $directoryResponse->assertOk()
            ->assertSee('Diploma in English (UK)')
            ->assertSee('London English Proficiency Program');

        $this->get('/programs/diploma-in-english-uk')
            ->assertOk()
            ->assertSee('Diploma in English (UK)')
            ->assertSee('Complete UK Certification Package')
            ->assertSee('Request Student Package');
    }

    public function test_program_inquiry_saves_to_mysql_and_dispatches_two_brevo_emails(): void
    {
        Config::set('services.brevo.key', 'xkeysib-test-key-123');
        Config::set('services.brevo.sender_email', 'admissions@giecollege.com');
        Config::set('services.brevo.sender_name', 'GIEC Admissions');
        Config::set('services.brevo.admissions_notify_email', 'lead-desk@giecollege.com');

        Http::fake([
            'https://api.brevo.com/v3/smtp/email' => Http::response(['messageId' => '<test-msg@brevo.com>'], 201),
        ]);

        $response = $this->postJson('/programs/diploma-in-english-uk/inquire', [
            'full_name' => 'Kasun Wijesinghe',
            'email' => 'kasun@example.com',
            'phone' => '+94 77 998 1122',
            'preferred_format' => 'Online',
            'selected_package' => 'Complete UK Certification Package',
            'message' => 'Looking forward to the May weekend batch.',
        ]);

        $response->assertCreated()
            ->assertJsonPath('inquiry.full_name', 'Kasun Wijesinghe')
            ->assertJsonPath('inquiry.selected_package', 'Complete UK Certification Package')
            ->assertJsonPath('email_status.dispatched', true)
            ->assertJsonPath('email_status.student_sent', true)
            ->assertJsonPath('email_status.admin_sent', true);

        $this->assertDatabaseHas('inquiries', [
            'email' => 'kasun@example.com',
            'preferred_format' => 'Online',
            'selected_package' => 'Complete UK Certification Package',
            'status' => 'new',
        ]);

        Http::assertSentCount(2);

        Http::assertSent(function (HttpClientRequest $request) {
            return $request->url() === 'https://api.brevo.com/v3/smtp/email'
                && $request->hasHeader('api-key', 'xkeysib-test-key-123')
                && ($request['to'][0]['email'] ?? null) === 'kasun@example.com'
                && str_contains($request['htmlContent'] ?? '', 'Complete UK Certification Package')
                && str_contains($request['htmlContent'] ?? '', 'LKR 110,000');
        });

        Http::assertSent(function (HttpClientRequest $request) {
            return $request->url() === 'https://api.brevo.com/v3/smtp/email'
                && ($request['to'][0]['email'] ?? null) === 'lead-desk@giecollege.com'
                && str_contains($request['htmlContent'] ?? '', 'Kasun Wijesinghe');
        });
    }

    public function test_program_inquiry_gracefully_persists_when_brevo_api_key_is_blank(): void
    {
        Config::set('services.brevo.key', '');

        $response = $this->postJson('/programs/diploma-in-english-uk/inquire', [
            'full_name' => 'Dilani Perera',
            'email' => 'dilani@example.com',
            'phone' => '+94 76 555 0000',
            'preferred_format' => 'On-Campus',
            'selected_package' => 'Standard Track Package',
        ]);

        $response->assertCreated()
            ->assertJsonPath('email_status.dispatched', false)
            ->assertJsonPath('email_status.reason', 'missing_api_key');

        $this->assertDatabaseHas('inquiries', [
            'email' => 'dilani@example.com',
            'status' => 'new',
        ]);
    }

    public function test_contact_form_creates_general_inquiry(): void
    {
        Config::set('services.brevo.key', '');

        $response = $this->post('/contact', [
            'full_name' => 'Sahan Silva',
            'email' => 'sahan@example.com',
            'phone' => '+94 71 222 3344',
            'message' => 'Can I visit the Colombo 03 campus on Saturday morning?',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('inquiries', [
            'email' => 'sahan@example.com',
            'program_id' => null,
            'status' => 'new',
        ]);
    }

    public function test_admin_panel_authentication_program_crud_and_csv_export(): void
    {
        $this->get('/admin')->assertRedirect('/login');

        $admin = User::where('email', 'admin@giecollege.com')->firstOrFail();

        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertRedirect('/admin');

        $this->get('/admin')->assertOk()->assertSee('Admissions & Academic Overview');
        $this->get('/admin/programs')->assertOk()->assertSee('Diploma in English (UK)');

        $department = Department::firstOrFail();

        $storeResponse = $this->post('/admin/programs', [
            'department_id' => $department->id,
            'title' => 'Executive Certificate in IELTS Mastery',
            'slug' => '',
            'level' => 'Certificate',
            'formats' => ['On-Campus', 'Hybrid'],
            'duration' => '10 Weeks',
            'next_intake' => 'June Intake',
            'accreditation' => 'GIEC & UK Exam Prep Certified',
            'summary' => 'Targeted Band 7.5+ IELTS preparation.',
            'overview' => 'Intensive academic reading, writing, listening, and speaking workshops.',
            'modules' => [
                ['title' => 'Academic Writing Task 1 & 2', 'description' => 'Cohesion and lexical precision.'],
            ],
            'entry_requirements' => ['Intermediate English level'],
            'student_packages' => [
                [
                    'name' => 'Standard IELTS Track',
                    'fee' => 'LKR 38,000',
                    'badge' => 'Popular',
                    'features' => ['10 weeks coaching', '4 mock tests'],
                ],
            ],
            'is_published' => '1',
            'is_featured' => '0',
        ]);

        $storeResponse->assertRedirect('/admin/programs');

        $createdProgram = Program::where('slug', 'executive-certificate-in-ielts-mastery')->first();
        $this->assertNotNull($createdProgram);

        $this->get('/programs/' . $createdProgram->slug)
            ->assertOk()
            ->assertSee('Executive Certificate in IELTS Mastery');

        $inquiry = Inquiry::firstOrFail();

        $this->patch("/admin/inquiries/{$inquiry->id}/status", [
            'status' => 'contacted',
        ])->assertRedirect();

        $this->assertDatabaseHas('inquiries', [
            'id' => $inquiry->id,
            'status' => 'contacted',
        ]);

        $csvResponse = $this->get('/admin/inquiries/export');
        $csvResponse->assertOk();
        $this->assertStringContainsString('text/csv', (string) $csvResponse->headers->get('content-type'));
        $csvContent = $csvResponse->streamedContent();
        $this->assertStringContainsString('Full Name', $csvContent);
        $this->assertStringContainsString($inquiry->full_name, $csvContent);
    }

    public function test_dynamic_categories_and_navbar_dropdown_controlled_from_admin(): void
    {
        $admin = User::where('email', 'admin@giecollege.com')->firstOrFail();
        $this->actingAs($admin);

        // 1. Create a new category via /admin/categories
        $this->post('/admin/categories', [
            'name' => 'Healthcare & Nursing',
            'slug' => '',
            'description' => 'UK healthcare assistant and clinical leadership qualifications.',
            'sort_order' => 5,
            'show_in_nav' => '1',
        ])->assertRedirect('/admin/categories');

        $healthcare = Department::where('slug', 'healthcare-nursing')->firstOrFail();

        // New category renders dynamically inside the public navbar dropdown
        $this->get('/about')
            ->assertOk()
            ->assertSee('Healthcare &amp; Nursing', false)
            ->assertSee('healthcare-nursing');

        // 2. Create a program with an inline new category + custom level
        $this->post('/admin/programs', [
            'department_id' => $healthcare->id,
            'new_department_name' => 'Special Student Packages',
            'title' => 'Global University Pathway Bundle',
            'slug' => '',
            'level' => 'Student Package',
            'formats' => ['On-Campus', 'Online'],
            'duration' => '12 Months',
            'next_intake' => 'Next Month',
            'accreditation' => 'GIEC UK Pathway',
            'summary' => 'All-in-one academic bridge package.',
            'overview' => 'Combined English and Business Foundation pathway.',
            'modules' => [['title' => 'Academic Bridge', 'description' => 'Core skills.']],
            'entry_requirements' => ['G.C.E. O/L'],
            'student_packages' => [[
                'name' => 'Complete Pathway',
                'fee' => 'LKR 195,000',
                'badge' => 'All-In-One',
                'features' => ['Tuition included'],
            ]],
            'is_published' => '1',
        ])->assertRedirect('/admin/programs');

        $this->assertDatabaseHas('departments', [
            'name' => 'Special Student Packages',
            'slug' => 'special-student-packages',
            'show_in_nav' => true,
        ]);

        // Both the inline-created category, custom level, and program appear in public navbar & /programs
        $this->get('/')
            ->assertOk()
            ->assertSee('Special Student Packages')
            ->assertSee('Global University Pathway Bundle')
            ->assertSee('Student Package');

        $this->get('/programs')
            ->assertOk()
            ->assertSee('Special Student Packages')
            ->assertSee('Global University Pathway Bundle')
            ->assertSee('Student Package');

        // 3. Attempting to delete a category that still has programs fails safely
        $specialCategory = Department::where('slug', 'special-student-packages')->firstOrFail();
        $this->delete("/admin/categories/{$specialCategory->id}")
            ->assertSessionHas('error');
        $this->assertDatabaseHas('departments', ['id' => $specialCategory->id]);

        // 4. Hiding a category from navbar removes it from the public navbar dropdown
        $this->put("/admin/categories/{$healthcare->id}", [
            'name' => 'Healthcare & Nursing',
            'slug' => 'healthcare-nursing',
            'description' => 'Updated description',
            'sort_order' => 5,
            'show_in_nav' => '0',
        ])->assertRedirect('/admin/categories');

        $this->get('/about')
            ->assertOk()
            ->assertDontSee('Healthcare &amp; Nursing', false);
    }
}
