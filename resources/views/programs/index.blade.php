@extends('layouts.app')

@section('title', 'Programs & Student Packages — Gordon International Eduventures College (GIEC)')

@section('content')
    <!-- Editorial Page Header -->
    <section class="bg-navy-950 text-white border-b border-navy-800 relative overflow-hidden">
        <div class="absolute inset-0 editorial-grid-bg pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-14">
            <nav class="text-xs text-slate-400 flex items-center gap-2 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-gold-400 font-medium">Programs &amp; Student Packages</span>
            </nav>
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                <div class="max-w-3xl">
                    <h1 class="font-heading text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        Academic Programs &amp; Student Packages
                    </h1>
                    <p class="mt-3 text-slate-300 text-base leading-relaxed">
                        Filter across UK-accredited diplomas, London English Levels 1–10 certificates, undergraduate HNDs, BSc (Hons) top-ups, and postgraduate qualifications tailored for On-Campus, Online, and Hybrid study.
                    </p>
                </div>
                <div class="text-xs text-slate-300 bg-navy-800 border border-slate-700 rounded-xl px-4 py-3 shrink-0">
                    <span class="block text-gold-400 font-bold uppercase tracking-wider mb-0.5">Need Placement Help?</span>
                    Call or WhatsApp <a href="https://wa.me/94761561870" target="_blank" rel="noopener" class="text-white font-semibold underline">+94 76 156 1870</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Faceted Two-Column Directory (ORU-Inspired Layout) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-12"
             x-data="programDirectory(@js($programsPayload), @js($initialFilters))">

        <!-- Mobile Filter Trigger Bar -->
        <div class="lg:hidden flex items-center justify-between gap-3 mb-6 bg-white p-3.5 rounded-xl border border-slate-200">
            <button type="button"
                    @click="mobileFiltersOpen = true"
                    class="inline-flex items-center gap-2 bg-navy-900 text-white text-sm font-semibold px-4 py-2.5 rounded-lg">
                <svg class="w-4 h-4 text-gold-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                <span>Filter Programs</span>
                <span x-show="activeFilterCount > 0"
                      x-text="activeFilterCount"
                      class="ml-1 bg-gold-500 text-navy-950 text-xs font-bold px-1.5 py-0.5 rounded-full"></span>
            </button>
            <p class="text-sm font-semibold text-slate-700">
                <span x-text="filteredPrograms.length"></span> matching
            </p>
        </div>

        <!-- Mobile Slide-Over Filter Drawer -->
        <div x-show="mobileFiltersOpen" x-cloak class="fixed inset-0 z-50 lg:hidden" role="dialog" aria-modal="true">
            <div x-show="mobileFiltersOpen"
                 @click="mobileFiltersOpen = false"
                 class="fixed inset-0 bg-navy-950/60 backdrop-blur-sm"></div>
            <div class="fixed inset-y-0 left-0 w-full max-w-xs bg-white border-r border-slate-200 shadow-2xl overflow-y-auto p-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-200 mb-5">
                    <h2 class="font-heading font-bold text-lg text-navy-900">Filter Directory</h2>
                    <button type="button" @click="mobileFiltersOpen = false" class="p-2 rounded-lg text-slate-500 hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                @include('programs.partials.filter-controls', ['idPrefix' => 'mobile'])
                <button type="button"
                        @click="mobileFiltersOpen = false"
                        class="mt-6 w-full bg-navy-900 text-white font-semibold py-3 rounded-xl text-sm">
                    Show <span x-text="filteredPrograms.length"></span> Programs
                </button>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <!-- Left Sticky Filter Sidebar (~28% desktop) -->
            <aside class="hidden lg:block w-full lg:w-[28%] shrink-0 lg:sticky lg:top-24">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    @include('programs.partials.filter-controls', ['idPrefix' => 'desktop'])
                </div>
            </aside>

            <!-- Right Main Grid (~72% desktop) -->
            <div class="w-full lg:w-[72%] min-w-0">
                <!-- Results Counter & Active Filter Chips -->
                <div class="bg-white rounded-xl border border-slate-200 px-5 py-4 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold text-navy-900">
                            Showing <span class="text-gold-700 font-bold" x-text="filteredPrograms.length"></span>
                            <span x-text="filteredPrograms.length === 1 ? 'Program & Student Package' : 'Programs & Student Packages'"></span>
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-2" x-show="activeFilterCount > 0" x-cloak>
                        <template x-for="lvl in filters.levels" :key="'chip-l-' + lvl">
                            <button type="button" @click="toggleArrayFilter('levels', lvl)"
                                    class="inline-flex items-center gap-1.5 text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-navy-900 px-2.5 py-1 rounded-full">
                                <span x-text="lvl"></span>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </template>
                        <template x-for="fmt in filters.formats" :key="'chip-f-' + fmt">
                            <button type="button" @click="toggleArrayFilter('formats', fmt)"
                                    class="inline-flex items-center gap-1.5 text-xs font-semibold bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-200 px-2.5 py-1 rounded-full">
                                <span x-text="fmt"></span>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </template>
                        <button type="button" @click="resetFilters()"
                                class="text-xs font-semibold text-rose-600 hover:text-rose-700 underline ml-1">
                            Reset all
                        </button>
                    </div>
                </div>

                <!-- 3-Column Program Cards Grid -->
                <div x-show="filteredPrograms.length > 0"
                     class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    <template x-for="program in filteredPrograms" :key="program.id">
                        <article class="group bg-white rounded-xl border border-slate-200 p-5 flex flex-col justify-between transition-all duration-200 hover:-translate-y-1 hover:shadow-lg hover:border-slate-300">
                            <div>
                                <!-- Format Pill Badges -->
                                <div class="flex flex-wrap items-center gap-1.5 mb-3.5">
                                    <template x-for="format in program.formats" :key="program.id + '-' + format">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold border"
                                              :class="formatBadgeClass(format)"
                                              x-text="format"></span>
                                    </template>
                                </div>

                                <!-- Department Label -->
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gold-600 mb-1.5"
                                   x-text="program.department_name"></p>

                                <!-- Bold Program Title -->
                                <h2 class="font-heading text-lg font-bold text-navy-900 group-hover:text-gold-700 transition-colors leading-snug">
                                    <a :href="program.url" x-text="program.title"></a>
                                </h2>

                                <p class="mt-2.5 text-xs text-slate-600 leading-relaxed line-clamp-3"
                                   x-text="program.summary"></p>
                            </div>

                            <div class="mt-5 pt-4 border-t border-slate-100 space-y-3">
                                <!-- Duration & Level Metadata -->
                                <div class="flex items-center justify-between text-xs">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-semibold"
                                          x-text="program.level"></span>
                                    <span class="text-slate-500 font-medium truncate ml-2" x-text="program.duration"></span>
                                </div>

                                <div class="flex items-center justify-between text-xs text-slate-500">
                                    <span x-text="program.package_count + ' Package Tiers'"></span>
                                    <span class="font-semibold text-navy-900" x-text="'From ' + program.starting_fee"></span>
                                </div>

                                <a :href="program.url"
                                   class="w-full inline-flex items-center justify-between px-3.5 py-2.5 rounded-lg bg-slate-50 group-hover:bg-navy-900 text-navy-900 group-hover:text-white border border-slate-200 group-hover:border-navy-900 text-xs font-semibold transition-colors">
                                    <span>View Package &amp; Apply</span>
                                    <span>&rarr;</span>
                                </a>
                            </div>
                        </article>
                    </template>
                </div>

                <!-- Clean Empty State UI when 0 Results Match -->
                <div x-show="filteredPrograms.length === 0"
                     x-cloak
                     class="bg-white rounded-2xl border border-slate-200 p-12 text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-4">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-navy-900">No matching programs found</h3>
                    <p class="mt-2 text-sm text-slate-600 max-w-md mx-auto">
                        Try clearing one or more study format, program level, or department checkboxes to view all available GIEC qualifications.
                    </p>
                    <button type="button"
                            @click="resetFilters()"
                            class="mt-6 inline-flex items-center gap-2 bg-navy-900 hover:bg-navy-800 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors">
                        Reset All Filters
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function programDirectory(allPrograms, initialFilters) {
        return {
            programs: allPrograms,
            mobileFiltersOpen: false,
            filters: {
                search: initialFilters.search || '',
                levels: Array.isArray(initialFilters.levels) ? initialFilters.levels : [],
                formats: Array.isArray(initialFilters.formats) ? initialFilters.formats : [],
                departments: Array.isArray(initialFilters.departments) ? initialFilters.departments : [],
            },

            init() {
                this.$watch('filters', () => {
                    this.syncUrlParams();
                }, { deep: true });
            },

            get activeFilterCount() {
                return (this.filters.search.trim() !== '' ? 1 : 0)
                    + this.filters.levels.length
                    + this.filters.formats.length
                    + this.filters.departments.length;
            },

            get filteredPrograms() {
                const term = this.filters.search.trim().toLowerCase();

                return this.programs.filter((program) => {
                    if (term !== '') {
                        const haystack = [
                            program.title,
                            program.summary,
                            program.level,
                            program.department_name,
                            program.accreditation,
                            ...(program.formats || []),
                        ].join(' ').toLowerCase();

                        if (!haystack.includes(term)) {
                            return false;
                        }
                    }

                    if (this.filters.levels.length > 0 && !this.filters.levels.includes(program.level)) {
                        return false;
                    }

                    if (this.filters.formats.length > 0) {
                        const programFormats = program.formats || [];
                        const hasFormatMatch = this.filters.formats.some((fmt) => programFormats.includes(fmt));
                        if (!hasFormatMatch) {
                            return false;
                        }
                    }

                    if (this.filters.departments.length > 0) {
                        const deptMatch = this.filters.departments.includes(program.department_slug)
                            || this.filters.departments.includes(program.department_name);
                        if (!deptMatch) {
                            return false;
                        }
                    }

                    return true;
                });
            },

            toggleArrayFilter(key, value) {
                const idx = this.filters[key].indexOf(value);
                if (idx === -1) {
                    this.filters[key].push(value);
                } else {
                    this.filters[key].splice(idx, 1);
                }
            },

            resetFilters() {
                this.filters.search = '';
                this.filters.levels = [];
                this.filters.formats = [];
                this.filters.departments = [];
            },

            formatBadgeClass(format) {
                if (format === 'Online') {
                    return 'bg-sky-50 text-sky-800 border-sky-200';
                }
                if (format === 'Hybrid') {
                    return 'bg-amber-50 text-amber-800 border-amber-200';
                }
                return 'bg-emerald-50 text-emerald-800 border-emerald-200';
            },

            syncUrlParams() {
                const params = new URLSearchParams();
                if (this.filters.search.trim() !== '') {
                    params.set('q', this.filters.search.trim());
                }
                if (this.filters.levels.length > 0) {
                    params.set('level', this.filters.levels.join(','));
                }
                if (this.filters.formats.length > 0) {
                    params.set('format', this.filters.formats.join(','));
                }
                if (this.filters.departments.length > 0) {
                    params.set('department', this.filters.departments.join(','));
                }
                const queryString = params.toString();
                const nextUrl = queryString ? `${window.location.pathname}?${queryString}` : window.location.pathname;
                window.history.replaceState({}, '', nextUrl);
            }
        };
    }
</script>
@endpush
