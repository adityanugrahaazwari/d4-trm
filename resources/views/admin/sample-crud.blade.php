@extends('layouts.admin')

@php
    $sec = $section ?? 'data';
    $titleMap = [
        'sejarah' => 'Sejarah Program Studi',
        'visi-misi' => 'Visi & Misi Program Studi',
        'sambutan' => 'Sambutan Ketua Program Studi',
        'struktur' => 'Struktur Organisasi',
        'dosen' => 'Data Dosen Pengajar',
        'tendik' => 'Data Tenaga Kependidikan',
        'kurikulum' => 'Manajemen Kurikulum',
        'mata-kuliah' => 'Daftar Mata Kuliah',
        'kalender' => 'Kalender Akademik',
        'cpl' => 'Capaian Pembelajaran Lulusan (CPL)',
        'profil-lulusan' => 'Profil Lulusan',
        'berita' => 'Berita Program Studi',
        'kategori-berita' => 'Kategori Berita',
        'pengumuman' => 'Pengumuman Akademik',
        'agenda' => 'Agenda Kegiatan',
        'fasilitas' => 'Data Fasilitas & Laboratorium',
        'album-galeri' => 'Album Galeri',
        'foto-galeri' => 'Foto & Dokumentasi',
        'identitas' => 'Identitas Website',
        'homepage' => 'Pengaturan Homepage & Hero',
        'kontak-sosmed' => 'Kontak & Media Sosial',
        'logo-favicon' => 'Logo & Favicon Website',
        'media-list' => 'Daftar Berkas Media',
        'media-upload' => 'Unggah Berkas Media',
        'users' => 'Manajemen Pengguna',
        'roles' => 'Manajemen Peran (Roles)',
        'permissions' => 'Hak Akses Sistem (Permissions)',
        'my-profile' => 'Profil Akun Pengelola',
    ];

    $title = $titleMap[$sec] ?? ucfirst(str_replace('-', ' ', $sec));
    $isFormOnly = in_array($sec, ['sejarah', 'visi-misi', 'sambutan', 'struktur', 'identitas', 'homepage', 'kontak-sosmed', 'logo-favicon', 'my-profile', 'media-upload']);
    $isMediaGrid = ($sec === 'media-list');

    // Filter, Search, Pagination Parameters
    $searchQuery = trim((string) request('q', ''));
    $roleFilter = trim((string) request('role', ''));
    $moduleFilter = trim((string) request('module', ''));
    $statusFilter = trim((string) request('status', ''));
    $perPage = (int) request('per_page', 10);
    if (! in_array($perPage, [5, 10, 25, 50], true)) {
        $perPage = 10;
    }

    // Single Record Form Records
    $profileRecord = in_array($sec, ['sejarah', 'visi-misi', 'sambutan', 'struktur'])
        ? \App\Models\StudyProgramProfile::forSection($sec)
        : null;

    $settingsRecord = in_array($sec, ['identitas', 'homepage', 'kontak-sosmed', 'logo-favicon'])
        ? \App\Models\Setting::pluck('value', 'key')->all()
        : [];

    // Helper Collections for Dropdowns
    $allRoles = in_array($sec, ['users', 'roles', 'permissions']) ? \App\Models\Role::where('is_active', true)->get() : collect();
    $allPermissions = in_array($sec, ['users', 'roles', 'permissions']) ? \App\Models\Permission::where('is_active', true)->get() : collect();
    $allModules = ($sec === 'permissions') ? \App\Models\Permission::select('module')->distinct()->pluck('module') : collect();
    $allCurricula = ($sec === 'mata-kuliah') ? \App\Models\Curriculum::where('is_active', true)->get() : collect();
    $allCategories = ($sec === 'berita') ? \App\Models\Category::all() : collect();
    $allLecturers = in_array($sec, ['sambutan', 'struktur']) ? \App\Models\Staff::where('type', 'dosen')->where('is_active', true)->orderBy('order')->get() : collect();
    $allStaff = ($sec === 'struktur') ? \App\Models\Staff::where('is_active', true)->orderBy('order')->get() : collect();

    // Query builder per section
    $paginator = null;

    if ($sec === 'users') {
        $userQuery = \App\Models\User::with('roleRelation');
        if ($searchQuery !== '') {
            $userQuery->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('email', 'like', "%{$searchQuery}%")
                  ->orWhere('role', 'like', "%{$searchQuery}%")
                  ->orWhereHas('roleRelation', function ($rq) use ($searchQuery) {
                      $rq->where('name', 'like', "%{$searchQuery}%");
                  });
            });
        }
        if ($roleFilter !== '') {
            $userQuery->where(function ($q) use ($roleFilter) {
                $q->where('role', $roleFilter)
                  ->orWhereHas('roleRelation', fn ($rq) => $rq->where('slug', $roleFilter));
            });
        }
        $paginator = $userQuery->orderBy('id', 'asc')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'roles') {
        $roleQuery = \App\Models\Role::with('permissions')->withCount('users');
        if ($searchQuery !== '') {
            $roleQuery->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('slug', 'like', "%{$searchQuery}%")
                  ->orWhere('description', 'like', "%{$searchQuery}%");
            });
        }
        if ($statusFilter !== '') {
            $roleQuery->where('is_active', $statusFilter === 'active');
        }
        $paginator = $roleQuery->orderBy('id', 'asc')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'permissions') {
        $permQuery = \App\Models\Permission::with('roles');
        if ($searchQuery !== '') {
            $permQuery->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('slug', 'like', "%{$searchQuery}%")
                  ->orWhere('module', 'like', "%{$searchQuery}%")
                  ->orWhere('description', 'like', "%{$searchQuery}%");
            });
        }
        if ($moduleFilter !== '') {
            $permQuery->where('module', $moduleFilter);
        }
        if ($statusFilter !== '') {
            $permQuery->where('is_active', $statusFilter === 'active');
        }
        $paginator = $permQuery->orderBy('id', 'asc')->paginate($perPage)->withQueryString();
    } elseif (in_array($sec, ['dosen', 'tendik'])) {
        $staffQuery = \App\Models\Staff::where('type', $sec === 'tendik' ? 'tendik' : 'dosen');
        if ($searchQuery !== '') {
            $staffQuery->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('nip_nidn', 'like', "%{$searchQuery}%")
                  ->orWhere('position', 'like', "%{$searchQuery}%")
                  ->orWhere('expertise', 'like', "%{$searchQuery}%")
                  ->orWhere('education', 'like', "%{$searchQuery}%")
                  ->orWhere('email', 'like', "%{$searchQuery}%");
            });
        }
        if ($statusFilter !== '') {
            $staffQuery->where('is_active', $statusFilter === 'active');
        }
        $paginator = $staffQuery->orderBy('order')->orderBy('id', 'asc')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'berita') {
        $newsQuery = \App\Models\News::with(['category', 'author']);
        if ($searchQuery !== '') {
            $newsQuery->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('content', 'like', "%{$searchQuery}%");
            });
        }
        $paginator = $newsQuery->latest('published_at')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'pengumuman') {
        $annQuery = \App\Models\Announcement::query();
        if ($searchQuery !== '') {
            $annQuery->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('content', 'like', "%{$searchQuery}%");
            });
        }
        $paginator = $annQuery->latest('published_at')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'agenda') {
        $eventQuery = \App\Models\Event::query();
        if ($searchQuery !== '') {
            $eventQuery->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('location', 'like', "%{$searchQuery}%")
                  ->orWhere('speaker', 'like', "%{$searchQuery}%");
            });
        }
        $paginator = $eventQuery->orderBy('event_date', 'asc')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'kurikulum') {
        $currQuery = \App\Models\Curriculum::withCount('courses');
        if ($searchQuery !== '') {
            $currQuery->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('year', 'like', "%{$searchQuery}%");
            });
        }
        $paginator = $currQuery->orderBy('year', 'desc')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'mata-kuliah') {
        $courseQuery = \App\Models\Course::with('curriculum');
        if ($searchQuery !== '') {
            $courseQuery->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('code', 'like', "%{$searchQuery}%");
            });
        }
        $paginator = $courseQuery->orderBy('semester')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'kalender') {
        $calQuery = \App\Models\AcademicCalendar::query();
        if ($searchQuery !== '') {
            $calQuery->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('academic_year', 'like', "%{$searchQuery}%");
            });
        }
        $paginator = $calQuery->latest('start_date')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'cpl') {
        $cplQuery = \App\Models\Cpl::query();
        if ($searchQuery !== '') {
            $cplQuery->where(function ($q) use ($searchQuery) {
                $q->where('code', 'like', "%{$searchQuery}%")
                  ->orWhere('description', 'like', "%{$searchQuery}%");
            });
        }
        $paginator = $cplQuery->orderBy('order')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'profil-lulusan') {
        $gpQuery = \App\Models\GraduateProfile::query();
        if ($searchQuery !== '') {
            $gpQuery->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('description', 'like', "%{$searchQuery}%");
            });
        }
        $paginator = $gpQuery->orderBy('order')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'fasilitas') {
        $facQuery = \App\Models\Facility::query();
        if ($searchQuery !== '') {
            $facQuery->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('location', 'like', "%{$searchQuery}%")
                  ->orWhere('category', 'like', "%{$searchQuery}%");
            });
        }
        $paginator = $facQuery->orderBy('id', 'asc')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'album-galeri') {
        $albumQuery = \App\Models\GalleryAlbum::withCount('photos');
        if ($searchQuery !== '') {
            $albumQuery->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('description', 'like', "%{$searchQuery}%");
            });
        }
        $paginator = $albumQuery->orderBy('id', 'desc')->paginate($perPage)->withQueryString();
    } elseif ($sec === 'media-list') {
        $mediaQuery = \App\Models\MediaFile::query();
        if ($searchQuery !== '') {
            $mediaQuery->where('filename', 'like', "%{$searchQuery}%");
        }
        $paginator = $mediaQuery->latest()->paginate($perPage)->withQueryString();
    }
@endphp

