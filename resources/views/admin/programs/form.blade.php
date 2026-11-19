@php
    $initialModules = old('modules', $program->modules ?: [['title' => '', 'description' => '']]);
    $initialRequirements = old('entry_requirements', $program->entry_requirements ?: ['']);
    $initialPackages = old('student_packages', $program->student_packages ?: [[
        'name' => 'Standard Track Package',
        'fee' => '',
        'badge' => 'Popular',
        'features' => [''],
    ]]);
    $selectedFormats = old('formats', $program->formats ?? ['On-Campus']);
@endphp

<div class="space-y-8"
     x-data="programEditor({
        modules: @js(array_values($initialModules)),
        requirements: @js(array_values($initialRequirements)),
        packages: @js(array_values($initialPackages))
     })">

    <!-- Core Program Metadata -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h2 class="font-heading text-lg font-bold text-navy-900">Core Program Details</h2>
            <p class="text-xs text-slate-500 mt-0.5">Basic metadata displayed in the /programs directory and hero header.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="title" class="block text-xs font-semibold text-slate-700 mb-1.5">Program Title *</label>
                <input id="title" type="text" name="title" value="{{ old('title', $program->title) }}" required
                       class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
            </div>

            <div>
                <label for="slug" class="block text-xs font-semibold text-slate-700 mb-1.5">URL Slug <span class="text-slate-400 font-normal">(auto-generated if blank)</span></label>
                <input id="slug" type="text" name="slug" value="{{ old('slug', $program->slug) }}"
                       placeholder="e.g. diploma-in-english-uk"
                       class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
            </div>

            <div class="space-y-2.5">
                <div>
                    <label for="department_id" class="block text-xs font-semibold text-slate-700 mb-1.5">Category / Department *</label>
                    <select id="department_id" name="department_id"
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" @selected((int) old('department_id', $program->department_id) === $dept->id)>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="new_department_name" class="block text-[11px] font-semibold text-slate-500 mb-1">Or Create New Category Inline (Optional)</label>
                    <input id="new_department_name"
                           type="text"
                           name="new_department_name"
                           value="{{ old('new_department_name') }}"
                           placeholder="Type new category name to add & assign..."
                           class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white text-xs focus:border-gold-600 focus:ring-gold-600">
                </div>
            </div>

            <div>
                <label for="level" class="block text-xs font-semibold text-slate-700 mb-1.5">Program Level / Type * <span class="text-slate-400 font-normal">(select or type custom)</span></label>
                <input id="level"
                       type="text"
                       name="level"
                       list="program-level-presets"
                       value="{{ old('level', $program->level ?: 'Diploma') }}"
                       required
                       placeholder="e.g. Diploma, Certificate, Student Package..."
                       class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                <datalist id="program-level-presets">
                    @foreach($levels as $level)
                        <option value="{{ $level }}">
                    @endforeach
                </datalist>
            </div>

            <div>
                <label for="duration" class="block text-xs font-semibold text-slate-700 mb-1.5">Duration *</label>
                <input id="duration" type="text" name="duration" value="{{ old('duration', $program->duration) }}" required
                       placeholder="e.g. 6 Months (Full-Time / Weekend)"
                       class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
            </div>

            <div>
                <label for="next_intake" class="block text-xs font-semibold text-slate-700 mb-1.5">Next Intake *</label>
                <input id="next_intake" type="text" name="next_intake" value="{{ old('next_intake', $program->next_intake) }}" required
                       placeholder="e.g. January & May Intakes"
                       class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
            </div>

            <div class="md:col-span-2">
                <label for="accreditation" class="block text-xs font-semibold text-slate-700 mb-1.5">Accreditation / Awarding Standard *</label>
                <input id="accreditation" type="text" name="accreditation" value="{{ old('accreditation', $program->accreditation) }}" required
                       placeholder="e.g. UK / Spinnaker School Accredited"
                       class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
            </div>
        </div>

        <!-- Study Formats -->
        <div>
            <p class="block text-xs font-semibold text-slate-700 mb-2">Study Formats * (Select at least one)</p>
            <div class="flex flex-wrap gap-4">
                @foreach($formats as $format)
                    <label class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                        <input type="checkbox"
                               name="formats[]"
                               value="{{ $format }}"
                               @checked(in_array($format, $selectedFormats ?? []))
                               class="rounded border-slate-300 text-gold-600 focus:ring-gold-600">
                        <span class="text-sm font-medium text-navy-900">{{ $format }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Summary & Overview -->
        <div class="space-y-4">
            <div>
                <label for="summary" class="block text-xs font-semibold text-slate-700 mb-1.5">Card Summary *</label>
                <textarea id="summary" name="summary" rows="2" required
                          class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">{{ old('summary', $program->summary) }}</textarea>
            </div>

            <div>
                <label for="overview" class="block text-xs font-semibold text-slate-700 mb-1.5">Detailed Program Overview &amp; Career Pathways *</label>
                <textarea id="overview" name="overview" rows="5" required
                          class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">{{ old('overview', $program->overview) }}</textarea>
            </div>
        </div>

        <!-- Visibility Toggles -->
        <div class="flex flex-wrap items-center gap-6 pt-2">
            <label class="inline-flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $program->is_published))
                       class="rounded border-slate-300 text-gold-600 focus:ring-gold-600">
                <span class="text-sm font-semibold text-navy-900">Published on Public Website</span>
            </label>
            <label class="inline-flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $program->is_featured))
                       class="rounded border-slate-300 text-gold-600 focus:ring-gold-600">
                <span class="text-sm font-semibold text-navy-900">Feature on Homepage</span>
            </label>
        </div>
    </div>

    <!-- Alpine.js Repeater: Student Package Tiers -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
            <div>
                <h2 class="font-heading text-lg font-bold text-navy-900">Student Packages &amp; Fee Tiers</h2>
                <p class="text-xs text-slate-500 mt-0.5">Define Standard, Fast-Track, or Complete UK Certification packages shown on the course page and Brevo confirmation emails.</p>
            </div>
            <button type="button"
                    @click="addPackage()"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-navy-900 hover:bg-navy-800 text-white text-xs font-semibold shrink-0">
                + Add Package Tier
            </button>
        </div>

        <div class="space-y-5">
            <template x-for="(pkg, pkgIdx) in packages" :key="'pkg-' + pkgIdx">
                <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-5 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gold-700" x-text="'Package Tier #' + (pkgIdx + 1)"></span>
                        <button type="button"
                                x-show="packages.length > 1"
                                @click="removePackage(pkgIdx)"
                                class="text-xs font-semibold text-rose-600 hover:text-rose-700">
                            Remove Tier
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Package Name</label>
                            <input type="text"
                                   :name="`student_packages[${pkgIdx}][name]`"
                                   x-model="pkg.name"
                                   placeholder="e.g. Standard Track Package"
                                   class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-gold-600 focus:ring-gold-600">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Fee</label>
                            <input type="text"
                                   :name="`student_packages[${pkgIdx}][fee]`"
                                   x-model="pkg.fee"
                                   placeholder="e.g. LKR 65,000"
                                   class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-gold-600 focus:ring-gold-600">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Badge (Optional)</label>
                            <input type="text"
                                   :name="`student_packages[${pkgIdx}][badge]`"
                                   x-model="pkg.badge"
                                   placeholder="e.g. Best Value"
                                   class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-gold-600 focus:ring-gold-600">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-xs font-semibold text-slate-700">Included Package Benefits</label>
                            <button type="button"
                                    @click="addPackageFeature(pkgIdx)"
                                    class="text-xs font-semibold text-gold-700 hover:text-gold-800">
                                + Add Benefit
                            </button>
                        </div>
                        <div class="space-y-2">
                            <template x-for="(feat, fIdx) in pkg.features" :key="'feat-' + pkgIdx + '-' + fIdx">
                                <div class="flex items-center gap-2">
                                    <input type="text"
                                           :name="`student_packages[${pkgIdx}][features][${fIdx}]`"
                                           x-model="pkg.features[fIdx]"
                                           placeholder="e.g. Official UK-endorsed Diploma certificate"
                                           class="flex-1 rounded-xl border-slate-200 bg-white text-sm focus:border-gold-600 focus:ring-gold-600">
                                    <button type="button"
                                            x-show="pkg.features.length > 1"
                                            @click="removePackageFeature(pkgIdx, fIdx)"
                                            class="px-2.5 py-2 rounded-lg text-xs font-semibold text-rose-600 hover:bg-rose-50">
                                        &times;
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Alpine.js Repeater: Syllabus Modules -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
            <div>
                <h2 class="font-heading text-lg font-bold text-navy-900">Curriculum &amp; Syllabus Modules</h2>
                <p class="text-xs text-slate-500 mt-0.5">Add interactive accordion modules displayed on the program page.</p>
            </div>
            <button type="button"
                    @click="addModule()"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-navy-900 hover:bg-navy-800 text-white text-xs font-semibold shrink-0">
                + Add Module
            </button>
        </div>

        <div class="space-y-4">
            <template x-for="(mod, mIdx) in modules" :key="'mod-' + mIdx">
                <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500" x-text="'Module #' + (mIdx + 1)"></span>
                        <button type="button"
                                x-show="modules.length > 1"
                                @click="removeModule(mIdx)"
                                class="text-xs font-semibold text-rose-600 hover:text-rose-700">
                            Remove
                        </button>
                    </div>
                    <input type="text"
                           :name="`modules[${mIdx}][title]`"
                           x-model="mod.title"
                           placeholder="Module title (e.g. Module 1: Advanced Grammar & Syntax)"
                           class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-gold-600 focus:ring-gold-600">
                    <textarea rows="2"
                              :name="`modules[${mIdx}][description]`"
                              x-model="mod.description"
                              placeholder="Short description of topics covered..."
                              class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-gold-600 focus:ring-gold-600"></textarea>
                </div>
            </template>
        </div>
    </div>

    <!-- Alpine.js Repeater: Entry Requirements -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
            <div>
                <h2 class="font-heading text-lg font-bold text-navy-900">Entry Requirements</h2>
                <p class="text-xs text-slate-500 mt-0.5">Clear admission prerequisites displayed to prospective applicants.</p>
            </div>
            <button type="button"
                    @click="addRequirement()"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-navy-900 hover:bg-navy-800 text-white text-xs font-semibold shrink-0">
                + Add Requirement
            </button>
        </div>

        <div class="space-y-2.5">
            <template x-for="(req, rIdx) in requirements" :key="'req-' + rIdx">
                <div class="flex items-center gap-2">
                    <input type="text"
                           :name="`entry_requirements[${rIdx}]`"
                           x-model="requirements[rIdx]"
                           placeholder="e.g. G.C.E. O/L pass in English or equivalent proficiency"
                           class="flex-1 rounded-xl border-slate-200 text-sm focus:border-gold-600 focus:ring-gold-600">
                    <button type="button"
                            x-show="requirements.length > 1"
                            @click="removeRequirement(rIdx)"
                            class="px-3 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-rose-600 hover:bg-rose-50">
                        Remove
                    </button>
                </div>
            </template>
        </div>
    </div>

    <!-- Save Action Bar -->
    <div class="flex items-center justify-end gap-4 pt-2">
        <a href="{{ route('admin.programs.index') }}"
           class="px-5 py-3 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-700 hover:bg-slate-50">
            Cancel
        </a>
        <button type="submit"
                class="px-6 py-3 rounded-xl bg-gold-600 hover:bg-gold-500 text-white text-sm font-bold shadow-sm transition-colors">
            {{ $program->exists ? 'Save Program Changes' : 'Create Program' }}
        </button>
    </div>
</div>

@push('scripts')
<script>
    function programEditor(initial) {
        return {
            modules: initial.modules.length ? initial.modules : [{ title: '', description: '' }],
            requirements: initial.requirements.length ? initial.requirements : [''],
            packages: initial.packages.length ? initial.packages.map(pkg => ({
                name: pkg.name || '',
                fee: pkg.fee || '',
                badge: pkg.badge || '',
                features: Array.isArray(pkg.features) && pkg.features.length ? pkg.features : [''],
            })) : [{ name: '', fee: '', badge: '', features: [''] }],

            addModule() {
                this.modules.push({ title: '', description: '' });
            },
            removeModule(index) {
                this.modules.splice(index, 1);
            },
            addRequirement() {
                this.requirements.push('');
            },
            removeRequirement(index) {
                this.requirements.splice(index, 1);
            },
            addPackage() {
                this.packages.push({ name: '', fee: '', badge: '', features: [''] });
            },
            removePackage(index) {
                this.packages.splice(index, 1);
            },
            addPackageFeature(pkgIdx) {
                this.packages[pkgIdx].features.push('');
            },
            removePackageFeature(pkgIdx, featIdx) {
                this.packages[pkgIdx].features.splice(featIdx, 1);
            }
        };
    }
</script>
@endpush
