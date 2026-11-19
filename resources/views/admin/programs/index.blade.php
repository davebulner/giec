@extends('layouts.admin')

@section('title', 'Manage Programs & Packages — GIEC Staff Admin')
@section('page_title', 'Programs & Student Packages')
@section('page_subtitle', 'Create, update, and organize academic programs, syllabus modules, and fee packages.')

@section('header_actions')
    <a href="{{ route('admin.programs.create') }}"
       class="inline-flex items-center gap-2 bg-navy-900 hover:bg-navy-800 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
        <span>+ Add New Program</span>
    </a>
@endsection

@section('content')
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-3.5">Program Title &amp; Department</th>
                        <th class="px-6 py-3.5">Level &amp; Formats</th>
                        <th class="px-6 py-3.5">Packages</th>
                        <th class="px-6 py-3.5">Leads</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($programs as $program)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div class="font-heading font-bold text-navy-900">{{ $program->title }}</div>
                                <div class="text-xs text-slate-500 mt-0.5">
                                    {{ $program->department?->name }} &middot; {{ $program->duration }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-xs font-semibold">
                                    {{ $program->level }}
                                </span>
                                <div class="mt-1.5 flex flex-wrap gap-1">
                                    @foreach($program->formats ?? [] as $format)
                                        <span class="text-[11px] px-2 py-0.5 rounded-full bg-slate-50 border border-slate-200 text-slate-600">
                                            {{ $format }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-600 font-medium">
                                {{ count($program->student_packages ?? []) }} tiers &middot; {{ count($program->modules ?? []) }} modules
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-navy-900">
                                {{ $program->inquiries_count }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1 items-start">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $program->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                        {{ $program->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                    @if($program->is_featured)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gold-50 text-gold-700 border border-gold-200">
                                            Featured
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    @if($program->is_published)
                                        <a href="{{ route('programs.show', $program) }}" target="_blank" rel="noopener"
                                           class="px-2.5 py-1.5 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-100">
                                            View
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.programs.edit', $program) }}"
                                       class="px-3 py-1.5 rounded-lg bg-navy-900 hover:bg-navy-800 text-white text-xs font-semibold">
                                        Edit
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.programs.destroy', $program) }}"
                                          onsubmit="return confirm('Delete this program? Existing inquiries will remain preserved.');">
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
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">No programs created yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
