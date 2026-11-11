@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Ringkasan')
@section('page_subtitle', 'Selamat datang di Panel Administrasi D-IV Teknologi Rekayasa Multimedia')

@section('content')
<div class="space-y-8">
    <!-- System Status Banner -->
    <div class="rounded-2xl bg-gradient-to-r from-brand-primary to-slate-900 text-white p-5 sm:p-6 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-start gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0 border border-white/20">
                <svg class="w-5 h-5 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-sm sm:text-base text-white">Sistem Manajemen Portal D-IV TRM Aktif</h3>
                <p class="text-xs text-white/80 mt-0.5">Semua data metrik terhubung real-time dengan basis data resmi program studi. Selamat bertugas, <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->role_label }}).</p>
            </div>
        </div>
        <div class="flex items-center gap-2 self-stretch sm:self-auto justify-end">
            <a href="{{ route('home') }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-bold text-white transition-colors flex items-center gap-1.5 border border-white/20">
                <span>Kunjungi Website</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Metric Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-2">
            <div class="flex items-center justify-between text-xs text-brand-muted">
                <span class="font-semibold uppercase tracking-wider">Total Berita</span>
                <span class="text-[10px] bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-0.5 rounded-full font-bold">Live DB</span>
            </div>
            <div class="text-3xl font-extrabold text-brand-dark">{{ $totalNews }}</div>
            <div class="text-xs text-emerald-600 font-semibold flex items-center gap-1">
                <span>&bull; {{ $publishedNews }} Terbit</span>
                <span>/</span>
                <span class="text-slate-400">{{ $draftNews }} Draf</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-2">
            <div class="flex items-center justify-between text-xs text-brand-muted">
                <span class="font-semibold uppercase tracking-wider">Pengumuman</span>
                <span class="text-[10px] bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-0.5 rounded-full font-bold">Live DB</span>
            </div>
            <div class="text-3xl font-extrabold text-brand-dark">{{ $totalAnnouncements }}</div>
            <div class="text-xs text-brand-secondary font-semibold">
                {{ $publishedAnnouncements }} Dokumen aktif dipublikasi
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-2">
            <div class="flex items-center justify-between text-xs text-brand-muted">
                <span class="font-semibold uppercase tracking-wider">Dosen &amp; Tendik</span>
                <span class="text-[10px] bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-0.5 rounded-full font-bold">Live DB</span>
            </div>
            <div class="text-3xl font-extrabold text-brand-dark">{{ $totalStaff }}</div>
            <div class="text-xs text-slate-500 font-medium">
                {{ $lecturersCount }} Dosen &bull; {{ $tendikCount }} Tenaga Kependidikan
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-2">
            <div class="flex items-center justify-between text-xs text-brand-muted">
                <span class="font-semibold uppercase tracking-wider">Mata Kuliah</span>
                <span class="text-[10px] bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-0.5 rounded-full font-bold">Live DB</span>
            </div>
            <div class="text-3xl font-extrabold text-brand-dark">{{ $totalCourses }}</div>
            <div class="text-xs text-brand-primary font-semibold truncate">
                {{ $activeCurriculum?->name ?? 'Kurikulum 2026/2027' }}
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts & Recent Updates -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left: Quick Actions -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-base text-brand-dark">Aksi Cepat Pengelola</h3>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-brand-primary-light text-brand-primary">
                        {{ auth()->user()->role_label }}
                    </span>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    @if(auth()->user()->canManageNews())
                        <a href="{{ route('admin.crud.sample', ['section' => 'berita']) }}" class="p-4 rounded-xl border border-slate-200 hover:border-brand-primary hover:bg-brand-primary-light transition-all flex flex-col items-center justify-center text-center gap-2 group">
                            <div class="w-10 h-10 rounded-lg bg-brand-primary-light text-brand-primary flex items-center justify-center group-hover:bg-brand-primary group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary">Tulis Berita Baru</span>
                        </a>

                        <a href="{{ route('admin.crud.sample', ['section' => 'pengumuman']) }}" class="p-4 rounded-xl border border-slate-200 hover:border-brand-primary hover:bg-brand-primary-light transition-all flex flex-col items-center justify-center text-center gap-2 group">
                            <div class="w-10 h-10 rounded-lg bg-brand-sky-light text-brand-secondary flex items-center justify-center group-hover:bg-brand-secondary group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary">Buat Pengumuman</span>
                        </a>
                    @endif

                    @if(auth()->user()->canManageAcademic())
                        <a href="{{ route('admin.crud.sample', ['section' => 'kurikulum']) }}" class="p-4 rounded-xl border border-slate-200 hover:border-brand-primary hover:bg-brand-primary-light transition-all flex flex-col items-center justify-center text-center gap-2 group">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary">Kelola Kurikulum</span>
                        </a>
                    @endif

                    @if(auth()->user()->canManageFacilities())
                        <a href="{{ route('admin.crud.sample', ['section' => 'fasilitas']) }}" class="p-4 rounded-xl border border-slate-200 hover:border-brand-primary hover:bg-brand-primary-light transition-all flex flex-col items-center justify-center text-center gap-2 group">
                            <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary">Data Fasilitas & Lab</span>
                        </a>
                    @endif

                    @if(auth()->user()->canManageRbac())
                        <a href="{{ route('admin.crud.sample', ['section' => 'users']) }}" class="p-4 rounded-xl border border-slate-200 hover:border-brand-primary hover:bg-brand-primary-light transition-all flex flex-col items-center justify-center text-center gap-2 group">
                            <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary">Kelola Pengguna</span>
                        </a>
                    @endif

                    @if(auth()->user()->canManageSettings())
                        <a href="{{ route('admin.crud.sample', ['section' => 'identitas']) }}" class="p-4 rounded-xl border border-slate-200 hover:border-brand-primary hover:bg-brand-primary-light transition-all flex flex-col items-center justify-center text-center gap-2 group">
                            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary">Atur Identitas</span>
                        </a>
                    @endif

                    <a href="{{ route('admin.crud.sample', ['section' => 'my-profile']) }}" class="p-4 rounded-xl border border-slate-200 hover:border-brand-primary hover:bg-brand-primary-light transition-all flex flex-col items-center justify-center text-center gap-2 group">
                        <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center group-hover:bg-brand-primary group-hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-brand-dark group-hover:text-brand-primary">Profil Saya</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right: Recent Content Activities Table -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-base text-brand-dark">Aktivitas Konten Terbaru</h3>
                        <p class="text-xs text-brand-muted">Pembaruan terkini warta berita dan dokumen pengumuman prodi</p>
                    </div>
                    <a href="{{ route('admin.crud.sample', ['section' => 'berita']) }}" class="text-xs font-bold text-brand-primary hover:text-brand-primary-hover">
                        Kelola Konten &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase tracking-wider font-semibold">
                            <tr>
                                <th class="py-3 px-6">Judul Konten</th>
                                <th class="py-3 px-4">Tipe / Kategori</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-6 text-right">Terakhir Diperbarui</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                            @forelse($recentActivities as $act)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="py-3 px-6 font-bold text-brand-dark">
                                        <a href="{{ $act->url }}" class="hover:text-brand-primary transition-colors line-clamp-1">
                                            {{ $act->title }}
                                        </a>
                                    </td>
                                    <td class="py-3 px-4 text-brand-muted whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1">
                                            <span class="font-semibold text-slate-800">{{ $act->type }}</span>
                                            <span>&bull;</span>
                                            <span>{{ $act->category }}</span>
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        @if($act->is_published)
                                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                                Terbit
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                                Draf
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-right text-slate-400 whitespace-nowrap">
                                        {{ $act->date ? \Illuminate\Support\Carbon::parse($act->date)->translatedFormat('d M Y, H:i') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 px-6 text-center text-brand-muted">
                                        Belum ada aktivitas konten terbaru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
