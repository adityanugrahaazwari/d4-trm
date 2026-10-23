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
    Route::get('/sejarah', fn () => view('public.page-placeholder', [
        'category' => 'Profil',
        'title' => 'Sejarah Program Studi',
        'description' => 'Latar belakang pendirian Program Studi D-4 Teknik Rekayasa Multimedia POLITALA.',
    ]))->name('history');

    Route::get('/visi-misi', fn () => view('public.page-placeholder', [
        'category' => 'Profil',
        'title' => 'Visi & Misi',
        'description' => 'Visi, misi, dan tujuan strategis pengembangan pendidikan vokasi multimedia.',
    ]))->name('vision-mission');

    Route::get('/sambutan-kaprodi', fn () => view('public.page-placeholder', [
        'category' => 'Profil',
        'title' => 'Sambutan Ketua Program Studi',
        'description' => 'Pesan dan arahan dari pimpinan Program Studi D-4 Teknik Rekayasa Multimedia.',
    ]))->name('welcome');

    Route::get('/struktur-organisasi', fn () => view('public.page-placeholder', [
        'category' => 'Profil',
        'title' => 'Struktur Organisasi',
        'description' => 'Bagan susunan tata kelola dan manajemen Program Studi.',
    ]))->name('structure');

    Route::get('/dosen', fn () => view('public.page-placeholder', [
        'category' => 'Profil',
        'title' => 'Dosen Pengajar',
        'description' => 'Daftar pendidik profesional di bidang rekayasa multimedia.',
    ]))->name('lecturers');

    Route::get('/tenaga-kependidikan', fn () => view('public.page-placeholder', [
        'category' => 'Profil',
        'title' => 'Tenaga Kependidikan',
        'description' => 'Staf teknisi laboratorium dan administrasi program studi.',
    ]))->name('staff');
});

// Akademik
Route::prefix('akademik')->name('public.academic.')->group(function () {
    Route::get('/kurikulum', fn () => view('public.page-placeholder', [
        'category' => 'Akademik',
        'title' => 'Kurikulum Program Studi',
        'description' => 'Struktur sebaran kurikulum sarjana terapan bidang teknologi multimedia.',
    ]))->name('curriculum');

    Route::get('/mata-kuliah', fn () => view('public.page-placeholder', [
        'category' => 'Akademik',
        'title' => 'Daftar Mata Kuliah',
        'description' => 'Daftar mata kuliah teori dan praktikum per semester.',
    ]))->name('courses');

    Route::get('/kalender-akademik', fn () => view('public.page-placeholder', [
        'category' => 'Akademik',
        'title' => 'Kalender Akademik',
        'description' => 'Jadwal dan agenda perkuliahan tahun akademik berjalan.',
    ]))->name('calendar');

    Route::get('/capaian-pembelajaran', fn () => view('public.page-placeholder', [
        'category' => 'Akademik',
        'title' => 'Capaian Pembelajaran Lulusan (CPL)',
        'description' => 'Standar kompetensi lulusan D-4 Teknik Rekayasa Multimedia.',
    ]))->name('cpl');

    Route::get('/profil-lulusan', fn () => view('public.page-placeholder', [
        'category' => 'Akademik',
        'title' => 'Profil Lulusan',
        'description' => 'Prospek karier dan profil lulusan di dunia usaha dan dunia industri (DUDI).',
    ]))->name('graduate-profile');
});

// Berita & Informasi
Route::get('/berita', fn () => view('public.page-placeholder', [
    'category' => 'Informasi',
    'title' => 'Berita Program Studi',
    'description' => 'Kabar terkini seputar kegiatan dan perkembangan program studi.',
]))->name('public.news.index');

Route::get('/pengumuman', fn () => view('public.page-placeholder', [
    'category' => 'Informasi',
    'title' => 'Pengumuman Akademik',
    'description' => 'Pemberitahuan resmi akademik bagi sivitas akademika.',
]))->name('public.announcements.index');

Route::get('/agenda', fn () => view('public.page-placeholder', [
    'category' => 'Informasi',
    'title' => 'Agenda Kegiatan',
    'description' => 'Jadwal seminar, workshop, dan kegiatan vokasi.',
]))->name('public.events.index');

// Fasilitas, Galeri & Kontak
Route::get('/fasilitas', fn () => view('public.page-placeholder', [
    'category' => 'Fasilitas',
    'title' => 'Fasilitas & Laboratorium',
    'description' => 'Sarana dan prasarana pendukung kegiatan belajar dan praktikum multimedia.',
]))->name('public.facilities.index');

Route::get('/galeri', fn () => view('public.page-placeholder', [
    'category' => 'Dokumentasi',
    'title' => 'Galeri Kegiatan',
    'description' => 'Dokumentasi visual foto dan aktivitas program studi.',
]))->name('public.gallery.index');

Route::get('/kontak', fn () => view('public.page-placeholder', [
    'category' => 'Informasi',
    'title' => 'Kontak Program Studi',
    'description' => 'Informasi kontak resmi, alamat sekretariat, dan layanan pertanyaan.',
]))->name('public.contact');

// Auth (Akan diselesaikan di Tahap 6, sementara disiapkan route namanya)
Route::get('/admin/login', fn () => view('admin.auth.login'))->name('login');

// Panel Admin (Tahap 5 Layout & UI Kit)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
    Route::get('/crud/{section}', function ($section) {
        return view('admin.sample-crud', compact('section'));
    })->name('crud.sample');
});
