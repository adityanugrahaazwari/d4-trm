@extends('layouts.public')

@section('title', 'Profil Lulusan - D-IV TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Akademik</span>
            <span>/</span>
            <span class="text-brand-dark">Profil Lulusan</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Profil Lulusan &amp; Prospek Karier</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Peluang profesi sarjana terapan (S.Tr.Kom.) di industri kreatif digital dan teknologi informasi</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Profil Lulusan]
            </span>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    <!-- Grid Profil Profesi -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Profesi 1 -->
        <div class="group bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
            <!-- Illustration Header Container -->
            <div class="relative h-52 sm:h-56 bg-gradient-to-br from-slate-50 via-brand-primary-light/40 to-slate-100/70 p-6 flex items-center justify-center border-b border-slate-100 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-primary/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-brand-secondary/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                
                <!-- Badge Number -->
                <div class="absolute top-4 left-4 w-10 h-10 rounded-2xl bg-brand-primary text-white flex items-center justify-center font-bold text-sm shadow-md shadow-brand-primary/20 z-10">
                    01
                </div>

                <!-- Tag Kategori -->
                <div class="absolute top-4 right-4 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-white/90 text-brand-primary border border-brand-primary/20 shadow-2xs backdrop-blur-xs z-10">
                    Game Tech
                </div>

                <!-- Illustration SVG -->
                <img src="{{ asset('assets/undraw_virtual-reality_4fo0.svg') }}" 
                     alt="Game Developer & Gameplay Engineer" 
                     class="h-full max-h-40 w-auto object-contain transition-transform duration-500 group-hover:scale-105 relative z-1"
                     loading="lazy">
            </div>

            <!-- Card Body Content -->
            <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between space-y-5">
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-brand-dark group-hover:text-brand-primary transition-colors">
                        Game Developer &amp; Gameplay Engineer
                    </h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Bertanggung jawab dalam merancang arsitektur permainan, kecerdasan buatan (Game AI), fisika objek, dan gameplay logic menggunakan Unity atau Unreal Engine.
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 text-xs">
                    <strong class="text-brand-dark block mb-1.5 flex items-center gap-1.5 font-bold">
                        <svg class="w-4 h-4 text-brand-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Peluang Instansi / Perusahaan:
                    </strong>
                    <span class="text-slate-600 leading-relaxed block pl-5.5">Studio Game Nasional &amp; Internasional, Perusahaan Simulasi Militer/Aviasi, Edutech Games.</span>
                </div>
            </div>
        </div>

        <!-- Profesi 2 -->
        <div class="group bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
            <!-- Illustration Header Container -->
            <div class="relative h-52 sm:h-56 bg-gradient-to-br from-slate-50 via-brand-secondary/10 to-slate-100/70 p-6 flex items-center justify-center border-b border-slate-100 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-secondary/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-brand-primary/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                
                <!-- Badge Number -->
                <div class="absolute top-4 left-4 w-10 h-10 rounded-2xl bg-brand-secondary text-white flex items-center justify-center font-bold text-sm shadow-md shadow-brand-secondary/20 z-10">
                    02
                </div>

                <!-- Tag Kategori -->
                <div class="absolute top-4 right-4 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-white/90 text-brand-secondary border border-brand-secondary/20 shadow-2xs backdrop-blur-xs z-10">
                    3D &amp; Animation
                </div>

                <!-- Illustration SVG -->
                <img src="{{ asset('assets/undraw_3d-modeling_j8a3.svg') }}" 
                     alt="3D Technical Artist & Animator" 
                     class="h-full max-h-40 w-auto object-contain transition-transform duration-500 group-hover:scale-105 relative z-1"
                     loading="lazy">
            </div>

            <!-- Card Body Content -->
            <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between space-y-5">
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-brand-dark group-hover:text-brand-primary transition-colors">
                        3D Technical Artist &amp; Animator
                    </h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Menghubungkan aspek seni dan pemrograman melalui pemodelan 3D, shader visual, rigging karakter, dan optimalisasi aset real-time render.
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 text-xs">
                    <strong class="text-brand-dark block mb-1.5 flex items-center gap-1.5 font-bold">
                        <svg class="w-4 h-4 text-brand-secondary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Peluang Instansi / Perusahaan:
                    </strong>
                    <span class="text-slate-600 leading-relaxed block pl-5.5">Studio Animasi Film, Perusahaan Periklanan/CGI, Agensi Visual Efek, Industri Arsitektur 3D.</span>
                </div>
            </div>
        </div>

        <!-- Profesi 3 -->
        <div class="group bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
            <!-- Illustration Header Container -->
            <div class="relative h-52 sm:h-56 bg-gradient-to-br from-slate-50 via-brand-sky-light to-slate-100/70 p-6 flex items-center justify-center border-b border-slate-100 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-sky/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-brand-primary/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                
                <!-- Badge Number -->
                <div class="absolute top-4 left-4 w-10 h-10 rounded-2xl bg-brand-primary text-white flex items-center justify-center font-bold text-sm shadow-md shadow-brand-primary/20 z-10">
                    03
                </div>

                <!-- Tag Kategori -->
                <div class="absolute top-4 right-4 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-white/90 text-brand-primary border border-brand-primary/20 shadow-2xs backdrop-blur-xs z-10">
                    Immersive XR
                </div>

                <!-- Illustration SVG -->
                <img src="{{ asset('assets/undraw_augmented-reality_3ie0.svg') }}" 
                     alt="Interactive Media & Immersive Tech Specialist (XR)" 
                     class="h-full max-h-40 w-auto object-contain transition-transform duration-500 group-hover:scale-105 relative z-1"
                     loading="lazy">
            </div>

            <!-- Card Body Content -->
            <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between space-y-5">
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-brand-dark group-hover:text-brand-primary transition-colors">
                        Interactive Media &amp; Immersive Tech Specialist (XR)
                    </h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Membangun aplikasi virtual reality, augmented reality, dan interactive museum/exhibition untuk pelatihan industri, pariwisata, dan edukasi interaktif.
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 text-xs">
                    <strong class="text-brand-dark block mb-1.5 flex items-center gap-1.5 font-bold">
                        <svg class="w-4 h-4 text-brand-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Peluang Instansi / Perusahaan:
                    </strong>
                    <span class="text-slate-600 leading-relaxed block pl-5.5">Perusahaan Teknologi Imersif, BUMN, Sektor Pertambangan &amp; Energi (VR Safety Training).</span>
                </div>
            </div>
        </div>

        <!-- Profesi 4 -->
        <div class="group bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
            <!-- Illustration Header Container -->
            <div class="relative h-52 sm:h-56 bg-gradient-to-br from-slate-50 via-amber-50/50 to-slate-100/70 p-6 flex items-center justify-center border-b border-slate-100 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-200/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-brand-primary/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                
                <!-- Badge Number -->
                <div class="absolute top-4 left-4 w-10 h-10 rounded-2xl bg-amber-500 text-white flex items-center justify-center font-bold text-sm shadow-md shadow-amber-500/20 z-10">
                    04
                </div>

                <!-- Tag Kategori -->
                <div class="absolute top-4 right-4 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-white/90 text-amber-800 border border-amber-200/80 shadow-2xs backdrop-blur-xs z-10">
                    UI/UX &amp; Product
                </div>

                <!-- Illustration SVG -->
                <img src="{{ asset('assets/undraw_brainstorming_gny9.svg') }}" 
                     alt="UI/UX Designer & Creative Technologist" 
                     class="h-full max-h-40 w-auto object-contain transition-transform duration-500 group-hover:scale-105 relative z-1"
                     loading="lazy">
            </div>

            <!-- Card Body Content -->
            <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between space-y-5">
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-brand-dark group-hover:text-brand-primary transition-colors">
                        UI/UX Designer &amp; Creative Technologist
                    </h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Mendesain pengalaman interaksi pengguna yang intuitif, visual storytelling digital, serta prototipe interaktif untuk web, mobile, dan sistem pintar.
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 text-xs">
                    <strong class="text-brand-dark block mb-1.5 flex items-center gap-1.5 font-bold">
                        <svg class="w-4 h-4 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Peluang Instansi / Perusahaan:
                    </strong>
                    <span class="text-slate-600 leading-relaxed block pl-5.5">Startup Digital, Perbankan/Fintech, Software House, Digital Creative Agency.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Career Guidance & Accreditation Info Banner -->
    <div class="bg-gradient-to-r from-brand-primary via-brand-primary to-brand-primary-dark rounded-3xl p-8 sm:p-10 text-white shadow-xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-6">
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="space-y-2 text-center lg:text-left relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white/15 text-brand-sky border border-white/20">
                Pendidikan Vokasi Berbasis Proyek (PBL)
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Kesiapan Kerja &amp; Sertifikasi Kompetensi</h2>
            <p class="text-xs sm:text-sm text-slate-200 max-w-2xl leading-relaxed">
                Setiap lulusan D-IV TRM dibekali ijazah Sarjana Terapan Komputer (S.Tr.Kom.), Surat Keterangan Pendamping Ijazah (SKPI), serta sertifikasi kompetensi keahlian nasional BNSP untuk percepatan serapan industri.
            </p>
        </div>
        <div class="flex items-center gap-3 shrink-0 relative z-10">
            <a href="{{ route('public.academic.curriculum') }}" class="px-5 py-3 rounded-2xl bg-white text-brand-primary font-bold text-xs hover:bg-brand-surface shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                <span>Lihat Kurikulum Terkait</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
            <a href="{{ route('public.contact') }}" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs border border-white/20 transition-all">
                Konsultasi Studi
            </a>
        </div>
    </div>
</div>
@endsection
