<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
    <title>@yield('title', 'Staff Admin Portal — GIEC')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-canvas text-slate-800 font-sans">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Admin Sidebar -->
        <aside class="w-full lg:w-64 bg-navy-950 text-slate-300 border-b lg:border-b-0 lg:border-r border-navy-800 shrink-0 flex flex-col justify-between">
            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}" class="block bg-white rounded-xl p-3 mb-2 shadow-sm">
                    <img src="{{ asset('images/logo.webp') }}" alt="GIEC" class="h-10 w-auto object-contain mx-auto" />
                </a>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-gold-400 text-center pb-5 border-b border-navy-800">
                    Admissions Staff Portal
                </p>

                <nav class="mt-6 space-y-1.5">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-navy-800 text-white border border-navy-700' : 'text-slate-400 hover:text-white hover:bg-navy-900' }}">
                        <svg class="w-4 h-4 text-gold-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Overview</span>
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-navy-800 text-white border border-navy-700' : 'text-slate-400 hover:text-white hover:bg-navy-900' }}">
                        <svg class="w-4 h-4 text-gold-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Categories &amp; Navbar</span>
                    </a>

                    <a href="{{ route('admin.programs.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.programs.*') ? 'bg-navy-800 text-white border border-navy-700' : 'text-slate-400 hover:text-white hover:bg-navy-900' }}">
                        <svg class="w-4 h-4 text-gold-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Programs &amp; Packages</span>
                    </a>

                    <a href="{{ route('admin.inquiries.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.inquiries.*') ? 'bg-navy-800 text-white border border-navy-700' : 'text-slate-400 hover:text-white hover:bg-navy-900' }}">
                        <svg class="w-4 h-4 text-gold-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Inquiries &amp; Leads</span>
                    </a>
                </nav>
            </div>

            <div class="p-6 border-t border-navy-800 space-y-3">
                <a href="{{ route('home') }}" target="_blank" rel="noopener"
                   class="flex items-center justify-between px-3.5 py-2 rounded-lg text-xs font-semibold text-slate-300 bg-navy-900 hover:bg-navy-800 border border-navy-700 transition-colors">
                    <span>View Live Site</span>
                    <svg class="w-3.5 h-3.5 text-gold-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>

                <div class="flex items-center justify-between pt-2">
                    <div class="truncate pr-2">
                        <p class="text-xs font-semibold text-white truncate">{{ auth()->user()?->name }}</p>
                        <p class="text-[11px] text-slate-400 truncate">{{ auth()->user()?->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs font-semibold text-rose-400 hover:text-rose-300 transition-colors">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Admin Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white border-b border-slate-200 px-6 lg:px-10 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="font-heading text-xl font-bold text-navy-900">@yield('page_title', 'Admin Dashboard')</h1>
                    @hasSection('page_subtitle')
                        <p class="text-sm text-slate-500 mt-0.5">@yield('page_subtitle')</p>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    @yield('header_actions')
                </div>
            </header>

            <main class="flex-1 p-6 lg:p-10">
                @if(session('success'))
                    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800 flex items-center justify-between">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                        <p class="font-semibold mb-1">Please fix the following errors:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
