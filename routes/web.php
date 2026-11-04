<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Design System Showcase
Route::get('/design-system', function () {
    return view('design-system');
})->name('design-system');

use App\Http\Controllers\PublicController;

// Public Pages (Tahap 11 - Menghubungkan Konten ke Website Publik)
Route::get('/', [PublicController::class, 'home'])->name('home');

// Profil
Route::prefix('profil')->name('public.profile.')->group(function () {
    Route::get('/sejarah', [PublicController::class, 'history'])->name('history');
    Route::get('/visi-misi', [PublicController::class, 'visionMission'])->name('vision-mission');
    Route::get('/sambutan-kaprodi', [PublicController::class, 'welcome'])->name('welcome');
    Route::get('/struktur-organisasi', [PublicController::class, 'structure'])->name('structure');
    Route::get('/dosen', [PublicController::class, 'lecturers'])->name('lecturers');
    Route::get('/tenaga-kependidikan', [PublicController::class, 'staff'])->name('staff');
});

// Akademik
Route::prefix('akademik')->name('public.academic.')->group(function () {
    Route::get('/kurikulum', [PublicController::class, 'curriculum'])->name('curriculum');
    Route::get('/mata-kuliah', fn () => redirect()->to(route('public.academic.curriculum').'#mata-kuliah'))->name('courses');
    Route::get('/kalender-akademik', [PublicController::class, 'calendar'])->name('calendar');
    Route::get('/capaian-pembelajaran', [PublicController::class, 'cpl'])->name('cpl');
    Route::get('/profil-lulusan', [PublicController::class, 'graduateProfile'])->name('graduate-profile');
});

// Berita & Informasi
Route::get('/berita', [PublicController::class, 'newsIndex'])->name('public.news.index');
Route::get('/berita/{slug}', [PublicController::class, 'newsShow'])->name('public.news.show');
Route::get('/pengumuman', [PublicController::class, 'announcementsIndex'])->name('public.announcements.index');
Route::get('/agenda', [PublicController::class, 'eventsIndex'])->name('public.events.index');
Route::get('/agenda/{slug}', [PublicController::class, 'eventsShow'])->name('public.events.show');

// Fasilitas, Galeri & Kontak
Route::get('/fasilitas', [PublicController::class, 'facilitiesIndex'])->name('public.facilities.index');
Route::get('/galeri', [PublicController::class, 'galleryIndex'])->name('public.gallery.index');
Route::get('/kontak', [PublicController::class, 'contact'])->name('public.contact');

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\RbacController;

// Auth Routes (Tahap 6 - Autentikasi dan Keamanan)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'create'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'store'])->name('login.store');
});

Route::post('/admin/logout', [AuthController::class, 'destroy'])->name('logout')->middleware('auth');

