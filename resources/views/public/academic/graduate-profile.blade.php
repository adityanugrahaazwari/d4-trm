@extends('layouts.public')

@section('title', 'Profil Lulusan & Prospek Karier - D-IV TRM POLITALA')

@section('content')
<!-- Header Page -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-24 sm:pt-28 lg:pt-32 pb-8 sm:pb-10 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Akademik</span>
            <span>/</span>
            <span class="text-brand-dark">Profil Lulusan</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-6 mt-3 sm:mt-4">
            <div class="max-w-3xl space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-brand-primary/10 text-brand-primary border border-brand-primary/20">
                    <span class="w-2 h-2 rounded-full bg-brand-primary animate-pulse"></span>
                    <span>Gelar Akademik: Sarjana Terapan Komputer (S.Tr.Kom.)</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Profil Lulusan &amp; Prospek Karier
                </h1>
                <p class="text-sm sm:text-base text-brand-muted leading-relaxed">
                    Peluang profesi masa depan sarjana terapan di ekosistem industri kreatif digital, teknologi game komersial, produksi animasi 3D, dan rekayasa komputasi spasial imersif.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-xs">
                    Level 6 KKNI Nasional
                </span>
                <span class="px-3.5 py-1.5 rounded-full text-xs font-semibold bg-brand-primary-light text-brand-primary border border-brand-primary/20">
                    {{ $profiles->count() }} Profil Utama
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 lg:py-14 space-y-12 sm:space-y-14">
    <!-- Grid Profil Profesi -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($profiles as $idx => $p)
            <div class="group bg-white rounded-3xl border border-slate-200/90 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <!-- Card Top Header Illustration Container -->
                    <div class="relative h-44 sm:h-48 bg-gradient-to-br from-slate-900 via-brand-dark to-slate-800 p-6 flex items-center justify-center border-b border-slate-100 overflow-hidden">
                        <div class="absolute -right-6 -bottom-6 w-32 h-32 rounded-full bg-brand-primary/20 blur-xl"></div>
                        <div class="absolute -left-6 -top-6 w-32 h-32 rounded-full bg-brand-secondary/20 blur-xl"></div>

                        <!-- Number Badge -->
                        <div class="absolute top-4 left-4 w-9 h-9 rounded-2xl bg-white/10 backdrop-blur-md text-white border border-white/15 flex items-center justify-center font-black text-xs shadow-xs z-10 font-mono">
                            {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <!-- Category Tag -->
                        <div class="absolute top-4 right-4 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-primary text-white shadow-xs z-10">
                            @if(str_contains(strtolower($p->title), 'game'))
                                Game Engineering
                            @elseif(str_contains(strtolower($p->title), '3d') || str_contains(strtolower($p->title), 'animat'))
                                3D &amp; CGI Pipeline
                            @elseif(str_contains(strtolower($p->title), 'xr') || str_contains(strtolower($p->title), 'vr'))
                                Spatial Computing
                            @elseif(str_contains(strtolower($p->title), 'web') || str_contains(strtolower($p->title), 'ui'))
                                Creative Web &amp; UX
                            @elseif(str_contains(strtolower($p->title), 'video') || str_contains(strtolower($p->title), 'vfx'))
                                Cinema Production
                            @elseif(str_contains(strtolower($p->title), 'audio') || str_contains(strtolower($p->title), 'sound'))
                                Sound Engineering
                            @else
                                Multimedia Tech
                            @endif
                        </div>

                        <!-- Center Tech Graphic -->
                        <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 shadow-md flex items-center justify-center text-brand-sky relative z-10 group-hover:scale-110 transition-transform duration-300">
                            @if(str_contains(strtolower($p->title), 'game'))
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @elseif(str_contains(strtolower($p->title), '3d') || str_contains(strtolower($p->title), 'animat'))
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            @elseif(str_contains(strtolower($p->title), 'xr') || str_contains(strtolower($p->title), 'vr'))
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            @elseif(str_contains(strtolower($p->title), 'web') || str_contains(strtolower($p->title), 'ui'))
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            @elseif(str_contains(strtolower($p->title), 'video') || str_contains(strtolower($p->title), 'vfx'))
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            @else
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                </svg>
                            @endif
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-8 space-y-4">
                        <h3 class="text-xl font-extrabold text-brand-dark group-hover:text-brand-primary transition-colors leading-snug">
                            {{ $p->title }}
                        </h3>

                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                            {{ $p->description }}
                        </p>

                        <!-- Career Roles Chips -->
                        @if(!empty($p->career_roles_list) && count($p->career_roles_list) > 0)
                            <div class="pt-4 border-t border-slate-100 space-y-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>Peluang Jabatan &amp; Profesi Karier:</span>
                                </span>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($p->career_roles_list as $role)
                                        <span class="px-2.5 py-1 rounded-lg bg-brand-surface text-brand-dark text-xs font-semibold border border-slate-200">
                                            {{ $role }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @elseif(!empty($p->career_prospects))
                            <div class="pt-4 border-t border-slate-100 text-xs space-y-1">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Peluang Jabatan:</span>
                                <p class="text-slate-700 font-medium leading-relaxed">{{ $p->career_prospects }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="p-6 pt-0">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-3 py-1.5 rounded-xl w-full justify-center">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Daya Serap Industri Tinggi (DUDI Kreatif)</span>
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Certification & Employability Banner -->
    <div class="rounded-3xl bg-gradient-to-r from-brand-dark via-slate-900 to-brand-primary p-8 sm:p-12 text-white relative overflow-hidden shadow-xl">
        <div class="absolute right-0 top-0 w-96 h-96 bg-brand-primary/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
            <div class="space-y-3 max-w-2xl">
                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/10 text-brand-cream border border-white/10">
                    Sertifikasi &amp; Portofolio Wisuda
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Setiap Lulusan Dibekali Portofolio Rill &amp; Sertifikat BNSP
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Sebelum menyelesaikan studi sarjana terapan, mahasiswa D-IV TRM POLITALA wajib mengikuti Uji Kompetensi Lembaga Sertifikasi Profesi (LSP P-1 POLITALA / BNSP) serta menghasilkan portofolio karya komersial bersama mitra industri.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a href="{{ route('public.academic.curriculum') }}" 
                   class="px-5 py-3 rounded-2xl bg-white text-brand-dark hover:bg-brand-cream text-xs font-bold transition-all shadow-md flex items-center gap-2">
                    <span>Lihat Kurikulum Terapan</span>
                </a>
                <a href="{{ route('public.facilities.index') }}" 
                   class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 text-white border border-white/20 text-xs font-bold transition-all flex items-center gap-2">
                    <span>Fasilitas Studio Lab</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
