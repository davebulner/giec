@extends('layouts.admin')

@section('title', 'Edit Category — GIEC Staff Admin')
@section('page_title', 'Edit Category: ' . $category->name)
@section('page_subtitle', 'Update category details, display order, and navbar dropdown visibility.')

@section('header_actions')
    <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold text-slate-600 hover:text-navy-900">
        &larr; Back to Categories
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-6 bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-700 mb-1.5">Category Name *</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" required
                           class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                </div>

                <div>
                    <label for="slug" class="block text-xs font-semibold text-slate-700 mb-1.5">URL Slug *</label>
                    <input id="slug" type="text" name="slug" value="{{ old('slug', $category->slug) }}" required
                           class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                </div>

                <div>
                    <label for="description" class="block text-xs font-semibold text-slate-700 mb-1.5">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-5 items-end">
                    <div>
                        <label for="sort_order" class="block text-xs font-semibold text-slate-700 mb-1.5">Sort Order</label>
                        <input id="sort_order" type="number" min="0" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}"
                               class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                    </div>

                    <label class="flex items-center gap-2.5 py-2.5 cursor-pointer">
                        <input type="checkbox" name="show_in_nav" value="1" @checked(old('show_in_nav', $category->show_in_nav))
                               class="rounded border-slate-300 text-gold-600 focus:ring-gold-600">
                        <span class="text-sm font-semibold text-navy-900">Show in Navbar Dropdown</span>
                    </label>
                </div>

                <div class="pt-3 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-600 text-white text-sm font-bold shadow-sm">
                        Save Category Changes
                    </button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-6 bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
            <h2 class="font-heading text-lg font-bold text-navy-900 mb-1">Programs in This Category ({{ $category->programs->count() }})</h2>
            <p class="text-xs text-slate-500 mb-5">Published items appear directly under this category in the navbar dropdown.</p>

            @if($category->programs->isEmpty())
                <p class="text-sm text-slate-500 py-4">No programs assigned to this category yet.</p>
            @else
                <ul class="divide-y divide-slate-100">
                    @foreach($category->programs as $prog)
                        <li class="py-3 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-navy-900">{{ $prog->title }}</p>
                                <p class="text-xs text-slate-500">{{ $prog->level }} &middot; {{ $prog->is_published ? 'Published' : 'Draft' }}</p>
                            </div>
                            <a href="{{ route('admin.programs.edit', $prog) }}" class="text-xs font-semibold text-gold-700 hover:text-navy-900 shrink-0">
                                Edit &rarr;
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
