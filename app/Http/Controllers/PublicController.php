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

        return view('public.profile.vision-mission', compact('profile'));
    }

    /**
     * Sambutan Ketua Program Studi.
     */
    public function welcome(): View
    {
        $profile = StudyProgramProfile::forSection('sambutan');
        $kaprodi = Staff::where('position', 'like', '%Koordinator Program Studi%')->first()
            ?? Staff::lecturers()->first();

        return view('public.profile.welcome', compact('profile', 'kaprodi'));
    }

    /**
     * Struktur Organisasi.
     */
    public function structure(): View
    {
        $profile = StudyProgramProfile::forSection('struktur');
        $staffList = Staff::active()->orderBy('order')->get();

        return view('public.profile.structure', compact('profile', 'staffList'));
    }

    /**
     * Dosen & Tenaga Pengajar.
     */
    public function lecturers(): View
    {
        $lecturers = Staff::lecturers()->active()->orderBy('order')->get();

        return view('public.profile.lecturers', compact('lecturers'));
    }

    /**
     * Tenaga Kependidikan.
     */
    public function staff(): View
    {
        $staffList = Staff::tendik()->active()->orderBy('order')->get();

        return view('public.profile.staff', compact('staffList'));
    }

    /**
     * Kurikulum & Mata Kuliah.
     */
    public function curriculum(): View
    {
        $curriculum = Curriculum::where('is_active', true)->with('courses')->first();
        $courses = $curriculum ? $curriculum->courses->groupBy('semester') : collect();

        return view('public.academic.curriculum', compact('curriculum', 'courses'));
    }

    /**
     * Kalender Akademik.
     */
    public function calendar(): View
    {
        $calendars = AcademicCalendar::where('is_active', true)->latest()->get();

        return view('public.academic.calendar', compact('calendars'));
    }

    /**
     * Capaian Pembelajaran Lulusan (CPL).
     */
    public function cpl(): View
    {
        $cpls = Cpl::orderBy('order')->get()->groupBy('category');

        return view('public.academic.cpl', compact('cpls'));
    }

    /**
     * Profil Lulusan.
     */
    public function graduateProfile(): View
    {
        $profiles = GraduateProfile::orderBy('order')->get();

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
    public function facilitiesIndex(): View
    {
        $facilities = Facility::active()->get();

        return view('public.facilities.index', compact('facilities'));
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
