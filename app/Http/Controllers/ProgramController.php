<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramInquiryRequest;
use App\Models\Department;
use App\Models\Inquiry;
use App\Models\Program;
use App\Services\BrevoMailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(Request $request): View
    {
        $programs = Program::query()
            ->with('department')
            ->published()
            ->orderBy('title')
            ->get();

        $programsPayload = $programs->map(function (Program $program): array {
            $packages = $program->student_packages ?? [];
            $startingFee = $packages[0]['fee'] ?? 'Contact Admissions';

            return [
                'id' => $program->id,
                'title' => $program->title,
                'slug' => $program->slug,
                'level' => $program->level,
                'formats' => $program->formats ?? [],
                'duration' => $program->duration,
                'next_intake' => $program->next_intake,
                'accreditation' => $program->accreditation,
                'summary' => $program->summary,
                'department_id' => $program->department_id,
                'department_name' => $program->department?->name ?? 'General Studies',
                'department_slug' => $program->department?->slug ?? '',
                'package_count' => count($packages),
                'starting_fee' => $startingFee,
                'is_featured' => (bool) $program->is_featured,
                'url' => route('programs.show', $program),
            ];
        })->values();

        $departments = Department::query()
            ->withCount(['programs' => fn ($query) => $query->published()])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $publishedLevels = $programs->pluck('level')->filter()->unique()->values();
        $levels = $publishedLevels->isNotEmpty()
            ? collect(Program::LEVELS)->intersect($publishedLevels)->merge($publishedLevels)->unique()->values()->all()
            : Program::LEVELS;

        $normalizeFilter = static function ($value): array {
            if (is_array($value)) {
                return array_values(array_filter(array_map('trim', $value)));
            }
            if (is_string($value) && trim($value) !== '') {
                return array_values(array_filter(array_map('trim', explode(',', $value))));
            }

            return [];
        };

        $initialFilters = [
            'search' => trim((string) $request->query('q', '')),
            'levels' => $normalizeFilter($request->query('level')),
            'formats' => $normalizeFilter($request->query('format')),
            'departments' => $normalizeFilter($request->query('department')),
        ];

        return view('programs.index', [
            'programsPayload' => $programsPayload,
            'departments' => $departments,
            'levels' => $levels,
            'formats' => Program::FORMATS,
            'initialFilters' => $initialFilters,
        ]);
    }

    public function show(Program $program): View
    {
        abort_unless($program->is_published, 404);

        $program->load('department');

        $relatedPrograms = Program::query()
            ->with('department')
            ->published()
            ->where('id', '!=', $program->id)
            ->where('department_id', $program->department_id)
            ->take(3)
            ->get();

        if ($relatedPrograms->isEmpty()) {
            $relatedPrograms = Program::query()
                ->with('department')
                ->published()
                ->where('id', '!=', $program->id)
                ->take(3)
                ->get();
        }

        return view('programs.show', [
            'program' => $program,
            'relatedPrograms' => $relatedPrograms,
        ]);
    }

    public function inquire(StoreProgramInquiryRequest $request, Program $program, BrevoMailService $brevo): JsonResponse|RedirectResponse
    {
        abort_unless($program->is_published, 404);

        $validated = $request->validated();

        $inquiry = Inquiry::create([
            'program_id' => $program->id,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'preferred_format' => $validated['preferred_format'],
            'selected_package' => $validated['selected_package'],
            'message' => $validated['message'] ?? null,
            'status' => 'new',
        ]);

        $mailResult = $brevo->sendInquiryNotifications($inquiry);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your student package request has been confirmed and sent to your email.',
                'inquiry' => [
                    'id' => $inquiry->id,
                    'full_name' => $inquiry->full_name,
                    'email' => $inquiry->email,
                    'program_title' => $program->title,
                    'preferred_format' => $inquiry->preferred_format,
                    'selected_package' => $inquiry->selected_package,
                ],
                'email_status' => $mailResult,
            ], 201);
        }

        return back()->with('success', 'Thank you! Your student package request has been submitted.');
    }
}
