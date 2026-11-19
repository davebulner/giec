<div class="space-y-6">
    <!-- Filter Header & Reset -->
    <div class="flex items-center justify-between pb-4 border-b border-slate-200">
        <div class="flex items-center gap-2">
            <h2 class="font-heading font-bold text-base text-navy-900">Filter Programs</h2>
            <span x-show="activeFilterCount > 0"
                  x-cloak
                  x-text="activeFilterCount"
                  class="inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 rounded-full text-[11px] font-bold bg-gold-600 text-white"></span>
        </div>
        <button type="button"
                @click="resetFilters()"
                x-show="activeFilterCount > 0"
                x-cloak
                class="text-xs font-semibold text-gold-700 hover:text-gold-800 transition-colors">
            Reset Filters
        </button>
    </div>

    <!-- Instant Keyword Search -->
    <div>
        <label for="{{ $idPrefix }}-search" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
            Keyword Search
        </label>
        <div class="relative">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input id="{{ $idPrefix }}-search"
                   type="text"
                   x-model="filters.search"
                   placeholder="Search program name..."
                   class="w-full pl-9 pr-8 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm text-navy-900 placeholder-slate-400 focus:border-gold-600 focus:ring-gold-600">
            <button type="button"
                    x-show="filters.search !== ''"
                    x-cloak
                    @click="filters.search = ''"
                    aria-label="Clear search"
                    class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs font-bold">
                &times;
            </button>
        </div>
    </div>

    <!-- Program Level Checkboxes -->
    <div class="pt-4 border-t border-slate-100">
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Program Level</p>
        <div class="space-y-2.5">
            @foreach($levels as $level)
                <label class="flex items-center justify-between cursor-pointer group">
                    <span class="flex items-center gap-2.5">
                        <input type="checkbox"
                               value="{{ $level }}"
                               x-model="filters.levels"
                               class="rounded border-slate-300 text-gold-600 focus:ring-gold-600">
                        <span class="text-sm text-slate-700 group-hover:text-navy-900 font-medium">{{ $level }}</span>
                    </span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Study Format Checkboxes -->
    <div class="pt-4 border-t border-slate-100">
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Study Format</p>
        <div class="space-y-2.5">
            @foreach($formats as $format)
                <label class="flex items-center justify-between cursor-pointer group">
                    <span class="flex items-center gap-2.5">
                        <input type="checkbox"
                               value="{{ $format }}"
                               x-model="filters.formats"
                               class="rounded border-slate-300 text-gold-600 focus:ring-gold-600">
                        <span class="text-sm text-slate-700 group-hover:text-navy-900 font-medium">{{ $format }}</span>
                    </span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Department / Faculty Checkboxes -->
    <div class="pt-4 border-t border-slate-100">
        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Department / Faculty</p>
        <div class="space-y-2.5">
            @foreach($departments as $dept)
                <label class="flex items-center justify-between cursor-pointer group gap-2">
                    <span class="flex items-center gap-2.5">
                        <input type="checkbox"
                               value="{{ $dept->slug }}"
                               x-model="filters.departments"
                               class="rounded border-slate-300 text-gold-600 focus:ring-gold-600">
                        <span class="text-sm text-slate-700 group-hover:text-navy-900 font-medium">{{ $dept->name }}</span>
                    </span>
                    <span class="text-xs text-slate-400 font-semibold">{{ $dept->programs_count }}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>
