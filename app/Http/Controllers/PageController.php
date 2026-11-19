<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactInquiryRequest;
use App\Models\Department;
use App\Models\Inquiry;
use App\Models\Program;
use App\Services\BrevoMailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $featuredPrograms = Program::query()
            ->with('department')
            ->published()
            ->featured()
            ->latest('id')
            ->take(3)
            ->get();

        if ($featuredPrograms->count() < 3) {
            $featuredPrograms = Program::query()
                ->with('department')
                ->published()
                ->take(3)
                ->get();
        }

        $departments = Department::query()
            ->withCount(['programs' => fn ($query) => $query->published()])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $publishedLevels = Program::query()
            ->published()
            ->pluck('level')
            ->filter()
            ->unique()
            ->values();

        $levels = $publishedLevels->isNotEmpty()
            ? collect(Program::LEVELS)->intersect($publishedLevels)->merge($publishedLevels)->unique()->values()->all()
            : Program::LEVELS;

        return view('pages.home', [
            'featuredPrograms' => $featuredPrograms,
            'departments' => $departments,
            'levels' => $levels,
            'formats' => Program::FORMATS,
            'totalPrograms' => Program::published()->count(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'departmentsCount' => Department::count(),
            'programsCount' => Program::published()->count(),
        ]);
    }

    public function admissions(): View
    {
        $programs = Program::query()
            ->published()
            ->orderBy('title')
            ->get(['id', 'title', 'slug', 'level']);

        return view('pages.admissions', [
            'programs' => $programs,
        ]);
    }

    public function contact(): View
    {
        $programs = Program::query()
            ->published()
            ->orderBy('title')
            ->get(['id', 'title', 'slug', 'formats', 'student_packages']);

        return view('pages.contact', [
            'programs' => $programs,
            'formats' => Program::FORMATS,
        ]);
    }

    public function submitContact(StoreContactInquiryRequest $request, BrevoMailService $brevo): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        $inquiry = Inquiry::create([
            'program_id' => $validated['program_id'] ?? null,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'preferred_format' => $validated['preferred_format'] ?? null,
            'selected_package' => $validated['selected_package'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        $mailResult = $brevo->sendInquiryNotifications($inquiry);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Thank you! Your inquiry has been received by GIEC Admissions.',
                'inquiry' => [
                    'id' => $inquiry->id,
                    'full_name' => $inquiry->full_name,
                    'email' => $inquiry->email,
                ],
                'email_status' => $mailResult,
            ], 201);
        }

        return back()->with('success', 'Thank you! Your inquiry has been sent to GIEC Admissions. Please check your email for confirmation.');
    }
}
