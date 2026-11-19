<?php

namespace App\Http\Requests\Admin;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SaveProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $slug = $this->input('slug');
        if (blank($slug) && filled($this->input('title'))) {
            $slug = Str::slug((string) $this->input('title'));
        }

        $this->merge([
            'slug' => Str::slug((string) $slug),
            'new_department_name' => filled($this->input('new_department_name'))
                ? trim((string) $this->input('new_department_name'))
                : null,
            'level' => filled($this->input('level'))
                ? trim((string) $this->input('level'))
                : '',
            'is_featured' => $this->boolean('is_featured'),
            'is_published' => $this->boolean('is_published'),
        ]);
    }

    public function rules(): array
    {
        $program = $this->route('program');

        return [
            'department_id' => ['required_without:new_department_name', 'nullable', 'exists:departments,id'],
            'new_department_name' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('programs', 'slug')->ignore($program?->id),
            ],
            'level' => ['required', 'string', 'max:100'],
            'formats' => ['required', 'array', 'min:1'],
            'formats.*' => ['string', Rule::in(Program::FORMATS)],
            'duration' => ['required', 'string', 'max:255'],
            'next_intake' => ['required', 'string', 'max:255'],
            'accreditation' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string', 'max:1000'],
            'overview' => ['required', 'string'],
            'modules' => ['nullable', 'array'],
            'modules.*.title' => ['nullable', 'string', 'max:255'],
            'modules.*.description' => ['nullable', 'string', 'max:1500'],
            'entry_requirements' => ['nullable', 'array'],
            'entry_requirements.*' => ['nullable', 'string', 'max:500'],
            'student_packages' => ['nullable', 'array'],
            'student_packages.*.name' => ['nullable', 'string', 'max:255'],
            'student_packages.*.fee' => ['nullable', 'string', 'max:100'],
            'student_packages.*.badge' => ['nullable', 'string', 'max:100'],
            'student_packages.*.features' => ['nullable', 'array'],
            'student_packages.*.features.*' => ['nullable', 'string', 'max:500'],
            'is_featured' => ['boolean'],
            'is_published' => ['boolean'],
        ];
    }

    public function validatedPayload(): array
    {
        $data = $this->validated();

        if (filled($data['new_department_name'] ?? null)) {
            $deptName = trim((string) $data['new_department_name']);
            $deptSlug = Str::slug($deptName);
            $department = Department::firstOrCreate(
                ['slug' => $deptSlug],
                [
                    'name' => $deptName,
                    'sort_order' => ((int) Department::max('sort_order')) + 1,
                    'show_in_nav' => true,
                ]
            );
            $data['department_id'] = $department->id;
        }
        unset($data['new_department_name']);

        $modules = collect($data['modules'] ?? [])
            ->filter(fn ($m) => filled($m['title'] ?? null))
            ->map(fn ($m) => [
                'title' => trim((string) $m['title']),
                'description' => trim((string) ($m['description'] ?? '')),
            ])
            ->values()
            ->all();

        $requirements = collect($data['entry_requirements'] ?? [])
            ->filter(fn ($item) => filled($item))
            ->map(fn ($item) => trim((string) $item))
            ->values()
            ->all();

        $packages = collect($data['student_packages'] ?? [])
            ->filter(fn ($pkg) => filled($pkg['name'] ?? null))
            ->map(function ($pkg) {
                $features = collect($pkg['features'] ?? [])
                    ->filter(fn ($f) => filled($f))
                    ->map(fn ($f) => trim((string) $f))
                    ->values()
                    ->all();

                return [
                    'name' => trim((string) $pkg['name']),
                    'fee' => trim((string) ($pkg['fee'] ?? 'Contact Admissions')),
                    'badge' => trim((string) ($pkg['badge'] ?? '')),
                    'features' => $features,
                ];
            })
            ->values()
            ->all();

        $data['modules'] = $modules;
        $data['entry_requirements'] = $requirements;
        $data['student_packages'] = $packages;

        return $data;
    }
}
