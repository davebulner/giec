@extends('layouts.admin')

@section('title', 'Categories & Navbar — GIEC Staff Admin')
@section('page_title', 'Categories & Navbar Dropdown Control')
@section('page_subtitle', 'Create and order categories dynamically. All visible categories and their programs automatically update the website navbar dropdown and directory filters.')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left 4 Columns: Quick-Create Category Form -->
        <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <div class="border-b border-slate-100 pb-4 mb-5">
                <h2 class="font-heading text-lg font-bold text-navy-900">Add New Category</h2>
                <p class="text-xs text-slate-500 mt-0.5">Categories appear dynamically in the Programs &amp; Packages navbar dropdown and directory sidebar.</p>
            </div>

            <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="cat-name" class="block text-xs font-semibold text-slate-700 mb-1.5">Category Name *</label>
                    <input id="cat-name" type="text" name="name" value="{{ old('name') }}" required
                           placeholder="e.g. Student Packages or Healthcare"
                           class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                </div>

                <div>
                    <label for="cat-slug" class="block text-xs font-semibold text-slate-700 mb-1.5">URL Slug <span class="text-slate-400 font-normal">(auto-generated if blank)</span></label>
                    <input id="cat-slug" type="text" name="slug" value="{{ old('slug') }}"
                           placeholder="e.g. student-packages"
                           class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                </div>

                <div>
                    <label for="cat-description" class="block text-xs font-semibold text-slate-700 mb-1.5">Short Description</label>
                    <textarea id="cat-description" name="description" rows="3"
                              placeholder="Brief summary displayed on the homepage school cards..."
                              class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4 items-end">
                    <div>
                        <label for="cat-order" class="block text-xs font-semibold text-slate-700 mb-1.5">Sort Order</label>
                        <input id="cat-order" type="number" min="0" name="sort_order" value="{{ old('sort_order', 0) }}"
                               class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                    </div>

                    <label class="flex items-center gap-2 py-2.5 cursor-pointer">
                        <input type="checkbox" name="show_in_nav" value="1" checked
                               class="rounded border-slate-300 text-gold-600 focus:ring-gold-600">
                        <span class="text-xs font-semibold text-navy-900">Show in Navbar</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-navy-900 hover:bg-navy-800 text-white font-semibold text-sm py-3 rounded-xl shadow-sm transition-colors">
                    + Create Category
                </button>
            </form>
        </div>

        <!-- Right 8 Columns: Categories Table -->
        <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h2 class="font-heading font-bold text-base text-navy-900">Active Categories ({{ $categories->count() }})</h2>
                    <p class="text-xs text-slate-500">Ordered by Sort Order ascending, then Name.</p>
                </div>
                <a href="{{ route('admin.programs.create') }}" class="text-xs font-bold text-gold-700 hover:text-navy-900">
                    + Add Program to Category &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-3.5">Order</th>
                            <th class="px-6 py-3.5">Category Name</th>
                            <th class="px-6 py-3.5">Programs</th>
                            <th class="px-6 py-3.5">Navbar Dropdown</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($categories as $category)
                            <tr class="hover:bg-slate-50/70">
                                <td class="px-6 py-4 font-mono text-xs font-bold text-slate-500">
                                    #{{ $category->sort_order }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-heading font-bold text-navy-900">{{ $category->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $category->slug }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs font-semibold text-navy-900">
                                    {{ $category->programs_count }} {{ Str::plural('item', $category->programs_count) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $category->show_in_nav ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                        {{ $category->show_in_nav ? 'Visible in Navbar' : 'Hidden from Navbar' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                           class="px-3 py-1.5 rounded-lg bg-navy-900 hover:bg-navy-800 text-white text-xs font-semibold">
                                            Edit
                                        </a>
                                        <form method="POST"
                                              action="{{ route('admin.categories.destroy', $category) }}"
                                              onsubmit="return confirm('Delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-2.5 py-1.5 rounded-lg border border-rose-200 text-rose-600 hover:bg-rose-50 text-xs font-semibold">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-500">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
