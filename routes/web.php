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

// Public Pages
Route::get('/', function () {
    return view('public.home');
})->name('home');

// Profil
Route::prefix('profil')->name('public.profile.')->group(function () {
    Route::get('/sejarah', fn () => view('public.profile.history'))->name('history');
    Route::get('/visi-misi', fn () => view('public.profile.vision-mission'))->name('vision-mission');
    Route::get('/sambutan-kaprodi', fn () => view('public.profile.welcome'))->name('welcome');
    Route::get('/struktur-organisasi', fn () => view('public.profile.structure'))->name('structure');
    Route::get('/dosen', fn () => view('public.profile.lecturers'))->name('lecturers');
    Route::get('/tenaga-kependidikan', fn () => view('public.profile.staff'))->name('staff');
});

// Akademik
Route::prefix('akademik')->name('public.academic.')->group(function () {
    Route::get('/kurikulum', fn () => view('public.academic.curriculum'))->name('curriculum');
    Route::get('/mata-kuliah', fn () => redirect()->to(route('public.academic.curriculum').'#mata-kuliah'))->name('courses');
    Route::get('/kalender-akademik', fn () => view('public.academic.calendar'))->name('calendar');
    Route::get('/capaian-pembelajaran', fn () => view('public.academic.cpl'))->name('cpl');
    Route::get('/profil-lulusan', fn () => view('public.academic.graduate-profile'))->name('graduate-profile');
});

// Berita & Informasi
Route::get('/berita', fn () => view('public.news.index'))->name('public.news.index');
Route::get('/berita/{slug}', function ($slug = 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') {
    return view('public.news.show', compact('slug'));
})->name('public.news.show');
Route::get('/pengumuman', fn () => view('public.announcements.index'))->name('public.announcements.index');
Route::get('/agenda', fn () => view('public.events.index'))->name('public.events.index');
Route::get('/agenda/{slug}', function ($slug = 'kuliah-pakar-pipeline-animasi-3d-studio-hollywood') {
    return view('public.events.show', compact('slug'));
})->name('public.events.show');

// Fasilitas, Galeri & Kontak
Route::get('/fasilitas', fn () => view('public.facilities.index'))->name('public.facilities.index');
Route::get('/galeri', fn () => view('public.gallery.index'))->name('public.gallery.index');
Route::get('/kontak', fn () => view('public.contact'))->name('public.contact');

use App\Http\Controllers\Admin\AuthController;

// Auth Routes (Tahap 6 - Autentikasi dan Keamanan)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'create'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'store'])->name('login.store');
});

Route::post('/admin/logout', [AuthController::class, 'destroy'])->name('logout')->middleware('auth');

// Panel Admin (Tahap 5 Layout & UI Kit, diproteksi auth pada Tahap 6)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
    Route::get('/crud/{section}', function ($section) {
        if (! auth()->user()->canAccessSection($section)) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki wewenang untuk mengakses modul ini.');
        }

        return view('admin.sample-crud', compact('section'));
    })->name('crud.sample');
});
