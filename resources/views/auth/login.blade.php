@extends('layouts.app')

@section('title', 'Staff Portal Sign In — GIEC')

@section('content')
    <section class="max-w-md mx-auto px-4 sm:px-6 py-16 lg:py-24">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-lg overflow-hidden">
            <div class="bg-navy-950 px-8 py-6 border-b-4 border-gold-500 text-white">
                <div class="inline-block bg-white rounded-lg px-3 py-1.5 mb-3">
                    <img src="{{ asset('images/logo.webp') }}" alt="GIEC" class="h-8 w-auto object-contain" />
                </div>
                <h1 class="font-heading text-2xl font-bold text-white">Staff Admin Sign In</h1>
                <p class="text-xs text-slate-300 mt-1">Manage programs, student packages, and admissions leads.</p>
            </div>

            <form method="POST" action="{{ route('login.submit') }}" class="p-8 space-y-5">
                @csrf

                @if($errors->any())
                    <div class="rounded-xl bg-rose-50 border border-rose-200 px-4 py-3 text-xs text-rose-700 font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Staff Email Address</label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           placeholder="admin@giecollege.com"
                           class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-500 focus:ring-gold-500">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">Password</label>
                    <input id="password"
                           type="password"
                           name="password"
                           required
                           class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-500 focus:ring-gold-500">
                </div>

                <label class="flex items-center gap-2 text-xs text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-gold-600 focus:ring-gold-500">
                    <span>Keep me signed in on this workstation</span>
                </label>

                <button type="submit"
                        class="w-full bg-navy-900 hover:bg-navy-800 text-white font-semibold text-sm py-3 rounded-xl shadow-sm transition-colors">
                    Sign In
                </button>
            </form>
        </div>
    </section>
@endsection
