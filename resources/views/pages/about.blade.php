@extends('layouts.app')

@section('title', 'About GIEC — Gordon International Eduventures College')

@section('content')
    <section class="bg-navy-950 text-white border-b border-navy-800 relative overflow-hidden">
        <div class="absolute inset-0 editorial-grid-bg pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-20">
            <p class="text-xs font-bold uppercase tracking-widest text-gold-400 mb-3">About GIEC &middot; Over 8 Years of Industry Expertise</p>
            <h1 class="font-heading text-3xl sm:text-5xl font-extrabold text-white tracking-tight max-w-3xl leading-tight">
                Your Trusted Partner in Global Education &amp; Career Success.
            </h1>
            <p class="mt-5 text-lg text-slate-300 max-w-2xl leading-relaxed">
                Headquartered in Colombo 03, Gordon International Eduventures College (GIEC) bridges local talent and international opportunities through globally recognised qualifications and strategic university partnerships.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-16 space-y-16">
        <!-- About GIEC Narrative & Institutional Crest -->
        <div id="our-story" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            <div class="lg:col-span-7 space-y-5">
                <p class="text-xs font-bold uppercase tracking-widest text-gold-700">About GIEC</p>
                <h2 class="font-heading text-3xl font-extrabold text-navy-900">Empowering Individuals Through Globally Recognised Qualifications</h2>

                <div class="space-y-4 text-slate-600 leading-relaxed text-[15.5px]">
                    <p>
                        Gordon International Eduventures College (GIEC) is a leading education and professional development institution dedicated to empowering individuals through high-quality learning opportunities and globally recognised qualifications.
                    </p>
                    <p>
                        At GIEC, we believe that education is the foundation for personal growth, professional success, and lifelong learning. Our mission is to bridge the gap between local talent and global opportunities by providing access to internationally accredited programmes, industry-focused training, and innovative learning solutions.
                    </p>
                    <p>
                        Through strategic partnerships with renowned universities, professional bodies, and educational institutions worldwide, we deliver qualifications that are relevant, flexible, and designed to meet the evolving needs of today's learners and employers. Whether students aspire to pursue higher education, develop professional skills, or enhance their language proficiency, GIEC offers comprehensive learning pathways that support every stage of their educational journey.
                    </p>
                    <p>
                        Our experienced academic and administrative team is committed to delivering exceptional student support, personalised guidance, and a learning environment that encourages excellence, innovation, and career success. We take pride in nurturing confident, capable graduates who are prepared to thrive in an increasingly competitive global landscape.
                    </p>
                    <p class="font-medium text-navy-900">
                        At GIEC, we are more than an education provider—we are a trusted partner in helping students and professionals achieve their academic ambitions and unlock their full potential.
                    </p>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-28">
                <div class="bg-white rounded-2xl border border-slate-200 p-8 flex flex-col items-center text-center shadow-sm">
                    <img src="{{ asset('images/logo.webp') }}" alt="GIEC Heraldic Crest" class="h-24 w-auto object-contain mb-4" />
                    <p class="text-xs font-bold uppercase tracking-widest text-gold-700">Scientia Est Potentia</p>
                    <p class="text-xs text-slate-500 mt-1">Colombo 03 Campus &middot; No. 408, 3rd Floor, Galle Road</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <p class="font-heading text-3xl font-extrabold text-gold-600">8+ Yrs</p>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1">Industry Expertise</p>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <p class="font-heading text-3xl font-extrabold text-navy-900">{{ $programsCount }}+</p>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1">Accredited Programmes</p>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <p class="font-heading text-3xl font-extrabold text-navy-900">{{ $departmentsCount }}</p>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1">Academic Schools</p>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <p class="font-heading text-3xl font-extrabold text-navy-900">3 Modes</p>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1">On-Campus, Online, Hybrid</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision & Mission Cards -->
        <div id="mission-vision" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-navy-950 text-white rounded-2xl p-8 sm:p-10 border border-navy-800 relative overflow-hidden">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-navy-900 border border-navy-700 text-[11px] font-bold uppercase tracking-widest text-gold-400 mb-4">
                    Vision
                </div>
                <h3 class="font-heading text-2xl font-bold text-white mb-4">Sri Lanka’s Leading Hub for Global Education</h3>
                <p class="text-slate-200 text-base leading-relaxed">
                    To become Sri Lanka’s leading hub for global education, empowering learners with internationally recognised qualifications, world-class language skills, and future-ready competencies that open pathways to success locally and worldwide.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-8 sm:p-10 border border-slate-200 border-t-4 border-t-gold-500 shadow-sm">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-50 border border-gold-200 text-[11px] font-bold uppercase tracking-widest text-gold-700 mb-4">
                    Mission
                </div>
                <h3 class="font-heading text-2xl font-bold text-navy-900 mb-4">Guidance, Expertise &amp; Modern Learning Models</h3>
                <p class="text-slate-600 text-base leading-relaxed">
                    To deliver high-quality English and professional education through experienced educators, modern teaching methodologies, and flexible learning models. With over 8 years of industry expertise, GIEC is committed to guiding students toward international study pathways, career growth, and personal development, while fostering diversity, confidence, and continuous learning.
                </p>
            </div>
        </div>

        <!-- Strategic Pillars & Campus Highlights -->
        <div id="accreditation" class="bg-white rounded-2xl border border-slate-200 p-8 sm:p-10">
            <div class="max-w-2xl mb-8">
                <p class="text-xs font-bold uppercase tracking-widest text-gold-700">The GIEC Promise</p>
                <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-navy-900 mt-1">Academic Excellence, Partnerships &amp; Student Support</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-xl bg-canvas border border-slate-200">
                    <h3 class="font-heading font-bold text-base text-navy-900">Global University Partnerships</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Strategic alliances with renowned international universities, UK awarding bodies, and Spinnaker School pedagogy ensure globally portable credentials.
                    </p>
                </div>
                <div class="p-6 rounded-xl bg-canvas border border-slate-200">
                    <h3 class="font-heading font-bold text-base text-navy-900">Personalised Student Support</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Our experienced academic and administrative team provides 1-on-1 study pathway guidance, diagnostic placement, and continuous mentoring.
                    </p>
                </div>
                <div id="campus" class="p-6 rounded-xl bg-canvas border border-slate-200">
                    <h3 class="font-heading font-bold text-base text-navy-900">Colombo 03 Smart Campus</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Located at No. 408, 3rd Floor, Galle Road, Colombo 03—supporting On-Campus, Live Online, and Hybrid learners across Sri Lanka and abroad.
                    </p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                <p class="text-sm text-slate-600">Ready to start your global education journey with GIEC?</p>
                <a href="{{ route('programs.index') }}" class="inline-flex items-center gap-2 bg-navy-900 hover:bg-navy-800 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors">
                    Explore Programs &amp; Packages &rarr;
                </a>
            </div>
        </div>
    </section>
@endsection
