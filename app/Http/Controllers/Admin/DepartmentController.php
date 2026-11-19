<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $categories = Department::query()
            ->withCount('programs')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $slug = $request->filled('slug')
            ? Str::slug((string) $request->input('slug'))
            : Str::slug((string) $request->input('name'));

        $request->merge([
            'slug' => $slug,
            'show_in_nav' => $request->boolean('show_in_nav'),
            'sort_order' => (int) ($request->input('sort_order', 0)),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('departments', 'slug')],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['integer', 'min:0', 'max:9999'],
            'show_in_nav' => ['boolean'],
        ]);

        $category = Department::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "Category \"{$category->name}\" created and synced to navigation.");
    }

    public function edit(Department $category): View
    {
        $category->load(['programs' => fn ($query) => $query->orderBy('title')]);

        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Department $category): RedirectResponse
    {
        $slug = $request->filled('slug')
            ? Str::slug((string) $request->input('slug'))
            : Str::slug((string) $request->input('name'));

        $request->merge([
            'slug' => $slug,
            'show_in_nav' => $request->boolean('show_in_nav'),
            'sort_order' => (int) ($request->input('sort_order', 0)),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('departments', 'slug')->ignore($category->id)],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['integer', 'min:0', 'max:9999'],
            'show_in_nav' => ['boolean'],
        ]);

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "Category \"{$category->name}\" updated successfully.");
    }

    public function destroy(Department $category): RedirectResponse
    {
        if ($category->programs()->exists()) {
            return back()->with('error', "Cannot delete \"{$category->name}\" while programs are assigned to it. Reassign or delete those programs first.");
        }

        $name = $category->name;
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "Category \"{$name}\" deleted.");
    }
}
