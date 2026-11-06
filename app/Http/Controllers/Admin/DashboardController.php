<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Event;
use App\Models\Facility;
use App\Models\News;
use App\Models\Staff;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard summary.
     */
    public function index(): View
    {
        $totalNews = News::count();
        $publishedNews = News::published()->count();
        $draftNews = News::where('status', 'draft')->count();

        $totalAnnouncements = Announcement::count();
        $publishedAnnouncements = Announcement::published()->count();

        $totalStaff = Staff::count();
        $lecturersCount = Staff::lecturers()->count();
        $tendikCount = Staff::tendik()->count();

        $totalCourses = Course::count();
        $activeCurriculum = Curriculum::where('is_active', true)->first();

        $totalFacilities = Facility::count();
        $totalEvents = Event::count();

        // Recent content activities combining latest News and Announcements
        $recentNews = News::latest('updated_at')
            ->take(5)
            ->get()
            ->map(fn (News $item) => (object) [
                'id' => $item->id,
                'title' => $item->title,
                'type' => 'Berita',
                'category' => $item->category?->name ?? 'Warta',
                'status' => $item->status === 'published' ? 'Terbit' : 'Draf',
                'is_published' => $item->status === 'published',
                'date' => $item->updated_at ?? $item->created_at,
                'url' => route('admin.crud.sample', ['section' => 'berita']),
            ]);

        $recentAnnouncements = Announcement::latest('updated_at')
            ->take(3)
            ->get()
            ->map(fn (Announcement $item) => (object) [
                'id' => $item->id,
                'title' => $item->title,
                'type' => 'Pengumuman',
                'category' => $item->category ?? 'Akademik',
                'status' => $item->status !== 'draft' ? 'Terbit' : 'Draf',
                'is_published' => $item->status !== 'draft',
                'date' => $item->updated_at ?? $item->created_at,
                'url' => route('admin.crud.sample', ['section' => 'pengumuman']),
            ]);

        /** @var Collection<int, object> $recentActivities */
        $recentActivities = $recentNews->concat($recentAnnouncements)
            ->sortByDesc('date')
            ->take(6);

        return view('admin.dashboard', compact(
            'totalNews',
            'publishedNews',
            'draftNews',
            'totalAnnouncements',
            'publishedAnnouncements',
            'totalStaff',
            'lecturersCount',
            'tendikCount',
            'totalCourses',
            'activeCurriculum',
            'totalFacilities',
            'totalEvents',
            'recentActivities'
        ));
    }
}
