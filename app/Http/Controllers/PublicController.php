<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendar;
use App\Models\Announcement;
use App\Models\Cpl;
use App\Models\Curriculum;
use App\Models\Event;
use App\Models\Facility;
use App\Models\GalleryAlbum;
use App\Models\GraduateProfile;
use App\Models\News;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\StudyProgramProfile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display public homepage with live database content and highlights.
     */
    public function home(): View
    {
        $latestNews = News::published()
            ->with('category')
            ->latest('published_at')
            ->take(3)
            ->get();

        $upcomingEvents = Event::upcoming()
            ->take(2)
            ->get();

        $facilities = Facility::active()
            ->take(3)
            ->get();

        $lecturersCount = Staff::lecturers()->active()->count();
        $profile = StudyProgramProfile::forSection('visi_misi');
        $historyProfile = StudyProgramProfile::forSection('sejarah');
        $timeline = data_get($historyProfile, 'meta.timeline', []);

        return view('public.home', compact('latestNews', 'upcomingEvents', 'facilities', 'lecturersCount', 'profile', 'historyProfile', 'timeline'));
    }

    /**
     * Sejarah Program Studi.
     */
    public function history(): View
    {
        $profile = StudyProgramProfile::forSection('sejarah');
        $timeline = data_get($profile, 'meta.timeline', []);

        return view('public.profile.history', compact('profile', 'timeline'));
    }

    /**
     * Visi & Misi Program Studi.
     */
    public function visionMission(): View
    {
        $profile = StudyProgramProfile::forSection('visi_misi');
        $vision = data_get($profile, 'meta.vision_statement', 'Menjadi pusat pendidikan tinggi vokasi unggulan dan rujukan di bidang teknologi rekayasa multimedia terapan yang berdaya saing global, inovatif, dan berjiwa wirausaha pada tahun 2030.');
        $targetYear = data_get($profile, 'meta.target_year', '2030');
        $missions = data_get($profile, 'meta.missions', []);
        $goals = data_get($profile, 'meta.goals', []);
        $coreValues = data_get($profile, 'meta.core_values', []);

        return view('public.profile.vision-mission', compact('profile', 'vision', 'targetYear', 'missions', 'goals', 'coreValues'));
    }

    /**
     * Sambutan Ketua Program Studi.
     */
    public function welcome(): View
    {
        $profile = StudyProgramProfile::forSection('sambutan');
        $kaprodi = Staff::where('position', 'like', '%Koordinator Program Studi%')->first()
            ?? Staff::lecturers()->first();

        $kaprodiName = data_get($profile, 'meta.kaprodi_name', $kaprodi?->name ?? 'Dr. H. Rian Hidayat, M.Kom.');
        $kaprodiNip = data_get($profile, 'meta.kaprodi_nip', $kaprodi?->nip_nidn ?? '198504122014041001');
        $kaprodiPosition = data_get($profile, 'meta.kaprodi_position', $kaprodi?->position ?? 'Koordinator Program Studi Sarjana Terapan TRM');
        $kaprodiDepartment = data_get($profile, 'meta.kaprodi_department', 'Jurusan Komputer dan Bisnis, Politeknik Negeri Tanah Laut');
        $kaprodiEmail = data_get($profile, 'meta.kaprodi_email', $kaprodi?->email ?? 'rian.hidayat@politala.ac.id');
        $kaprodiPhoto = data_get($profile, 'meta.kaprodi_photo_url', $kaprodi?->photo);
        $period = data_get($profile, 'meta.period', 'Periode 2024 - 2028');

        $pageTitle = $profile?->title ?? 'Sambutan Ketua Program Studi';
        $pageSubtitle = data_get($profile, 'meta.subtitle', 'Pesan dan visi kepemimpinan Program Studi Sarjana Terapan Teknik Rekayasa Multimedia');
        $greeting = data_get($profile, 'meta.greeting', 'Assalamu’alaikum Warahmatullahi Wabarakatuh & Salam Sejahtera,');
        $quote = data_get($profile, 'meta.quote', 'TRM POLITALA hadir untuk melahirkan talenta digital masa depan yang memadukan keunggulan rekayasa teknologi dan estetika seni multimedia.');
        $content = $profile?->content ?? "Selamat datang di website resmi Program Studi Sarjana Terapan (D-4) Teknik Rekayasa Multimedia (TRM) Politeknik Negeri Tanah Laut.\n\nEra transformasi digital saat ini menuntut sinergi antara kemampuan rekayasa perangkat lunak dan kepekaan seni multimedia. TRM POLITALA hadir dengan visi mencetak sarjana terapan yang tidak hanya memahami teori komputasi, tetapi juga mahir merancang game, memproduksi aset 3D & animasi, serta membangun solusi virtual dan augmented reality yang relevan dengan kebutuhan dunia kerja saat ini.\n\nMelalui kurikulum berbasis Teaching Factory dan Project-Based Learning, mahasiswa kami dipersiapkan sejak semester awal untuk mengerjakan proyek nyata bersama mitra industri. Kami berkomitmen untuk menyediakan iklim akademik yang kolaboratif, fasilitas laboratorium berteknologi terkini, dan bimbingan dosen yang berdedikasi.\n\nKami mengajak seluruh calon mahasiswa, mitra industri, dan masyarakat untuk bersama-sama mengembangkan ekosistem multimedia terapan yang unggul dan berdaya saing.";
        $closingGreeting = data_get($profile, 'meta.closing_greeting', 'Wassalamu’alaikum Warahmatullahi Wabarakatuh.');
        $signatureTitle = data_get($profile, 'meta.signature_title', 'Koordinator Program Studi D-4 TRM POLITALA');
        $signatureName = data_get($profile, 'meta.signature_name', $kaprodiName);
        $videoUrl = data_get($profile, 'meta.video_url');

        $keyPoints = data_get($profile, 'meta.key_points', [
            [
                'badge' => 'Metode Belajar',
                'title' => 'Pembelajaran Berbasis Proyek (PBL)',
                'description' => 'Kurikulum vokasi 70% praktik yang membiasakan mahasiswa menyelesaikan proyek riil industri animasi, game, dan aplikasi interaktif sejak awal perkuliahan.',
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
                'description' => 'Setiap lulusan dibekali sertifikasi kompetensi profesi dan portofolio karya teruji sebelum wisuda untuk menjamin daya serap kerja.',
            ],
        ]);

        return view('public.profile.welcome', compact(
            'profile',
            'kaprodi',
            'kaprodiName',
            'kaprodiNip',
            'kaprodiPosition',
            'kaprodiDepartment',
            'kaprodiEmail',
            'kaprodiPhoto',
            'period',
            'pageTitle',
            'pageSubtitle',
            'greeting',
            'quote',
            'content',
            'closingGreeting',
            'signatureTitle',
            'signatureName',
            'videoUrl',
            'keyPoints'
        ));
    }

    /**
     * Struktur Organisasi.
     */
    public function structure(): View
    {
        $profile = StudyProgramProfile::forSection('struktur');
        $staffList = Staff::active()->orderBy('order')->get();
        $lecturers = $staffList->where('type', 'dosen')->values();
        $tendikList = $staffList->where('type', 'tendik')->values();

        $meta = $profile?->meta ?? [];

        // 1. Kaprodi
        $kaprodi = null;
        if (! empty($meta['kaprodi_id'])) {
            $kaprodi = $staffList->firstWhere('id', (int) $meta['kaprodi_id']);
        }
        if (! $kaprodi) {
            $kaprodi = $staffList->first(function ($s) {
                $pos = strtolower($s->position ?? '');

                return str_contains($pos, 'koordinator program studi') || str_contains($pos, 'kaprodi');
            }) ?? $lecturers->first();
        }

        // 2. Kepala Laboratorium & Studio
        $kaLab = null;
        if (! empty($meta['kalab_id'])) {
            $kaLab = $staffList->firstWhere('id', (int) $meta['kalab_id']);
        }
        if (! $kaLab) {
            $kaLab = $staffList->first(function ($s) {
                $pos = strtolower($s->position ?? '');

                return str_contains($pos, 'kepala studio') || str_contains($pos, 'kepala lab') || str_contains($pos, 'kalab');
            });
        }

        // 3. Pranata Laboratorium Pendidikan (PLP)
        $plp = null;
        if (! empty($meta['plp_id'])) {
            $plp = $staffList->firstWhere('id', (int) $meta['plp_id']);
        }
        if (! $plp) {
            $plp = $staffList->first(function ($s) {
                $pos = strtolower($s->position ?? '');

                return str_contains($pos, 'pranata laboratorium') || str_contains($pos, 'plp') || str_contains($pos, 'laboran');
            }) ?? $tendikList->first();
        }

        // 4. Koordinator MBKM & Kemitraan
        $koordMbkm = null;
        if (! empty($meta['mbkm_id'])) {
            $koordMbkm = $staffList->firstWhere('id', (int) $meta['mbkm_id']);
        }
        if (! $koordMbkm) {
            $koordMbkm = $staffList->first(function ($s) {
                $pos = strtolower($s->position ?? '');

                return str_contains($pos, 'mbkm') || str_contains($pos, 'kerjasama') || str_contains($pos, 'magang');
            });
        }

        // 5. Pembina Kemahasiswaan & Studio Game
        $pembinaKemahasiswaan = null;
        if (! empty($meta['kemahasiswaan_id'])) {
            $pembinaKemahasiswaan = $staffList->firstWhere('id', (int) $meta['kemahasiswaan_id']);
        }
        if (! $pembinaKemahasiswaan) {
            $pembinaKemahasiswaan = $staffList->first(function ($s) {
                $pos = strtolower($s->position ?? '');

                return str_contains($pos, 'kemahasiswaan') || str_contains($pos, 'studio game') || str_contains($pos, 'ormawa');
            });
        }

        // 6. Tata Usaha & Layanan Administrasi
        $adminStaff = null;
        if (! empty($meta['admin_id'])) {
            $adminStaff = $staffList->firstWhere('id', (int) $meta['admin_id']);
        }
        if (! $adminStaff) {
            $adminStaff = $staffList->first(function ($s) use ($plp) {
                $pos = strtolower($s->position ?? '');

                return (str_contains($pos, 'administrasi') || str_contains($pos, 'tata usaha') || $s->type === 'tendik') && $s->id !== $plp?->id;
            }) ?? $tendikList->where('id', '!=', $plp?->id)->first();
        }

        // Metadata override from CMS if specified
        $departmentHead = [
            'title' => 'Ketua Jurusan Komputer & Bisnis',
            'name' => data_get($meta, 'department_head_name', 'Hj. Agustian Noor, S.Kom., M.Kom.'),
            'nip' => data_get($meta, 'department_head_nip', '197908152005011002'),
            'institution' => data_get($meta, 'department_head_dept', 'Jurusan Komputer & Bisnis, Politeknik Negeri Tanah Laut'),
        ];

        $gkm = [
            'title' => 'Gugus Kendali Mutu (GKM) Prodi',
            'name' => data_get($meta, 'gkm_name', 'Tim Penjaminan Mutu Internal TRM'),
            'nip' => data_get($meta, 'gkm_nip', 'Standar Mutu LAM-INFOKOM'),
            'institution' => 'Pusat Penjaminan Mutu (P4M) POLITALA',
        ];

        $skNumber = data_get($meta, 'sk_number', 'SK Direktur POLITALA No. 124/PL34/OT/2026');
        $academicYear = data_get($meta, 'academic_year', 'Tahun Akademik 2026/2027');
        $customUnits = data_get($meta, 'custom_units', [
            [
                'unit' => 'Kelompok Bidang Keahlian (KBK) Game & XR',
                'leader' => $pembinaKemahasiswaan?->name ?? 'Bambang Trianto, S.Kom., M.Cs.',
                'desc' => 'Fokus pengembangan kurikulum dan riset terapan bidang Game Engine Architecture & Immersive Tech (AR/VR).',
            ],
            [
                'unit' => 'Kelompok Bidang Keahlian (KBK) Animasi & Media Digital',
                'leader' => $kaLab?->name ?? 'Fathurrahman, M.Sn.',
                'desc' => 'Fokus perancangan aset grafis 3D, rigging, motion capture, visual effects, dan audio spasial.',
            ],
        ]);

        return view('public.profile.structure', compact(
            'profile',
            'staffList',
            'lecturers',
            'tendikList',
            'kaprodi',
            'kaLab',
            'plp',
            'koordMbkm',
            'pembinaKemahasiswaan',
            'adminStaff',
            'departmentHead',
            'gkm',
            'skNumber',
            'academicYear',
            'customUnits'
        ));
    }

    /**
     * Dosen & Tenaga Pengajar.
     */
    public function lecturers(Request $request): View
    {
        $search = trim((string) $request->input('q', ''));
        $query = Staff::lecturers()->active();

        if ($search !== '') {
            $query->search($search);
        }

        $lecturers = $query->orderBy('order')->orderBy('name')->get();

        return view('public.profile.lecturers', compact('lecturers', 'search'));
    }

    /**
     * Tenaga Kependidikan.
     */
    public function staff(Request $request): View
    {
        $search = trim((string) $request->input('q', ''));
        $query = Staff::tendik()->active();

        if ($search !== '') {
            $query->search($search);
        }

        $staffList = $query->orderBy('order')->orderBy('name')->get();

        return view('public.profile.staff', compact('staffList', 'search'));
    }

    /**
     * Kurikulum & Mata Kuliah.
     */
    public function curriculum(Request $request): View
    {
        $allCurricula = Curriculum::orderByDesc('is_active')->orderByDesc('year')->get();

        $selectedId = $request->query('kurikulum');
        if ($selectedId) {
            $curriculum = Curriculum::with('courses')->find($selectedId);
        } else {
            $curriculum = Curriculum::where('is_active', true)->with('courses')->latest('year')->first();
        }

        if (! $curriculum) {
            $curriculum = Curriculum::with('courses')->first();
        }

        $coursesGrouped = [];
        for ($i = 1; $i <= 8; $i++) {
            $coursesGrouped[$i] = [];
        }

        if ($curriculum && $curriculum->courses->isNotEmpty()) {
            foreach ($curriculum->courses as $course) {
                $sem = (int) $course->semester;
                if ($sem >= 1 && $sem <= 8) {
                    $coursesGrouped[$sem][] = [
                        'code' => $course->code,
                        'name' => $course->name,
                        'theory' => (int) $course->theory_sks,
                        'practice' => (int) $course->practical_sks,
                        'total' => (int) ($course->sks ?: ($course->theory_sks + $course->practical_sks)),
                        'type' => $course->type,
                        'description' => $course->description ?? '',
                    ];
                }
            }
        }

        $totalSks = $curriculum?->total_sks ?? 144;
        $totalCourses = $curriculum ? $curriculum->courses->count() : 0;
        $courses = $curriculum ? $curriculum->courses->groupBy('semester') : collect();

        return view('public.academic.curriculum', compact(
            'curriculum',
            'allCurricula',
            'courses',
            'coursesGrouped',
            'totalSks',
            'totalCourses'
        ));
    }

    /**
     * Kalender Akademik.
     */
    public function calendar(Request $request): View
    {
        $selectedSemester = trim((string) $request->input('semester', 'semua'));
        $search = trim((string) $request->input('q', ''));

        $query = AcademicCalendar::where('is_active', true);

        if ($selectedSemester !== '' && $selectedSemester !== 'semua') {
            $query->where(function ($q) use ($selectedSemester) {
                $q->where('semester', $selectedSemester)->orWhere('semester', 'semua');
            });
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $calendars = $query->orderBy('start_date', 'asc')->get();

        $academicYears = AcademicCalendar::where('is_active', true)
            ->pluck('academic_year')
            ->unique()
            ->values();

        return view('public.academic.calendar', compact(
            'calendars',
            'selectedSemester',
            'search',
            'academicYears'
        ));
    }

    /**
     * Capaian Pembelajaran Lulusan (CPL).
     */
    public function cpl(): View
    {
        $allCpls = Cpl::ordered()->get();
        $cpls = $allCpls->groupBy(function ($item) {
            return strtolower(trim($item->category));
        });

        $totalCpl = $allCpls->count();

        return view('public.academic.cpl', compact('cpls', 'allCpls', 'totalCpl'));
    }

    /**
     * Profil Lulusan.
     */
    public function graduateProfile(): View
    {
        $profiles = GraduateProfile::ordered()->get();

        return view('public.academic.graduate-profile', compact('profiles'));
    }

    /**
     * Berita & Informasi.
     */
    public function newsIndex(): View
    {
        $newsList = News::published()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(9);

        return view('public.news.index', compact('newsList'));
    }

    /**
     * Detail Berita.
     */
    public function newsShow(string $slug): View
    {
        $news = News::published()
            ->with(['category', 'author'])
            ->where('slug', $slug)
            ->first();

        // Graceful fallback for mock slugs if database not yet matched
        if (! $news) {
            $news = News::published()->first() ?? new News([
                'title' => ucwords(str_replace('-', ' ', $slug)),
                'slug' => $slug,
                'content' => 'Konten berita sedang dalam proses kurasi dan publikasi redaksi.',
                'published_at' => now(),
            ]);
        }

        $relatedNews = News::published()
            ->where('id', '!=', $news->id ?? 0)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.news.show', compact('news', 'slug', 'relatedNews'));
    }

    /**
     * Pengumuman Akademik.
     */
    public function announcementsIndex(): View
    {
        $announcements = Announcement::published()
            ->latest('published_at')
            ->paginate(10);

        return view('public.announcements.index', compact('announcements'));
    }

    /**
     * Agenda Kegiatan.
     */
    public function eventsIndex(): View
    {
        $events = Event::published()
            ->orderBy('event_date', 'asc')
            ->paginate(9);

        return view('public.events.index', compact('events'));
    }

    /**
     * Detail Agenda.
     */
    public function eventsShow(string $slug): View
    {
        $event = Event::published()
            ->where('slug', $slug)
            ->first();

        if (! $event) {
            $event = Event::published()->first() ?? new Event([
                'title' => ucwords(str_replace('-', ' ', $slug)),
                'slug' => $slug,
                'description' => 'Deskripsi agenda sedang diperbarui oleh panitia penyelenggara.',
                'location' => 'Politeknik Negeri Tanah Laut',
                'event_date' => now()->addDays(7),
                'start_time' => '09:00',
                'end_time' => '15:00',
            ]);
        }

        return view('public.events.show', compact('event', 'slug'));
    }

    /**
     * Fasilitas & Laboratorium.
     */
    public function facilitiesIndex(Request $request): View
    {
        $search = trim((string) $request->input('q', ''));
        $category = trim((string) $request->input('category', 'all'));

        $query = Facility::active();

        if ($category !== '' && $category !== 'all') {
            $query->category($category);
        }

        if ($search !== '') {
            $query->search($search);
        }

        $facilities = $query->get();

        $allFacilities = Facility::active()->get();
        $categories = $allFacilities->pluck('category')->filter()->unique()->values();
        $totalWorkstations = (int) $allFacilities->sum('capacity');

        return view('public.facilities.index', compact(
            'facilities',
            'categories',
            'search',
            'category',
            'totalWorkstations'
        ));
    }

    /**
     * Galeri & Dokumentasi.
     */
    public function galleryIndex(): View
    {
        $albums = GalleryAlbum::with('photos')->latest()->get();

        return view('public.gallery.index', compact('albums'));
    }

    /**
     * Kontak & Lokasi.
     */
    public function contact(): View
    {
        $contactSettings = Setting::whereIn('group', ['contact', 'social', 'identity'])
            ->pluck('value', 'key');

        return view('public.contact', compact('contactSettings'));
    }
}