@section('title', $title)
@section('page_title', $title)
@section('page_subtitle', 'Modul pengelolaan data dan konten resmi D-IV TRM POLITALA')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    deleteModalOpen: false, 
    selectedItem: null,
    deleteFormAction: '',
    formAction: '',
    formMethod: 'POST',
    modalTitle: 'Tambah Data',
    formData: { 
        id: null, 
        title: '', 
        name: '', 
        email: '', 
        phone: '',
        nidn: '',
        nip: '',
        nip_nidn: '',
        position: '',
        academic_degree: '',
        education: '',
        expertise: '',
        photo: '',
        order: 0,
        code: '',
        category: 'Umum',
        role_id: '{{ $allRoles->first()?->id ?? 1 }}',
        curriculum_id: '{{ $allCurricula->first()?->id ?? 1 }}',
        theory_credits: 2,
        practice_credits: 2,
        semester: 1,
        academic_year: '2026/2027',
        start_date: '',
        end_date: '',
        location: '',
        speaker: '',
        capacity: 30,
        content: '',
        desc: '',
        status: 'published',
        permissions: []
    }
}" class="space-y-6">

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" @click="$el.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold shadow-xs">
            <div class="font-bold mb-1">Terdapat kesalahan pengisian data:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Status Helper Banner -->
    <div class="rounded-2xl bg-brand-sky-light border border-brand-sky/60 p-4 text-brand-dark text-xs flex flex-wrap items-center justify-between gap-2 shadow-xs">
        <div class="flex items-center gap-2.5">
            <svg class="w-4 h-4 text-brand-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><strong>Modul: {{ $title }}.</strong> Terhubung ke database resmi program studi D-IV Teknik Rekayasa Multimedia.</span>
        </div>
        <span class="text-[10px] uppercase font-bold text-brand-primary bg-white px-2 py-0.5 rounded shadow-xs">
            Live Database Connected
        </span>
    </div>

    @if($isFormOnly)
        {{-- VIEW MODE 1: FORMULIR PENGATURAN / SINGLE RECORD --}}
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-xs max-w-4xl space-y-8">
            <div class="border-b border-slate-100 pb-4">
                <h3 class="text-lg font-bold text-brand-dark">Formulir Pengelolaan: {{ $title }}</h3>
                <p class="text-xs text-brand-muted mt-0.5">Lengkapi isian data resmi di bawah ini untuk memperbarui database.</p>
            </div>

            @if(in_array($sec, ['sejarah', 'visi-misi', 'sambutan', 'struktur']))
                <form method="POST" action="{{ route('admin.profile-section.update') }}" enctype="multipart/form-data" class="space-y-6 text-xs sm:text-sm">
                    @csrf
                    <input type="hidden" name="section" value="{{ $sec }}">

                    <div class="space-y-1.5">
                        <label class="block font-bold text-brand-dark">Judul Bagian</label>
                        <input type="text" name="title" value="{{ old('title', $profileRecord->title ?? $title) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block font-bold text-brand-dark">Isi Konten / Uraian Resmi <span class="text-rose-500">*</span></label>
                        <textarea name="content" rows="8" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary leading-relaxed">{{ old('content', $profileRecord->content ?? '') }}</textarea>
                    </div>

                    @if($sec === 'sejarah')
                        @php
                            $existingTimeline = data_get($profileRecord, 'meta.timeline', [
                                [
                                    'year' => '2024',
                                    'title' => 'Inisiasi Pendirian & Analisis Kebutuhan Industri',
                                    'badge' => 'Tahap Awal',
                                    'status' => 'completed',
                                    'description' => 'Pembentukan satuan tugas perumus pendirian prodi dan penyusunan naskah akademik berkolaborasi dengan asosiasi industri.',
                                ],
                                [
                                    'year' => '2025',
                                    'title' => 'Pembangunan Laboratorium Studio & Pengajuan Izin',
                                    'badge' => 'Infrastruktur',
                                    'status' => 'completed',
                                    'description' => 'Pengadaan fasilitas workstation grafis dan pembangunan Studio Motion Capture.',
                                ],
                                [
                                    'year' => '2026',
                                    'title' => 'Penerbitan SK Resmi & Penerimaan Angkatan Perdana',
                                    'badge' => 'Operasional Resmi',
                                    'status' => 'current',
                                    'description' => 'Diterbitkannya SK izin operasional resmi dan penerimaan mahasiswa baru angkatan pertama.',
                                ],
                                [
                                    'year' => '2027+',
                                    'title' => 'Ekspansi Inkubator Game, Render Farm & Akreditasi Unggul',
                                    'badge' => 'Akselerasi Masa Depan',
                                    'status' => 'upcoming',
                                    'description' => 'Pengembangan teaching factory dan hilirisasi karya game & animasi ke pasar global.',
                                ],
                            ]);
                        @endphp

                        <!-- Meta Informasi Tambahan -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 rounded-2xl bg-brand-surface border border-slate-200">
                            <div class="space-y-1">
                                <label class="block font-bold text-brand-dark text-xs">Tahun Pendirian</label>
                                <input type="text" name="meta[established_year]" value="{{ old('meta.established_year', data_get($profileRecord, 'meta.established_year', '2026')) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div class="space-y-1">
                                <label class="block font-bold text-brand-dark text-xs">Nomor SK Pendirian</label>
                                <input type="text" name="meta[sk_number]" value="{{ old('meta.sk_number', data_get($profileRecord, 'meta.sk_number', 'SK Kemendiktisaintek RI No. 124/D/OT/2026')) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div class="space-y-1">
                                <label class="block font-bold text-brand-dark text-xs">Gelar Akademik Lulusan</label>
                                <input type="text" name="meta[degree_title]" value="{{ old('meta.degree_title', data_get($profileRecord, 'meta.degree_title', 'Sarjana Terapan Komputer (S.Tr.Kom.)')) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs">
                            </div>
                        </div>

                        <!-- Alpine Repeater for Timeline -->
                        <div class="space-y-4 pt-4 border-t border-slate-100" 
                             x-data="{ 
                                 timeline: {{ Js::from($existingTimeline) }},
                                 addMilestone() {
                                     this.timeline.push({
                                         year: '2028',
                                         title: 'Tonggak Baru',
                                         badge: 'Pengembangan',
                                         status: 'upcoming',
                                         description: 'Keterangan pencapaian tonggak...'
                                     });
                                 },
                                 removeMilestone(index) {
                                     if (this.timeline.length > 1) {
                                         this.timeline.splice(index, 1);
                                     }
                                 }
                             }">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-brand-dark">Linimasa Tonggak Sejarah (Timeline Milestones)</h4>
                                    <p class="text-xs text-brand-muted">Daftar tonggak peristiwa penting yang akan tampil pada halaman sejarah dan beranda (homepage).</p>
                                </div>
                                <button type="button" @click="addMilestone()" class="px-3 py-1.5 rounded-xl bg-brand-primary-light text-brand-primary text-xs font-bold hover:bg-brand-primary hover:text-white transition-all flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>Tambah Tonggak</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                <template x-for="(item, idx) in timeline" :key="idx">
                                    <div class="p-4 rounded-2xl bg-white border border-slate-200 space-y-3 shadow-2xs">
                                        <div class="flex items-center justify-between gap-3">
                                            <span class="text-xs font-bold text-brand-secondary" x-text="'Tonggak #' + (idx + 1)"></span>
                                            <button type="button" @click="removeMilestone(idx)" class="text-rose-500 hover:text-rose-700 text-xs font-semibold flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                            <div>
                                                <label class="block text-[11px] font-semibold text-brand-muted mb-1">Tahun / Periode</label>
                                                <input type="text" :name="'meta[timeline][' + idx + '][year]'" x-model="item.year" required class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-brand-muted mb-1">Label / Badge</label>
                                                <input type="text" :name="'meta[timeline][' + idx + '][badge]'" x-model="item.badge" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                            </div>
                                            <div>
                                                <label class="block text-[11px] font-semibold text-brand-muted mb-1">Status Tonggak</label>
                                                <select :name="'meta[timeline][' + idx + '][status]'" x-model="item.status" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                                    <option value="completed">Terealisasi (Completed)</option>
                                                    <option value="current">Berjalan Saat Ini (Current)</option>
                                                    <option value="upcoming">Rencana Mendatang (Upcoming)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-[11px] font-semibold text-brand-muted mb-1">Judul Tonggak</label>
                                            <input type="text" :name="'meta[timeline][' + idx + '][title]'" x-model="item.title" required class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                        </div>

                                        <div>
                                            <label class="block text-[11px] font-semibold text-brand-muted mb-1">Uraian Ringkas</label>
                                            <textarea :name="'meta[timeline][' + idx + '][description]'" x-model="item.description" rows="2" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs"></textarea>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    @elseif($sec === 'visi-misi')
                        @php
                            $existingMissions = data_get($profileRecord, 'meta.missions', [
                                ['number' => 1, 'title' => 'Pendidikan Vokasi Selaras Industri & OBE', 'description' => 'Menyelenggarakan pendidikan sarjana terapan berbasis Outcome-Based Education (OBE) dan Project-Based Learning (PBL).'],
                                ['number' => 2, 'title' => 'Penelitian Terapan & Inovasi Tepat Guna', 'description' => 'Mengembangkan penelitian terapan dan menghasilkan produk teknologi rekayasa multimedia yang inovatif dan bernilai HKI.'],
                                ['number' => 3, 'title' => 'Pengabdian Masyarakat & Transformasi Digital', 'description' => 'Menerapkan produk teknologi rekayasa multimedia untuk memberdayakan masyarakat dan UMKM daerah.'],
                                ['number' => 4, 'title' => 'Kemitraan Strategis Bersama DUDI & Asosiasi', 'description' => 'Memperluas jejaring kemitraan strategis dengan studio game dan rumah produksi animasi global.'],
                            ]);

                            $existingGoals = data_get($profileRecord, 'meta.goals', [
                                ['title' => 'Lulusan Kompeten & Bersertifikasi Profesi', 'description' => 'Menghasilkan Sarjana Terapan Komputer (S.Tr.Kom.) berkarakter unggul dan tersertifikasi BNSP.'],
                                ['title' => 'Produk Karya Siap Komersial & Bernilai HKI', 'description' => 'Menghasilkan karya rekayasa multimedia komersial yang terdaftar Hak Kekayaan Intelektual.'],
                                ['title' => 'Inkubasi Technopreneurship Kreatif Mahasiswa', 'description' => 'Mendorong lahirnya rintisan usaha teknologi dan studio kreatif mahasiswa melalui teaching factory.'],
                                ['title' => 'Tata Kelola Unggul & Akreditasi Berkualitas', 'description' => 'Mewujudkan tata kelola program studi yang modern, akuntabel, dan berakreditasi Unggul.'],
                            ]);
                        @endphp

                        <!-- Pernyataan Visi & Target Tahun -->
                        <div class="p-5 rounded-2xl bg-brand-surface border border-slate-200 space-y-4">
                            <h4 class="font-bold text-brand-dark">Pernyataan Visi Resmi Program Studi</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                <div class="sm:col-span-3 space-y-1">
                                    <label class="block text-xs font-semibold text-brand-muted">Teks Kalimat Visi</label>
                                    <textarea name="meta[vision_statement]" rows="3" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">{{ old('meta.vision_statement', data_get($profileRecord, 'meta.vision_statement', 'Menjadi pusat pendidikan tinggi vokasi unggulan dan rujukan di bidang teknologi rekayasa multimedia terapan yang berdaya saing global, inovatif, dan berjiwa wirausaha pada tahun 2030.')) }}</textarea>
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-xs font-semibold text-brand-muted">Target Tahun Visi</label>
                                    <input type="text" name="meta[target_year]" value="{{ old('meta.target_year', data_get($profileRecord, 'meta.target_year', '2030')) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                </div>
                            </div>
                        </div>

                        <!-- Repeater Misi -->
                        <div class="space-y-4 pt-4 border-t border-slate-100"
                             x-data="{ 
                                 missions: {{ Js::from($existingMissions) }},
                                 addMission() {
                                     this.missions.push({
                                         number: this.missions.length + 1,
                                         title: 'Misi Baru',
                                         description: 'Uraian pelaksanaan misi...'
                                     });
                                 },
                                 removeMission(idx) {
                                     if (this.missions.length > 1) {
                                         this.missions.splice(idx, 1);
                                     }
                                 }
                             }">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-brand-dark">Daftar Misi Program Studi</h4>
                                    <p class="text-xs text-brand-muted">Pilar pelaksanaan Tridharma dan kemitraan industri.</p>
                                </div>
                                <button type="button" @click="addMission()" class="px-3 py-1.5 rounded-xl bg-brand-primary-light text-brand-primary text-xs font-bold hover:bg-brand-primary hover:text-white transition-all flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>Tambah Misi</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                <template x-for="(m, idx) in missions" :key="idx">
                                    <div class="p-4 rounded-2xl bg-white border border-slate-200 space-y-3 shadow-2xs">
                                        <div class="flex items-center justify-between gap-3">
                                            <span class="text-xs font-bold text-brand-primary" x-text="'Misi #' + (idx + 1)"></span>
                                            <button type="button" @click="removeMission(idx)" class="text-rose-500 hover:text-rose-700 text-xs font-semibold flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                                            <div class="sm:col-span-1">
                                                <label class="block text-[11px] font-semibold text-brand-muted mb-1">Nomor Urut</label>
                                                <input type="number" :name="'meta[missions][' + idx + '][number]'" :value="idx + 1" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                            </div>
                                            <div class="sm:col-span-3">
                                                <label class="block text-[11px] font-semibold text-brand-muted mb-1">Judul Misi</label>
                                                <input type="text" :name="'meta[missions][' + idx + '][title]'" x-model="m.title" required class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-[11px] font-semibold text-brand-muted mb-1">Uraian Misi</label>
                                            <textarea :name="'meta[missions][' + idx + '][description]'" x-model="m.description" rows="2" required class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs"></textarea>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Repeater Tujuan Program Studi -->
                        <div class="space-y-4 pt-4 border-t border-slate-100"
                             x-data="{ 
                                 goals: {{ Js::from($existingGoals) }},
                                 addGoal() {
                                     this.goals.push({
                                         title: 'Tujuan Baru',
                                         description: 'Uraian tujuan strategis...'
                                     });
                                 },
                                 removeGoal(idx) {
                                     if (this.goals.length > 1) {
                                         this.goals.splice(idx, 1);
                                     }
                                 }
                             }">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-brand-dark">Tujuan Program Studi (Educational Goals)</h4>
                                    <p class="text-xs text-brand-muted">Target capaian lulusan dan kelembagaan prodi.</p>
                                </div>
                                <button type="button" @click="addGoal()" class="px-3 py-1.5 rounded-xl bg-brand-primary-light text-brand-primary text-xs font-bold hover:bg-brand-primary hover:text-white transition-all flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>Tambah Tujuan</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                <template x-for="(g, idx) in goals" :key="idx">
                                    <div class="p-4 rounded-2xl bg-white border border-slate-200 space-y-3 shadow-2xs">
                                        <div class="flex items-center justify-between gap-3">
                                            <span class="text-xs font-bold text-brand-secondary" x-text="'Tujuan #' + (idx + 1)"></span>
                                            <button type="button" @click="removeGoal(idx)" class="text-rose-500 hover:text-rose-700 text-xs font-semibold flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </div>

                                        <div>
                                            <label class="block text-[11px] font-semibold text-brand-muted mb-1">Judul / Sasaran Tujuan</label>
                                            <input type="text" :name="'meta[goals][' + idx + '][title]'" x-model="g.title" required class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                        </div>

                                        <div>
                                            <label class="block text-[11px] font-semibold text-brand-muted mb-1">Uraian Rinci</label>
                                            <textarea :name="'meta[goals][' + idx + '][description]'" x-model="g.description" rows="2" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs"></textarea>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    @elseif($sec === 'sambutan')
                        @php
                            $existingPoints = data_get($profileRecord, 'meta.key_points', [
                                [
                                    'badge' => 'Metode Belajar',
                                    'title' => 'Pembelajaran Berbasis Proyek (PBL)',
                                    'description' => 'Kurikulum vokasi 70% praktik yang membiasakan mahasiswa menyelesaikan proyek riil industri animasi, game, dan media interaktif sejak awal perkuliahan.',
                                ],
                                [
                                    'badge' => 'Infrastruktur',
                                    'title' => 'Laboratorium & Workstation Standar Industri',
                                    'description' => 'Fasilitas Studio Motion Capture, Laboratorium Komputasi Grafis berkecepatan tinggi, dan Render Farm terintegrasi.',
                                ],
                                [
                                    'badge' => 'Kemitraan DUDI',
                                    'title' => 'Kolaborasi Ekosistem Industri Kreatif',
                                    'description' => 'Kemitraan strategis dengan studio game komersial dan rumah produksi multimedia untuk program magang bersertifikat dan rekrutmen kerja.',
                                ],
                                [
                                    'badge' => 'Kompetensi',
                                    'title' => 'Sertifikasi Keahlian Berstandar Nasional (BNSP)',
                                    'description' => 'Lulusan dibekali sertifikasi kompetensi profesi dan portofolio karya teruji sebelum wisuda untuk menjamin daya serap kerja.',
                                ],
                            ]);

                            $lecturersJson = $allLecturers->map(function ($lecturer) {
                                return [
                                    'id' => $lecturer->id,
                                    'name' => $lecturer->name,
                                    'nip_nidn' => $lecturer->nip_nidn,
                                    'position' => $lecturer->position,
                                    'email' => $lecturer->email,
                                    'photo' => $lecturer->photo,
                                ];
                            })->values();

                            $currentKaprodiName = old('meta.kaprodi_name', data_get($profileRecord, 'meta.kaprodi_name', 'Dr. H. Rian Hidayat, M.Kom.'));
                            $currentKaprodiNip = old('meta.kaprodi_nip', data_get($profileRecord, 'meta.kaprodi_nip', '198504122014041001'));
                            $currentKaprodiPos = old('meta.kaprodi_position', data_get($profileRecord, 'meta.kaprodi_position', 'Koordinator Program Studi Sarjana Terapan TRM'));
                            $currentKaprodiDept = old('meta.kaprodi_department', data_get($profileRecord, 'meta.kaprodi_department', 'Jurusan Komputer dan Bisnis, Politeknik Negeri Tanah Laut'));
                            $currentKaprodiEmail = old('meta.kaprodi_email', data_get($profileRecord, 'meta.kaprodi_email', 'rian.hidayat@politala.ac.id'));
                            $currentKaprodiPhoto = old('meta.kaprodi_photo_url', data_get($profileRecord, 'meta.kaprodi_photo_url', ''));
                            $currentPeriod = old('meta.period', data_get($profileRecord, 'meta.period', 'Periode 2024 - 2028'));
                        @endphp

                        <div class="space-y-6 pt-4 border-t border-slate-100"
                             x-data="{
                                 lecturers: {{ Js::from($lecturersJson) }},
                                 kaprodiName: '{{ addslashes($currentKaprodiName) }}',
                                 kaprodiNip: '{{ addslashes($currentKaprodiNip) }}',
                                 kaprodiPos: '{{ addslashes($currentKaprodiPos) }}',
                                 kaprodiEmail: '{{ addslashes($currentKaprodiEmail) }}',
                                 kaprodiPhotoUrl: '{{ addslashes($currentKaprodiPhoto) }}',
                                 signatureName: '{{ addslashes(old('meta.signature_name', data_get($profileRecord, 'meta.signature_name', $currentKaprodiName))) }}',
                                 previewPhoto: '{{ addslashes($currentKaprodiPhoto) }}',
                                 selectedStaffId: '',
                                 keyPoints: {{ Js::from($existingPoints) }},
                                 applyStaff(id) {
                                     const found = this.lecturers.find(l => String(l.id) === String(id));
                                     if (found) {
                                         this.kaprodiName = found.name || '';
                                         this.kaprodiNip = found.nip_nidn || '';
                                         this.kaprodiPos = found.position || '';
                                         this.kaprodiEmail = found.email || '';
                                         this.signatureName = found.name || '';
                                         if (found.photo) {
                                             this.kaprodiPhotoUrl = found.photo;
                                             this.previewPhoto = found.photo;
                                         }
                                     }
                                 },
                                 handleFileChange(event) {
                                     const file = event.target.files[0];
                                     if (file) {
                                         const reader = new FileReader();
                                         reader.onload = (e) => {
                                             this.previewPhoto = e.target.result;
                                         };
                                         reader.readAsDataURL(file);
                                     }
                                 },
                                 addPoint() {
                                     this.keyPoints.push({
                                         badge: 'Fokus',
                                         title: 'Pilar Baru',
                                         description: 'Uraian pilar prioritas sambutan...'
                                     });
                                 },
                                 removePoint(idx) {
                                     if (this.keyPoints.length > 1) {
                                         this.keyPoints.splice(idx, 1);
                                     }
                                 }
                             }">

                            <!-- Autofill dari Data Dosen -->
                            <div class="p-4 sm:p-5 rounded-2xl bg-brand-surface border border-slate-200 space-y-3">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                    <div>
                                        <h4 class="font-bold text-brand-dark flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            <span>Asisten Isi Otomatis Pimpinan</span>
                                        </h4>
                                        <p class="text-xs text-brand-muted">Pilih profil dari master data Dosen untuk mengisi nama, NIP, email, dan jabatan secara otomatis.</p>
                                    </div>
                                    <div class="w-full sm:w-64">
                                        <select x-model="selectedStaffId" @change="applyStaff($event.target.value)" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-brand-primary/20">
                                            <option value="">-- Pilih Dosen / Kaprodi --</option>
                                            <template x-for="lect in lecturers" :key="lect.id">
                                                <option :value="lect.id" x-text="lect.name + ' (' + (lect.position || 'Dosen') + ')'"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Identitas & Kontak Pimpinan (Kaprodi) -->
                            <div class="p-5 rounded-2xl bg-white border border-slate-200 space-y-4">
                                <h4 class="font-bold text-brand-dark flex items-center gap-2">
                                    <svg class="w-4 h-4 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Identitas &amp; Profil Ketua Program Studi</span>
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Nama Lengkap &amp; Gelar <span class="text-rose-500">*</span></label>
                                        <input type="text" name="meta[kaprodi_name]" x-model="kaprodiName" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">NIP / NIDN</label>
                                        <input type="text" name="meta[kaprodi_nip]" x-model="kaprodiNip" placeholder="198504122014041001" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Jabatan Resmi</label>
                                        <input type="text" name="meta[kaprodi_position]" x-model="kaprodiPos" placeholder="Koordinator Program Studi Sarjana Terapan TRM" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Masa Jabatan / Periode</label>
                                        <input type="text" name="meta[period]" value="{{ $currentPeriod }}" placeholder="Periode 2024 - 2028" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Unit Kerja / Jurusan</label>
                                        <input type="text" name="meta[kaprodi_department]" value="{{ $currentKaprodiDept }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Email Kontak Resmi</label>
                                        <input type="email" name="meta[kaprodi_email]" x-model="kaprodiEmail" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                </div>

                                <!-- Foto Kaprodi Upload & URL -->
                                <div class="pt-3 border-t border-slate-100">
                                    <label class="block text-xs font-semibold text-brand-muted mb-2">Foto Resmi Kaprodi</label>
                                    <div class="flex flex-col sm:flex-row items-center gap-4">
                                        <!-- Photo Preview Box -->
                                        <div class="w-24 h-28 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center relative shadow-2xs">
                                            <template x-if="previewPhoto">
                                                <img :src="previewPhoto" alt="Preview Foto" class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!previewPhoto">
                                                <div class="text-center p-2 text-slate-400">
                                                    <svg class="w-8 h-8 mx-auto opacity-40 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    <span class="text-[9px] block">Tanpa Foto</span>
                                                </div>
                                            </template>
                                        </div>

                                        <div class="flex-1 w-full space-y-2">
                                            <div>
                                                <span class="text-[11px] font-semibold text-slate-600 block mb-1">Unggah Berkas Gambar (JPG, PNG, WebP &bull; Maks 2MB)</span>
                                                <input type="file" name="kaprodi_photo_file" @change="handleFileChange($event)" accept="image/png,image/jpeg,image/webp" class="w-full px-3 py-1.5 rounded-xl border border-slate-200 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-primary-light file:text-brand-primary hover:file:bg-brand-primary hover:file:text-white">
                                            </div>
                                            <div>
                                                <span class="text-[11px] font-semibold text-slate-500 block mb-1">Atau Tautan URL / Path Foto</span>
                                                <input type="text" name="meta[kaprodi_photo_url]" x-model="kaprodiPhotoUrl" @input="previewPhoto = kaprodiPhotoUrl" placeholder="/storage/profiles/kaprodi.jpg atau https://..." class="w-full px-3 py-1.5 rounded-xl border border-slate-200 text-xs">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pesan Sambutan Editorial -->
                            <div class="p-5 rounded-2xl bg-white border border-slate-200 space-y-4">
                                <h4 class="font-bold text-brand-dark flex items-center gap-2">
                                    <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Pesan &amp; Redaksi Editorial Sambutan</span>
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Subjudul Sambutan</label>
                                        <input type="text" name="meta[subtitle]" value="{{ old('meta.subtitle', data_get($profileRecord, 'meta.subtitle', 'Pesan dan visi kepemimpinan Program Studi Sarjana Terapan Teknik Rekayasa Multimedia')) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Salam Pembuka</label>
                                        <input type="text" name="meta[greeting]" value="{{ old('meta.greeting', data_get($profileRecord, 'meta.greeting', 'Assalamu’alaikum Warahmatullahi Wabarakatuh & Salam Sejahtera,')) }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <label class="block text-xs font-semibold text-brand-muted">Kutipan Kunci / Highlight Statement</label>
                                    <textarea name="meta[quote]" rows="2" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20 leading-relaxed">{{ old('meta.quote', data_get($profileRecord, 'meta.quote', 'TRM POLITALA hadir untuk melahirkan talenta digital masa depan yang memadukan keunggulan rekayasa teknologi dan estetika seni multimedia.')) }}</textarea>
                                    <span class="text-[10px] text-slate-400">Kalimat sorotan utama yang ditampilkan menonjol dalam kartu kutipan.</span>
                                </div>

                                <div class="space-y-1">
                                    <label class="block text-xs font-semibold text-brand-muted">Tautan Video Sambutan (YouTube, Opsional)</label>
                                    <input type="url" name="meta[video_url]" value="{{ old('meta.video_url', data_get($profileRecord, 'meta.video_url', '')) }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-3 border-t border-slate-100">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Salam Penutup</label>
                                        <input type="text" name="meta[closing_greeting]" value="{{ old('meta.closing_greeting', data_get($profileRecord, 'meta.closing_greeting', 'Wassalamu’alaikum Warahmatullahi Wabarakatuh.')) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Nama Penandatangan Digital</label>
                                        <input type="text" name="meta[signature_name]" x-model="signatureName" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Keterangan Jabatan Penandatangan</label>
                                        <input type="text" name="meta[signature_title]" value="{{ old('meta.signature_title', data_get($profileRecord, 'meta.signature_title', 'Koordinator Program Studi D-4 TRM POLITALA')) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs">
                                    </div>
                                </div>
                            </div>

                            <!-- Repeater Pilar / Poin Kunci Sambutan -->
                            <div class="p-5 rounded-2xl bg-brand-surface/70 border border-slate-200 space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-bold text-brand-dark flex items-center gap-2">
                                            <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                            <span>Pilar Keunggulan &amp; Poin Kunci Sambutan</span>
                                        </h4>
                                        <p class="text-xs text-brand-muted">Poin-poin prioritas yang ditekankan dalam sambutan Kaprodi.</p>
                                    </div>
                                    <button type="button" @click="addPoint()" class="px-3 py-1.5 rounded-xl bg-brand-primary-light text-brand-primary text-xs font-bold hover:bg-brand-primary hover:text-white transition-all flex items-center gap-1.5 shadow-2xs">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span>Tambah Pilar</span>
                                    </button>
                                </div>

                                <div class="space-y-3">
                                    <template x-for="(pt, idx) in keyPoints" :key="idx">
                                        <div class="p-4 rounded-2xl bg-white border border-slate-200 space-y-3 shadow-2xs">
                                            <div class="flex items-center justify-between gap-3">
                                                <span class="text-xs font-bold text-brand-primary" x-text="'Pilar #' + (idx + 1)"></span>
                                                <button type="button" @click="removePoint(idx)" class="text-rose-500 hover:text-rose-700 text-xs font-semibold flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </div>

                                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                                <div>
                                                    <label class="block text-[11px] font-semibold text-brand-muted mb-1">Kategori / Badge</label>
                                                    <input type="text" :name="'meta[key_points][' + idx + '][badge]'" x-model="pt.badge" placeholder="Metode Belajar / Fasilitas" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label class="block text-[11px] font-semibold text-brand-muted mb-1">Judul Pilar</label>
                                                    <input type="text" :name="'meta[key_points][' + idx + '][title]'" x-model="pt.title" required class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-[11px] font-semibold text-brand-muted mb-1">Keterangan / Uraian Rinci</label>
                                                <textarea :name="'meta[key_points][' + idx + '][description]'" x-model="pt.description" rows="2" required class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs"></textarea>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    @elseif($sec === 'struktur')
                        @php
                            $existingUnits = data_get($profileRecord, 'meta.custom_units', [
                                [
                                    'unit' => 'Kelompok Bidang Keahlian (KBK) Game & XR',
                                    'leader' => 'Bambang Trianto, S.Kom., M.Cs.',
                                    'desc' => 'Fokus pengembangan kurikulum dan riset terapan bidang Game Engine Architecture & Immersive Tech (AR/VR).',
                                ],
                                [
                                    'unit' => 'Kelompok Bidang Keahlian (KBK) Animasi & Media Digital',
                                    'leader' => 'Fathurrahman, M.Sn.',
                                    'desc' => 'Fokus perancangan aset grafis 3D, rigging, motion capture, visual effects, dan audio spasial.',
                                ],
                            ]);

                            $currentSkNumber = old('meta.sk_number', data_get($profileRecord, 'meta.sk_number', 'SK Direktur POLITALA No. 124/PL34/OT/2026'));
                            $currentAcademicYear = old('meta.academic_year', data_get($profileRecord, 'meta.academic_year', 'Tahun Akademik 2026/2027'));
                            $currentDeptHeadName = old('meta.department_head_name', data_get($profileRecord, 'meta.department_head_name', 'Hj. Agustian Noor, S.Kom., M.Kom.'));
                            $currentDeptHeadNip = old('meta.department_head_nip', data_get($profileRecord, 'meta.department_head_nip', '197908152005011002'));
                            $currentDeptHeadDept = old('meta.department_head_dept', data_get($profileRecord, 'meta.department_head_dept', 'Jurusan Komputer & Bisnis, Politeknik Negeri Tanah Laut'));
                            $currentGkmName = old('meta.gkm_name', data_get($profileRecord, 'meta.gkm_name', 'Tim Gugus Kendali Mutu (GKM) TRM'));
                            $currentGkmNip = old('meta.gkm_nip', data_get($profileRecord, 'meta.gkm_nip', 'Pusat Penjaminan Mutu (P4M)'));

                            $selectedKaprodiId = old('meta.kaprodi_id', data_get($profileRecord, 'meta.kaprodi_id', $allStaff->firstWhere('position', 'like', '%Koordinator%')?->id));
                            $selectedKalabId = old('meta.kalab_id', data_get($profileRecord, 'meta.kalab_id', $allStaff->first(fn($s) => str_contains(strtolower($s->position ?? ''), 'studio') || str_contains(strtolower($s->position ?? ''), 'lab'))?->id));
                            $selectedPlpId = old('meta.plp_id', data_get($profileRecord, 'meta.plp_id', $allStaff->firstWhere('position', 'like', '%PLP%')?->id));
                            $selectedMbkmId = old('meta.mbkm_id', data_get($profileRecord, 'meta.mbkm_id', $allStaff->first(fn($s) => str_contains(strtolower($s->position ?? ''), 'mbkm'))?->id));
                            $selectedKemahasiswaanId = old('meta.kemahasiswaan_id', data_get($profileRecord, 'meta.kemahasiswaan_id', $allStaff->first(fn($s) => str_contains(strtolower($s->position ?? ''), 'game'))?->id));
                            $selectedAdminId = old('meta.admin_id', data_get($profileRecord, 'meta.admin_id', $allStaff->first(fn($s) => str_contains(strtolower($s->position ?? ''), 'administrasi'))?->id));
                        @endphp

                        <div class="space-y-6 pt-4 border-t border-slate-100"
                             x-data="{
                                 customUnits: {{ Js::from($existingUnits) }},
                                 addUnit() {
                                     this.customUnits.push({
                                         unit: 'Unit / KBK Baru',
                                         leader: '',
                                         desc: 'Uraian lingkup tugas unit...'
                                     });
                                 },
                                 removeUnit(idx) {
                                     if (this.customUnits.length > 1) {
                                         this.customUnits.splice(idx, 1);
                                     }
                                 }
                             }">

                            <!-- Info Sinkronisasi Otomatis Tree -->
                            <div class="p-4 sm:p-5 rounded-2xl bg-brand-surface border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-brand-primary/10 text-brand-primary flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-brand-dark">Integrasi Tree Otomatis Master Data</h4>
                                        <p class="text-xs text-brand-muted mt-0.5">
                                            Bagan pohon (*tree*) struktur organisasi secara cerdas membaca data dari master Dosen &amp; Tendik. Anda dapat menetapkan penugasan spesifik atau mengelola personil di menu masing-masing.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <a href="{{ route('admin.crud.sample', ['section' => 'dosen']) }}" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-brand-primary hover:bg-brand-primary hover:text-white transition-colors">
                                        Data Dosen
                                    </a>
                                    <a href="{{ route('admin.crud.sample', ['section' => 'tendik']) }}" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-brand-secondary hover:bg-brand-secondary hover:text-white transition-colors">
                                        Data Tendik
                                    </a>
                                </div>
                            </div>

                            <!-- Legalitas SK & Periode -->
                            <div class="p-5 rounded-2xl bg-white border border-slate-200 space-y-4">
                                <h4 class="font-bold text-brand-dark flex items-center gap-2">
                                    <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Legalitas SK &amp; Periode Struktur</span>
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Nomor Surat Keputusan (SK)</label>
                                        <input type="text" name="meta[sk_number]" value="{{ $currentSkNumber }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Tahun Akademik / Masa Berlaku</label>
                                        <input type="text" name="meta[academic_year]" value="{{ $currentAcademicYear }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                </div>
                            </div>

                            <!-- Pimpinan Jurusan & GKM -->
                            <div class="p-5 rounded-2xl bg-white border border-slate-200 space-y-4">
                                <h4 class="font-bold text-brand-dark flex items-center gap-2">
                                    <svg class="w-4 h-4 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <span>Pimpinan Jurusan &amp; Penjaminan Mutu (GKM)</span>
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div class="space-y-1 sm:col-span-2">
                                        <label class="block text-xs font-semibold text-brand-muted">Nama Ketua Jurusan &amp; Gelar</label>
                                        <input type="text" name="meta[department_head_name]" value="{{ $currentDeptHeadName }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">NIP Ketua Jurusan</label>
                                        <input type="text" name="meta[department_head_nip]" value="{{ $currentDeptHeadNip }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">PIC / Koordinator Gugus Kendali Mutu (GKM)</label>
                                        <input type="text" name="meta[gkm_name]" value="{{ $currentGkmName }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Unit / Lembaga Penjaminan Mutu</label>
                                        <input type="text" name="meta[gkm_nip]" value="{{ $currentGkmNip }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                                    </div>
                                </div>
                            </div>

                            <!-- Pemetaan Pejabat Struktural Prodi dari Master Staf -->
                            <div class="p-5 rounded-2xl bg-white border border-slate-200 space-y-4">
                                <h4 class="font-bold text-brand-dark flex items-center gap-2">
                                    <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Penetapan Pejabat Struktural Prodi (Pilih dari Staf)</span>
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Koordinator Program Studi (Kaprodi)</label>
                                        <select name="meta[kaprodi_id]" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-brand-primary/20">
                                            <option value="">-- Otomatis Berdasarkan Jabatan --</option>
                                            @foreach($allStaff as $stf)
                                                <option value="{{ $stf->id }}" {{ (string)$selectedKaprodiId === (string)$stf->id ? 'selected' : '' }}>
                                                    {{ $stf->name }} ({{ $stf->position ?? $stf->type }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Kepala Laboratorium &amp; Studio Multimedia</label>
                                        <select name="meta[kalab_id]" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-brand-primary/20">
                                            <option value="">-- Otomatis Berdasarkan Jabatan --</option>
                                            @foreach($allStaff as $stf)
                                                <option value="{{ $stf->id }}" {{ (string)$selectedKalabId === (string)$stf->id ? 'selected' : '' }}>
                                                    {{ $stf->name }} ({{ $stf->position ?? $stf->type }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Pranata Laboratorium Pendidikan (PLP)</label>
                                        <select name="meta[plp_id]" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-brand-primary/20">
                                            <option value="">-- Otomatis Berdasarkan Jabatan --</option>
                                            @foreach($allStaff as $stf)
                                                <option value="{{ $stf->id }}" {{ (string)$selectedPlpId === (string)$stf->id ? 'selected' : '' }}>
                                                    {{ $stf->name }} ({{ $stf->position ?? $stf->type }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Koordinator MBKM &amp; Kemitraan Industri</label>
                                        <select name="meta[mbkm_id]" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-brand-primary/20">
                                            <option value="">-- Otomatis Berdasarkan Jabatan --</option>
                                            @foreach($allStaff as $stf)
                                                <option value="{{ $stf->id }}" {{ (string)$selectedMbkmId === (string)$stf->id ? 'selected' : '' }}>
                                                    {{ $stf->name }} ({{ $stf->position ?? $stf->type }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Pembina Kemahasiswaan &amp; Studio Game</label>
                                        <select name="meta[kemahasiswaan_id]" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-brand-primary/20">
                                            <option value="">-- Otomatis Berdasarkan Jabatan --</option>
                                            @foreach($allStaff as $stf)
                                                <option value="{{ $stf->id }}" {{ (string)$selectedKemahasiswaanId === (string)$stf->id ? 'selected' : '' }}>
                                                    {{ $stf->name }} ({{ $stf->position ?? $stf->type }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-brand-muted">Staf Administrasi &amp; Tata Usaha Prodi</label>
                                        <select name="meta[admin_id]" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-brand-primary/20">
                                            <option value="">-- Otomatis Berdasarkan Jabatan --</option>
                                            @foreach($allStaff as $stf)
                                                <option value="{{ $stf->id }}" {{ (string)$selectedAdminId === (string)$stf->id ? 'selected' : '' }}>
                                                    {{ $stf->name }} ({{ $stf->position ?? $stf->type }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Repeater Unit / KBK Tambahan -->
                            <div class="p-5 rounded-2xl bg-brand-surface/70 border border-slate-200 space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-bold text-brand-dark flex items-center gap-2">
                                            <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                            <span>Kelompok Bidang Keahlian (KBK) &amp; Unit Khusus</span>
                                        </h4>
                                        <p class="text-xs text-brand-muted">Unit penugasan riset dan instruksional di bawah naungan prodi.</p>
                                    </div>
                                    <button type="button" @click="addUnit()" class="px-3 py-1.5 rounded-xl bg-brand-primary-light text-brand-primary text-xs font-bold hover:bg-brand-primary hover:text-white transition-all flex items-center gap-1.5 shadow-2xs">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span>Tambah Unit/KBK</span>
                                    </button>
                                </div>

                                <div class="space-y-3">
                                    <template x-for="(u, idx) in customUnits" :key="idx">
                                        <div class="p-4 rounded-2xl bg-white border border-slate-200 space-y-3 shadow-2xs">
                                            <div class="flex items-center justify-between gap-3">
                                                <span class="text-xs font-bold text-brand-primary" x-text="'Unit #' + (idx + 1)"></span>
                                                <button type="button" @click="removeUnit(idx)" class="text-rose-500 hover:text-rose-700 text-xs font-semibold flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </div>

                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                <div>
                                                    <label class="block text-[11px] font-semibold text-brand-muted mb-1">Nama Unit / KBK</label>
                                                    <input type="text" :name="'meta[custom_units][' + idx + '][unit]'" x-model="u.unit" required class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                                </div>
                                                <div>
                                                    <label class="block text-[11px] font-semibold text-brand-muted mb-1">Koordinator / Penanggung Jawab</label>
                                                    <input type="text" :name="'meta[custom_units][' + idx + '][leader]'" x-model="u.leader" placeholder="Nama Dosen..." class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-[11px] font-semibold text-brand-muted mb-1">Deskripsi Ruang Lingkup</label>
                                                <textarea :name="'meta[custom_units][' + idx + '][desc]'" x-model="u.desc" rows="2" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs"></textarea>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-sm transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            @elseif(in_array($sec, ['identitas', 'homepage', 'kontak-sosmed', 'logo-favicon']))
                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6 text-xs sm:text-sm">
                    @csrf
                    <input type="hidden" name="section" value="{{ $sec }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="block font-bold text-brand-dark">Nama Website / Program Studi</label>
                            <input type="text" name="settings[site_name]" value="{{ old('settings.site_name', $settingsRecord['site_name'] ?? 'D-IV Teknik Rekayasa Multimedia') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block font-bold text-brand-dark">Singkatan Brand</label>
                            <input type="text" name="settings[site_tagline]" value="{{ old('settings.site_tagline', $settingsRecord['site_tagline'] ?? 'TRM POLITALA') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="block font-bold text-brand-dark">Email Resmi</label>
                            <input type="email" name="settings[contact_email]" value="{{ old('settings.contact_email', $settingsRecord['contact_email'] ?? 'trm@politala.ac.id') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block font-bold text-brand-dark">Nomor Telepon</label>
                            <input type="text" name="settings[contact_phone]" value="{{ old('settings.contact_phone', $settingsRecord['contact_phone'] ?? '(0512) 2021065') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block font-bold text-brand-dark">Alamat Kampus</label>
                        <textarea name="settings[contact_address]" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">{{ old('settings.contact_address', $settingsRecord['contact_address'] ?? 'Jl. A. Yani KM. 06, Desa Panggung, Kec. Pelaihari, Kab. Tanah Laut, Kalimantan Selatan 70815') }}</textarea>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-sm transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Simpan Pengaturan</span>
                        </button>
                    </div>
                </form>
            @else
                <div class="space-y-4">
                    <p class="text-xs text-brand-muted">Pengaturan profil akun atau unggahan berkas dapat dikelola langsung dari menu terkait.</p>
                </div>
            @endif
        </div>

    @elseif($isMediaGrid)
        {{-- VIEW MODE 2: MEDIA MANAGER GRID --}}
        <div class="space-y-6">
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
                <form method="GET" action="{{ route('admin.crud.sample', ['section' => $sec]) }}" class="relative w-full sm:w-80">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari media..." class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @if($paginator && $paginator->count() > 0)
                    @foreach($paginator as $m)
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-3 shadow-xs space-y-2 group hover:border-brand-primary/50 transition-all">
                            <div class="aspect-square rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 relative overflow-hidden">
                                <span class="text-[10px] font-mono">{{ $m->extension ?? 'FILE' }}</span>
                            </div>
                            <div class="space-y-0.5">
                                <h5 class="font-bold text-[11px] text-brand-dark truncate">{{ $m->filename }}</h5>
                                <span class="text-[10px] text-brand-muted block">{{ $m->file_size_formatted ?? '1.2 MB' }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    @for ($m = 1; $m <= 6; $m++)
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-3 shadow-xs space-y-2 group hover:border-brand-primary/50 transition-all">
                            <div class="aspect-square rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 relative overflow-hidden">
                                <span class="text-[10px] font-mono">JPG #{{ $m }}</span>
                            </div>
                            <div class="space-y-0.5">
                                <h5 class="font-bold text-[11px] text-brand-dark truncate">lab_multimedia_{{ $m }}.jpg</h5>
                                <span class="text-[10px] text-brand-muted block">1.5 MB &bull; JPG</span>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>

    @else
        {{-- VIEW MODE 3: TABULAR CRUD DATA LIST --}}
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <form method="GET" action="{{ route('admin.crud.sample', ['section' => $sec]) }}" class="flex flex-1 flex-wrap sm:flex-nowrap items-center gap-2.5 max-w-2xl">
                <div class="relative flex-1 min-w-[200px]">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}" 
                           placeholder="Cari dalam {{ strtolower($title) }}..." 
                           class="w-full pl-10 pr-8 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    @if(request('q'))
                        <a href="{{ route('admin.crud.sample', ['section' => $sec]) }}" class="absolute right-3 top-2 text-slate-400 hover:text-slate-600 text-base font-bold">&times;</a>
                    @endif
                </div>

                @if($sec === 'users')
                    <select name="role" onchange="this.form.submit()" class="px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20">
                        <option value="">Semua Peran</option>
                        @foreach($allRoles as $roleOption)
                            <option value="{{ $roleOption->slug }}" {{ request('role') === $roleOption->slug ? 'selected' : '' }}>{{ $roleOption->name }}</option>
                        @endforeach
                    </select>
                @endif

                <select name="per_page" onchange="this.form.submit()" class="px-2.5 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20">
                    <option value="5" {{ $perPage === 5 ? 'selected' : '' }}>5 / hal</option>
                    <option value="10" {{ $perPage === 10 ? 'selected' : '' }}>10 / hal</option>
                    <option value="25" {{ $perPage === 25 ? 'selected' : '' }}>25 / hal</option>
                </select>

                <button type="submit" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors shrink-0 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Cari</span>
                </button>
            </form>

            <button type="button" 
                    @if($sec === 'users')
                        @click="modalTitle = 'Tambah Pengguna'; formAction = '{{ route('admin.rbac.users.store') }}'; formMethod = 'POST'; formData = { id: null, name: '', email: '', role_id: '{{ $allRoles->first()?->id ?? 1 }}', password: '', status: 'published' }; modalOpen = true"
                    @elseif($sec === 'roles')
                        @click="modalTitle = 'Tambah Peran (Role)'; formAction = '{{ route('admin.rbac.roles.store') }}'; formMethod = 'POST'; formData = { id: null, name: '', slug: '', desc: '', status: 'published', permissions: [] }; modalOpen = true"
                    @elseif($sec === 'permissions')
                        @click="modalTitle = 'Tambah Hak Akses'; formAction = '{{ route('admin.rbac.permissions.store') }}'; formMethod = 'POST'; formData = { id: null, name: '', slug: '', module: 'Akademik & Pengajaran', desc: '', status: 'published' }; modalOpen = true"
                    @elseif(in_array($sec, ['dosen', 'tendik']))
                        @click="modalTitle = 'Tambah {{ $sec === 'tendik' ? 'Tenaga Kependidikan' : 'Dosen Pengajar' }}'; formAction = '{{ route('admin.staff.store') }}'; formMethod = 'POST'; formData = { id: null, name: '', nidn: '', nip: '', nip_nidn: '', position: '', academic_degree: '', education: '', expertise: '', email: '', phone: '', photo: '', order: 0, status: 'published' }; modalOpen = true"
                    @elseif($sec === 'berita')
                        @click="modalTitle = 'Tulis Berita Baru'; formAction = '{{ route('admin.news.store') }}'; formMethod = 'POST'; formData = { id: null, title: '', slug: '', category_id: '{{ $allCategories->first()?->id ?? '' }}', content: '', status: 'published' }; modalOpen = true"
                    @elseif($sec === 'pengumuman')
                        @click="modalTitle = 'Tambah Pengumuman Resmi'; formAction = '{{ route('admin.announcements.store') }}'; formMethod = 'POST'; formData = { id: null, title: '', slug: '', content: '', status: 'Akademik' }; modalOpen = true"
                    @elseif($sec === 'agenda')
                        @click="modalTitle = 'Jadwalkan Agenda Baru'; formAction = '{{ route('admin.events.store') }}'; formMethod = 'POST'; formData = { id: null, title: '', slug: '', location: '', event_date: '', start_time: '09:00', end_time: '15:00', speaker: '', status: 'Pendaftaran Dibuka' }; modalOpen = true"
                    @elseif($sec === 'kurikulum')
                        @click="modalTitle = 'Tambah Kurikulum Baru'; formAction = '{{ route('admin.curricula.store') }}'; formMethod = 'POST'; formData = { id: null, name: '', year: '2026', total_credits: 144, desc: '', status: 'published' }; modalOpen = true"
                    @elseif($sec === 'mata-kuliah')
                        @click="modalTitle = 'Tambah Mata Kuliah'; formAction = '{{ route('admin.courses.store') }}'; formMethod = 'POST'; formData = { id: null, curriculum_id: '{{ $allCurricula->first()?->id ?? 1 }}', code: '', name: '', theory_credits: 2, practice_credits: 2, semester: 1, desc: '' }; modalOpen = true"
                    @elseif($sec === 'kalender')
                        @click="modalTitle = 'Tambah Agenda Kalender'; formAction = '{{ route('admin.calendars.store') }}'; formMethod = 'POST'; formData = { id: null, academic_year: '2026/2027', semester: 'ganjil', title: '', start_date: '', end_date: '', desc: '' }; modalOpen = true"
                    @elseif($sec === 'cpl')
                        @click="modalTitle = 'Tambah Butir CPL'; formAction = '{{ route('admin.cpls.store') }}'; formMethod = 'POST'; formData = { id: null, code: '', category: 'Pengetahuan', desc: '' }; modalOpen = true"
                    @elseif($sec === 'profil-lulusan')
                        @click="modalTitle = 'Tambah Profil Lulusan'; formAction = '{{ route('admin.graduate-profiles.store') }}'; formMethod = 'POST'; formData = { id: null, title: '', desc: '', career_prospects: '' }; modalOpen = true"
                    @elseif($sec === 'fasilitas')
                        @click="modalTitle = 'Tambah Fasilitas / Lab'; formAction = '{{ route('admin.facilities.store') }}'; formMethod = 'POST'; formData = { id: null, name: '', category: 'Laboratorium Komputer', capacity: 36, location: 'Gedung TI Lantai 2', specifications: '', software: '', desc: '', order: 0, status: 'published', photo: '' }; modalOpen = true"
                    @elseif($sec === 'album-galeri')
                        @click="modalTitle = 'Buat Album Galeri'; formAction = '{{ route('admin.gallery-albums.store') }}'; formMethod = 'POST'; formData = { id: null, title: '', slug: '', desc: '' }; modalOpen = true"
                    @else
                        @click="modalTitle = 'Tambah ' + '{{ $title }}'; formAction = ''; formMethod = 'POST'; formData = { id: null, title: '' }; modalOpen = true"
                    @endif
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah {{ $title }}</span>
            </button>
        </div>

        <!-- Dynamic Data Table -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 uppercase tracking-wider font-semibold">
                        <tr>
                            <th class="py-3.5 px-6 w-12 text-center">No</th>
                            @if(in_array($sec, ['dosen', 'tendik']))
                                <th class="py-3.5 px-4">Nama Lengkap &amp; Gelar</th>
                                <th class="py-3.5 px-4">NIP / NIDN</th>
                                <th class="py-3.5 px-4">Jabatan</th>
                                <th class="py-3.5 px-4">{{ $sec === 'tendik' ? 'Bidang Tugas' : 'Keahlian & Pendidikan' }}</th>
                                <th class="py-3.5 px-4">Kontak</th>
                                <th class="py-3.5 px-4 text-center">Urutan</th>
                                <th class="py-3.5 px-4">Status</th>
                            @elseif($sec === 'kurikulum')
                                <th class="py-3.5 px-4">Nama Kurikulum</th>
                                <th class="py-3.5 px-4 text-center">Tahun Berlaku</th>
                                <th class="py-3.5 px-4 text-center">Total SKS</th>
                                <th class="py-3.5 px-4 text-center">Jumlah MK</th>
                                <th class="py-3.5 px-4">Status</th>
                            @elseif($sec === 'mata-kuliah')
                                <th class="py-3.5 px-4">Kode MK</th>
                                <th class="py-3.5 px-4">Nama Mata Kuliah</th>
                                <th class="py-3.5 px-4 text-center">Teori</th>
                                <th class="py-3.5 px-4 text-center">Praktik</th>
                                <th class="py-3.5 px-4 text-center">Semester</th>
                                <th class="py-3.5 px-4 text-center">Sifat</th>
                            @elseif($sec === 'kalender')
                                <th class="py-3.5 px-4">Nama Agenda Akademik</th>
                                <th class="py-3.5 px-4">Tahun Ajaran / Semester</th>
                                <th class="py-3.5 px-4">Jadwal Pelaksanaan</th>
                                <th class="py-3.5 px-4">Status</th>
                            @elseif($sec === 'cpl')
                                <th class="py-3.5 px-4">Kode CPL</th>
                                <th class="py-3.5 px-4">Kategori Aspek</th>
                                <th class="py-3.5 px-4">Uraian Kemampuan Lulusan</th>
                            @elseif($sec === 'profil-lulusan')
                                <th class="py-3.5 px-4">Profil Profesi</th>
                                <th class="py-3.5 px-4">Deskripsi Peran</th>
                                <th class="py-3.5 px-4">Peluang &amp; Lapangan Kerja</th>
                            @elseif($sec === 'berita')
                                <th class="py-3.5 px-4">Judul Berita</th>
                                <th class="py-3.5 px-4">Kategori</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-4">Tanggal Publikasi</th>
                            @elseif($sec === 'pengumuman')
                                <th class="py-3.5 px-4">Judul Pengumuman</th>
                                <th class="py-3.5 px-4">Klasifikasi</th>
                                <th class="py-3.5 px-4">Tanggal Publikasi</th>
                                <th class="py-3.5 px-4">Status</th>
                            @elseif($sec === 'agenda')
                                <th class="py-3.5 px-4">Nama Agenda Kegiatan</th>
                                <th class="py-3.5 px-4">Tanggal &amp; Waktu</th>
                                <th class="py-3.5 px-4">Lokasi &amp; Pemateri</th>
                                <th class="py-3.5 px-4">Status</th>
                            @elseif($sec === 'fasilitas')
                                <th class="py-3.5 px-4">Nama Fasilitas / Lab</th>
                                <th class="py-3.5 px-4">Kategori</th>
                                <th class="py-3.5 px-4">Kapasitas &amp; Lokasi</th>
                                <th class="py-3.5 px-4">Status</th>
                            @elseif($sec === 'album-galeri')
                                <th class="py-3.5 px-4">Judul Album</th>
                                <th class="py-3.5 px-4 text-center">Jumlah Foto</th>
                                <th class="py-3.5 px-4">Status</th>
                            @elseif($sec === 'users')
                                <th class="py-3.5 px-4">Nama Pengguna</th>
                                <th class="py-3.5 px-4">Email</th>
                                <th class="py-3.5 px-4">Peran</th>
                                <th class="py-3.5 px-4">Status</th>
                            @elseif($sec === 'roles')
                                <th class="py-3.5 px-4">Nama Peran</th>
                                <th class="py-3.5 px-4">Slug</th>
                                <th class="py-3.5 px-4 text-center">Pengguna</th>
                                <th class="py-3.5 px-4">Status</th>
                            @elseif($sec === 'permissions')
                                <th class="py-3.5 px-4">Nama Hak Akses</th>
                                <th class="py-3.5 px-4">Slug</th>
                                <th class="py-3.5 px-4">Modul</th>
                                <th class="py-3.5 px-4">Status</th>
                            @else
                                <th class="py-3.5 px-4">Nama / Judul</th>
                                <th class="py-3.5 px-4">Kategori</th>
                                <th class="py-3.5 px-4">Status</th>
                            @endif
                            <th class="py-3.5 px-6 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-brand-dark font-medium">
                        @if($paginator && $paginator->count() > 0)
                            @foreach($paginator as $k => $item)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="py-3.5 px-6 text-center text-slate-400 font-bold">
                                        {{ $paginator->firstItem() ? ($paginator->firstItem() + $k) : ($k + 1) }}
                                    </td>

                                    @if(in_array($sec, ['dosen', 'tendik']))
                                        <td class="py-3.5 px-4 font-bold text-brand-dark">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl overflow-hidden bg-brand-surface border border-slate-200 shrink-0 flex items-center justify-center shadow-2xs">
                                                    @if(!empty($item->photo))
                                                        <img src="{{ $item->photo_url }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-tr from-brand-primary/10 to-brand-surface text-brand-primary font-bold text-xs">
                                                            {{ strtoupper(substr($item->name, 0, 2)) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="font-extrabold text-brand-dark leading-snug">{{ $item->name }}</div>
                                                    @if($item->education)
                                                        <div class="text-[10px] text-brand-muted font-normal mt-0.5">{{ $item->education }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-4 font-mono text-slate-600 text-xs">{{ $item->nip_nidn ?? '-' }}</td>
                                        <td class="py-3.5 px-4">
                                            <span class="inline-block px-2.5 py-0.5 rounded-lg text-[11px] font-semibold bg-brand-primary-light text-brand-primary">
                                                {{ $item->position ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 text-slate-700 max-w-xs">
                                            <div class="text-xs font-medium truncate">{{ $item->expertise ?? '-' }}</div>
                                            @if($item->education && $sec === 'dosen')
                                                <div class="text-[10px] text-slate-500 truncate mt-0.5">{{ $item->education }}</div>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-4 text-xs">
                                            @if($item->email)
                                                <a href="mailto:{{ $item->email }}" class="text-brand-primary hover:underline flex items-center gap-1 font-medium truncate max-w-[150px]">
                                                    <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                    <span class="truncate">{{ $item->email }}</span>
                                                </a>
                                            @endif
                                            @if($item->phone)
                                                <span class="text-[10px] text-slate-500 block mt-0.5">{{ $item->phone }}</span>
                                            @endif
                                            @if(!$item->email && !$item->phone)
                                                <span class="text-slate-400">-</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-4 text-center font-bold text-slate-600">{{ $item->order }}</td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Staf: {{ addslashes($item->name) }}'; formAction = '{{ route('admin.staff.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, name: '{{ addslashes($item->name) }}', nidn: '{{ addslashes($item->nip_nidn ?? '') }}', nip: '{{ addslashes($item->nip_nidn ?? '') }}', nip_nidn: '{{ addslashes($item->nip_nidn ?? '') }}', position: '{{ addslashes($item->position ?? '') }}', academic_degree: '{{ addslashes($item->education ?? '') }}', education: '{{ addslashes($item->education ?? '') }}', expertise: '{{ addslashes($item->expertise ?? '') }}', email: '{{ addslashes($item->email ?? '') }}', phone: '{{ addslashes($item->phone ?? '') }}', photo: '{{ addslashes($item->photo ?? '') }}', order: {{ $item->order ?? 0 }}, status: '{{ $item->is_active ? 'published' : 'draft' }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors" title="Ubah Data">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = '{{ addslashes($item->name) }}'; deleteFormAction = '{{ route('admin.staff.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus Data">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'kurikulum')
                                        <td class="py-3.5 px-4 font-bold text-brand-dark">{{ $item->name }}</td>
                                        <td class="py-3.5 px-4 text-center font-bold">{{ $item->year }}</td>
                                        <td class="py-3.5 px-4 text-center">{{ $item->total_credits }} SKS</td>
                                        <td class="py-3.5 px-4 text-center">{{ $item->courses_count }} MK</td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $item->is_active ? 'Berlaku' : 'Arsip' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Kurikulum'; formAction = '{{ route('admin.curricula.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, name: '{{ addslashes($item->name) }}', year: '{{ $item->year }}', total_credits: {{ $item->total_credits }}, desc: '{{ addslashes($item->description ?? '') }}', status: '{{ $item->is_active ? 'published' : 'draft' }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Kurikulum {{ addslashes($item->name) }}'; deleteFormAction = '{{ route('admin.curricula.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'mata-kuliah')
                                        <td class="py-3.5 px-4 font-mono font-bold text-brand-primary">{{ $item->code }}</td>
                                        <td class="py-3.5 px-4 font-bold text-brand-dark">{{ $item->name }}</td>
                                        <td class="py-3.5 px-4 text-center">{{ $item->theory_credits }}</td>
                                        <td class="py-3.5 px-4 text-center">{{ $item->practice_credits }}</td>
                                        <td class="py-3.5 px-4 text-center">Semester {{ $item->semester }}</td>
                                        <td class="py-3.5 px-4 text-center">
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $item->is_mandatory ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $item->is_mandatory ? 'Wajib' : 'Pilihan' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Mata Kuliah'; formAction = '{{ route('admin.courses.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, curriculum_id: '{{ $item->curriculum_id }}', code: '{{ $item->code }}', name: '{{ addslashes($item->name) }}', theory_credits: {{ $item->theory_credits }}, practice_credits: {{ $item->practice_credits }}, semester: {{ $item->semester }}, desc: '{{ addslashes($item->description ?? '') }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Mata Kuliah {{ addslashes($item->name) }}'; deleteFormAction = '{{ route('admin.courses.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'berita')
                                        <td class="py-3.5 px-4 font-bold text-brand-dark max-w-sm truncate">{{ $item->title }}</td>
                                        <td class="py-3.5 px-4 text-brand-muted">{{ $item->category->name ?? 'Umum' }}</td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                                {{ $item->status === 'published' ? 'Terbit' : 'Draf' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 text-slate-400">{{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}</td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Berita'; formAction = '{{ route('admin.news.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, title: '{{ addslashes($item->title) }}', slug: '{{ $item->slug }}', category_id: '{{ $item->category_id }}', content: '{{ addslashes($item->content) }}', status: '{{ $item->status }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Berita {{ addslashes($item->title) }}'; deleteFormAction = '{{ route('admin.news.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'pengumuman')
                                        <td class="py-3.5 px-4 font-bold text-brand-dark max-w-sm truncate">{{ $item->title }}</td>
                                        <td class="py-3.5 px-4 text-brand-muted">{{ $item->status }}</td>
                                        <td class="py-3.5 px-4 text-slate-400">{{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}</td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Arsip' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Pengumuman'; formAction = '{{ route('admin.announcements.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, title: '{{ addslashes($item->title) }}', slug: '{{ $item->slug }}', content: '{{ addslashes($item->content) }}', status: '{{ $item->status }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Pengumuman {{ addslashes($item->title) }}'; deleteFormAction = '{{ route('admin.announcements.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'agenda')
                                        <td class="py-3.5 px-4 font-bold text-brand-dark max-w-sm truncate">{{ $item->title }}</td>
                                        <td class="py-3.5 px-4 text-brand-muted">
                                            {{ $item->event_date ? $item->event_date->format('d M Y') : '-' }} ({{ $item->start_time ?? '09:00' }})
                                        </td>
                                        <td class="py-3.5 px-4 text-slate-700">
                                            <div>{{ $item->location }}</div>
                                            <div class="text-[10px] text-slate-500">{{ $item->speaker ?? 'Dosen TRM' }}</div>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-brand-sky-light text-brand-primary border border-brand-sky/40">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Agenda'; formAction = '{{ route('admin.events.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, title: '{{ addslashes($item->title) }}', slug: '{{ $item->slug }}', location: '{{ addslashes($item->location) }}', event_date: '{{ $item->event_date ? $item->event_date->format('Y-m-d') : '' }}', start_time: '{{ $item->start_time }}', end_time: '{{ $item->end_time }}', speaker: '{{ addslashes($item->speaker ?? '') }}', status: '{{ $item->status }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Agenda {{ addslashes($item->title) }}'; deleteFormAction = '{{ route('admin.events.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'fasilitas')
                                        <td class="py-3.5 px-4 font-bold text-brand-dark">
                                            <div class="flex items-center gap-3">
                                                @if($item->image_url)
                                                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-10 h-10 rounded-xl object-cover border border-slate-200 shrink-0">
                                                @else
                                                    <div class="w-10 h-10 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold text-xs shrink-0">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="font-extrabold text-brand-dark">{{ $item->name }}</div>
                                                    <div class="text-[11px] text-slate-400 font-mono">/fasilitas #{{ $item->order }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                                @if(str_contains(strtolower($item->category ?? ''), 'studio'))
                                                    bg-purple-50 text-purple-700 border border-purple-200
                                                @elseif(str_contains(strtolower($item->category ?? ''), 'sarana') || str_contains(strtolower($item->category ?? ''), 'pbl'))
                                                    bg-amber-50 text-amber-700 border border-amber-200
                                                @else
                                                    bg-blue-50 text-blue-700 border border-blue-200
                                                @endif">
                                                {{ $item->category ?? 'Laboratorium' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 text-slate-700">
                                            <div class="font-semibold text-xs text-brand-dark">{{ $item->capacity }} Unit Workstation</div>
                                            <div class="text-[11px] text-brand-muted mt-0.5">{{ $item->location ?? 'Gedung TI' }}</div>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $item->is_active ? 'Tersedia' : 'Pemeliharaan' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Fasilitas'; formAction = '{{ route('admin.facilities.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, name: '{{ addslashes($item->name) }}', category: '{{ addslashes($item->category ?? 'Laboratorium Komputer') }}', capacity: {{ $item->capacity ?? 30 }}, location: '{{ addslashes($item->location ?? '') }}', specifications: '{{ addslashes($item->specifications ?? '') }}', software: '{{ addslashes($item->software ?? '') }}', desc: '{{ addslashes($item->description ?? '') }}', order: {{ $item->order ?? 0 }}, status: '{{ $item->is_active ? 'published' : 'draft' }}', photo: '{{ $item->image_url ?? '' }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Fasilitas {{ addslashes($item->name) }}'; deleteFormAction = '{{ route('admin.facilities.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'album-galeri')
                                        <td class="py-3.5 px-4 font-bold text-brand-dark">{{ $item->title }}</td>
                                        <td class="py-3.5 px-4 text-center font-bold">{{ $item->photos_count }} Foto</td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $item->is_active ? 'Publik' : 'Draf' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Album'; formAction = '{{ route('admin.gallery-albums.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, title: '{{ addslashes($item->title) }}', slug: '{{ $item->slug }}', desc: '{{ addslashes($item->description ?? '') }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Album {{ addslashes($item->title) }}'; deleteFormAction = '{{ route('admin.gallery-albums.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'cpl')
                                        <td class="py-3.5 px-4 font-mono font-bold text-brand-primary">{{ $item->code }}</td>
                                        <td class="py-3.5 px-4 text-brand-muted font-bold">{{ $item->category }}</td>
                                        <td class="py-3.5 px-4 text-slate-700 max-w-md">{{ $item->description }}</td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah CPL'; formAction = '{{ route('admin.cpls.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, code: '{{ $item->code }}', category: '{{ $item->category }}', desc: '{{ addslashes($item->description) }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'CPL {{ $item->code }}'; deleteFormAction = '{{ route('admin.cpls.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'profil-lulusan')
                                        <td class="py-3.5 px-4 font-bold text-brand-dark">{{ $item->title }}</td>
                                        <td class="py-3.5 px-4 text-slate-600 max-w-sm">{{ $item->description }}</td>
                                        <td class="py-3.5 px-4 text-brand-muted">{{ $item->career_prospects ?? '-' }}</td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Profil Lulusan'; formAction = '{{ route('admin.graduate-profiles.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, title: '{{ addslashes($item->title) }}', desc: '{{ addslashes($item->description) }}', career_prospects: '{{ addslashes($item->career_prospects ?? '') }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Profil {{ addslashes($item->title) }}'; deleteFormAction = '{{ route('admin.graduate-profiles.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'users')
                                        <td class="py-3.5 px-4 font-bold text-brand-dark">{{ $item->name }}</td>
                                        <td class="py-3.5 px-4 text-slate-600">{{ $item->email }}</td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-brand-sky-light text-brand-primary border border-brand-sky">
                                                {{ $item->roleRelation->name ?? $item->role }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Pengguna'; formAction = '{{ route('admin.rbac.users.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, name: '{{ addslashes($item->name) }}', email: '{{ $item->email }}', role_id: '{{ $item->role_id ?? ($allRoles->firstWhere('slug', $item->role)?->id ?? 1) }}', status: '{{ $item->is_active ? 'published' : 'draft' }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Akun {{ addslashes($item->name) }}'; deleteFormAction = '{{ route('admin.rbac.users.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'roles')
                                        <td class="py-3.5 px-4 font-bold text-brand-dark">{{ $item->name }}</td>
                                        <td class="py-3.5 px-4 font-mono text-[11px] text-brand-primary">{{ $item->slug }}</td>
                                        <td class="py-3.5 px-4 text-center">{{ $item->users_count }} Akun</td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Peran'; formAction = '{{ route('admin.rbac.roles.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, name: '{{ addslashes($item->name) }}', slug: '{{ $item->slug }}', desc: '{{ addslashes($item->description ?? '') }}', status: '{{ $item->is_active ? 'published' : 'draft' }}', permissions: {{ json_encode($item->permissions->pluck('id')->all()) }} }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Peran {{ addslashes($item->name) }}'; deleteFormAction = '{{ route('admin.rbac.roles.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @elseif($sec === 'permissions')
                                        <td class="py-3.5 px-4 font-bold text-brand-dark">{{ $item->name }}</td>
                                        <td class="py-3.5 px-4 font-mono text-[11px] text-brand-primary">{{ $item->slug }}</td>
                                        <td class="py-3.5 px-4 text-slate-600">{{ $item->module }}</td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $item->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button" 
                                                        @click="modalTitle = 'Ubah Hak Akses'; formAction = '{{ route('admin.rbac.permissions.update', $item) }}'; formMethod = 'PUT'; formData = { id: {{ $item->id }}, name: '{{ addslashes($item->name) }}', slug: '{{ $item->slug }}', module: '{{ addslashes($item->module) }}', desc: '{{ addslashes($item->description ?? '') }}', status: '{{ $item->is_active ? 'published' : 'draft' }}' }; modalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-slate-100 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button type="button" 
                                                        @click="selectedItem = 'Hak Akses {{ addslashes($item->name) }}'; deleteFormAction = '{{ route('admin.rbac.permissions.destroy', $item) }}'; deleteModalOpen = true" 
                                                        class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        <div class="text-xs font-semibold text-slate-500">
                                            Belum ada data {{ strtolower($title) }} yang terdaftar di sistem.
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Dynamic Pagination Summary -->
            @if($paginator instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                <div class="px-6 py-4 bg-slate-50/70 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-brand-muted">
                    <div>
                        @if($paginator->total() > 0)
                            <span>Menampilkan <strong class="text-brand-dark">{{ $paginator->firstItem() }}</strong> sampai <strong class="text-brand-dark">{{ $paginator->lastItem() }}</strong> dari <strong class="text-brand-dark">{{ $paginator->total() }}</strong> data terdaftar</span>
                        @else
                            <span>Tidak ada data yang tersedia</span>
                        @endif
                    </div>

                    @if($paginator->hasPages())
                        <div class="flex items-center gap-1">
                            @foreach($paginator->onEachSide(1)->linkCollection() as $link)
                                @if(str_contains($link['label'], 'Previous'))
                                    @if($link['url'])
                                        <a href="{{ $link['url'] }}" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-semibold transition-colors">Sebelumnya</a>
                                    @else
                                        <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-300 font-semibold cursor-not-allowed">Sebelumnya</span>
                                    @endif
                                @elseif(str_contains($link['label'], 'Next'))
                                    @if($link['url'])
                                        <a href="{{ $link['url'] }}" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-semibold transition-colors">Selanjutnya</a>
                                    @else
                                        <span class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-300 font-semibold cursor-not-allowed">Selanjutnya</span>
                                    @endif
                                @elseif($link['label'] === '...')
                                    <span class="px-2.5 py-1.5 text-slate-400 font-bold">...</span>
                                @elseif($link['active'])
                                    <span class="px-3 py-1.5 rounded-lg bg-brand-primary text-white font-bold shadow-xs">{{ $link['label'] }}</span>
                                @else
                                    <a href="{{ $link['url'] }}" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-semibold transition-colors">{{ $link['label'] }}</a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Modal Form Tambah / Ubah -->
        <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div x-show="modalOpen" 
                     @click="modalOpen = false" 
                     class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs"></div>

                <div x-show="modalOpen" 
                     class="relative inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle bg-white rounded-3xl shadow-xl border border-slate-200/80">
                    
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                        <h3 class="text-base font-bold text-brand-dark" x-text="modalTitle">Formulir Data</h3>
                        <button type="button" @click="modalOpen = false" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form :action="formAction" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                        @csrf
                        <template x-if="formMethod === 'PUT'">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        @if(in_array($sec, ['dosen', 'tendik']))
                            <input type="hidden" name="type" value="{{ $sec === 'tendik' ? 'tendik' : 'dosen' }}">
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Nama Lengkap &amp; Gelar <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" x-model="formData.name" placeholder="cth: Ir. Ahmad Junaidi, M.Kom." required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-brand-primary/20">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">NIP</label>
                                    <input type="text" name="nip" x-model="formData.nip" placeholder="cth: 1985031..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-mono">
                                </div>
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">NIDN</label>
                                    <input type="text" name="nidn" x-model="formData.nidn" placeholder="cth: 110508..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-mono">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Jabatan / Posisi</label>
                                    <input type="text" name="position" x-model="formData.position" placeholder="{{ $sec === 'tendik' ? 'cth: Pranata Laboratorium Pendidikan' : 'cth: Koordinator Program Studi / Lektor' }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Urutan Tampilan</label>
                                    <input type="number" name="order" x-model="formData.order" placeholder="0" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">{{ $sec === 'tendik' ? 'Bidang Tugas / Layanan' : 'Bidang Keahlian' }}</label>
                                    <input type="text" name="expertise" x-model="formData.expertise" placeholder="{{ $sec === 'tendik' ? 'cth: Pengelolaan Lab Studio Komputer' : 'cth: Game Programming, 3D Animation' }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Pendidikan Terakhir</label>
                                    <input type="text" name="education" x-model="formData.education" placeholder="{{ $sec === 'tendik' ? 'cth: D-3 Teknik Informatika' : 'cth: S2 Ilmu Komputer - UGM' }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Alamat Email</label>
                                    <input type="email" name="email" x-model="formData.email" placeholder="cth: staf@politala.ac.id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Nomor Telepon / WhatsApp</label>
                                    <input type="text" name="phone" x-model="formData.phone" placeholder="cth: 08123456789" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Foto Profil</label>
                                <div class="space-y-2">
                                    <input type="file" name="photo_file" accept="image/png,image/jpeg,image/webp" class="w-full px-3 py-1.5 rounded-xl border border-slate-200 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-primary-light file:text-brand-primary hover:file:bg-brand-primary hover:file:text-white">
                                    <input type="text" name="photo" x-model="formData.photo" placeholder="Atau masukkan path / URL foto (cth: /images/...)" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs">
                                </div>
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Status Keaktifan</label>
                                <select name="is_active" x-model="formData.status" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                    <option value="published">Aktif (Ditampilkan di Website)</option>
                                    <option value="draft">Nonaktif (Disembunyikan)</option>
                                </select>
                            </div>
                        @elseif($sec === 'kurikulum')
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Nama Kurikulum <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" x-model="formData.name" placeholder="cth: Kurikulum OBE 2026" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Tahun Berlaku <span class="text-rose-500">*</span></label>
                                    <input type="text" name="year" x-model="formData.year" placeholder="2026" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Total SKS</label>
                                    <input type="number" name="total_credits" x-model="formData.total_credits" value="144" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Deskripsi Ringkas</label>
                                <textarea name="description" x-model="formData.desc" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs"></textarea>
                            </div>
                        @elseif($sec === 'mata-kuliah')
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Kurikulum Induk <span class="text-rose-500">*</span></label>
                                <select name="curriculum_id" x-model="formData.curriculum_id" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                    @foreach($allCurricula as $curr)
                                        <option value="{{ $curr->id }}">{{ $curr->name }} ({{ $curr->year }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Kode MK <span class="text-rose-500">*</span></label>
                                    <input type="text" name="code" x-model="formData.code" placeholder="TRM101" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-mono">
                                </div>
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Teori (SKS)</label>
                                    <input type="number" name="theory_credits" x-model="formData.theory_credits" min="0" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Praktik (SKS)</label>
                                    <input type="number" name="practice_credits" x-model="formData.practice_credits" min="0" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Nama Mata Kuliah <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" x-model="formData.name" placeholder="cth: Pemrograman Multimedia" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Semester</label>
                                <select name="semester" x-model="formData.semester" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                    @for($s = 1; $s <= 8; $s++)
                                        <option value="{{ $s }}">Semester {{ $s }}</option>
                                    @endfor
                                </select>
                            </div>
                        @elseif($sec === 'berita')
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Judul Berita <span class="text-rose-500">*</span></label>
                                <input type="text" name="title" x-model="formData.title" placeholder="Masukkan judul berita..." required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Kategori</label>
                                <select name="category_id" x-model="formData.category_id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                    @foreach($allCategories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Isi Konten Berita <span class="text-rose-500">*</span></label>
                                <textarea name="content" x-model="formData.content" rows="6" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs"></textarea>
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Status Publikasi</label>
                                <select name="status" x-model="formData.status" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                    <option value="published">Publikasikan Langsung</option>
                                    <option value="draft">Simpan Sebagai Draf</option>
                                </select>
                            </div>
                        @elseif($sec === 'pengumuman')
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Judul Pengumuman <span class="text-rose-500">*</span></label>
                                <input type="text" name="title" x-model="formData.title" placeholder="cth: Jadwal Pengambilan Kartu Rencana Studi" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Klasifikasi</label>
                                <select name="status" x-model="formData.status" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                    <option value="Akademik">Akademik</option>
                                    <option value="Kemahasiswaan">Kemahasiswaan</option>
                                    <option value="Tugas Akhir">Tugas Akhir / Skripsi</option>
                                    <option value="Magang Industri">Magang Industri</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Isi Pengumuman <span class="text-rose-500">*</span></label>
                                <textarea name="content" x-model="formData.content" rows="6" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs"></textarea>
                            </div>
                        @elseif($sec === 'agenda')
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Nama Kegiatan <span class="text-rose-500">*</span></label>
                                <input type="text" name="title" x-model="formData.title" placeholder="cth: Kuliah Pakar Industri Game" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Tanggal Pelaksanaan <span class="text-rose-500">*</span></label>
                                    <input type="date" name="event_date" x-model="formData.event_date" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Waktu Mulai</label>
                                    <input type="text" name="start_time" x-model="formData.start_time" placeholder="09:00" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Lokasi Kegiatan <span class="text-rose-500">*</span></label>
                                <input type="text" name="location" x-model="formData.location" placeholder="Auditorium Kampus POLITALA" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Narasumber / Pembicara</label>
                                <input type="text" name="speaker" x-model="formData.speaker" placeholder="cth: Lead Animator Studio XYZ" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                        @elseif($sec === 'fasilitas')
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Nama Fasilitas / Lab <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" x-model="formData.name" placeholder="cth: Studio Animasi 3D & Motion Capture" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Kategori Fasilitas</label>
                                    <select name="category" x-model="formData.category" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                        <option value="Laboratorium Komputer">Laboratorium Komputer</option>
                                        <option value="Studio Produksi & Cinema">Studio Produksi &amp; Cinema</option>
                                        <option value="Sarana Pendukung & Riset">Sarana Pendukung &amp; Riset</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Kapasitas (PC/Orang)</label>
                                    <input type="number" name="capacity" x-model="formData.capacity" placeholder="36" min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                                <div>
                                    <label class="block font-bold text-brand-dark mb-1.5">Urutan Prioritas</label>
                                    <input type="number" name="order" x-model="formData.order" placeholder="0" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                </div>
                            </div>

                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Lokasi Gedung / Ruangan</label>
                                <input type="text" name="location" x-model="formData.location" placeholder="Gedung TI Lantai 2 - Ruang 201" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>

                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Spesifikasi Hardware / Perangkat Keras</label>
                                <textarea name="specifications" x-model="formData.specifications" rows="2" placeholder="cth: 36 Unit Workstation Core i9, Dual GPU RTX 4090, 64GB RAM, VR Headset..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs"></textarea>
                            </div>

                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Software &amp; Tools Utama (Pisahkan dengan koma)</label>
                                <input type="text" name="software" x-model="formData.software" placeholder="Blender 4, Unreal Engine 5, Adobe After Effects, Maya, Unity" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>

                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Uraian &amp; Fungsi Praktikum</label>
                                <textarea name="description" x-model="formData.desc" rows="3" placeholder="Jelaskan peruntukan praktikum dan kegiatan riset pada fasilitas ini..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs"></textarea>
                            </div>

                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Foto Fasilitas (Unggah File Gambar)</label>
                                <template x-if="formData.photo">
                                    <div class="mb-2 flex items-center gap-3 p-2 bg-slate-50 rounded-xl border border-slate-200">
                                        <img :src="formData.photo" alt="Preview Foto" class="w-16 h-12 rounded-lg object-cover border border-slate-200">
                                        <div class="text-[11px] text-brand-muted">Foto saat ini tersimpan di sistem.</div>
                                    </div>
                                </template>
                                <input type="file" name="image_file" accept="image/jpeg,image/png,image/webp" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-primary-light file:text-brand-primary hover:file:bg-brand-primary hover:file:text-white file:transition-colors">
                                <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WebP. Maks 4MB.</p>
                            </div>

                            <div class="flex items-center gap-2 pt-1">
                                <input type="checkbox" name="is_active" id="facility_is_active" value="1" :checked="formData.status === 'published' || formData.status === '1' || formData.status === true" class="rounded text-brand-primary focus:ring-brand-primary">
                                <label for="facility_is_active" class="font-bold text-brand-dark text-xs cursor-pointer">Fasilitas aktif dan siap digunakan untuk perkuliahan/praktikum</label>
                            </div>
                        @elseif($sec === 'users')
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Nama Pengguna <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" x-model="formData.name" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Email Login <span class="text-rose-500">*</span></label>
                                <input type="email" name="email" x-model="formData.email" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Peran (Role) <span class="text-rose-500">*</span></label>
                                <select name="role_id" x-model="formData.role_id" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                                    @foreach($allRoles as $roleOption)
                                        <option value="{{ $roleOption->id }}">{{ $roleOption->name }} ({{ $roleOption->slug }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Kata Sandi</label>
                                <input type="password" name="password" x-model="formData.password" placeholder="Kosongkan jika tidak ingin mengubah..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                        @else
                            <div>
                                <label class="block font-bold text-brand-dark mb-1.5">Nama / Judul <span class="text-rose-500">*</span></label>
                                <input type="text" name="title" x-model="formData.title" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs">
                            </div>
                        @endif

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                            <button type="button" @click="modalOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 font-semibold text-slate-600 hover:bg-slate-50">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 rounded-xl bg-brand-primary text-white font-bold hover:bg-brand-primary-hover shadow-sm">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div x-show="deleteModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div x-show="deleteModalOpen" @click="deleteModalOpen = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs"></div>

                <div x-show="deleteModalOpen" class="relative inline-block w-full max-w-sm p-6 overflow-hidden text-center align-middle bg-white rounded-3xl shadow-xl border border-slate-200/80">
                    <div class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 mx-auto flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h4 class="text-base font-bold text-brand-dark mb-1">Konfirmasi Penghapusan</h4>
                    <p class="text-xs text-brand-muted leading-relaxed mb-6">
                        Apakah Anda yakin ingin menghapus <strong x-text="selectedItem"></strong>? Tindakan ini akan menghapus data secara permanen dari basis data.
                    </p>
                    <div class="flex items-center justify-center gap-3">
                        <button type="button" @click="deleteModalOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <form :action="deleteFormAction" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-sm transition-colors">
                                Ya, Hapus Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
