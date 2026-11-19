<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
    <title>@yield('title', 'Gordon International Eduventures College (GIEC) — Colombo 03')</title>
    <meta name="description" content="@yield('meta_description', 'Gordon International Eduventures College (GIEC) in Colombo 03, Sri Lanka. UK-accredited Diplomas, English Proficiency Levels 1–10, HNDs, BSc Top-Up, and Postgraduate Leadership pathways.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen flex flex-col bg-canvas text-slate-800 font-sans"
      x-data="{ mobileMenuOpen: false }"
      @keydown.escape.window="mobileMenuOpen = false">

    <!-- Top Institutional Utility Strip -->
    <div class="bg-navy-950 text-slate-300 text-xs border-b border-navy-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-9 flex items-center justify-between gap-4">
            <div class="flex items-center gap-5 truncate">
                <span class="inline-flex items-center gap-1.5 truncate">
                    <svg class="w-3.5 h-3.5 text-gold-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="truncate">No. 408, 3rd Floor, Galle Road, Colombo 03</span>
                </span>
                <span class="hidden md:inline-flex items-center gap-2 text-slate-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-gold-400"></span>
                    <span class="italic text-gold-300/90 font-medium">Scientia Est Potentia</span>
                    <span>&middot; UK &amp; Spinnaker Accredited Pathways</span>
                </span>
            </div>

            <div class="flex items-center gap-4 shrink-0">
                <a href="mailto:admissions@giecollege.com" class="hidden sm:inline-flex items-center gap-1.5 hover:text-gold-300 transition-colors">
                    admissions@giecollege.com
                </a>
                <span class="hidden sm:inline text-navy-700">|</span>
                <a href="https://wa.me/94761561870" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 hover:text-gold-300 transition-colors font-semibold text-white">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.031 2c-5.516 0-9.969 4.453-9.969 9.969 0 1.766.453 3.484 1.328 5l-1.391 5.063 5.188-1.359c1.469.797 3.125 1.219 4.844 1.219 5.516 0 9.969-4.453 9.969-9.969s-4.453-9.922-9.969-9.922zm5.797 14.078c-.25.703-1.438 1.344-1.984 1.422-.516.078-1.156.109-1.875-.125-.438-.141-1-.328-1.719-.641-3.031-1.313-5-4.375-5.156-4.578-.156-.203-1.234-1.641-1.234-3.125s.781-2.219 1.063-2.516c.281-.297.609-.375.813-.375.203 0 .406 0 .578.016.188.016.438-.078.688.531.25.609.859 2.094.938 2.25.078.156.125.344.031.547-.094.203-.141.328-.297.5-.156.172-.328.391-.469.516-.156.156-.313.328-.141.641.172.313.781 1.281 1.672 2.078 1.156 1.031 2.125 1.344 2.438 1.5.313.156.484.125.672-.078.188-.203.781-.906.984-1.219.203-.313.422-.266.703-.156.281.109 1.797.844 2.109 1 .313.156.516.234.594.359.078.125.078.734-.172 1.438z"/>
                    </svg>
                    <span>+94 76 156 1870</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Sticky Glassmorphic Header with Dropdown Navigation -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/90 shadow-[0_1px_12px_-4px_rgba(24,19,78,0.08)]"
            x-data="{ openDropdown: null }"
            @keydown.escape.window="openDropdown = null">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Official Brand Logo Lockup -->
                <a href="{{ route('home') }}" class="flex items-center shrink-0 focus:outline-none">
                    <img src="{{ asset('images/logo.webp') }}"
                         alt="Gordon International Eduventures College (GIEC)"
                         class="h-12 sm:h-14 w-auto object-contain" />
                </a>

                <!-- Desktop Navigation with Interactive Dropdowns -->
                <nav class="hidden lg:flex items-center gap-1" aria-label="Main navigation">
                    <a href="{{ route('home') }}"
                       class="px-3.5 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'text-navy-900 bg-navy-50' : 'text-slate-700 hover:text-navy-900 hover:bg-slate-50' }}">
                        Home
                    </a>

                    <!-- Dynamic Programs & Packages Mega-Dropdown -->
                    <div class="relative"
                         @mouseenter="openDropdown = 'programs'"
                         @mouseleave="openDropdown = null"
                         @click.outside="if (openDropdown === 'programs') openDropdown = null">
                        <button type="button"
                                @click="openDropdown = openDropdown === 'programs' ? null : 'programs'"
                                :aria-expanded="openDropdown === 'programs'"
                                class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('programs.*') ? 'text-navy-900 bg-navy-50' : 'text-slate-700 hover:text-navy-900 hover:bg-slate-50' }}">
                            <span>Programs &amp; Packages</span>
                            <svg class="w-4 h-4 transition-transform duration-150"
                                 :class="openDropdown === 'programs' ? 'rotate-180 text-gold-600' : 'text-slate-400'"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="openDropdown === 'programs'"
                             x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-[740px] max-w-[92vw] z-50">
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl overflow-hidden">
                                <div class="h-1 bg-gradient-to-r from-navy-900 via-gold-500 to-navy-900"></div>
                                <div class="grid grid-cols-12 divide-x divide-slate-100 p-6 gap-6">
                                    <!-- Dynamic Categories & Their Programs (8 Columns) -->
                                    <div class="col-span-8">
                                        <p class="text-[11px] font-bold uppercase tracking-widest text-gold-700 mb-3">Categories &amp; Programmes</p>
                                        <div class="grid grid-cols-2 gap-4 max-h-[340px] overflow-y-auto pr-1">
                                            @forelse($navCategories as $category)
                                                <div class="rounded-xl bg-slate-50/80 border border-slate-100 p-3.5">
                                                    <a href="{{ route('programs.index', ['department' => $category->slug]) }}"
                                                       class="flex items-center justify-between gap-2 text-sm font-bold text-navy-900 hover:text-gold-700 transition-colors">
                                                        <span>{{ $category->name }}</span>
                                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-white border border-slate-200 text-slate-600">
                                                            {{ $category->programs_count }}
                                                        </span>
                                                    </a>
                                                    @if($category->programs->isNotEmpty())
                                                        <ul class="mt-2.5 space-y-1 border-t border-slate-200/70 pt-2">
                                                            @foreach($category->programs->take(4) as $navProgram)
                                                                <li>
                                                                    <a href="{{ route('programs.show', $navProgram) }}"
                                                                       class="block text-xs text-slate-600 hover:text-gold-700 truncate py-0.5">
                                                                        &rsaquo; {{ $navProgram->title }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                            @if($category->programs->count() > 4)
                                                                <li>
                                                                    <a href="{{ route('programs.index', ['department' => $category->slug]) }}"
                                                                       class="block text-[11px] font-bold text-gold-700 hover:underline pt-0.5">
                                                                        View all {{ $category->programs->count() }} &rarr;
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    @else
                                                        <p class="mt-2 text-[11px] text-slate-400">Browse programs in this category &rarr;</p>
                                                    @endif
                                                </div>
                                            @empty
                                                <p class="text-xs text-slate-500 col-span-2">No categories available yet.</p>
                                            @endforelse
                                        </div>
                                    </div>

                                    <!-- Dynamic Qualification Levels (4 Columns) -->
                                    <div class="col-span-4 pl-6">
                                        <p class="text-[11px] font-bold uppercase tracking-widest text-gold-700 mb-3">By Level / Type</p>
                                        <div class="space-y-1.5">
                                            @foreach($navLevels as $navLevel)
                                                <a href="{{ route('programs.index', ['level' => $navLevel]) }}"
                                                   class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-navy-50/70 text-sm font-semibold text-navy-900 hover:text-gold-700 transition-colors">
                                                    <span>{{ $navLevel }}</span>
                                                    <span class="text-xs text-slate-400">&rarr;</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Mega-Dropdown Footer -->
                                <div class="bg-slate-50 border-t border-slate-200 px-6 py-3.5 flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-2 text-xs">
                                        <span class="text-slate-500 font-medium">Formats:</span>
                                        @foreach($navFormats as $navFormat)
                                            <a href="{{ route('programs.index', ['format' => $navFormat]) }}"
                                               class="px-2.5 py-1 rounded-full bg-white border border-slate-200 text-navy-900 font-semibold hover:border-gold-500">
                                                {{ $navFormat }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('programs.index') }}" class="text-xs font-bold text-gold-700 hover:text-navy-900 transition-colors">
                                        View Full Directory &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('admissions') }}"
                       class="px-3.5 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admissions') ? 'text-navy-900 bg-navy-50' : 'text-slate-700 hover:text-navy-900 hover:bg-slate-50' }}">
                        Admissions
                    </a>

                    <a href="{{ route('about') }}"
                       class="px-3.5 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('about') ? 'text-navy-900 bg-navy-50' : 'text-slate-700 hover:text-navy-900 hover:bg-slate-50' }}">
                        About GIEC
                    </a>

                    <a href="{{ route('contact') }}"
                       class="px-3.5 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('contact') ? 'text-navy-900 bg-navy-50' : 'text-slate-700 hover:text-navy-900 hover:bg-slate-50' }}">
                        Contact
                    </a>
                </nav>

                <!-- Desktop CTA + Mobile Menu Trigger -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('programs.index') }}"
                       class="hidden sm:inline-flex items-center gap-2 bg-navy-900 hover:bg-navy-800 text-white text-sm font-semibold px-4.5 py-2.5 px-5 rounded-xl border border-navy-900 shadow-sm transition-all hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-gold-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Find a Program</span>
                    </a>

                    <button type="button"
                            @click="mobileMenuOpen = true"
                            aria-label="Open navigation menu"
                            class="lg:hidden inline-flex items-center justify-center p-2.5 rounded-xl border border-slate-200 text-navy-900 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Alpine.js Mobile Slide-Over Menu with Accordions -->
    <div x-show="mobileMenuOpen"
         x-cloak
         class="fixed inset-0 z-50 lg:hidden"
         role="dialog"
         aria-modal="true">
        <div x-show="mobileMenuOpen"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileMenuOpen = false"
             class="fixed inset-0 bg-navy-950/65 backdrop-blur-sm"></div>

        <div x-show="mobileMenuOpen"
             x-transition:enter="transform transition ease-out duration-250"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transform transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             x-data="{ openMobileGroup: 'programs' }"
             class="fixed inset-y-0 right-0 w-full max-w-xs bg-white border-l border-slate-200 shadow-2xl flex flex-col justify-between p-6 overflow-y-auto">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-slate-200">
                    <img src="{{ asset('images/logo.webp') }}" alt="GIEC Logo" class="h-10 w-auto object-contain" />
                    <button type="button" @click="mobileMenuOpen = false" class="p-2 rounded-lg text-slate-500 hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="mt-5 space-y-1.5">
                    <a href="{{ route('home') }}"
                       class="block px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('home') ? 'bg-navy-900 text-white' : 'text-navy-900 hover:bg-slate-100' }}">
                        Home
                    </a>

                    <!-- Mobile Programs Accordion -->
                    <div class="rounded-xl border border-slate-200 overflow-hidden">
                        <button type="button"
                                @click="openMobileGroup = openMobileGroup === 'programs' ? null : 'programs'"
                                class="w-full flex items-center justify-between px-3.5 py-2.5 text-sm font-semibold text-navy-900 bg-slate-50">
                            <span>Programs &amp; Packages</span>
                            <svg class="w-4 h-4 transition-transform" :class="openMobileGroup === 'programs' ? 'rotate-180 text-gold-600' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="openMobileGroup === 'programs'" class="p-2 space-y-1 bg-white text-xs">
                            <a href="{{ route('programs.index') }}" class="block px-3 py-2 rounded-lg font-bold text-gold-700 hover:bg-gold-50">All Programs Directory &rarr;</a>
                            @foreach($navCategories as $category)
                                <a href="{{ route('programs.index', ['department' => $category->slug]) }}" class="block px-3 py-2 rounded-lg font-semibold text-navy-900 hover:bg-slate-50">
                                    {{ $category->name }} ({{ $category->programs_count }})
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('admissions') }}"
                       class="block px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('admissions') ? 'bg-navy-900 text-white' : 'text-navy-900 hover:bg-slate-100' }}">
                        Admissions
                    </a>

                    <a href="{{ route('about') }}"
                       class="block px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('about') ? 'bg-navy-900 text-white' : 'text-navy-900 hover:bg-slate-100' }}">
                        About GIEC
                    </a>

                    <a href="{{ route('contact') }}"
                       class="block px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('contact') ? 'bg-navy-900 text-white' : 'text-navy-900 hover:bg-slate-100' }}">
                        Contact
                    </a>
                </nav>
            </div>

            <div class="pt-6 mt-6 border-t border-slate-200 space-y-3">
                <a href="{{ route('programs.index') }}"
                   class="w-full inline-flex items-center justify-center gap-2 bg-gold-500 hover:bg-gold-600 text-white text-sm font-semibold px-4 py-3 rounded-xl shadow-sm">
                    Find a Program
                </a>
                <a href="https://wa.me/94761561870" target="_blank" rel="noopener"
                   class="w-full inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-navy-900 text-sm font-semibold px-4 py-2.5 rounded-xl">
                    WhatsApp Admissions
                </a>
            </div>
        </div>
    </div>

    <!-- Main Page Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Institutional Footer -->
    <footer class="bg-navy-950 text-slate-300 border-t-4 border-gold-500 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
                <!-- Institutional Overview with Official Crest Logo -->
                <div class="lg:col-span-4 space-y-4">
                    <a href="{{ route('home') }}" class="inline-block bg-white rounded-xl px-4 py-2.5 shadow-sm">
                        <img src="{{ asset('images/logo.webp') }}"
                             alt="Gordon International Eduventures College (GIEC)"
                             class="h-12 w-auto object-contain" />
                    </a>
                    <p class="text-sm text-slate-300/90 leading-relaxed">
                        Empowering ambitious Sri Lankan and international learners with UK-accredited qualifications, London English Levels 1–10 mastery, Higher National Diplomas, and executive leadership pathways.
                    </p>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-navy-900 border border-navy-700 text-xs text-gold-300 font-medium">
                        <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                        Scientia Est Potentia &middot; UK &amp; Spinnaker Accredited
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="lg:col-span-2">
                    <h4 class="font-heading text-xs font-bold uppercase tracking-wider text-white mb-4">Academic Portal</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-gold-400 transition-colors">Home</a></li>
                        <li><a href="{{ route('programs.index') }}" class="text-slate-400 hover:text-gold-400 transition-colors">Programs &amp; Packages</a></li>
                        <li><a href="{{ route('admissions') }}" class="text-slate-400 hover:text-gold-400 transition-colors">Admissions Process</a></li>
                        <li><a href="{{ route('about') }}" class="text-slate-400 hover:text-gold-400 transition-colors">About GIEC</a></li>
                        <li><a href="{{ route('contact') }}" class="text-slate-400 hover:text-gold-400 transition-colors">Contact Campus</a></li>
                    </ul>
                </div>

                <!-- Study Pathways -->
                <div class="lg:col-span-3">
                    <h4 class="font-heading text-xs font-bold uppercase tracking-wider text-white mb-4">Categories &amp; Pathways</h4>
                    <ul class="space-y-2.5 text-sm">
                        @foreach($navCategories->take(5) as $category)
                            <li>
                                <a href="{{ route('programs.index', ['department' => $category->slug]) }}" class="text-slate-400 hover:text-gold-400 transition-colors">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Campus Address & Hotline -->
                <div class="lg:col-span-3 space-y-3">
                    <h4 class="font-heading text-xs font-bold uppercase tracking-wider text-white mb-4">Colombo 03 Campus</h4>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        No. 408, 3rd Floor, Galle Road,<br>
                        Colombo 03, Sri Lanka
                    </p>
                    <div class="space-y-1.5 text-sm">
                        <p>
                            <span class="text-slate-500">Hotline / WhatsApp:</span><br>
                            <a href="https://wa.me/94761561870" target="_blank" rel="noopener" class="text-gold-400 font-semibold hover:underline">+94 76 156 1870</a>
                        </p>
                        <p>
                            <span class="text-slate-500">Admissions Email:</span><br>
                            <a href="mailto:admissions@giecollege.com" class="text-slate-200 hover:text-gold-400">admissions@giecollege.com</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-navy-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} Gordon International Eduventures College (GIEC). All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <span>giecollege.com</span>
                    <span>&middot;</span>
                    <span>Colombo 03, Sri Lanka</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
