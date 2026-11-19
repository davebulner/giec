@extends('layouts.app')

@section('title', 'Admissions & Enrollment Guide — GIEC Colombo 03')

@section('content')
    <section class="bg-navy-950 text-white border-b border-navy-800 relative overflow-hidden">
        <div class="absolute inset-0 editorial-grid-bg pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-20">
            <p class="text-xs font-bold uppercase tracking-widest text-gold-400 mb-3">Admissions Office &middot; Intakes Open</p>
            <h1 class="font-heading text-3xl sm:text-5xl font-extrabold text-white tracking-tight max-w-3xl leading-tight">
                Clear, Guided Enrollment from Placement to Graduation.
            </h1>
            <p class="mt-5 text-lg text-slate-300 max-w-2xl leading-relaxed">
                Whether you are joining from Colombo, outstation via Live Online, or internationally, our admissions advisors simplify every step—including flexible interest-free installment plans.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-16 space-y-16">
        <!-- 4-Step Visual Enrollment Timeline -->
        <div id="enrollment-steps" class="scroll-mt-28">
            <div class="mb-10">
                <p class="text-xs font-bold uppercase tracking-widest text-gold-700">Enrollment Roadmap</p>
                <h2 class="font-heading text-3xl font-extrabold text-navy-900 mt-1">4 Simple Steps to Enroll at GIEC</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $steps = [
                        ['num' => '01', 'title' => 'Select Program & Package', 'desc' => 'Browse our directory, choose your desired Study Format (On-Campus, Online, or Hybrid), and submit your Student Package request.'],
                        ['num' => '02', 'title' => 'Advisor & Placement Call', 'desc' => 'Within 24 hours, a GIEC counselor reviews your goals and schedules a quick 20-minute diagnostic check if applying for English Levels 1–10.'],
                        ['num' => '03', 'title' => 'Document Verification', 'desc' => 'Share scanned copies of your NIC/Passport and highest academic results (O/L, A/L, or Diploma transcripts) digitally or at Colombo 03.'],
                        ['num' => '04', 'title' => 'Fee Plan & Orientation', 'desc' => 'Confirm your upfront or monthly installment plan, receive your LMS credentials, and join your cohort orientation session.'],
                    ];
                @endphp
                @foreach($steps as $step)
                    <div class="bg-white rounded-2xl border border-slate-200 border-t-4 border-t-gold-500 p-6 relative">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-navy-900 text-gold-400 font-heading font-extrabold text-sm mb-4">
                            {{ $step['num'] }}
                        </span>
                        <h3 class="font-heading font-bold text-lg text-navy-900">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm text-slate-600 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Installment Payment & Student Guidelines -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div id="installment-plans" class="scroll-mt-28 bg-white rounded-2xl border border-slate-200 p-8">
                <p class="text-xs font-bold uppercase tracking-widest text-gold-700">Financial Flexibility</p>
                <h2 class="font-heading text-2xl font-extrabold text-navy-900 mt-1 mb-4">Flexible Installment Plans</h2>
                <p class="text-sm text-slate-600 leading-relaxed mb-5">
                    GIEC believes financial structure should never delay academic progression. All Diploma, HND, BSc Top-Up, and Postgraduate packages offer interest-free installment options.
                </p>
                <ul class="space-y-3 text-sm text-slate-700">
                    <li class="flex items-start gap-2.5">
                        <span class="text-gold-600 font-bold">&check;</span>
                        <span>3-month, 6-month, and 12-month structured zero-interest monthly schedules.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="text-gold-600 font-bold">&check;</span>
                        <span>Full-payment merit concession available for upfront package settlement.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="text-gold-600 font-bold">&check;</span>
                        <span>Transparent UK awarding-body &amp; registration fees itemized upfront with zero hidden surcharges.</span>
                    </li>
                </ul>
            </div>

            <div id="student-guidelines" class="scroll-mt-28 bg-navy-950 text-white rounded-2xl border border-navy-800 p-8">
                <p class="text-xs font-bold uppercase tracking-widest text-gold-400">Local &amp; International Guidelines</p>
                <h2 class="font-heading text-2xl font-bold text-white mt-1 mb-4">Document Checklist &amp; Modes</h2>
                <ul class="space-y-3 text-sm text-slate-300">
                    <li class="flex items-start gap-2.5">
                        <span class="text-gold-400 font-bold">&bull;</span>
                        <span><strong>Sri Lankan Students:</strong> Copy of National Identity Card (NIC) or Passport, O/L &amp; A/L certificates (pending results welcome for conditional entry).</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="text-gold-400 font-bold">&bull;</span>
                        <span><strong>International / Overseas Online Students:</strong> Valid Passport copy, previous academic transcripts, and reliable internet for live interactive seminars.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="text-gold-400 font-bold">&bull;</span>
                        <span><strong>Mature Executive Entry (RPL):</strong> Updated CV and employment service letters for applicants aged 21+ with supervisory experience.</span>
                    </li>
                </ul>
                <div class="mt-6 pt-5 border-t border-navy-800 flex flex-wrap gap-3">
                    <a href="{{ route('programs.index') }}" class="bg-gold-500 hover:bg-gold-600 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition-colors">
                        Select Your Program
                    </a>
                    <a href="https://wa.me/94761561870" target="_blank" rel="noopener" class="bg-navy-900 hover:bg-navy-800 border border-navy-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors">
                        WhatsApp Advisor
                    </a>
                </div>
            </div>
        </div>

        <!-- Alpine.js Admissions FAQ Accordion -->
        @php
            $faqs = [
                ['q' => 'How do I know which level to join in the London English Proficiency Program (Levels 1–10)?', 'a' => 'Every applicant completes a complimentary 20-minute diagnostic speaking and writing check with a GIEC trainer—either at our Colombo 03 campus or via Zoom—so you start at your exact level without repeating basics.'],
                ['q' => 'Are Online and Hybrid classes live or pre-recorded?', 'a' => 'All GIEC Online and Hybrid cohorts feature live interactive instruction with real-time lecturer feedback, plus recorded session archives in our LMS for revision.'],
                ['q' => 'Can I switch between On-Campus and Online schedules if my work hours change?', 'a' => 'Yes. Hybrid-eligible and dual-mode students can coordinate with the Registrar to move between Galle Road weekend batches and live online sessions.'],
                ['q' => 'Do GIEC HNDs and Diplomas support UK university degree top-up progression?', 'a' => 'Yes. Our Level 4 & Level 5 Higher National Diploma (240 credits) is specifically designed for direct entry into Final-Year Level 6 BSc (Hons) Top-Up degrees locally or overseas.'],
            ];
        @endphp
        <div id="admissions-faq" class="scroll-mt-28 bg-white rounded-2xl border border-slate-200 p-6 sm:p-10" x-data="{ openFaq: 0 }">
            <div class="mb-6">
                <p class="text-xs font-bold uppercase tracking-widest text-gold-700">Common Questions</p>
                <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-navy-900 mt-1">Admissions Frequently Asked Questions</h2>
            </div>

            <div class="divide-y divide-slate-200 border border-slate-200 rounded-xl overflow-hidden">
                @foreach($faqs as $idx => $faq)
                    <div>
                        <button type="button"
                                @click="openFaq = openFaq === {{ $idx }} ? null : {{ $idx }}"
                                class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 hover:bg-slate-50 transition-colors">
                            <span class="font-heading font-bold text-sm sm:text-base text-navy-900">{{ $faq['q'] }}</span>
                            <svg class="w-5 h-5 text-slate-400 shrink-0 transition-transform duration-200"
                                 :class="openFaq === {{ $idx }} ? 'rotate-180 text-gold-600' : ''"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="openFaq === {{ $idx }}" x-cloak class="px-5 pb-4 pt-1 text-sm text-slate-600 leading-relaxed bg-slate-50/70 border-t border-slate-100">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
