@extends('layouts.public')

@section('title', 'Beranda - D-4 Teknik Rekayasa Multimedia POLITALA')

@section('content')
<div class="flex flex-col gap-16 lg:gap-24">

    {{-- 2. Hero Section --}}
    <section class="relative overflow-hidden bg-brand-primary-dark text-white pt-20 sm:pt-24 lg:pt-28 pb-16 lg:pb-24">
        <!-- Background Campus Architecture & Gradient Overlay -->
        <div class="absolute inset-0 z-0">
            <!-- Stylized Campus Background Pattern -->
            <div class="absolute inset-0 bg-[radial-gradient(#97D7FF_1.2px,transparent_1.2px)] [background-size:28px_28px] opacity-15 pointer-events-none"></div>
            <!-- Gradient Overlay: menjaga keterbacaan teks dan menyatukan palet warna -->
            <div class="absolute inset-0 bg-gradient-to-r from-brand-primary-dark/95 via-brand-primary/90 to-brand-primary/80 z-10"></div>
            <!-- Glow Accents -->
            <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-brand-sky/20 blur-3xl z-10 pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-[32rem] h-[32rem] rounded-full bg-brand-secondary/25 blur-3xl z-10 pointer-events-none"></div>
        </div>

        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-14 items-center">
                
                <!-- Left Narrative Column -->
                <div class="lg:col-span-7 space-y-7">
                    <!-- Campus & Degree Identifier Badge -->
                    <div class="inline-flex flex-wrap items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-semibold text-brand-sky shadow-sm">
                        <span class="flex items-center gap-1.5 text-brand-cream">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>POLITALA Tanah Laut</span>
                        </span>
                        <span class="text-white/40">&bull;</span>
                        <span class="text-white">Sarjana Terapan (D-4)</span>
                        <span class="text-white/40">&bull;</span>
                        <span class="inline-flex items-center gap-1 text-emerald-400 font-bold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Akreditasi Baik Sekali
                        </span>
                    </div>

                    <!-- Main Dynamic Headline -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.1] sm:leading-[1.1]">
                        Pusat Keunggulan <br class="hidden sm:inline" />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-cream via-brand-sky to-white">
                            Seni Digital &amp; Teknologi
                        </span>
                        <br />
                        Teknik Rekayasa Multimedia
                    </h1>

                    <p class="text-base sm:text-lg text-slate-200/90 max-w-2xl leading-relaxed font-normal">
                        Mempersiapkan talenta masa depan yang menguasai integrasi komputasi modern dan kreativitas visual: mulai dari <span class="text-white font-semibold">Game Programming</span>, <span class="text-white font-semibold">Produksi Animasi 3D</span>, hingga ekosistem interaktif <span class="text-white font-semibold">Virtual Reality (VR/AR)</span>.
                    </p>

                    <!-- Primary CTAs (Pendaftaran Mahasiswa Baru & Kurikulum) -->
                    <div class="flex flex-wrap items-center gap-3.5 pt-1">
                        <!-- Pendaftaran PMB Button (Standout Primary CTA) -->
                        <a href="https://pmb.politala.ac.id" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="px-6 py-3.5 rounded-full bg-gradient-to-r from-emerald-400 to-teal-400 hover:from-emerald-300 hover:to-teal-300 text-slate-950 font-black text-sm hover:shadow-xl hover:shadow-emerald-500/25 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2.5 group shadow-lg">
                            <svg class="w-4 h-4 text-slate-950 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span>Pendaftaran Mahasiswa Baru</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>

                        <!-- Jelajahi Kurikulum -->
                        <a href="{{ route('public.academic.curriculum') }}" 
                           class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white font-bold text-sm transition-all flex items-center gap-2 hover:scale-[1.02] active:scale-[0.98]">
                            <span>Jelajahi Kurikulum</span>
                            <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Quick PMB Jalur Masuk Badge -->
                    <div class="inline-flex items-center gap-2 text-xs text-brand-sky/90 bg-white/5 backdrop-blur-sm px-3.5 py-1.5 rounded-xl border border-white/10">
                        <span class="text-brand-cream font-bold">Jalur Masuk:</span>
                        <span>SNBP • SNBT • Jalur Mandiri POLITALA</span>
                    </div>

                    <!-- Quick Highlights Metrics Cards -->
                    <div class="pt-6 border-t border-white/15 grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-xl">
                        <div class="bg-white/5 rounded-2xl p-3 border border-white/10 backdrop-blur-sm">
                            <div class="text-xl sm:text-2xl font-black text-brand-cream">144 SKS</div>
                            <div class="text-[10px] text-brand-sky/80 uppercase tracking-wider font-semibold">Kurikulum Terapan</div>
                        </div>
                        <div class="bg-white/5 rounded-2xl p-3 border border-white/10 backdrop-blur-sm">
                            <div class="text-xl sm:text-2xl font-black text-brand-cream">4 Tahun</div>
                            <div class="text-[10px] text-brand-sky/80 uppercase tracking-wider font-semibold">Jenjang D-4 (S1)</div>
                        </div>
                        <div class="bg-white/5 rounded-2xl p-3 border border-white/10 backdrop-blur-sm">
                            <div class="text-xl sm:text-2xl font-black text-brand-cream">100%</div>
                            <div class="text-[10px] text-brand-sky/80 uppercase tracking-wider font-semibold">Lab Standar Industri</div>
                        </div>
                        <div class="bg-white/5 rounded-2xl p-3 border border-white/10 backdrop-blur-sm">
                            <div class="text-xl sm:text-2xl font-black text-brand-cream">S.Tr.Kom.</div>
                            <div class="text-[10px] text-brand-sky/80 uppercase tracking-wider font-semibold">Gelar Kelulusan</div>
                        </div>
                    </div>
                </div>

                <!-- Right Dynamic Interactive Showcase: Studio & Creative Pipeline -->
                <div class="lg:col-span-5" x-data="{ activeTab: 'game' }">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        
                        <!-- Floating Badge 1: Identitas Kampus POLITALA -->
                        <div class="absolute -top-6 -left-4 sm:-left-6 z-30 bg-white/95 backdrop-blur-md p-3 rounded-2xl border border-white/40 shadow-xl flex items-center gap-2.5 text-brand-dark animate-bounce [animation-duration:5s]">
                            <div class="w-9 h-9 rounded-xl bg-brand-primary flex items-center justify-center text-white shrink-0 shadow-xs">
                                <svg class="w-5 h-5 text-brand-cream" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <span class="block text-[9px] font-bold text-brand-secondary uppercase tracking-wider">Kampus Terpadu</span>
                                <span class="block text-xs font-extrabold text-brand-dark">POLITALA Pelaihari</span>
                            </div>
                        </div>

                        <!-- Main Studio Interactive Mockup Window -->
                        <div class="rounded-3xl bg-slate-900/85 backdrop-blur-2xl border border-white/20 p-5 sm:p-6 shadow-2xl relative overflow-hidden space-y-4">
                            
                            <!-- Window Control Bar & Interactive Tabs -->
                            <div class="flex items-center justify-between border-b border-white/10 pb-3 gap-2">
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <span class="w-3 h-3 rounded-full bg-rose-500/90"></span>
                                    <span class="w-3 h-3 rounded-full bg-amber-500/90"></span>
                                    <span class="w-3 h-3 rounded-full bg-emerald-500/90"></span>
                                </div>
                                
                                <!-- Tab Switches -->
                                <div class="flex items-center gap-1 bg-black/40 p-1 rounded-xl text-[10px] font-semibold">
                                    <button type="button" 
                                            @click="activeTab = 'game'" 
                                            :class="activeTab === 'game' ? 'bg-brand-primary text-white shadow-xs' : 'text-slate-400 hover:text-white'"
                                            class="px-2.5 py-1 rounded-lg transition-colors">
                                        Game Dev
                                    </button>
                                    <button type="button" 
                                            @click="activeTab = '3d'" 
                                            :class="activeTab === '3d' ? 'bg-brand-primary text-white shadow-xs' : 'text-slate-400 hover:text-white'"
                                            class="px-2.5 py-1 rounded-lg transition-colors">
                                        Animasi 3D
                                    </button>
                                    <button type="button" 
                                            @click="activeTab = 'vr'" 
                                            :class="activeTab === 'vr' ? 'bg-brand-primary text-white shadow-xs' : 'text-slate-400 hover:text-white'"
                                            class="px-2.5 py-1 rounded-lg transition-colors">
                                        VR / Immersive
                                    </button>
                                </div>
                            </div>

                            <!-- Interactive Studio Graphic Screen -->
                            <div class="aspect-4/3 rounded-2xl bg-gradient-to-br from-slate-950 via-slate-900 to-brand-primary-dark/90 border border-white/10 p-5 flex flex-col justify-between relative overflow-hidden">
                                <!-- Dynamic Visual Grid Pattern -->
                                <div class="absolute inset-0 opacity-20 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:16px_16px]"></div>
                                
                                <!-- Header inside Screen -->
                                <div class="relative z-10 flex items-center justify-between text-xs text-brand-sky font-mono">
                                    <span class="bg-black/50 px-2 py-0.5 rounded text-[11px] border border-white/10 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                        <span x-text="activeTab === 'game' ? 'Engine: Unreal Engine 5' : (activeTab === '3d' ? 'Shader: Realtime Cycles' : 'Spatial XR: Meta Quest Ready')"></span>
                                    </span>
                                    <span class="text-brand-cream text-[11px]">FPS: 60 • 4K HDR</span>
                                </div>

                                <!-- Center Visual Graphic (Changes per Tab) -->
                                <div class="relative z-10 flex flex-col items-center justify-center my-3 space-y-2 text-center">
                                    
                                    <!-- 1. Game Development Visual -->
                                    <div x-show="activeTab === 'game'" x-transition class="flex flex-col items-center space-y-2">
                                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-600 via-brand-primary to-brand-sky flex items-center justify-center text-white shadow-xl shadow-indigo-500/25 border border-white/20 transform hover:scale-105 transition-transform">
                                            <svg class="w-9 h-9 text-brand-cream" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="block text-sm font-extrabold text-white tracking-wide">Pengembangan Game 2D &amp; 3D</span>
                                            <span class="block text-[11px] text-slate-300 font-mono">Unreal Engine • Unity • C# &amp; Blueprints</span>
                                        </div>
                                    </div>

                                    <!-- 2. 3D Animation Visual -->
                                    <div x-show="activeTab === '3d'" x-transition class="flex flex-col items-center space-y-2" style="display: none;">
                                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-amber-500 via-orange-600 to-rose-500 flex items-center justify-center text-white shadow-xl shadow-orange-500/25 border border-white/20 transform hover:scale-105 transition-transform">
                                            <svg class="w-9 h-9 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="block text-sm font-extrabold text-white tracking-wide">Pemodelan 3D, Rigging &amp; VFX</span>
                                            <span class="block text-[11px] text-slate-300 font-mono">Blender 4 • Autodesk Maya • ZBrush</span>
                                        </div>
                                    </div>

                                    <!-- 3. Virtual Reality Visual -->
                                    <div x-show="activeTab === 'vr'" x-transition class="flex flex-col items-center space-y-2" style="display: none;">
                                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-emerald-500 via-teal-600 to-sky-500 flex items-center justify-center text-white shadow-xl shadow-teal-500/25 border border-white/20 transform hover:scale-105 transition-transform">
                                            <svg class="w-9 h-9 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="block text-sm font-extrabold text-white tracking-wide">Teknologi Imersif (VR/AR/XR)</span>
                                            <span class="block text-[11px] text-slate-300 font-mono">Spatial Audio • Hand Tracking • 360 Video</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer inside Screen -->
                                <div class="relative z-10 flex items-center justify-between text-[11px] text-slate-400 border-t border-white/10 pt-2 font-mono">
                                    <span>Pipeline Kreatif</span>
                                    <span class="text-emerald-400 font-bold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        Siap Diterapkan di Industri
                                    </span>
                                </div>
                            </div>

                            <!-- Bottom Feature Tags inside Card -->
                            <div class="grid grid-cols-2 gap-2 text-center text-xs">
                                <div class="bg-white/5 rounded-xl p-2.5 border border-white/10 text-slate-200">
                                    <span class="block font-bold text-brand-cream">Magang Industri 1 Tahun</span>
                                    <span class="text-[10px] text-slate-400">Pengalaman Riil di DUDI</span>
                                </div>
                                <div class="bg-white/5 rounded-xl p-2.5 border border-white/10 text-slate-200">
                                    <span class="block font-bold text-brand-cream">Studio Render &amp; MoCap</span>
                                    <span class="text-[10px] text-slate-400">Standar Produksi Film &amp; Game</span>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Badge 2: Keunggulan Kompetensi (No Emojis) -->
                        <div class="absolute -bottom-6 -right-4 sm:-right-6 z-30 bg-white/95 backdrop-blur-md p-3 rounded-2xl border border-white/40 shadow-xl flex items-center gap-2.5 text-brand-dark">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-brand-primary to-brand-secondary flex items-center justify-center text-white shrink-0 shadow-xs">
                                <svg class="w-5 h-5 text-brand-cream" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <span class="block text-[9px] font-bold text-emerald-700 uppercase tracking-wider">Vokasi Masa Depan</span>
                                <span class="block text-xs font-extrabold text-brand-dark">Teknologi Rekayasa Multimedia</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

            </div>
        </div>
    </section>

    {{-- 3. Pengenalan Program Studi --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5 order-2 lg:order-1">
                <div class="relative">
                    <div class="aspect-4/3 rounded-2xl bg-gradient-to-tr from-brand-secondary/20 via-brand-sky/20 to-brand-primary/10 border border-brand-border p-8 flex flex-col justify-between shadow-inner">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-white border border-slate-200 text-xs font-semibold text-brand-primary">
                            Identitas Program Studi
                        </div>
                        <div class="space-y-3">
                            <span class="text-xs uppercase tracking-wider text-brand-muted font-bold block">Jurusan</span>
                            <div class="text-xl font-bold text-brand-dark">Komputer dan Bisnis</div>
                            <p class="text-xs text-brand-muted">
                                Politeknik Negeri Tanah Laut, Kalimantan Selatan
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-200/80 flex items-center justify-between text-xs text-brand-muted">
                            <span>Akreditasi: [Dalam Proses Akreditasi BAN-PT/LAM-INFOKOM]</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 space-y-6 order-1 lg:order-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-light text-brand-primary text-xs font-bold uppercase tracking-wider">
                    Tentang TRM POLITALA
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Program Studi Vokasi Unggulan di Bidang Rekayasa Multimedia
                </h2>
                <div class="space-y-4 text-brand-muted leading-relaxed">
                    <p>
                        Program Studi D-4 Teknik Rekayasa Multimedia dirancang untuk menjawab tingginya kebutuhan industri kreatif dan teknologi digital terhadap tenaga ahli terapan yang menguasai perancangan sistem multimedia interaktif, produksi konten animasi, perancangan game, dan UI/UX modern.
                    </p>
                    <p>
                        Dengan kurikulum berbasis praktik (Hands-on Learning) serta kolaborasi erat bersama Dunia Usaha dan Dunia Industri (DUDI), mahasiswa dibekali kemampuan teknis dan portofolio profesional sejak dini.
                    </p>
                </div>
                <div class="pt-2 flex items-center gap-4">
                    <a href="{{ route('public.profile.history') }}" class="text-sm font-bold text-brand-primary hover:text-brand-primary-hover flex items-center gap-1.5 transition-colors">
                        <span>Baca Sejarah &amp; Selengkapnya</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. Keunggulan Program Studi --}}
    <section class="bg-brand-surface py-16 border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="inline-flex px-3 py-1 rounded-full bg-brand-sky-light text-brand-primary text-xs font-bold uppercase tracking-wider">
                    Mengapa Memilih Kami
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                    Keunggulan Program Studi D-4 TRM
                </h2>
                <p class="text-brand-muted text-sm sm:text-base">
                    Komitmen pendidikan vokasi berkualitas dengan fasilitas modern dan kurikulum selaras industri.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Keunggulan 1 -->
                <div class="bg-white p-7 rounded-2xl border border-slate-200/80 shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold text-xl">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-brand-dark">Praktikum Berbasis Proyek (PBL)</h3>
                    <p class="text-sm text-brand-muted leading-relaxed">
                        Pembelajaran berpusat pada penugasan proyek industri nyata sehingga mahasiswa memiliki portofolio sebelum lulus.
                    </p>
                </div>

                <!-- Keunggulan 2 -->
                <div class="bg-white p-7 rounded-2xl border border-slate-200/80 shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold text-xl">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-brand-dark">Fasilitas Laboratorium Modern</h3>
                    <p class="text-sm text-brand-muted leading-relaxed">
                        Didukung laboratorium multimedia dengan workstation berspesifikasi tinggi untuk animasi, rendering 3D, dan pengembangan game.
                    </p>
                </div>

                <!-- Keunggulan 3 -->
                <div class="bg-white p-7 rounded-2xl border border-slate-200/80 shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold text-xl">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-brand-dark">Kemitraan Industri Kreatif</h3>
                    <p class="text-sm text-brand-muted leading-relaxed">
                        Program magang industri bersertifikat (MBKM Vokasi) untuk mempercepat serapan kerja lulusan di perusahaan multimedia dan digital agency.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. Kompetensi dan Prospek Karier --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="inline-flex px-3 py-1 rounded-full bg-brand-cream text-brand-dark text-xs font-bold uppercase tracking-wider">
                Masa Depan Lulusan
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                Kompetensi Utama &amp; Prospek Karier
            </h2>
            <p class="text-brand-muted text-sm sm:text-base">
                Peluang profesi bergengsi di era transformasi digital dan ekonomi kreatif.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all space-y-3">
                <div class="w-10 h-10 rounded-lg bg-brand-sky-light text-brand-primary flex items-center justify-center font-bold">
                    01
                </div>
                <h3 class="font-bold text-brand-dark text-base">Game Developer &amp; Programmer</h3>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Pengembang mekanik game, gameplay programmer, dan perancang simulasi interaktif virtual reality (VR).
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all space-y-3">
                <div class="w-10 h-10 rounded-lg bg-brand-sky-light text-brand-primary flex items-center justify-center font-bold">
                    02
                </div>
                <h3 class="font-bold text-brand-dark text-base">3D Artist &amp; Animator</h3>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Spesialis pemodelan 3D, texturing, rigging, dan animasi untuk industri perfilman, periklanan, dan game.
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all space-y-3">
                <div class="w-10 h-10 rounded-lg bg-brand-sky-light text-brand-primary flex items-center justify-center font-bold">
                    03
                </div>
                <h3 class="font-bold text-brand-dark text-base">UI/UX Designer</h3>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Desainer antarmuka dan pengalaman pengguna untuk aplikasi web, mobile, dan sistem interaktif digital.
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition-all space-y-3">
                <div class="w-10 h-10 rounded-lg bg-brand-sky-light text-brand-primary flex items-center justify-center font-bold">
                    04
                </div>
                <h3 class="font-bold text-brand-dark text-base">Multimedia Software Engineer</h3>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Perekayasa perangkat lunak berbasis media, video streaming, computer vision, dan sistem multimedia cerdas.
                </p>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('public.academic.graduate-profile') }}" class="inline-flex items-center gap-2 text-sm font-bold text-brand-primary hover:text-brand-primary-hover">
                <span>Pelajari Capaian Pembelajaran Lulusan (CPL) &amp; Profil Lengkap</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </section>

    {{-- 6. Dosen --}}
    <section class="bg-brand-surface py-16 border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="space-y-3">
                    <span class="inline-flex px-3 py-1 rounded-full bg-brand-primary-light text-brand-primary text-xs font-bold uppercase tracking-wider">
                        Tenaga Pendidik
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                        Dosen Pengajar
                    </h2>
                    <p class="text-brand-muted text-sm sm:text-base">
                        Didukung dosen berdedikasi dengan keahlian komputasi dan multimedia terapan.
                    </p>
                </div>
                <a href="{{ route('public.profile.lecturers') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-brand-primary hover:text-brand-primary-hover">
                    <span>Lihat Semua Dosen</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <!-- Card Dosen Grid (Dengan penanda data contoh eksplisit) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-md transition-all">
                        <div class="aspect-square bg-slate-100 flex items-center justify-center text-slate-400 border-b border-slate-100">
                            <svg class="w-16 h-16 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="p-5 space-y-2">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200 inline-block">
                                [Data Contoh #{{ $i }}]
                            </span>
                            <h3 class="font-bold text-sm text-brand-dark leading-tight">[Nama Dosen Pengajar {{ $i }}, M.Kom.]</h3>
                            <p class="text-xs text-brand-muted">Keahlian: [Multimedia &amp; Grafika Komputer]</p>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="text-xs text-slate-500 italic text-center">
                * Data nama dosen dan riwayat akademik di atas merupakan data contoh (dummy) dan akan diperbarui dengan data resmi institusi.
            </div>
        </div>
    </section>

    {{-- 7. Berita dan Pengumuman --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-3">
                <span class="inline-flex px-3 py-1 rounded-full bg-brand-sky-light text-brand-primary text-xs font-bold uppercase tracking-wider">
                    Kabar &amp; Agenda
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                    Berita &amp; Pengumuman Terbaru
                </h2>
                <p class="text-brand-muted text-sm sm:text-base">
                    Publikasi berita kegiatan dan pengumuman resmi program studi.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('public.news.index') }}" class="px-4 py-2 rounded-lg text-xs font-bold bg-brand-primary-light text-brand-primary hover:bg-brand-primary hover:text-white transition-colors">
                    Semua Berita
                </a>
                <a href="{{ route('public.announcements.index') }}" class="px-4 py-2 rounded-lg text-xs font-bold border border-slate-200 text-brand-dark hover:border-brand-primary hover:text-brand-primary transition-colors">
                    Semua Pengumuman
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @for ($j = 1; $j <= 3; $j++)
                <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all flex flex-col">
                    <div class="aspect-16/9 bg-slate-100 flex items-center justify-center text-slate-400 border-b border-slate-100 relative">
                        <svg class="w-12 h-12 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="absolute top-3 left-3 text-[10px] uppercase font-bold tracking-wider text-amber-800 bg-amber-100/90 px-2 py-0.5 rounded border border-amber-300">
                            [Berita Dummy #{{ $j }}]
                        </span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-xs text-brand-muted">
                                <span>{{ date('d M Y') }}</span>
                                <span>&bull;</span>
                                <span class="text-brand-secondary font-medium">Akademik</span>
                            </div>
                            <h3 class="font-bold text-base text-brand-dark leading-snug line-clamp-2 hover:text-brand-primary transition-colors">
                                <a href="{{ route('public.news.show', 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') }}">
                                    [Contoh Berita {{ $j }}] Sosialisasi Kurikulum dan Laboratorium Multimedia Terapan D-4 TRM
                                </a>
                            </h3>
                            <p class="text-xs text-brand-muted line-clamp-2 leading-relaxed">
                                Uraian ringkas berita mengenai persiapan kegiatan perkuliahan, workshop industri, dan fasilitas multimedia...
                            </p>
                        </div>
                        <a href="{{ route('public.news.show', 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') }}" class="text-xs font-bold text-brand-primary hover:text-brand-primary-hover inline-flex items-center gap-1">
                            <span>Baca Selengkapnya</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </article>
            @endfor
        </div>
    </section>

    {{-- 8. Fasilitas --}}
    <section class="bg-brand-surface py-16 border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="space-y-3">
                    <span class="inline-flex px-3 py-1 rounded-full bg-brand-primary-light text-brand-primary text-xs font-bold uppercase tracking-wider">
                        Sarana &amp; Prasarana
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                        Fasilitas Penunjang Pembelajaran
                    </h2>
                    <p class="text-brand-muted text-sm sm:text-base">
                        Ruang praktikum terintegrasi untuk mendukung proses belajar dan riset multimedia.
                    </p>
                </div>
                <a href="{{ route('public.facilities.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-brand-primary hover:text-brand-primary-hover">
                    <span>Lihat Seluruh Fasilitas</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 space-y-4 shadow-xs">
                    <div class="aspect-video rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200/60">
                        <span class="text-xs font-medium text-slate-400">[Foto Laboratorium Komputer]</span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200 inline-block mb-1.5">
                            [Data Contoh]
                        </span>
                        <h3 class="font-bold text-base text-brand-dark">Lab Komputasi Multimedia &amp; Desain</h3>
                        <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                            Dilengkapi PC berspesifikasi tinggi untuk pengolahan grafis 2D/3D, audio-video editing, dan UI prototyping.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 space-y-4 shadow-xs">
                    <div class="aspect-video rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200/60">
                        <span class="text-xs font-medium text-slate-400">[Foto Studio Animasi &amp; Motion]</span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200 inline-block mb-1.5">
                            [Data Contoh]
                        </span>
                        <h3 class="font-bold text-base text-brand-dark">Studio Animasi &amp; Green Screen</h3>
                        <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                            Fasilitas pengambilan gambar, motion capture, rekaman audio voice-over, dan produksi visual effect.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 space-y-4 shadow-xs">
                    <div class="aspect-video rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200/60">
                        <span class="text-xs font-medium text-slate-400">[Foto Lab Jaringan &amp; VR]</span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200 inline-block mb-1.5">
                            [Data Contoh]
                        </span>
                        <h3 class="font-bold text-base text-brand-dark">Lab Game Tech &amp; Immersive VR/AR</h3>
                        <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                            Eksperimen perangkat VR Headset, pengembangan interaktif simulator 3D, dan pengujian platform game.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 9. CTA Penutup --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="rounded-3xl bg-gradient-to-r from-brand-primary via-brand-primary to-brand-secondary text-white p-8 sm:p-14 shadow-xl relative overflow-hidden">
            <div class="relative z-10 max-w-2xl space-y-6">
                <span class="inline-flex px-3 py-1 rounded-full bg-brand-cream text-brand-dark text-xs font-bold uppercase tracking-wider">
                    Penerimaan Mahasiswa Baru
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                    Bergabung Menjadi Generasi Kreatif &amp; Inovator Multimedia
                </h2>
                <p class="text-sm sm:text-base text-brand-sky/90 leading-relaxed">
                    Dapatkan informasi pendaftaran mahasiswa baru, jalur seleksi, dan beasiswa melalui portal resmi Politeknik Negeri Tanah Laut.
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="{{ route('public.contact') }}" class="px-6 py-3 rounded-xl bg-white text-brand-primary font-bold hover:bg-slate-100 shadow-md transition-all">
                        Hubungi Program Studi
                    </a>
                    <a href="https://politala.ac.id" target="_blank" rel="noopener noreferrer" class="px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold transition-all flex items-center gap-2">
                        <span>Portal POLITALA</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
