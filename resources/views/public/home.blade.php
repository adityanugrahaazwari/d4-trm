@extends('layouts.public')

@section('title', 'Beranda - D-IV Teknik Rekayasa Multimedia POLITALA')

@section('content')
<div class="flex flex-col gap-16 lg:gap-24">

    {{-- 2. Hero Section --}}
    <section x-data="{ 
        activeTab: 'game',
        wireframeMode: false,
        focusIndex: 0,
        focusList: [
            'Game Development 3D',
            'Animasi &amp; Visual Effects',
            'Virtual Reality (VR/AR)',
            'Rekayasa Aplikasi Multimedia'
        ],
        init() {
            setInterval(() => {
                this.focusIndex = (this.focusIndex + 1) % this.focusList.length;
            }, 3200);
        }
    }" 
    class="relative overflow-hidden bg-brand-primary-dark text-white pt-20 sm:pt-24 lg:pt-28 pb-16 lg:pb-24">
        
        <!-- Ambient Cyber-Grid & Cinematic Background Layer with Slow Pulsing Orbs -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <!-- 3D Cyber-Grid Pattern -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(151,215,255,0.07)_1px,transparent_1px),linear-gradient(to_bottom,rgba(151,215,255,0.07)_1px,transparent_1px)] bg-[size:36px_36px] opacity-30"></div>
            <!-- Radial Dot Matrix -->
            <div class="absolute inset-0 bg-[radial-gradient(#97D7FF_1.2px,transparent_1.2px)] [background-size:24px_24px] opacity-15"></div>
            <!-- Gradient Overlay: menjaga keterbacaan teks dan kedalaman warna -->
            <div class="absolute inset-0 bg-gradient-to-r from-brand-primary-dark/95 via-brand-primary/90 to-brand-primary/80 z-10"></div>
            <!-- Ambient Glowing Color Orbs (with smooth breathing animations) -->
            <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-brand-sky/20 blur-3xl z-10 animate-pulse-slow"></div>
            <div class="absolute -bottom-24 -right-24 w-[34rem] h-[34rem] rounded-full bg-brand-secondary/30 blur-3xl z-10 animate-pulse-slow [animation-delay:2s]"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full bg-indigo-500/10 blur-3xl z-10 animate-pulse-slow [animation-delay:4s]"></div>
        </div>

        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-14 items-center">
                
                <!-- Left Narrative Column -->
                <div class="lg:col-span-7 space-y-7">
                    <!-- Campus & Degree Identifier Badge -->
                    <div class="inline-flex flex-wrap items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-semibold text-brand-sky shadow-sm transition-all hover:border-brand-sky/40">
                        <span class="flex items-center gap-1.5 text-brand-cream">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>POLITALA Tanah Laut</span>
                        </span>
                        <span class="text-white/40">&bull;</span>
                        <span class="text-white">Sarjana Terapan (D-IV)</span>
                        <span class="text-white/40">&bull;</span>
                        <span class="inline-flex items-center gap-1 text-emerald-400 font-bold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            Akreditasi Baik Sekali
                        </span>
                    </div>

                    <!-- Main Dynamic Animated Headline -->
                    <div class="space-y-2">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.15] sm:leading-[1.15]">
                            Pusat Keunggulan <br class="hidden sm:inline" />
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-cream via-brand-sky to-white">
                                Seni Digital &amp; Teknologi
                            </span>
                        </h1>
                        <div class="flex items-center gap-2.5 text-xl sm:text-2xl lg:text-3xl font-extrabold text-brand-sky">
                            <span class="text-slate-300 font-semibold text-lg sm:text-xl shrink-0">Fokus:</span>
                            <div class="relative inline-flex items-center min-h-[1.5em] overflow-hidden">
                                <template x-for="(focus, idx) in focusList" :key="idx">
                                    <span x-show="focusIndex === idx" 
                                          x-transition:enter="transition ease-out duration-500 transform"
                                          x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                                          x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                          x-transition:leave="transition ease-in duration-300 transform absolute"
                                          x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                          x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
                                          class="inline-block text-brand-cream border-b-2 border-brand-cream/60 whitespace-nowrap" 
                                          x-html="focus">
                                    </span>
                                </template>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm font-bold uppercase tracking-wider text-slate-300">
                            Program Studi Sarjana Terapan Teknik Rekayasa Multimedia
                        </p>
                    </div>

                    <p class="text-base sm:text-lg text-slate-200/90 max-w-2xl leading-relaxed font-normal">
                        Mempersiapkan talenta masa depan yang menguasai integrasi komputasi modern dan kreativitas visual: mulai dari <span class="text-white font-semibold">Game Programming</span>, <span class="text-white font-semibold">Produksi Animasi 3D</span>, hingga ekosistem interaktif <span class="text-white font-semibold">Virtual Reality (VR/AR)</span>.
                    </p>

                    <!-- Primary CTAs (Pendaftaran PMB, Kurikulum & Video Showreel) -->
                    <div class="flex flex-wrap items-center gap-3.5 pt-1">
                        <!-- Pendaftaran PMB Button (Standout Primary CTA with animated shimmer & pulse glow) -->
                        <a href="https://pmb.politala.ac.id" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="relative overflow-hidden px-6 py-3.5 rounded-full bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-400 hover:from-emerald-300 hover:to-teal-200 text-slate-950 font-black text-sm hover:shadow-2xl hover:shadow-emerald-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2.5 group shadow-lg">
                            <!-- Shimmer Light Ray Sweep -->
                            <span class="absolute inset-0 w-1/2 h-full bg-gradient-to-r from-transparent via-white/50 to-transparent skew-x-12 animate-shimmer pointer-events-none"></span>
                            
                            <svg class="w-4 h-4 text-slate-950 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span class="relative z-10">Pendaftaran Mahasiswa Baru</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>

                        <!-- Jelajahi Kurikulum -->
                        <a href="{{ route('public.academic.curriculum') }}" 
                           class="px-5 py-3.5 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white font-bold text-sm transition-all flex items-center gap-2 hover:scale-[1.02] active:scale-[0.98] hover:border-brand-sky/40">
                            <span>Jelajahi Kurikulum</span>
                            <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Quick Highlights Metrics Cards with Hover Lift -->
                    <div class="pt-6 border-t border-white/15 grid grid-cols-3 gap-3 max-w-lg">
                        <div class="card-fade-up bg-white/5 rounded-2xl p-3 border border-white/10 backdrop-blur-sm hover:bg-white/10 hover:border-brand-sky/40 hover:-translate-y-0.5 transition-all duration-300" data-card-delay="100">
                            <div class="text-xl sm:text-2xl font-black text-brand-cream">144 SKS</div>
                            <div class="text-[10px] text-brand-sky/80 uppercase tracking-wider font-semibold">Kurikulum Terapan</div>
                        </div>
                        <div class="card-fade-up bg-white/5 rounded-2xl p-3 border border-white/10 backdrop-blur-sm hover:bg-white/10 hover:border-brand-sky/40 hover:-translate-y-0.5 transition-all duration-300" data-card-delay="200">
                            <div class="text-xl sm:text-2xl font-black text-brand-cream">4 Tahun</div>
                            <div class="text-[10px] text-brand-sky/80 uppercase tracking-wider font-semibold">Jenjang D-IV (S1)</div>
                        </div>
                        <div class="card-fade-up bg-white/5 rounded-2xl p-3 border border-white/10 backdrop-blur-sm hover:bg-white/10 hover:border-brand-sky/40 hover:-translate-y-0.5 transition-all duration-300" data-card-delay="300">
                            <div class="text-xl sm:text-2xl font-black text-brand-cream">S.Tr.Kom.</div>
                            <div class="text-[10px] text-brand-sky/80 uppercase tracking-wider font-semibold">Gelar Kelulusan</div>
                        </div>
                    </div>

                    <!-- Tech Stack & Engine Strip with Micro-Interactions -->
                    <div class="pt-3 flex flex-wrap items-center gap-2 text-xs text-slate-300">
                        <span class="text-[10px] font-bold text-brand-sky uppercase tracking-wider mr-1">Tools &amp; Engine:</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 hover:border-brand-sky/50 font-mono text-[10px] text-white hover:text-brand-cream hover:-translate-y-0.5 transition-all duration-200 cursor-default shadow-xs">Unreal Engine 5</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 hover:border-brand-sky/50 font-mono text-[10px] text-white hover:text-brand-cream hover:-translate-y-0.5 transition-all duration-200 cursor-default shadow-xs">Unity 3D</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 hover:border-brand-sky/50 font-mono text-[10px] text-white hover:text-brand-cream hover:-translate-y-0.5 transition-all duration-200 cursor-default shadow-xs">Blender 4</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 hover:border-brand-sky/50 font-mono text-[10px] text-white hover:text-brand-cream hover:-translate-y-0.5 transition-all duration-200 cursor-default shadow-xs">Autodesk Maya</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 hover:border-brand-sky/50 font-mono text-[10px] text-white hover:text-brand-cream hover:-translate-y-0.5 transition-all duration-200 cursor-default shadow-xs">Adobe Suite</span>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 hover:border-brand-sky/50 font-mono text-[10px] text-white hover:text-brand-cream hover:-translate-y-0.5 transition-all duration-200 cursor-default shadow-xs">Meta Quest XR</span>
                    </div>
                </div>

                <!-- Right Dynamic Interactive Showcase: Studio & Creative Pipeline -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        
                        <!-- Floating Badge 1: Identitas Kampus POLITALA (Smooth Floating Keyframe) -->
                        <div class="absolute -top-6 -left-4 sm:-left-6 z-30 bg-white/95 backdrop-blur-md p-3 rounded-2xl border border-white/40 shadow-xl flex items-center gap-2.5 text-brand-dark animate-float hover:scale-105 transition-transform duration-300">
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
                        <div class="card-fade-up rounded-3xl bg-slate-900/85 backdrop-blur-2xl border border-white/20 p-5 sm:p-6 shadow-2xl relative overflow-hidden space-y-4 hover:border-brand-sky/30 transition-colors duration-500" data-card-delay="150">
                            
                            <!-- Window Control Bar & Interactive Tabs -->
                            <div class="flex items-center justify-between border-b border-white/10 pb-3 gap-2">
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <span class="w-3 h-3 rounded-full bg-rose-500/90 transition-transform hover:scale-125"></span>
                                    <span class="w-3 h-3 rounded-full bg-amber-500/90 transition-transform hover:scale-125"></span>
                                    <span class="w-3 h-3 rounded-full bg-emerald-500/90 transition-transform hover:scale-125"></span>
                                </div>
                                
                                <!-- Tab Switches -->
                                <div class="flex items-center gap-1 bg-black/40 p-1 rounded-xl text-[10px] font-semibold">
                                    <button type="button" 
                                            @click="activeTab = 'game'" 
                                            :class="activeTab === 'game' ? 'bg-brand-primary text-white shadow-xs' : 'text-slate-400 hover:text-white'"
                                            class="px-2 py-1 rounded-lg transition-all duration-200">
                                        Game Dev
                                    </button>
                                    <button type="button" 
                                            @click="activeTab = '3d'" 
                                            :class="activeTab === '3d' ? 'bg-brand-primary text-white shadow-xs' : 'text-slate-400 hover:text-white'"
                                            class="px-2 py-1 rounded-lg transition-all duration-200">
                                        Animasi 3D
                                    </button>
                                    <button type="button" 
                                            @click="activeTab = 'vr'" 
                                            :class="activeTab === 'vr' ? 'bg-brand-primary text-white shadow-xs' : 'text-slate-400 hover:text-white'"
                                            class="px-2 py-1 rounded-lg transition-all duration-200">
                                        VR / Immersive
                                    </button>
                                </div>
                            </div>

                            <!-- Interactive Studio Graphic Screen -->
                            <div class="aspect-4/3 rounded-2xl bg-gradient-to-br from-slate-950 via-slate-900 to-brand-primary-dark/90 border border-white/10 p-4 sm:p-5 flex flex-col justify-between relative overflow-hidden group">
                                <!-- Dynamic Visual Grid Pattern (Changes with Wireframe Mode) -->
                                <div class="absolute inset-0 transition-opacity duration-300"
                                     :class="wireframeMode ? 'opacity-40 bg-[linear-gradient(to_right,#00ffff_1px,transparent_1px),linear-gradient(to_bottom,#00ffff_1px,transparent_1px)] bg-[size:14px_14px]' : 'opacity-20 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:16px_16px]'"></div>
                                
                                <!-- Laser / Engine Scanline Beam Animation -->
                                <div class="absolute inset-x-0 h-16 bg-gradient-to-b from-transparent via-cyan-400/10 to-transparent pointer-events-none animate-scan z-10"></div>

                                <!-- Header inside Screen: Shader stats & Wireframe Toggle -->
                                <div class="relative z-10 flex items-center justify-between text-xs text-brand-sky font-mono">
                                    <span class="bg-black/50 px-2 py-0.5 rounded text-[11px] border border-white/10 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                        <span x-text="activeTab === 'game' ? 'Unreal Engine 5' : (activeTab === '3d' ? 'Blender Cycles' : 'Meta Quest XR')"></span>
                                    </span>
                                    
                                    <!-- Wireframe Mode Toggle Button -->
                                    <button type="button" 
                                            @click="wireframeMode = !wireframeMode"
                                            class="px-2 py-0.5 rounded text-[10px] font-bold border transition-all duration-200 flex items-center gap-1 hover:scale-105 active:scale-95"
                                            :class="wireframeMode ? 'bg-cyan-500/20 text-cyan-300 border-cyan-400/40 shadow-xs shadow-cyan-500/30' : 'bg-white/10 text-slate-300 border-white/10 hover:text-white'">
                                        <span x-text="wireframeMode ? 'Wireframe: ON' : 'Wireframe: OFF'"></span>
                                    </button>
                                </div>

                                <!-- Center Visual Graphic (Changes per Tab & Wireframe Mode) -->
                                <div class="relative z-10 flex flex-col items-center justify-center my-3 space-y-2 text-center">
                                    
                                    <!-- 1. Game Development Visual -->
                                    <div x-show="activeTab === 'game'" 
                                         x-transition:enter="transition ease-out duration-300 transform"
                                         x-transition:enter-start="opacity-0 scale-90"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         class="flex flex-col items-center space-y-2">
                                        <div class="h-20 flex items-center justify-center" :class="wireframeMode ? 'opacity-40 invert contrast-200' : ''">
                                            <img src="{{ asset('assets/undraw_virtual-reality_4fo0.svg') }}" alt="Game Development Visual" class="h-20 w-auto object-contain drop-shadow-lg group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                        <div>
                                            <span class="block text-sm font-extrabold text-white tracking-wide">Pengembangan Game 2D &amp; 3D</span>
                                            <span class="block text-[11px] text-slate-300 font-mono">Unreal Engine â€¢ Unity â€¢ C# &amp; Blueprints</span>
                                        </div>
                                    </div>

                                    <!-- 2. 3D Animation Visual -->
                                    <div x-show="activeTab === '3d'" 
                                         x-transition:enter="transition ease-out duration-300 transform"
                                         x-transition:enter-start="opacity-0 scale-90"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         class="flex flex-col items-center space-y-2" style="display: none;">
                                        <div class="h-20 flex items-center justify-center" :class="wireframeMode ? 'opacity-40 invert contrast-200' : ''">
                                            <img src="{{ asset('assets/undraw_3d-modeling_j8a3.svg') }}" alt="3D Animation Modeling" class="h-20 w-auto object-contain drop-shadow-lg group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                        <div>
                                            <span class="block text-sm font-extrabold text-white tracking-wide">Pemodelan 3D, Rigging &amp; VFX</span>
                                            <span class="block text-[11px] text-slate-300 font-mono">Blender 4 â€¢ Autodesk Maya â€¢ ZBrush</span>
                                        </div>
                                    </div>

                                    <!-- 3. Virtual Reality Visual -->
                                    <div x-show="activeTab === 'vr'" 
                                         x-transition:enter="transition ease-out duration-300 transform"
                                         x-transition:enter-start="opacity-0 scale-90"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         class="flex flex-col items-center space-y-2" style="display: none;">
                                        <div class="h-20 flex items-center justify-center" :class="wireframeMode ? 'opacity-40 invert contrast-200' : ''">
                                            <img src="{{ asset('assets/undraw_augmented-reality_3ie0.svg') }}" alt="Immersive Tech XR" class="h-20 w-auto object-contain drop-shadow-lg group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                        <div>
                                            <span class="block text-sm font-extrabold text-white tracking-wide">Teknologi Imersif (VR/AR/XR)</span>
                                            <span class="block text-[11px] text-slate-300 font-mono">Spatial Audio â€¢ Hand Tracking â€¢ 360 Video</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer inside Screen: Live Audio Equalizer Waveform & Pipeline -->
                                <div class="relative z-10 flex items-center justify-between text-[11px] text-slate-400 border-t border-white/10 pt-2 font-mono">
                                    <!-- Animated 7-Bar Waveform Equalizer -->
                                    <div class="flex items-end gap-1 h-3.5" title="Live Audio Bus Monitoring">
                                        <span class="w-1 h-2 bg-brand-sky rounded-full animate-bounce [animation-duration:600ms]"></span>
                                        <span class="w-1 h-3.5 bg-emerald-400 rounded-full animate-bounce [animation-duration:450ms]"></span>
                                        <span class="w-1 h-1.5 bg-brand-cream rounded-full animate-bounce [animation-duration:750ms]"></span>
                                        <span class="w-1 h-3 bg-rose-400 rounded-full animate-bounce [animation-duration:500ms]"></span>
                                        <span class="w-1 h-2 bg-brand-sky rounded-full animate-bounce [animation-duration:650ms]"></span>
                                        <span class="w-1 h-3.5 bg-cyan-300 rounded-full animate-bounce [animation-duration:550ms]"></span>
                                        <span class="w-1 h-1 bg-amber-300 rounded-full animate-bounce [animation-duration:700ms]"></span>
                                    </div>
                                    <span class="text-emerald-400 font-bold flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        Pipeline Industri Siap
                                    </span>
                                </div>
                            </div>

                            <!-- Bottom Feature Tags inside Card -->
                            <div class="grid grid-cols-2 gap-2 text-center text-xs">
                                <div class="bg-white/5 hover:bg-white/10 rounded-xl p-2.5 border border-white/10 text-slate-200 transition-colors">
                                    <span class="block font-bold text-brand-cream">Magang Industri 1 Tahun</span>
                                    <span class="text-[10px] text-slate-400">Pengalaman Riil di DUDI</span>
                                </div>
                                <div class="bg-white/5 hover:bg-white/10 rounded-xl p-2.5 border border-white/10 text-slate-200 transition-colors">
                                    <span class="block font-bold text-brand-cream">Studio Render &amp; MoCap</span>
                                    <span class="text-[10px] text-slate-400">Standar Film &amp; Game</span>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Badge 2: Keunggulan Kompetensi (Smooth Floating Keyframe with Delay) -->
                        <div class="absolute -bottom-6 -right-4 sm:-right-6 z-30 bg-white/95 backdrop-blur-md p-3 rounded-2xl border border-white/40 shadow-xl flex items-center gap-2.5 text-brand-dark animate-float-reverse hover:scale-105 transition-transform duration-300">
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

    {{-- 3. Pengenalan Program Studi --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5 order-2 lg:order-1">
                <div class="relative">
                    <!-- Floating Accent Badge -->
                    <div class="absolute -top-4 -right-3 z-20 bg-white/95 backdrop-blur-md px-3.5 py-1.5 rounded-xl border border-brand-primary/20 shadow-lg text-[11px] font-bold text-brand-primary flex items-center gap-1.5 animate-float hover:scale-105 transition-transform">
                        <span class="w-2 h-2 rounded-full bg-brand-primary animate-ping"></span>
                        <span>Sarjana Terapan Vokasi</span>
                    </div>

                    <div class="card-fade-up rounded-2xl bg-gradient-to-tr from-brand-secondary/20 via-brand-sky/20 to-brand-primary/10 border border-brand-border p-6 sm:p-7 flex flex-col justify-between shadow-inner hover:shadow-xl hover:border-brand-primary/30 transition-all duration-500 relative overflow-hidden group" data-card-delay="0">
                        <!-- Ambient Grid Background -->
                        <div class="absolute inset-0 bg-[radial-gradient(#086288_1px,transparent_1px)] [background-size:16px_16px] opacity-10 pointer-events-none"></div>

                        <div class="relative z-10 flex items-center justify-between">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-white border border-slate-200 text-xs font-semibold text-brand-primary shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span>
                                <span>Identitas Program Studi</span>
                            </div>
                            <span class="text-xs uppercase tracking-wider text-brand-primary font-bold">D-IV TRM</span>
                        </div>

                        <!-- Team Collaboration Illustration -->
                        <div class="relative z-10 my-4 flex items-center justify-center">
                            <img src="{{ asset('assets/undraw_team-collaboration_phnf.svg') }}" 
                                 alt="Kolaborasi Mahasiswa Multimedia POLITALA" 
                                 class="h-44 sm:h-52 w-auto object-contain drop-shadow-md group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <div class="relative z-10 space-y-1">
                            <span class="text-[10px] uppercase tracking-wider text-brand-muted font-bold block">Jurusan</span>
                            <div class="text-xl sm:text-2xl font-black text-brand-dark group-hover:text-brand-primary transition-colors">Komputer dan Bisnis</div>
                            <p class="text-xs text-brand-muted">
                                Politeknik Negeri Tanah Laut, Kalimantan Selatan
                            </p>
                        </div>
                        <div class="relative z-10 pt-3 mt-3 border-t border-slate-200/80 flex items-center justify-between text-xs text-brand-muted">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                <span>Akreditasi: [Dalam Proses Akreditasi BAN-PT/LAM-INFOKOM]</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 space-y-6 order-1 lg:order-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-light text-brand-primary text-xs font-bold uppercase tracking-wider shadow-xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span>
                    <span>Tentang TRM POLITALA</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Program Studi Vokasi Unggulan di Bidang Rekayasa Multimedia
                </h2>
                <div class="space-y-4 text-brand-muted leading-relaxed">
                    <p>
                        Program Studi D-IV Teknik Rekayasa Multimedia dirancang untuk menjawab tingginya kebutuhan industri kreatif dan teknologi digital terhadap tenaga ahli terapan yang menguasai perancangan sistem multimedia interaktif, produksi konten animasi, perancangan game, dan UI/UX modern.
                    </p>
                    <p>
                        Dengan kurikulum berbasis praktik (Hands-on Learning) serta kolaborasi erat bersama Dunia Usaha dan Dunia Industri (DUDI), mahasiswa dibekali kemampuan teknis dan portofolio profesional sejak dini.
                    </p>
                </div>

                <!-- Interactive Pillars Highlight -->
                <div class="grid grid-cols-3 gap-3 pt-1">
                    <div class="card-fade-up p-3 rounded-xl bg-brand-surface border border-slate-200/80 hover:border-brand-primary/40 hover:bg-white hover:-translate-y-1 hover:shadow-md transition-all duration-300" data-card-delay="0">
                        <span class="block text-xs font-black text-brand-dark">Hands-on Lab</span>
                        <span class="text-[10px] text-brand-muted font-medium">70% Praktik Vokasi</span>
                    </div>
                    <div class="card-fade-up p-3 rounded-xl bg-brand-surface border border-slate-200/80 hover:border-brand-primary/40 hover:bg-white hover:-translate-y-1 hover:shadow-md transition-all duration-300" data-card-delay="120">
                        <span class="block text-xs font-black text-brand-dark">Standar DUDI</span>
                        <span class="text-[10px] text-brand-muted font-medium">Kurikulum Selaras</span>
                    </div>
                    <div class="card-fade-up p-3 rounded-xl bg-brand-surface border border-slate-200/80 hover:border-brand-primary/40 hover:bg-white hover:-translate-y-1 hover:shadow-md transition-all duration-300" data-card-delay="240">
                        <span class="block text-xs font-black text-brand-dark">Portofolio Riil</span>
                        <span class="text-[10px] text-brand-muted font-medium">Karya Siap Industri</span>
                    </div>
                </div>

                <div class="pt-2 flex items-center gap-4">
                    <a href="{{ route('public.profile.history') }}" class="group text-sm font-bold text-brand-primary hover:text-brand-primary-hover flex items-center gap-1.5 transition-colors">
                        <span>Baca Sejarah &amp; Selengkapnya</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. Keunggulan Program Studi --}}
    <section class="bg-brand-surface py-16 border-y border-slate-200/80 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 relative z-10">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="inline-flex px-3 py-1 rounded-full bg-brand-sky-light text-brand-primary text-xs font-bold uppercase tracking-wider shadow-xs">
                    Mengapa Memilih Kami
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                    Keunggulan Program Studi D-IV TRM
                </h2>
                <p class="text-brand-muted text-sm sm:text-base">
                    Komitmen pendidikan vokasi berkualitas dengan fasilitas modern dan kurikulum selaras industri.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Keunggulan 1 -->
                <div class="card-fade-up group relative overflow-hidden bg-white p-7 rounded-2xl border border-slate-200/80 shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 space-y-4 flex flex-col justify-between" data-card-delay="0">
                    <!-- Top Accent Line -->
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-brand-primary to-brand-sky opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="space-y-4">
                        <div class="h-32 flex items-center justify-center p-2 bg-slate-50/80 rounded-xl border border-slate-100">
                            <img src="{{ asset('assets/undraw_live-collaboration_i8an.svg') }}" alt="Praktikum Berbasis Proyek PBL" class="h-28 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-lg font-bold text-brand-dark group-hover:text-brand-primary transition-colors">Praktikum Berbasis Proyek (PBL)</h3>
                        <p class="text-sm text-brand-muted leading-relaxed">
                            Pembelajaran berpusat pada penugasan proyek industri nyata sehingga mahasiswa memiliki portofolio sebelum lulus.
                        </p>
                    </div>
                </div>

                <!-- Keunggulan 2 -->
                <div class="card-fade-up group relative overflow-hidden bg-white p-7 rounded-2xl border border-slate-200/80 shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 space-y-4 flex flex-col justify-between" data-card-delay="150">
                    <!-- Top Accent Line -->
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-brand-secondary to-brand-sky opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="space-y-4">
                        <div class="h-32 flex items-center justify-center p-2 bg-slate-50/80 rounded-xl border border-slate-100">
                            <img src="{{ asset('assets/undraw_instant-analysis_vm8x.svg') }}" alt="Fasilitas Laboratorium Modern" class="h-28 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-lg font-bold text-brand-dark group-hover:text-brand-primary transition-colors">Fasilitas Laboratorium Modern</h3>
                        <p class="text-sm text-brand-muted leading-relaxed">
                            Didukung laboratorium multimedia dengan workstation berspesifikasi tinggi untuk animasi, rendering 3D, dan pengembangan game.
                        </p>
                    </div>
                </div>

                <!-- Keunggulan 3 -->
                <div class="card-fade-up group relative overflow-hidden bg-white p-7 rounded-2xl border border-slate-200/80 shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 space-y-4 flex flex-col justify-between" data-card-delay="300">
                    <!-- Top Accent Line -->
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-emerald-500 to-teal-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="space-y-4">
                        <div class="h-32 flex items-center justify-center p-2 bg-slate-50/80 rounded-xl border border-slate-100">
                            <img src="{{ asset('assets/undraw_handshake-deal_nwk6.svg') }}" alt="Kemitraan Industri Kreatif" class="h-28 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-lg font-bold text-brand-dark group-hover:text-brand-primary transition-colors">Kemitraan Industri Kreatif</h3>
                        <p class="text-sm text-brand-muted leading-relaxed">
                            Program magang industri bersertifikat (MBKM Vokasi) untuk mempercepat serapan kerja lulusan di perusahaan multimedia dan digital agency.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. Kompetensi dan Prospek Karier --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="inline-flex px-3 py-1 rounded-full bg-brand-cream text-brand-dark text-xs font-bold uppercase tracking-wider shadow-xs">
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
            <!-- Career 1 -->
            <div class="card-fade-up group relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:-translate-y-2 hover:border-brand-sky/60 transition-all duration-300 space-y-3 flex flex-col justify-between" data-card-delay="0">
                <div class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-sky to-brand-primary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="w-9 h-9 rounded-xl bg-brand-sky-light text-brand-primary group-hover:bg-brand-primary group-hover:text-white group-hover:scale-110 group-hover:shadow-md transition-all duration-300 flex items-center justify-center font-black text-xs">
                            01
                        </div>
                        <span class="text-[10px] uppercase font-bold tracking-wider text-brand-secondary">Game Industry</span>
                    </div>
                    <div class="h-24 flex items-center justify-center p-2 bg-slate-50/80 rounded-xl border border-slate-100">
                        <img src="{{ asset('assets/undraw_virtual-reality_4fo0.svg') }}" alt="Game Developer & Programmer" class="h-20 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h3 class="font-bold text-brand-dark text-base group-hover:text-brand-primary transition-colors">Game Developer &amp; Programmer</h3>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        Pengembang mekanik game, gameplay programmer, dan perancang simulasi interaktif virtual reality (VR).
                    </p>
                </div>
            </div>

            <!-- Career 2 -->
            <div class="card-fade-up group relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:-translate-y-2 hover:border-brand-sky/60 transition-all duration-300 space-y-3 flex flex-col justify-between" data-card-delay="120">
                <div class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-sky to-brand-primary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="w-9 h-9 rounded-xl bg-brand-sky-light text-brand-primary group-hover:bg-brand-primary group-hover:text-white group-hover:scale-110 group-hover:shadow-md transition-all duration-300 flex items-center justify-center font-black text-xs">
                            02
                        </div>
                        <span class="text-[10px] uppercase font-bold tracking-wider text-brand-secondary">Animation &amp; Film</span>
                    </div>
                    <div class="h-24 flex items-center justify-center p-2 bg-slate-50/80 rounded-xl border border-slate-100">
                        <img src="{{ asset('assets/undraw_3d-modeling_j8a3.svg') }}" alt="3D Artist & Animator" class="h-20 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h3 class="font-bold text-brand-dark text-base group-hover:text-brand-primary transition-colors">3D Artist &amp; Animator</h3>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        Spesialis pemodelan 3D, texturing, rigging, dan animasi untuk industri perfilman, periklanan, dan game.
                    </p>
                </div>
            </div>

            <!-- Career 3 -->
            <div class="card-fade-up group relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:-translate-y-2 hover:border-brand-sky/60 transition-all duration-300 space-y-3 flex flex-col justify-between" data-card-delay="240">
                <div class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-sky to-brand-primary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="w-9 h-9 rounded-xl bg-brand-sky-light text-brand-primary group-hover:bg-brand-primary group-hover:text-white group-hover:scale-110 group-hover:shadow-md transition-all duration-300 flex items-center justify-center font-black text-xs">
                            03
                        </div>
                        <span class="text-[10px] uppercase font-bold tracking-wider text-brand-secondary">Product &amp; UI/UX</span>
                    </div>
                    <div class="h-24 flex items-center justify-center p-2 bg-slate-50/80 rounded-xl border border-slate-100">
                        <img src="{{ asset('assets/undraw_brainstorming_gny9.svg') }}" alt="UI/UX Designer" class="h-20 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h3 class="font-bold text-brand-dark text-base group-hover:text-brand-primary transition-colors">UI/UX Designer</h3>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        Desainer antarmuka dan pengalaman pengguna untuk aplikasi web, mobile, dan sistem interaktif digital.
                    </p>
                </div>
            </div>

            <!-- Career 4 -->
            <div class="card-fade-up group relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:-translate-y-2 hover:border-brand-sky/60 transition-all duration-300 space-y-3 flex flex-col justify-between" data-card-delay="360">
                <div class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-sky to-brand-primary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="w-9 h-9 rounded-xl bg-brand-sky-light text-brand-primary group-hover:bg-brand-primary group-hover:text-white group-hover:scale-110 group-hover:shadow-md transition-all duration-300 flex items-center justify-center font-black text-xs">
                            04
                        </div>
                        <span class="text-[10px] uppercase font-bold tracking-wider text-brand-secondary">Software &amp; Vision</span>
                    </div>
                    <div class="h-24 flex items-center justify-center p-2 bg-slate-50/80 rounded-xl border border-slate-100">
                        <img src="{{ asset('assets/undraw_team-assignment_lzot.svg') }}" alt="Multimedia Software Engineer" class="h-20 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h3 class="font-bold text-brand-dark text-base group-hover:text-brand-primary transition-colors">Multimedia Software Engineer</h3>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        Perekayasa perangkat lunak berbasis media, video streaming, computer vision, dan sistem multimedia cerdas.
                    </p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('public.academic.graduate-profile') }}" class="group inline-flex items-center gap-2 text-sm font-bold text-brand-primary hover:text-brand-primary-hover transition-colors">
                <span>Pelajari Capaian Pembelajaran Lulusan (CPL) &amp; Profil Lengkap</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                    <span class="inline-flex px-3 py-1 rounded-full bg-brand-primary-light text-brand-primary text-xs font-bold uppercase tracking-wider shadow-xs">
                        Tenaga Pendidik
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                        Dosen Pengajar
                    </h2>
                    <p class="text-brand-muted text-sm sm:text-base">
                        Didukung dosen berdedikasi dengan keahlian komputasi dan multimedia terapan.
                    </p>
                </div>
                <a href="{{ route('public.profile.lecturers') }}" class="group inline-flex items-center gap-1.5 text-sm font-bold text-brand-primary hover:text-brand-primary-hover transition-colors">
                    <span>Lihat Semua Dosen</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <!-- Card Dosen Grid (Dengan penanda data contoh eksplisit) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="card-fade-up group bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-xl hover:-translate-y-2 hover:border-brand-primary/40 transition-all duration-300" data-card-delay="{{ ($i - 1) * 120 }}">
                        <div class="aspect-square bg-gradient-to-br from-slate-100 via-slate-50 to-brand-primary-light/30 flex items-center justify-center p-6 border-b border-slate-100 relative overflow-hidden">
                            <!-- Avatar Ambient Shimmer -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                            
                            <img src="{{ asset('assets/undraw_educator_6dgp.svg') }}" alt="Tenaga Pendidik D-IV TRM" class="h-28 w-auto object-contain drop-shadow-xs group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-5 space-y-2">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200 inline-block">
                                [Data Contoh #{{ $i }}]
                            </span>
                            <h3 class="font-bold text-sm text-brand-dark leading-tight group-hover:text-brand-primary transition-colors">[Nama Dosen Pengajar {{ $i }}, M.Kom.]</h3>
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
                <span class="inline-flex px-3 py-1 rounded-full bg-brand-sky-light text-brand-primary text-xs font-bold uppercase tracking-wider shadow-xs">
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
                <a href="{{ route('public.news.index') }}" class="px-4 py-2 rounded-lg text-xs font-bold bg-brand-primary-light text-brand-primary hover:bg-brand-primary hover:text-white hover:scale-105 active:scale-95 transition-all shadow-xs">
                    Semua Berita
                </a>
                <a href="{{ route('public.announcements.index') }}" class="px-4 py-2 rounded-lg text-xs font-bold border border-slate-200 text-brand-dark hover:border-brand-primary hover:text-brand-primary hover:scale-105 active:scale-95 transition-all shadow-xs">
                    Semua Pengumuman
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Article 1 -->
            <article class="card-fade-up group bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between" data-card-delay="0">
                <div>
                    <div class="aspect-16/9 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center p-4 border-b border-slate-100 relative overflow-hidden">
                        <!-- Shimmer Hover Glow -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <img src="{{ asset('assets/undraw_working-together_r43a.svg') }}" alt="Kerjasama Industri dan Studio Game" class="h-28 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 text-[10px] uppercase font-bold tracking-wider text-amber-800 bg-amber-100/95 px-2 py-0.5 rounded border border-amber-300 shadow-xs">
                            [Berita Dummy #1]
                        </span>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-2 text-xs text-brand-muted">
                            <span>{{ date('d M Y') }}</span>
                            <span>&bull;</span>
                            <span class="text-brand-secondary font-medium">Kemitraan DUDI</span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark leading-snug line-clamp-2 group-hover:text-brand-primary transition-colors">
                            <a href="{{ route('public.news.show', 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') }}">
                                [Contoh Berita 1] Sosialisasi Kurikulum dan Laboratorium Multimedia Terapan D-IV TRM
                            </a>
                        </h3>
                        <p class="text-xs text-brand-muted line-clamp-2 leading-relaxed">
                            Uraian ringkas berita mengenai persiapan kegiatan perkuliahan, workshop industri, dan fasilitas multimedia...
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-2">
                    <a href="{{ route('public.news.show', 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') }}" class="text-xs font-bold text-brand-primary hover:text-brand-primary-hover inline-flex items-center gap-1 group/btn">
                        <span>Baca Selengkapnya</span>
                        <svg class="w-3.5 h-3.5 transform group-hover/btn:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </article>

            <!-- Article 2 -->
            <article class="card-fade-up group bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between" data-card-delay="150">
                <div>
                    <div class="aspect-16/9 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center p-4 border-b border-slate-100 relative overflow-hidden">
                        <!-- Shimmer Hover Glow -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <img src="{{ asset('assets/undraw_brainstorming_gny9.svg') }}" alt="Workshop Kurikulum &amp; Desain" class="h-28 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 text-[10px] uppercase font-bold tracking-wider text-amber-800 bg-amber-100/95 px-2 py-0.5 rounded border border-amber-300 shadow-xs">
                            [Berita Dummy #2]
                        </span>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-2 text-xs text-brand-muted">
                            <span>{{ date('d M Y') }}</span>
                            <span>&bull;</span>
                            <span class="text-brand-secondary font-medium">Workshop Vokasi</span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark leading-snug line-clamp-2 group-hover:text-brand-primary transition-colors">
                            <a href="{{ route('public.news.show', 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') }}">
                                [Contoh Berita 2] Lokakarya Perancangan UI/UX &amp; Pemodelan Animasi Berbasis Standar Industri
                            </a>
                        </h3>
                        <p class="text-xs text-brand-muted line-clamp-2 leading-relaxed">
                            Pelatihan teknis intensif bagi mahasiswa dalam merancang antarmuka modern dan aset digital terstandar...
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-2">
                    <a href="{{ route('public.news.show', 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') }}" class="text-xs font-bold text-brand-primary hover:text-brand-primary-hover inline-flex items-center gap-1 group/btn">
                        <span>Baca Selengkapnya</span>
                        <svg class="w-3.5 h-3.5 transform group-hover/btn:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </article>

            <!-- Article 3 -->
            <article class="card-fade-up group bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:border-brand-primary/40 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between" data-card-delay="300">
                <div>
                    <div class="aspect-16/9 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center p-4 border-b border-slate-100 relative overflow-hidden">
                        <!-- Shimmer Hover Glow -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <img src="{{ asset('assets/undraw_team-assignment_lzot.svg') }}" alt="Praktikum &amp; Riset Multimedia" class="h-28 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 text-[10px] uppercase font-bold tracking-wider text-amber-800 bg-amber-100/95 px-2 py-0.5 rounded border border-amber-300 shadow-xs">
                            [Berita Dummy #3]
                        </span>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-2 text-xs text-brand-muted">
                            <span>{{ date('d M Y') }}</span>
                            <span>&bull;</span>
                            <span class="text-brand-secondary font-medium">Praktikum Lab</span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark leading-snug line-clamp-2 group-hover:text-brand-primary transition-colors">
                            <a href="{{ route('public.news.show', 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') }}">
                                [Contoh Berita 3] Uji Coba Perangkat VR Headset dan Simulator Interaktif Mahasiswa TRM
                            </a>
                        </h3>
                        <p class="text-xs text-brand-muted line-clamp-2 leading-relaxed">
                            Eksplorasi teknologi spasial virtual reality dalam mendukung inovasi pembelajaran interaktif di kampus...
                        </p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-2">
                    <a href="{{ route('public.news.show', 'd4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional') }}" class="text-xs font-bold text-brand-primary hover:text-brand-primary-hover inline-flex items-center gap-1 group/btn">
                        <span>Baca Selengkapnya</span>
                        <svg class="w-3.5 h-3.5 transform group-hover/btn:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </article>
        </div>
    </section>

    {{-- 8. Fasilitas --}}
    <section class="bg-brand-surface py-16 border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="space-y-3">
                    <span class="inline-flex px-3 py-1 rounded-full bg-brand-primary-light text-brand-primary text-xs font-bold uppercase tracking-wider shadow-xs">
                        Sarana &amp; Prasarana
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
                        Fasilitas Penunjang Pembelajaran
                    </h2>
                    <p class="text-brand-muted text-sm sm:text-base">
                        Ruang praktikum terintegrasi untuk mendukung proses belajar dan riset multimedia.
                    </p>
                </div>
                <a href="{{ route('public.facilities.index') }}" class="group inline-flex items-center gap-1.5 text-sm font-bold text-brand-primary hover:text-brand-primary-hover transition-colors">
                    <span>Lihat Seluruh Fasilitas</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                <!-- Lab 1 -->
                <div class="card-fade-up group bg-white rounded-2xl border border-slate-200/80 p-6 space-y-4 shadow-xs hover:shadow-xl hover:-translate-y-2 hover:border-brand-primary/40 transition-all duration-300" data-card-delay="0">
                    <div class="aspect-video rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center p-4 border border-slate-200/60 overflow-hidden relative group-hover:border-brand-primary/30 transition-colors">
                        <img src="{{ asset('assets/undraw_work-from-anywhere_tpk5.svg') }}" alt="Lab Komputasi Multimedia &amp; Desain" class="h-32 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200 inline-block">
                                [Data Contoh]
                            </span>
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Lab Aktif
                            </span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark group-hover:text-brand-primary transition-colors">Lab Komputasi Multimedia &amp; Desain</h3>
                        <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                            Dilengkapi PC berspesifikasi tinggi untuk pengolahan grafis 2D/3D, audio-video editing, dan UI prototyping.
                        </p>
                    </div>
                </div>

                <!-- Lab 2 -->
                <div class="card-fade-up group bg-white rounded-2xl border border-slate-200/80 p-6 space-y-4 shadow-xs hover:shadow-xl hover:-translate-y-2 hover:border-brand-primary/40 transition-all duration-300" data-card-delay="150">
                    <div class="aspect-video rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center p-4 border border-slate-200/60 overflow-hidden relative group-hover:border-brand-primary/30 transition-colors">
                        <img src="{{ asset('assets/undraw_3d-modeling_j8a3.svg') }}" alt="Studio Animasi &amp; Green Screen" class="h-32 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200 inline-block">
                                [Data Contoh]
                            </span>
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Studio Aktif
                            </span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark group-hover:text-brand-primary transition-colors">Studio Animasi &amp; Green Screen</h3>
                        <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                            Fasilitas pengambilan gambar, motion capture, rekaman audio voice-over, dan produksi visual effect.
                        </p>
                    </div>
                </div>

                <!-- Lab 3 -->
                <div class="card-fade-up group bg-white rounded-2xl border border-slate-200/80 p-6 space-y-4 shadow-xs hover:shadow-xl hover:-translate-y-2 hover:border-brand-primary/40 transition-all duration-300" data-card-delay="300">
                    <div class="aspect-video rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center p-4 border border-slate-200/60 overflow-hidden relative group-hover:border-brand-primary/30 transition-colors">
                        <img src="{{ asset('assets/undraw_augmented-reality_3ie0.svg') }}" alt="Lab Game Tech &amp; Immersive VR/AR" class="h-32 w-auto object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200 inline-block">
                                [Data Contoh]
                            </span>
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Lab Riset Aktif
                            </span>
                        </div>
                        <h3 class="font-bold text-base text-brand-dark group-hover:text-brand-primary transition-colors">Lab Game Tech &amp; Immersive VR/AR</h3>
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
        <div class="card-fade-up rounded-3xl bg-gradient-to-r from-brand-primary-dark via-brand-primary to-brand-secondary text-white p-8 sm:p-14 shadow-2xl relative overflow-hidden group" data-card-delay="0">
            <!-- Ambient Glowing Color Orbs -->
            <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-brand-sky/20 blur-3xl animate-pulse-slow pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-brand-secondary/30 blur-3xl animate-pulse-slow [animation-delay:2s] pointer-events-none"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#97D7FF_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>

            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <span class="inline-flex px-3.5 py-1.5 rounded-full bg-brand-cream text-brand-dark text-xs font-black uppercase tracking-wider shadow-sm">
                        Penerimaan Mahasiswa Baru
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                        Bergabung Menjadi Generasi Kreatif &amp; Inovator Multimedia
                    </h2>
                    <p class="text-sm sm:text-base text-brand-sky/90 leading-relaxed">
                        Dapatkan informasi pendaftaran mahasiswa baru, jalur seleksi, dan beasiswa melalui portal resmi Politeknik Negeri Tanah Laut.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <!-- Primary CTA with Animated Shimmer Ray -->
                        <a href="{{ route('public.contact') }}" class="relative overflow-hidden px-6 py-3.5 rounded-xl bg-white text-brand-primary font-bold hover:bg-brand-cream-light shadow-lg hover:shadow-2xl hover:scale-105 active:scale-95 transition-all duration-200 flex items-center gap-2 group/btn">
                            <span class="absolute inset-0 w-1/2 h-full bg-gradient-to-r from-transparent via-brand-primary/10 to-transparent skew-x-12 animate-shimmer pointer-events-none"></span>
                            <span class="relative z-10">Hubungi Program Studi</span>
                            <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>

                        <!-- Secondary Portal Link -->
                        <a href="https://politala.ac.id" target="_blank" rel="noopener noreferrer" class="px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/25 text-white font-semibold transition-all hover:scale-105 active:scale-95 flex items-center gap-2 group/portal">
                            <span>Portal POLITALA</span>
                            <svg class="w-4 h-4 transform group-hover/portal:translate-x-0.5 group-hover/portal:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- CTA Illustration -->
                <div class="hidden lg:flex lg:col-span-5 items-center justify-center relative">
                    <img src="{{ asset('assets/undraw_back-to-school-offers_uorw.svg') }}" 
                         alt="Penerimaan Mahasiswa Baru TRM POLITALA" 
                         class="max-h-64 w-auto object-contain drop-shadow-2xl animate-float">
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('styles')
<style>
/* Card Bottom-to-Top Animation (Slide Up & Fade In) */
html.js-cards-ready .card-fade-up {
    opacity: 0;
    transform: translateY(32px);
    transition-property: opacity, transform;
    transition-duration: 700ms;
    transition-timing-function: cubic-bezier(0.16, 1, 0.3, 1);
    will-change: opacity, transform;
}

html.js-cards-ready .card-fade-up.card-visible {
    opacity: 1;
    transform: translateY(0);
}

@media (prefers-reduced-motion: reduce) {
    html.js-cards-ready .card-fade-up {
        opacity: 1 !important;
        transform: none !important;
        transition: none !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
(function() {
    // Flag html as cards-ready so CSS only hides elements if JS is operational
    document.documentElement.classList.add('js-cards-ready');

    function initHomepageCardAnimations() {
        const cards = document.querySelectorAll('.card-fade-up');
        if (!cards.length) return;

        // Respect users preferring reduced motion
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) {
            cards.forEach(card => card.classList.add('card-visible'));
            return;
        }

        const animateCard = (card) => {
            const delay = parseInt(card.getAttribute('data-card-delay') || '0', 10);
            
            card.style.transitionDelay = `${delay}ms`;
            
            requestAnimationFrame(() => {
                card.classList.add('card-visible');
            });

            // After animation ends, remove animation classes and inline transitionDelay
            // so hover effects (e.g. hover:-translate-y-2) work natively without constraint
            const totalDuration = delay + 750;
            setTimeout(() => {
                card.style.transitionDelay = '';
                card.classList.remove('card-fade-up', 'card-visible');
            }, totalDuration);
        };

        // Determine if splash screen is visible on initial page load
        const splashEl = document.getElementById('page-splash-screen');
        const isSplashActive = splashEl && !splashEl.classList.contains('splash-hidden') && splashEl.style.display !== 'none';
        const startDelay = isSplashActive ? 220 : 0;

        setTimeout(() => {
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries, obs) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            obs.unobserve(entry.target);
                            animateCard(entry.target);
                        }
                    });
                }, {
                    root: null,
                    rootMargin: '0px 0px -40px 0px',
                    threshold: 0.08
                });

                cards.forEach(card => observer.observe(card));
            } else {
                cards.forEach(card => animateCard(card));
            }
        }, startDelay);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHomepageCardAnimations);
    } else {
        initHomepageCardAnimations();
    }
})();
</script>
@endpush
