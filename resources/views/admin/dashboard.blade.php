@extends('layouts.admin')

@section('title', 'Overview — GIEC Staff Admin')
@section('page_title', 'Admissions & Academic Overview')
@section('page_subtitle', 'Monitor active GIEC programs, student package tiers, and incoming admissions leads.')

@section('header_actions')
    <a href="{{ route('admin.programs.create') }}"
       class="inline-flex items-center gap-2 bg-navy-900 hover:bg-navy-800 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
        <span>+ New Program</span>
    </a>
@endsection

@section('content')
    <!-- KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Published Programs</p>
            <p class="font-heading text-3xl font-extrabold text-navy-900 mt-2">{{ $stats['published_programs'] }}</p>
            <p class="text-xs text-slate-500 mt-1">{{ $stats['total_programs'] }} total across {{ $stats['departments'] }} departments</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Leads</p>
            <p class="font-heading text-3xl font-extrabold text-navy-900 mt-2">{{ $stats['total_inquiries'] }}</p>
            <p class="text-xs text-slate-500 mt-1">Stored in MySQL leads database</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-amber-600">New Uncontacted</p>
            <p class="font-heading text-3xl font-extrabold text-gold-700 mt-2">{{ $stats['new_inquiries'] }}</p>
            <p class="text-xs text-slate-500 mt-1">Awaiting advisor follow-up</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-emerald-600">Enrolled Students</p>
            <p class="font-heading text-3xl font-extrabold text-emerald-700 mt-2">{{ $stats['enrolled_inquiries'] }}</p>
            <p class="text-xs text-slate-500 mt-1">Confirmed cohort registrations</p>
        </div>
    </div>

    <!-- Recent Inquiries Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between gap-4">
            <div>
                <h2 class="font-heading font-bold text-base text-navy-900">Recent Student Package Requests &amp; Inquiries</h2>
                <p class="text-xs text-slate-500">Latest 8 submissions across program pages and contact portal.</p>
            </div>
            <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-semibold text-gold-700 hover:text-gold-800">
                Manage All Leads &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-3.5">Applicant</th>
                        <th class="px-6 py-3.5">Program &amp; Package</th>
                        <th class="px-6 py-3.5">Format</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Submitted</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentInquiries as $inquiry)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-navy-900">{{ $inquiry->full_name }}</p>
                                <p class="text-xs text-slate-500">{{ $inquiry->email }} &middot; {{ $inquiry->phone }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-slate-800">{{ $inquiry->program?->title ?? 'General Inquiry' }}</p>
                                @if($inquiry->selected_package)
                                    <p class="text-xs text-gold-700 font-semibold">{{ $inquiry->selected_package }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-600">{{ $inquiry->preferred_format ?: '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    {{ $inquiry->status === 'enrolled' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($inquiry->status === 'contacted' ? 'bg-sky-50 text-sky-700 border border-sky-200' : 'bg-amber-50 text-amber-800 border border-amber-200') }}">
                                    {{ \App\Models\Inquiry::STATUSES[$inquiry->status] ?? ucfirst($inquiry->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500">
                                {{ $inquiry->created_at?->timezone('Asia/Colombo')->format('d M Y, h:i A') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500">No inquiries yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