// Panel Admin (Tahap 5 Layout & UI Kit, diproteksi auth pada Tahap 6)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    // Dynamic Database-Driven RBAC Management (Superadmin Only)
    Route::prefix('rbac')->name('rbac.')->middleware('can:manage-rbac')->group(function () {
        Route::post('/roles', [RbacController::class, 'storeRole'])->name('roles.store');
        Route::put('/roles/{role}', [RbacController::class, 'updateRole'])->name('roles.update');
        Route::delete('/roles/{role}', [RbacController::class, 'destroyRole'])->name('roles.destroy');

        Route::post('/permissions', [RbacController::class, 'storePermission'])->name('permissions.store');
        Route::put('/permissions/{permission}', [RbacController::class, 'updatePermission'])->name('permissions.update');
        Route::delete('/permissions/{permission}', [RbacController::class, 'destroyPermission'])->name('permissions.destroy');

        Route::post('/users', [RbacController::class, 'storeUser'])->name('users.store');
        Route::put('/users/{user}', [RbacController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [RbacController::class, 'destroyUser'])->name('users.destroy');
    });

    // Content & Academic Management (Tahap 8 - 10)
    Route::post('/staff', [ContentController::class, 'storeStaff'])->name('staff.store');
    Route::put('/staff/{staff}', [ContentController::class, 'updateStaff'])->name('staff.update');
    Route::delete('/staff/{staff}', [ContentController::class, 'destroyStaff'])->name('staff.destroy');

    Route::post('/news', [ContentController::class, 'storeNews'])->name('news.store');
    Route::put('/news/{news}', [ContentController::class, 'updateNews'])->name('news.update');
    Route::delete('/news/{news}', [ContentController::class, 'destroyNews'])->name('news.destroy');

    Route::post('/announcements', [ContentController::class, 'storeAnnouncement'])->name('announcements.store');
    Route::put('/announcements/{announcement}', [ContentController::class, 'updateAnnouncement'])->name('announcements.update');
    Route::delete('/announcements/{announcement}', [ContentController::class, 'destroyAnnouncement'])->name('announcements.destroy');

    Route::post('/events', [ContentController::class, 'storeEvent'])->name('events.store');
    Route::put('/events/{event}', [ContentController::class, 'updateEvent'])->name('events.update');
    Route::delete('/events/{event}', [ContentController::class, 'destroyEvent'])->name('events.destroy');

    Route::post('/curricula', [ContentController::class, 'storeCurriculum'])->name('curricula.store');
    Route::put('/curricula/{curriculum}', [ContentController::class, 'updateCurriculum'])->name('curricula.update');
    Route::delete('/curricula/{curriculum}', [ContentController::class, 'destroyCurriculum'])->name('curricula.destroy');

    Route::post('/courses', [ContentController::class, 'storeCourse'])->name('courses.store');
    Route::put('/courses/{course}', [ContentController::class, 'updateCourse'])->name('courses.update');
    Route::delete('/courses/{course}', [ContentController::class, 'destroyCourse'])->name('courses.destroy');

    Route::post('/calendars', [ContentController::class, 'storeCalendar'])->name('calendars.store');
    Route::put('/calendars/{calendar}', [ContentController::class, 'updateCalendar'])->name('calendars.update');
    Route::delete('/calendars/{calendar}', [ContentController::class, 'destroyCalendar'])->name('calendars.destroy');

    Route::post('/cpls', [ContentController::class, 'storeCpl'])->name('cpls.store');
    Route::put('/cpls/{cpl}', [ContentController::class, 'updateCpl'])->name('cpls.update');
    Route::delete('/cpls/{cpl}', [ContentController::class, 'destroyCpl'])->name('cpls.destroy');

    Route::post('/graduate-profiles', [ContentController::class, 'storeGraduateProfile'])->name('graduate-profiles.store');
    Route::put('/graduate-profiles/{graduateProfile}', [ContentController::class, 'updateGraduateProfile'])->name('graduate-profiles.update');
    Route::delete('/graduate-profiles/{graduateProfile}', [ContentController::class, 'destroyGraduateProfile'])->name('graduate-profiles.destroy');

    Route::post('/facilities', [ContentController::class, 'storeFacility'])->name('facilities.store');
    Route::put('/facilities/{facility}', [ContentController::class, 'updateFacility'])->name('facilities.update');
    Route::delete('/facilities/{facility}', [ContentController::class, 'destroyFacility'])->name('facilities.destroy');

    Route::post('/gallery-albums', [ContentController::class, 'storeGalleryAlbum'])->name('gallery-albums.store');
    Route::put('/gallery-albums/{galleryAlbum}', [ContentController::class, 'updateGalleryAlbum'])->name('gallery-albums.update');
    Route::delete('/gallery-albums/{galleryAlbum}', [ContentController::class, 'destroyGalleryAlbum'])->name('gallery-albums.destroy');

    Route::post('/profile-section', [ContentController::class, 'updateProfileSection'])->name('profile-section.update');
    Route::post('/settings', [ContentController::class, 'updateSettings'])->name('settings.update');

    Route::get('/crud/{section}', function ($section) {
        if (! auth()->user()->canAccessSection($section)) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki wewenang untuk mengakses modul ini.');
        }

        return view('admin.sample-crud', compact('section'));
    })->name('crud.sample');
});
