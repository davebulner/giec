<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveProgramRequest;
use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        $programs = Program::query()
            ->with('department')
            ->withCount('inquiries')
            ->latest('id')
            ->get();

        return view('admin.programs.index', [
            'programs' => $programs,
        ]);
    }

    public function create(): View
    {
        return view('admin.programs.create', [
            'program' => new Program([
                'formats' => ['On-Campus', 'Online'],
                'modules' => [
                    ['title' => '', 'description' => ''],
                ],
                'entry_requirements' => [''],
                'student_packages' => [
                    [
                        'name' => 'Standard Track Package',
                        'fee' => 'LKR ',
                        'badge' => 'Popular',
                        'features' => [''],
                    ],
                ],
                'is_published' => true,
                'is_featured' => false,
            ]),
            'departments' => Department::orderBy('sort_order')->orderBy('name')->get(),
            'levels' => $this->availableLevels(),
            'formats' => Program::FORMATS,
        ]);
    }

    public function store(SaveProgramRequest $request): RedirectResponse
    {
        $program = Program::create($request->validatedPayload());

        return redirect()
            ->route('admin.programs.index')
            ->with('success', "Program \"{$program->title}\" created successfully.");
    }

    public function edit(Program $program): View
    {
        return view('admin.programs.edit', [
            'program' => $program,
            'departments' => Department::orderBy('sort_order')->orderBy('name')->get(),
            'levels' => $this->availableLevels(),
            'formats' => Program::FORMATS,
        ]);
    }

    public function update(SaveProgramRequest $request, Program $program): RedirectResponse
    {
        $program->update($request->validatedPayload());

        return redirect()
            ->route('admin.programs.index')
            ->with('success', "Program \"{$program->title}\" updated successfully.");
    }

    public function destroy(Program $program): RedirectResponse
    {
        $title = $program->title;
        $program->delete();

        return redirect()
            ->route('admin.programs.index')
            ->with('success', "Program \"{$title}\" has been deleted.");
    }

    protected function availableLevels(): array
    {
        return collect(Program::LEVELS)
            ->merge(Program::query()->distinct()->pluck('level'))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }
}
