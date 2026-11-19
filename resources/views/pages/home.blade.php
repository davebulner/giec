@extends('layouts.app')

@section('title', 'Gordon International Eduventures College (GIEC) — Colombo 03, Sri Lanka')

@section('content')
    <!-- Hero Image Carousel with Docked Quick Program Finder -->
    <section class="relative bg-navy-950 text-white overflow-hidden border-b border-navy-800"
             x-data="heroCarousel(@js([
                [
                    'image' => asset('images/caro1.jpg'),
                    'alt' => 'GIEC students collaborating on campus',
                ],
                [
                    'image' => asset('images/caro2.webp'),
                    'alt' => 'Students walking across campus grounds',
                ],
                [
                    'image' => asset('images/caro3.jpeg'),
                    'alt' => 'University students in modern library study hall',
                ],
             ]))">

        <!-- Full-Bleed Continuous CSS Fade-In / Fade-Out Background Slides -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <template x-for="(slide, idx) in slides" :key="idx">
                <div class="absolute inset-0 transition-all duration-1000 ease-in-out will-change-transform"
                     :class="active === idx ? 'opacity-100 scale-105' : 'opacity-0 scale-100'">
                    <img :src="slide.image"
                         :alt="slide.alt"
                         class="w-full h-full object-cover object-center" />
                </div>
            </template>

            <!-- Royal Indigo Editorial Gradient Overlays -->
            <div class="absolute inset-0 bg-gradient-to-r from-navy-950/95 via-navy-900/80 to-navy-950/35"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-navy-950/90 via-transparent to-navy-950/40"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12 lg:pt-16 lg:pb-14">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 min-h-[310px] sm:min-h-[340px]">
                <!-- Official Hero Banner Copy -->
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-navy-900/90 backdrop-blur-sm border border-navy-700 text-[11px] sm:text-xs font-semibold text-gold-300 tracking-wide mb-5">
                        <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                        <span>SCIENTIA EST POTENTIA &middot; OVER 8 YEARS OF EXCELLENCE</span>
                    </div>

                    <h1 class="font-heading text-3xl sm:text-5xl lg:text-[3.2rem] font-extrabold text-white leading-[1.12] tracking-tight">
                        Your Trusted Partner for <span class="text-gold-400">Global Education Opportunities</span>
                    </h1>

                    <p class="mt-5 text-base sm:text-lg text-slate-200 leading-relaxed max-w-xl">
                        Empowering students to achieve their academic and career aspirations through internationally recognized qualifications, university partnerships, and professional training programmes.
                    </p>

                    <div class="mt-7 flex flex-wrap items-center gap-3.5">
                        <a href="{{ route('programs.index') }}"
                           class="inline-flex items-center gap-2 bg-gold-500 hover:bg-gold-600 text-white font-bold text-sm sm:text-base px-6 py-3.5 rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
                            <span>Start Your Global Education Journey with GIEC</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="{{ route('about') }}"
                           class="inline-flex items-center gap-2 bg-navy-900/85 hover:bg-navy-800 backdrop-blur-sm text-white border border-white/20 font-semibold text-sm sm:text-base px-5 py-3.5 rounded-xl transition-colors">
                            About GIEC
                        </a>
                    </div>
                </div>

                <!-- Carousel Controls: Prev / Indicators / Next -->
                <div class="relative z-20 flex items-center gap-3 self-start lg:self-end shrink-0 bg-navy-950/75 backdrop-blur-md border border-white/15 rounded-2xl px-4 py-2.5">
                    <button type="button"
                            @click="prev()"
                            aria-label="Previous slide"
                            class="w-9 h-9 rounded-xl bg-navy-900 hover:bg-gold-500 text-white flex items-center justify-center transition-colors border border-white/10">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <div class="flex items-center gap-2 px-1">
                        <template x-for="(slide, idx) in slides" :key="'dot-' + idx">
                            <button type="button"
                                    @click="goTo(idx)"
                                    :aria-label="'Go to slide ' + (idx + 1)"
                                    class="h-2 rounded-full transition-all duration-300"
                                    :class="active === idx ? 'w-8 bg-gold-400' : 'w-2.5 bg-white/40 hover:bg-white/70'"></button>
                        </template>
                    </div>

                    <button type="button"
                            @click="next()"
                            aria-label="Next slide"
                            class="w-9 h-9 rounded-xl bg-navy-900 hover:bg-gold-500 text-white flex items-center justify-center transition-colors border border-white/10">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Docked Interactive Quick Program & Package Finder Bar -->
            <div class="mt-10 bg-white/95 backdrop-blur-md rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-2xl text-slate-800">
                <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                    <p class="text-xs font-bold uppercase tracking-wider text-navy-900">Quick Program &amp; Package Finder</p>
                    <div class="hidden md:flex items-center gap-2 text-[11px]">
                        <span class="text-slate-400 font-semibold uppercase tracking-wider">Popular:</span>
                        <a href="{{ route('programs.index', ['q' => 'English']) }}" class="px-2.5 py-0.5 rounded-full bg-slate-100 hover:bg-gold-50 text-navy-900 hover:text-gold-700 font-semibold transition-colors">English (UK)</a>
                        <a href="{{ route('programs.index', ['level' => 'Undergraduate']) }}" class="px-2.5 py-0.5 rounded-full bg-slate-100 hover:bg-gold-50 text-navy-900 hover:text-gold-700 font-semibold transition-colors">HND &amp; BSc Top-Up</a>
                        <a href="{{ route('programs.index', ['department' => 'information-technology']) }}" class="px-2.5 py-0.5 rounded-full bg-slate-100 hover:bg-gold-50 text-navy-900 hover:text-gold-700 font-semibold transition-colors">IT &amp; Software</a>
                    </div>
                </div>

                <form action="{{ route('programs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3">
                    <div class="md:col-span-5">
                        <label for="hero-q" class="sr-only">Search Keyword</label>
                        <div class="relative">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input id="hero-q"
                                   type="text"
                                   name="q"
                                   placeholder="Search program (e.g. English, HND, IT, Strategic Management)..."
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm text-navy-900 placeholder-slate-400 focus:border-gold-500 focus:ring-gold-500">
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <label for="hero-level" class="sr-only">Qualification Level</label>
                        <select id="hero-level"
                                name="level"
                                class="w-full py-3 px-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm text-navy-900 focus:border-gold-500 focus:ring-gold-500">
                            <option value="">All Program Levels</option>
                            @foreach($levels as $level)
                                <option value="{{ $level }}">{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="hero-format" class="sr-only">Preferred Study Format</label>
                        <select id="hero-format"
                                name="format"
                                class="w-full py-3 px-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm text-navy-900 focus:border-gold-500 focus:ring-gold-500">
                            <option value="">Any Format</option>
                            @foreach($formats as $format)
                                <option value="{{ $format }}">{{ $format }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit"
                                class="w-full h-full inline-flex items-center justify-center gap-2 bg-navy-900 hover:bg-navy-800 text-white font-bold text-sm px-5 py-3 rounded-xl shadow-sm transition-colors">
                            <span>Find Programs</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Accreditation & Trust Strip -->
    <section class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-gold-50 border border-gold-200 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-gold-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-heading font-bold text-sm text-navy-900">UK &amp; Spinnaker Accredited</p>
                        <p class="text-xs text-slate-500 mt-0.5">Benchmarked to UK RQF &amp; CEFR standards</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-navy-50 border border-navy-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-navy-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-heading font-bold text-sm text-navy-900">Levels 1–10 Pathways</p>
                        <p class="text-xs text-slate-500 mt-0.5">Diagnostic placement to C2 executive fluency</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-navy-50 border border-navy-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-navy-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-heading font-bold text-sm text-navy-900">3 Flexible Study Modes</p>
                        <p class="text-xs text-slate-500 mt-0.5">On-Campus Colombo 03, Online &amp; Hybrid</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-navy-50 border border-navy-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-navy-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-heading font-bold text-sm text-navy-900">Tailored Student Packages</p>
                        <p class="text-xs text-slate-500 mt-0.5">Standard, Fast-Track &amp; Full UK bundles</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About GIEC, Vision & Mission Showcase -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <div class="lg:col-span-6 bg-white rounded-2xl border border-slate-200 p-8 flex flex-col justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-gold-700 mb-2">About GIEC &middot; 8+ Years of Expertise</p>
                    <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-navy-900 leading-snug">
                        Bridging Local Talent &amp; Global Opportunities
                    </h2>
                    <p class="mt-4 text-sm sm:text-base text-slate-600 leading-relaxed">
                        Gordon International Eduventures College (GIEC) is a leading education and professional development institution dedicated to empowering individuals through high-quality learning opportunities and globally recognised qualifications.
                    </p>
                    <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                        Through strategic partnerships with renowned universities, professional bodies, and educational institutions worldwide, we deliver qualifications that are relevant, flexible, and designed to meet the evolving needs of today's learners and employers.
                    </p>
                </div>
                <div class="mt-6 pt-5 border-t border-slate-100">
                    <a href="{{ route('about') }}" class="inline-flex items-center gap-2 text-sm font-bold text-navy-900 hover:text-gold-700 transition-colors">
                        <span>Read Full Story &amp; Accreditation</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-6 grid grid-cols-1 gap-5">
                <div class="bg-navy-950 text-white rounded-2xl border border-navy-800 p-7">
                    <span class="inline-block text-[11px] font-bold uppercase tracking-widest text-gold-400 mb-2">Our Vision</span>
                    <p class="text-sm sm:text-base text-slate-200 leading-relaxed">
                        To become Sri Lanka’s leading hub for global education, empowering learners with internationally recognised qualifications, world-class language skills, and future-ready competencies that open pathways to success locally and worldwide.
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 border-l-4 border-l-gold-500 p-7">
                    <span class="inline-block text-[11px] font-bold uppercase tracking-widest text-gold-700 mb-2">Our Mission</span>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                        To deliver high-quality English and professional education through experienced educators, modern teaching methodologies, and flexible learning models. With over 8 years of industry expertise, GIEC is committed to guiding students toward international study pathways, career growth, and personal development, while fostering diversity, confidence, and continuous learning.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Student Packages -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-gold-700 mb-2">Curated Academic Pathways</p>
                <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-navy-900">Featured Student Packages</h2>
                <p class="mt-2 text-slate-600 max-w-2xl">
                    Compare structured tuition tracks, UK external certification options, and flexible installment plans tailored to your career timeline.
                </p>
            </div>
            <a href="{{ route('programs.index') }}"
               class="inline-flex items-center gap-1.5 text-sm font-bold text-navy-900 hover:text-gold-700 transition-colors shrink-0">
                <span>Browse Full Directory</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            @foreach($featuredPrograms as $program)
                @php
                    $packages = $program->student_packages ?? [];
                    $startingFee = $packages[0]['fee'] ?? 'Contact Admissions';
                @endphp
                <article class="group bg-white rounded-2xl border border-slate-200 border-t-4 border-t-gold-500 p-6 flex flex-col justify-between transition-all duration-200 hover:-translate-y-1 hover:shadow-xl hover:border-slate-300">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-4">
                            <div class="flex flex-wrap items-center gap-1.5">
                                @foreach($program->formats ?? [] as $format)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold border
                                        {{ $format === 'Online' ? 'bg-sky-50 text-sky-800 border-sky-200' : ($format === 'Hybrid' ? 'bg-gold-50 text-gold-700 border-gold-200' : 'bg-emerald-50 text-emerald-800 border-emerald-200') }}">
                                        {{ $format }}
                                    </span>
                                @endforeach
                            </div>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-navy-50 text-navy-900">
                                {{ count($packages) }} Tiers
                            </span>
                        </div>

                        <p class="text-xs font-bold uppercase tracking-wider text-gold-700 mb-1.5">
                            {{ $program->department?->name }}
                        </p>

                        <h3 class="font-heading text-xl font-bold text-navy-900 group-hover:text-gold-700 transition-colors leading-snug">
                            <a href="{{ route('programs.show', $program) }}">{{ $program->title }}</a>
                        </h3>

                        <p class="mt-3 text-sm text-slate-600 leading-relaxed line-clamp-3">
                            {{ $program->summary }}
                        </p>
                    </div>

                    <div class="mt-6 pt-5 border-t border-slate-100 space-y-4">
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <span class="font-semibold text-slate-700">{{ $program->level }} &middot; {{ $program->duration }}</span>
                            <span class="font-bold text-navy-900">From {{ $startingFee }}</span>
                        </div>

                        <a href="{{ route('programs.show', $program) }}"
                           class="w-full inline-flex items-center justify-between px-4 py-2.5 rounded-xl bg-navy-50 group-hover:bg-navy-900 text-navy-900 group-hover:text-white border border-navy-100 group-hover:border-navy-900 text-sm font-semibold transition-colors">
                            <span>View Package &amp; Apply</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <!-- Academic Progression Architecture -->
    <section class="bg-navy-950 text-white py-16 border-y border-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-widest text-gold-400 mb-2">Structured British Academic Ladder</p>
                    <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-white">Clear Progression Across Every Stage</h2>
                </div>
                <a href="{{ route('programs.index') }}" class="text-sm font-semibold text-gold-400 hover:text-gold-300">Compare all levels &rarr;</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                    $ladder = [
                        ['step' => 'Stage 01', 'level' => 'Certificate', 'title' => 'Foundation & Proficiency', 'desc' => 'London English Levels 1–10 and corporate communication certificates to build academic fluency.'],
                        ['step' => 'Stage 02', 'level' => 'Diploma', 'title' => 'UK & Industry Diplomas', 'desc' => 'Specialize in English (UK), Software Engineering, or Hospitality Operations in 6–12 months.'],
                        ['step' => 'Stage 03', 'level' => 'Undergraduate', 'title' => 'HND & BSc (Hons) Top-Up', 'desc' => 'Earn 240 UK credits through HND and complete your final-year British Honours degree.'],
                        ['step' => 'Stage 04', 'level' => 'Postgraduate', 'title' => 'Strategic Leadership & MBA', 'desc' => 'Level 7 Postgraduate Diploma designed for executives advancing directly into an MBA Top-Up.'],
                    ];
                @endphp
                @foreach($ladder as $tier)
                    <a href="{{ route('programs.index', ['level' => $tier['level']]) }}"
                       class="group rounded-2xl bg-navy-900 border border-navy-800 hover:border-gold-500 p-6 transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[11px] font-bold uppercase tracking-widest text-gold-400">{{ $tier['step'] }}</span>
                                <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-navy-800 text-slate-200 border border-navy-700">{{ $tier['level'] }}</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-white group-hover:text-gold-300 transition-colors">{{ $tier['title'] }}</h3>
                            <p class="mt-2.5 text-xs text-slate-300 leading-relaxed">{{ $tier['desc'] }}</p>
                        </div>
                        <span class="mt-5 inline-flex items-center gap-1 text-xs font-bold text-gold-400 group-hover:translate-x-1 transition-transform">
                            Explore {{ $tier['level'] }}s &rarr;
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Academic Faculties Strip -->
    <section class="bg-white border-b border-slate-200 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mb-10">
                <p class="text-xs font-bold uppercase tracking-widest text-gold-700 mb-2">Academic Schools</p>
                <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-navy-900">Explore by Department</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($departments as $dept)
                    <a href="{{ route('programs.index', ['department' => $dept->slug]) }}"
                       class="group rounded-2xl border border-slate-200 bg-canvas hover:bg-white p-6 transition-all hover:border-gold-500 hover:shadow-md flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-bold text-gold-700 bg-gold-50 border border-gold-200 px-2.5 py-0.5 rounded-full">
                                    {{ $dept->programs_count }} {{ Str::plural('Program', $dept->programs_count) }}
                                </span>
                                <span class="text-slate-400 group-hover:text-gold-600 transition-colors">&rarr;</span>
                            </div>
                            <h3 class="font-heading font-bold text-base text-navy-900">{{ $dept->name }}</h3>
                            <p class="mt-2 text-xs text-slate-600 leading-relaxed">{{ $dept->description }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Study at GIEC Grid (4 Value Pillars with Custom Inline SVGs) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <p class="text-xs font-bold uppercase tracking-widest text-gold-700 mb-2">The GIEC Standard</p>
            <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-navy-900">Why Study at GIEC Colombo 03</h2>
            <p class="mt-3 text-slate-600">
                Built around working professionals, A/L school leavers, and aspiring global graduates who demand academic credibility without rigid barriers.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-gold-300 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-lg text-navy-900">Flexible Schedules</h3>
                <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                    Weekday, weekend, and evening cohorts in Colombo 03 plus live interactive online classrooms so your studies fit seamlessly around work or university.
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-gold-300 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-lg text-navy-900">Recognized Certifications</h3>
                <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                    UK RQF-aligned HNDs, BSc (Hons) top-ups, and Spinnaker School English diplomas accepted for international credit transfer and global employment.
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-gold-300 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-lg text-navy-900">Expert Faculty</h3>
                <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                    Learn directly from UK-certified language trainers, MBA/doctoral business academics, and senior software &amp; hospitality practitioners.
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-gold-300 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center mb-5">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-lg text-navy-900">Career-Focused Curriculum</h3>
                <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                    Assignment-led assessments, real-world case studies, GitHub engineering portfolios, and five-star hotel placements built for employability.
                </p>
            </div>
        </div>
    </section>

    <!-- Admissions CTA Banner -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="rounded-3xl bg-navy-900 border border-navy-800 px-6 py-12 sm:px-12 lg:py-14 flex flex-col lg:flex-row lg:items-center justify-between gap-8 relative overflow-hidden">
            <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-gradient-to-l from-gold-500/15 to-transparent pointer-events-none"></div>
            <div class="relative max-w-2xl">
                <span class="text-xs font-bold uppercase tracking-widest text-gold-400">Admissions Open for Upcoming Intakes</span>
                <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-white mt-2">
                    Not sure which Student Package matches your goals?
                </h2>
                <p class="mt-3 text-slate-300 text-base leading-relaxed">
                    Speak with a GIEC Admissions Counselor at our Galle Road, Colombo 03 campus or receive an instant fee breakdown &amp; placement recommendation via email or WhatsApp.
                </p>
            </div>

            <div class="relative flex flex-wrap items-center gap-3.5 shrink-0">
                <a href="{{ route('programs.index') }}"
                   class="inline-flex items-center gap-2 bg-gold-500 hover:bg-gold-600 text-white font-bold px-6 py-3.5 rounded-xl transition-colors">
                    Compare Programs
                </a>
                <a href="https://wa.me/94761561870" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 bg-white hover:bg-slate-100 text-navy-900 font-bold px-6 py-3.5 rounded-xl transition-colors">
                    Book Advisor Consultation
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function heroCarousel(slides) {
        return {
            slides: slides,
            active: 0,
            timer: null,

            init() {
                this.startTimer();
            },

            next() {
                this.active = (this.active + 1) % this.slides.length;
                this.startTimer();
            },

            prev() {
                this.active = (this.active - 1 + this.slides.length) % this.slides.length;
                this.startTimer();
            },

            goTo(index) {
                this.active = index;
                this.startTimer();
            },

            startTimer() {
                if (this.timer) {
                    clearInterval(this.timer);
                }
                this.timer = setInterval(() => {
                    this.active = (this.active + 1) % this.slides.length;
                }, 5000);
            }
        };
    }
</script>
@endpush
