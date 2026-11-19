@extends('layouts.app')

@section('title', $program->title . ' — GIEC Programs & Student Packages')
@section('meta_description', $program->summary)

@section('content')
    <!-- Program Hero Header -->
    <section class="bg-navy-950 text-white border-b border-navy-800 relative overflow-hidden">
        <div class="absolute inset-0 editorial-grid-bg pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <!-- Breadcrumbs -->
            <nav class="text-xs text-slate-400 flex flex-wrap items-center gap-2 mb-5">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('programs.index') }}" class="hover:text-white transition-colors">Programs &amp; Packages</a>
                <span>/</span>
                <a href="{{ route('programs.index', ['department' => $program->department?->slug]) }}" class="hover:text-white transition-colors">
                    {{ $program->department?->name }}
                </a>
                <span>/</span>
                <span class="text-gold-400 font-medium">{{ $program->title }}</span>
            </nav>

            <div class="flex flex-wrap items-center gap-2.5 mb-4">
                <!-- Accreditation Badge -->
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gold-600/20 border border-gold-500/40 text-gold-300 text-xs font-bold tracking-wide">
                    <svg class="w-3.5 h-3.5 text-gold-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $program->accreditation }}
                </span>

                <!-- Study Format Tags -->
                @foreach($program->formats ?? [] as $format)
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-navy-800 border border-slate-700 text-slate-200 text-xs font-semibold">
                        {{ $format }}
                    </span>
                @endforeach
            </div>

            <h1 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight max-w-4xl leading-tight">
                {{ $program->title }}
            </h1>

            <p class="mt-4 text-lg text-slate-300 max-w-3xl leading-relaxed">
                {{ $program->summary }}
            </p>
        </div>
    </section>

    <!-- 4-Column Quick-Facts Bar -->
    <section class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-slate-200">
                <div class="py-5 pr-4">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Duration</p>
                    <p class="mt-1 font-heading font-bold text-sm sm:text-base text-navy-900">{{ $program->duration }}</p>
                </div>

                <div class="py-5 pl-4 lg:px-6">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Study Format</p>
                    <p class="mt-1 font-heading font-bold text-sm sm:text-base text-navy-900">{{ implode(' · ', $program->formats ?? []) }}</p>
                </div>

                <div class="py-5 pr-4 lg:px-6">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Next Intake</p>
                    <p class="mt-1 font-heading font-bold text-sm sm:text-base text-gold-700">{{ $program->next_intake }}</p>
                </div>

                <div class="py-5 pl-4 lg:pl-6">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Campus / Delivery Location</p>
                    <p class="mt-1 font-heading font-bold text-sm sm:text-base text-navy-900">
                        @if(in_array('On-Campus', $program->formats ?? []) || in_array('Hybrid', $program->formats ?? []))
                            Colombo 03 Campus &amp; Live LMS
                        @else
                            100% Live Interactive Online
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Two-Column Main Body -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="flex flex-col lg:flex-row gap-10 items-start">

            <!-- Left Column (65%) -->
            <div class="w-full lg:w-[65%] space-y-12">

                <!-- Program Overview -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8">
                    <div class="flex items-center justify-between gap-4 pb-4 border-b border-slate-100 mb-6">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-gold-600">Qualification Overview</p>
                            <h2 class="font-heading text-2xl font-extrabold text-navy-900 mt-1">Program Overview &amp; Career Pathways</h2>
                        </div>
                        <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-lg bg-slate-100 text-navy-900 text-xs font-bold">
                            {{ $program->level }}
                        </span>
                    </div>

                    <div class="space-y-4 text-slate-700 leading-relaxed text-[15px]">
                        @foreach(preg_split('/\R{2,}/', trim($program->overview)) as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>

                <!-- Student Packages & Fee Structure -->
                <div>
                    <div class="mb-6">
                        <p class="text-xs font-bold uppercase tracking-widest text-gold-600">Tuition &amp; Enrollment Options</p>
                        <h2 class="font-heading text-2xl font-extrabold text-navy-900 mt-1">Student Packages &amp; Fee Structure</h2>
                        <p class="mt-1.5 text-sm text-slate-600">
                            Choose the package tier that best fits your academic timeline. Click any tier to pre-select it in the application form.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach($program->student_packages ?? [] as $idx => $package)
                            <div class="bg-white rounded-2xl border {{ $idx === count($program->student_packages ?? []) - 1 ? 'border-gold-500 ring-1 ring-gold-500/20' : 'border-slate-200' }} p-6 flex flex-col justify-between shadow-sm">
                                <div>
                                    <div class="flex items-start justify-between gap-2 mb-3">
                                        <h3 class="font-heading font-bold text-lg text-navy-900">{{ $package['name'] ?? 'Standard Package' }}</h3>
                                        @if(!empty($package['badge']))
                                            <span class="shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-gold-50 text-gold-700 border border-gold-200">
                                                {{ $package['badge'] }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="pb-4 mb-4 border-b border-slate-100">
                                        <span class="font-heading text-2xl font-extrabold text-navy-900">{{ $package['fee'] ?? 'Contact Admissions' }}</span>
                                        <span class="block text-xs text-slate-500 mt-0.5">Installment plans available</span>
                                    </div>

                                    <ul class="space-y-2.5 text-sm text-slate-700">
                                        @foreach($package['features'] ?? [] as $feature)
                                            <li class="flex items-start gap-2.5">
                                                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>{{ $feature }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <button type="button"
                                        @click="$dispatch('select-package', @js($package['name'] ?? '')); document.getElementById('package-inquiry-card').scrollIntoView({ behavior: 'smooth', block: 'center' })"
                                        class="mt-6 w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-50 hover:bg-navy-900 text-navy-900 hover:text-white border border-slate-200 hover:border-navy-900 text-sm font-semibold transition-colors">
                                    <span>Select This Package</span>
                                    <span>&rarr;</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Curriculum / Syllabus Modules (Interactive Alpine.js Accordion) -->
                @if(!empty($program->modules))
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8" x-data="{ openModule: 0 }">
                        <div class="mb-6">
                            <p class="text-xs font-bold uppercase tracking-widest text-gold-600">Academic Structure</p>
                            <h2 class="font-heading text-2xl font-extrabold text-navy-900 mt-1">Curriculum &amp; Syllabus Modules</h2>
                        </div>

                        <div class="divide-y divide-slate-200 border border-slate-200 rounded-xl overflow-hidden">
                            @foreach($program->modules as $index => $module)
                                <div class="bg-white">
                                    <button type="button"
                                            @click="openModule = openModule === {{ $index }} ? null : {{ $index }}"
                                            class="w-full px-5 py-4 text-left flex items-center justify-between gap-4 hover:bg-slate-50 transition-colors">
                                        <span class="font-heading font-bold text-sm sm:text-base text-navy-900">
                                            {{ $module['title'] ?? 'Module ' . ($index + 1) }}
                                        </span>
                                        <svg class="w-5 h-5 text-slate-400 shrink-0 transition-transform duration-200"
                                             :class="openModule === {{ $index }} ? 'rotate-180 text-gold-600' : ''"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div x-show="openModule === {{ $index }}"
                                         x-cloak
                                         class="px-5 pb-4 pt-1 text-sm text-slate-600 leading-relaxed bg-slate-50/70 border-t border-slate-100">
                                        {{ $module['description'] ?? '' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Entry Requirements -->
                @if(!empty($program->entry_requirements))
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8">
                        <p class="text-xs font-bold uppercase tracking-widest text-gold-600">Admission Eligibility</p>
                        <h2 class="font-heading text-2xl font-extrabold text-navy-900 mt-1 mb-5">Entry Requirements</h2>
                        <ul class="space-y-3">
                            @foreach($program->entry_requirements as $requirement)
                                <li class="flex items-start gap-3 text-sm text-slate-700 leading-relaxed">
                                    <span class="w-5 h-5 rounded-full bg-gold-50 border border-gold-200 text-gold-700 flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold">
                                        &check;
                                    </span>
                                    <span>{{ $requirement }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Right Sticky Sidebar (35%) — Course Package & Brevo AJAX Inquiry Form -->
            <aside class="w-full lg:w-[35%] lg:sticky lg:top-24">
                @php
                    $defaultFormat = ($program->formats ?? ['On-Campus'])[0] ?? 'On-Campus';
                    $defaultPackage = ($program->student_packages ?? [])[0]['name'] ?? 'Standard Track Package';
                @endphp

                <div id="package-inquiry-card"
                     class="bg-white rounded-2xl border border-slate-200 shadow-lg overflow-hidden"
                     x-data="programInquiryForm(@js(route('programs.inquire', $program)), @js($defaultFormat), @js($defaultPackage))"
                     @select-package.window="form.selected_package = $event.detail">

                    <div class="bg-navy-900 px-6 py-5 border-b-4 border-gold-500 text-white">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-gold-400">Instant Package Summary</p>
                        <h2 class="font-heading text-xl font-bold text-white mt-1">Request Student Package &amp; Apply</h2>
                        <p class="text-xs text-slate-300 mt-1">
                            Receive your detailed fee sheet and enrollment checklist straight to your inbox.
                        </p>
                    </div>

                    <!-- Success Inline Confirmation Card -->
                    <div x-show="submitted" x-cloak class="p-6 space-y-5">
                        <div class="rounded-xl bg-emerald-50 border border-emerald-200 p-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-heading font-bold text-base text-emerald-950">Package Request Confirmed!</h3>
                                    <p class="text-xs text-emerald-800 mt-1 leading-relaxed" x-text="successMessage"></p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-xl bg-slate-50 border border-slate-200 p-4 text-xs space-y-2 text-slate-700">
                            <div class="flex justify-between gap-2">
                                <span class="text-slate-500">Applicant:</span>
                                <span class="font-semibold text-navy-900" x-text="confirmedData.full_name"></span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span class="text-slate-500">Confirmation Email:</span>
                                <span class="font-semibold text-navy-900 truncate" x-text="confirmedData.email"></span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span class="text-slate-500">Selected Package:</span>
                                <span class="font-semibold text-gold-700 text-right" x-text="confirmedData.selected_package"></span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span class="text-slate-500">Study Format:</span>
                                <span class="font-semibold text-navy-900" x-text="confirmedData.preferred_format"></span>
                            </div>
                        </div>

                        <div class="space-y-2.5">
                            <a href="https://wa.me/94761561870" target="_blank" rel="noopener"
                               class="w-full inline-flex items-center justify-center gap-2 bg-gold-600 hover:bg-gold-500 text-white font-semibold text-sm px-4 py-3 rounded-xl transition-colors">
                                Chat on WhatsApp (+94 76 156 1870)
                            </a>
                            <button type="button"
                                    @click="resetForm()"
                                    class="w-full text-xs font-semibold text-slate-500 hover:text-navy-900 py-2">
                                Submit another inquiry
                            </button>
                        </div>
                    </div>

                    <!-- Inquiry Form -->
                    <form x-show="!submitted" @submit.prevent="submit()" class="p-6 space-y-4">
                        <div x-show="generalError" x-cloak class="rounded-xl bg-rose-50 border border-rose-200 px-3.5 py-2.5 text-xs text-rose-700 font-medium" x-text="generalError"></div>

                        <div>
                            <label for="inq-full-name" class="block text-xs font-semibold text-slate-700 mb-1">Full Name *</label>
                            <input id="inq-full-name"
                                   type="text"
                                   x-model="form.full_name"
                                   required
                                   placeholder="e.g. Nethmi Fernando"
                                   class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                            <p x-show="errors.full_name" x-text="errors.full_name?.[0]" class="mt-1 text-xs text-rose-600"></p>
                        </div>

                        <div>
                            <label for="inq-email" class="block text-xs font-semibold text-slate-700 mb-1">Email Address * <span class="text-slate-400 font-normal">(Receives Package PDF/Summary)</span></label>
                            <input id="inq-email"
                                   type="email"
                                   x-model="form.email"
                                   required
                                   placeholder="you@example.com"
                                   class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                            <p x-show="errors.email" x-text="errors.email?.[0]" class="mt-1 text-xs text-rose-600"></p>
                        </div>

                        <div>
                            <label for="inq-phone" class="block text-xs font-semibold text-slate-700 mb-1">Phone / WhatsApp Number *</label>
                            <input id="inq-phone"
                                   type="text"
                                   x-model="form.phone"
                                   required
                                   placeholder="+94 77 123 4567"
                                   class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                            <p x-show="errors.phone" x-text="errors.phone?.[0]" class="mt-1 text-xs text-rose-600"></p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                            <div>
                                <label for="inq-format" class="block text-xs font-semibold text-slate-700 mb-1">Preferred Study Format *</label>
                                <select id="inq-format"
                                        x-model="form.preferred_format"
                                        class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                                    @foreach(\App\Models\Program::FORMATS as $fmt)
                                        <option value="{{ $fmt }}">{{ $fmt }}</option>
                                    @endforeach
                                </select>
                                <p x-show="errors.preferred_format" x-text="errors.preferred_format?.[0]" class="mt-1 text-xs text-rose-600"></p>
                            </div>

                            <div>
                                <label for="inq-package" class="block text-xs font-semibold text-slate-700 mb-1">Preferred Package Tier *</label>
                                <select id="inq-package"
                                        x-model="form.selected_package"
                                        class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                                    @foreach($program->student_packages ?? [] as $pkg)
                                        <option value="{{ $pkg['name'] ?? '' }}">
                                            {{ $pkg['name'] ?? '' }} ({{ $pkg['fee'] ?? '' }})
                                        </option>
                                    @endforeach
                                </select>
                                <p x-show="errors.selected_package" x-text="errors.selected_package?.[0]" class="mt-1 text-xs text-rose-600"></p>
                            </div>
                        </div>

                        <div>
                            <label for="inq-message" class="block text-xs font-semibold text-slate-700 mb-1">Questions or Preferred Intake</label>
                            <textarea id="inq-message"
                                      rows="3"
                                      x-model="form.message"
                                      placeholder="Tell us if you prefer weekend/weekday classes or installment options..."
                                      class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600"></textarea>
                            <p x-show="errors.message" x-text="errors.message?.[0]" class="mt-1 text-xs text-rose-600"></p>
                        </div>

                        <button type="submit"
                                :disabled="loading"
                                class="w-full inline-flex items-center justify-center gap-2 bg-gold-600 hover:bg-gold-500 disabled:opacity-60 text-white font-bold text-sm px-5 py-3.5 rounded-xl shadow-sm transition-colors">
                            <svg x-show="loading" x-cloak class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            <span x-text="loading ? 'Sending Package Details...' : 'Send Student Package & Apply'"></span>
                        </button>

                        <p class="text-[11px] text-center text-slate-400">
                            No application fee required. Direct Colombo 03 Admissions support.
                        </p>
                    </form>
                </div>
            </aside>
        </div>

        <!-- Related Programs -->
        @if($relatedPrograms->isNotEmpty())
            <div class="mt-16 pt-12 border-t border-slate-200">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-heading text-2xl font-extrabold text-navy-900">Related Academic Pathways</h2>
                    <a href="{{ route('programs.index') }}" class="text-sm font-semibold text-gold-700 hover:text-gold-800">View all &rarr;</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPrograms as $related)
                        <a href="{{ route('programs.show', $related) }}"
                           class="group bg-white rounded-xl border border-slate-200 p-5 hover:border-slate-300 hover:shadow-md transition-all">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-gold-600 mb-1">{{ $related->department?->name }}</p>
                            <h3 class="font-heading font-bold text-base text-navy-900 group-hover:text-gold-700 transition-colors">{{ $related->title }}</h3>
                            <p class="mt-2 text-xs text-slate-500">{{ $related->level }} &middot; {{ $related->duration }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection

@push('scripts')
<script>
    function programInquiryForm(endpoint, defaultFormat, defaultPackage) {
        return {
            loading: false,
            submitted: false,
            successMessage: '',
            generalError: '',
            errors: {},
            confirmedData: {},
            form: {
                full_name: '',
                email: '',
                phone: '',
                preferred_format: defaultFormat,
                selected_package: defaultPackage,
                message: '',
            },

            async submit() {
                this.loading = true;
                this.errors = {};
                this.generalError = '';

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify(this.form),
                    });

                    const data = await response.json();

                    if (response.status === 422) {
                        this.errors = data.errors || {};
                        return;
                    }

                    if (!response.ok) {
                        this.generalError = data.message || 'Unable to submit inquiry right now. Please WhatsApp +94 76 156 1870.';
                        return;
                    }

                    this.submitted = true;
                    this.successMessage = data.message || 'Your student package request has been confirmed.';
                    this.confirmedData = data.inquiry || this.form;
                } catch (e) {
                    this.generalError = 'Network error occurred. Please check your connection and try again.';
                } finally {
                    this.loading = false;
                }
            },

            resetForm() {
                this.submitted = false;
                this.errors = {};
                this.generalError = '';
                this.form.full_name = '';
                this.form.email = '';
                this.form.phone = '';
                this.form.message = '';
            }
        };
    }
</script>
@endpush
