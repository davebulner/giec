@extends('layouts.app')

@section('title', 'Contact Campus — Gordon International Eduventures College (GIEC)')

@section('content')
    <section class="bg-navy-950 text-white border-b border-navy-800 relative overflow-hidden">
        <div class="absolute inset-0 editorial-grid-bg pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-16">
            <p class="text-xs font-bold uppercase tracking-widest text-gold-400 mb-3">Colombo 03 Campus &amp; Support</p>
            <h1 class="font-heading text-3xl sm:text-5xl font-extrabold text-white tracking-tight max-w-3xl">
                Connect with GIEC Admissions
            </h1>
            <p class="mt-4 text-lg text-slate-300 max-w-2xl leading-relaxed">
                Visit our Galle Road campus in Colombo 03, chat directly with an advisor on WhatsApp, or send us a message below.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            <!-- Left Campus Details & Embedded Map -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 space-y-6">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gold-600 mb-1">Campus Location</p>
                        <h2 class="font-heading text-xl font-bold text-navy-900">Gordon International Eduventures College</h2>
                        <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                            No. 408, 3rd Floor, Galle Road,<br>
                            Colombo 03, Sri Lanka
                        </p>
                    </div>

                    <div class="pt-5 border-t border-slate-100 space-y-3 text-sm">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Admissions Hotline &amp; WhatsApp</p>
                            <a href="tel:+94761561870" class="text-navy-900 font-bold text-base hover:text-gold-700">+94 76 156 1870</a>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Email</p>
                            <a href="mailto:admissions@giecollege.com" class="text-navy-900 font-semibold hover:text-gold-700">admissions@giecollege.com</a>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Campus Hours</p>
                            <p class="text-slate-600">Monday – Saturday: 8:30 AM – 6:00 PM</p>
                        </div>
                    </div>

                    <a href="https://wa.me/94761561870?text={{ urlencode('Hello GIEC Admissions, I would like information about your programs and student packages.') }}"
                       target="_blank"
                       rel="noopener"
                       class="w-full inline-flex items-center justify-center gap-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm px-5 py-3.5 rounded-xl transition-colors shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.031 2c-5.516 0-9.969 4.453-9.969 9.969 0 1.766.453 3.484 1.328 5l-1.391 5.063 5.188-1.359c1.469.797 3.125 1.219 4.844 1.219 5.516 0 9.969-4.453 9.969-9.969s-4.453-9.922-9.969-9.922zm5.797 14.078c-.25.703-1.438 1.344-1.984 1.422-.516.078-1.156.109-1.875-.125-.438-.141-1-.328-1.719-.641-3.031-1.313-5-4.375-5.156-4.578-.156-.203-1.234-1.641-1.234-3.125s.781-2.219 1.063-2.516c.281-.297.609-.375.813-.375.203 0 .406 0 .578.016.188.016.438-.078.688.531.25.609.859 2.094.938 2.25.078.156.125.344.031.547-.094.203-.141.328-.297.5-.156.172-.328.391-.469.516-.156.156-.313.328-.141.641.172.313.781 1.281 1.672 2.078 1.156 1.031 2.125 1.344 2.438 1.5.313.156.484.125.672-.078.188-.203.781-.906.984-1.219.203-.313.422-.266.703-.156.281.109 1.797.844 2.109 1 .313.156.516.234.594.359.078.125.078.734-.172 1.438z"/>
                        </svg>
                        <span>Chat Directly on WhatsApp</span>
                    </a>
                </div>

                <!-- Embedded Google Map for Galle Road, Colombo 03 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <iframe title="GIEC Campus Map - 408 Galle Road, Colombo 03"
                            src="https://maps.google.com/maps?q=408%20Galle%20Road,%20Colombo%2003,%20Sri%20Lanka&t=&z=15&ie=UTF8&iwloc=&output=embed"
                            class="w-full h-64 border-0"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Right General Inquiry Form (Wired to Brevo) -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-10">
                    <div class="mb-6">
                        <p class="text-xs font-bold uppercase tracking-widest text-gold-600">Send a Message</p>
                        <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-navy-900 mt-1">General Admissions Inquiry</h2>
                        <p class="mt-2 text-sm text-slate-600">
                            Have questions about upcoming intakes, corporate group training, or credit transfers? Submit this form to receive an instant email confirmation and advisor callback.
                        </p>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact-name" class="block text-xs font-semibold text-slate-700 mb-1.5">Full Name *</label>
                                <input id="contact-name" type="text" name="full_name" value="{{ old('full_name') }}" required
                                       placeholder="Your full name"
                                       class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                            </div>

                            <div>
                                <label for="contact-email" class="block text-xs font-semibold text-slate-700 mb-1.5">Email Address *</label>
                                <input id="contact-email" type="email" name="email" value="{{ old('email') }}" required
                                       placeholder="you@example.com"
                                       class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact-phone" class="block text-xs font-semibold text-slate-700 mb-1.5">Phone / WhatsApp *</label>
                                <input id="contact-phone" type="text" name="phone" value="{{ old('phone') }}" required
                                       placeholder="+94 77 123 4567"
                                       class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                            </div>

                            <div>
                                <label for="contact-format" class="block text-xs font-semibold text-slate-700 mb-1.5">Preferred Study Mode</label>
                                <select id="contact-format" name="preferred_format"
                                        class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                                    <option value="">Any Study Mode</option>
                                    @foreach($formats as $fmt)
                                        <option value="{{ $fmt }}" @selected(old('preferred_format') === $fmt)>{{ $fmt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="contact-program" class="block text-xs font-semibold text-slate-700 mb-1.5">Program of Interest (Optional)</label>
                            <select id="contact-program" name="program_id"
                                    class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                                <option value="">General Admissions / Not Decided Yet</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" @selected((string) old('program_id') === (string) $program->id)>
                                        {{ $program->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="contact-message" class="block text-xs font-semibold text-slate-700 mb-1.5">Message / Questions *</label>
                            <textarea id="contact-message" name="message" rows="4" required
                                      placeholder="Tell us about your academic background or questions..."
                                      class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-navy-900 hover:bg-navy-800 text-white font-semibold text-sm px-7 py-3.5 rounded-xl transition-colors shadow-sm">
                            Send Inquiry &amp; Request Callback
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
