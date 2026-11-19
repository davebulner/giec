@extends('layouts.admin')

@section('title', 'Inquiries & Leads Manager — GIEC Staff Admin')
@section('page_title', 'Inquiries & Leads Manager')
@section('page_subtitle', 'Track prospective student submissions, update enrollment status, and export leads to CSV.')

@section('header_actions')
    <a href="{{ route('admin.inquiries.export', request()->query()) }}"
       class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        <span>Export CSV</span>
    </a>
@endsection

@section('content')
    <!-- Filter Bar -->
    <form method="GET" action="{{ route('admin.inquiries.index') }}"
          class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 mb-6 grid grid-cols-1 md:grid-cols-12 gap-3.5 items-end">
        <div class="md:col-span-4">
            <label for="filter-search" class="block text-xs font-semibold text-slate-600 mb-1">Search Applicant</label>
            <input id="filter-search"
                   type="text"
                   name="search"
                   value="{{ $filters['search'] }}"
                   placeholder="Name, email, phone, or package..."
                   class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
        </div>

        <div class="md:col-span-4">
            <label for="filter-program" class="block text-xs font-semibold text-slate-600 mb-1">Program</label>
            <select id="filter-program" name="program_id"
                    class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                <option value="">All Programs</option>
                <option value="general" @selected($filters['program_id'] === 'general')>General Inquiries</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}" @selected((string) $filters['program_id'] === (string) $program->id)>
                        {{ $program->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="md:col-span-2">
            <label for="filter-status" class="block text-xs font-semibold text-slate-600 mb-1">Status</label>
            <select id="filter-status" name="status"
                    class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                <option value="">All Statuses</option>
                @foreach($statuses as $key => $label)
                    <option value="{{ $key }}" @selected($filters['status'] === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="md:col-span-2 flex items-center gap-2">
            <button type="submit" class="flex-1 bg-navy-900 hover:bg-navy-800 text-white text-sm font-semibold py-2.5 px-4 rounded-xl">
                Filter
            </button>
            @if($filters['search'] !== '' || $filters['program_id'] !== '' || $filters['status'] !== '')
                <a href="{{ route('admin.inquiries.index') }}" class="px-3 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- Inquiries Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-3.5">Applicant Details</th>
                        <th class="px-6 py-3.5">Program &amp; Package</th>
                        <th class="px-6 py-3.5">Message</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($inquiries as $inquiry)
                        <tr class="hover:bg-slate-50/70 align-top">
                            <td class="px-6 py-4">
                                <p class="font-bold text-navy-900">{{ $inquiry->full_name }}</p>
                                <p class="text-xs text-slate-600 mt-0.5">
                                    <a href="mailto:{{ $inquiry->email }}" class="hover:text-gold-700 underline">{{ $inquiry->email }}</a>
                                </p>
                                <p class="text-xs text-slate-600 mt-0.5">{{ $inquiry->phone }}</p>
                                <p class="text-[11px] text-slate-400 mt-1">
                                    {{ $inquiry->created_at?->timezone('Asia/Colombo')->format('d M Y, h:i A') }}
                                </p>
                            </td>

                            <td class="px-6 py-4">
                                <p class="font-semibold text-navy-900">{{ $inquiry->program?->title ?? 'General Inquiry' }}</p>
                                @if($inquiry->selected_package)
                                    <p class="text-xs font-semibold text-gold-700 mt-0.5">{{ $inquiry->selected_package }}</p>
                                @endif
                                @if($inquiry->preferred_format)
                                    <span class="inline-flex mt-1.5 items-center px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-[11px] font-semibold">
                                        {{ $inquiry->preferred_format }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 max-w-xs">
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    {{ $inquiry->message ?: '—' }}
                                </p>
                            </td>

                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.inquiries.update-status', $inquiry) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status"
                                            onchange="this.form.submit()"
                                            class="rounded-lg border-slate-200 text-xs font-semibold py-1.5 pr-8 focus:border-gold-600 focus:ring-gold-600
                                                {{ $inquiry->status === 'enrolled' ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : ($inquiry->status === 'contacted' ? 'bg-sky-50 text-sky-800 border-sky-200' : 'bg-amber-50 text-amber-800 border-amber-200') }}">
                                        @foreach($statuses as $key => $label)
                                            <option value="{{ $key }}" @selected($inquiry->status === $key)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>

                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                @php
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $inquiry->phone);
                                @endphp
                                <div class="inline-flex items-center gap-2">
                                    @if($cleanPhone)
                                        <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener"
                                           class="px-2.5 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 hover:bg-emerald-100 text-xs font-semibold">
                                            WhatsApp
                                        </a>
                                    @endif
                                    <form method="POST"
                                          action="{{ route('admin.inquiries.destroy', $inquiry) }}"
                                          onsubmit="return confirm('Delete this inquiry?');">
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
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">No inquiries match the selected filters.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>
@endsection
