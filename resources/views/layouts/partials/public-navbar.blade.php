<nav x-data="{ 
    mobileMenuOpen: false, 
    activeDropdown: null,
    scrolled: false 
}" 
@scroll.window="scrolled = (window.pageYOffset > 15)"
class="sticky top-0 z-50 w-full transition-all duration-300 border-b"
:class="scrolled 
    ? 'bg-white/95 backdrop-blur-xl border-slate-200/90 shadow-md shadow-slate-900/5' 
    : 'bg-white/90 backdrop-blur-lg border-slate-200/70 shadow-xs'">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between transition-all duration-300"
             :class="scrolled ? 'h-16' : 'h-20'">
            
            <!-- Brand Logo & Name -->
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group shrink-0">
                <div class="relative flex items-center justify-center">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-gradient-to-br from-brand-primary via-brand-primary to-brand-secondary text-white font-extrabold text-base sm:text-lg flex items-center justify-center shadow-md shadow-brand-primary/25 group-hover:scale-105 group-hover:shadow-brand-primary/40 transition-all duration-300 ring-2 ring-brand-primary-light">
                        TRM
                    </div>
                    <span class="absolute -bottom-0.5 -right-0.5 flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-sky opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-brand-secondary"></span>
                    </span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-brand-secondary leading-none">
                        Program Studi Terapan
                    </span>
                    <span class="font-extrabold text-sm sm:text-base text-brand-dark leading-tight group-hover:text-brand-primary transition-colors">
                        D-4 Rekayasa Multimedia
                    </span>
                    <span class="text-[10px] sm:text-[11px] font-medium text-slate-400 leading-none hidden sm:block">
                        Politeknik Negeri Tanah Laut
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <div class="hidden lg:flex items-center gap-1 xl:gap-1.5 text-sm font-semibold text-brand-dark">
                
                <!-- Beranda -->
                <a href="{{ route('home') }}" 
                   class="px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('home') ? 'text-brand-primary bg-brand-primary-light font-bold shadow-2xs' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                    Beranda
                </a>

                <!-- Profil Dropdown (Rich Mega Menu) -->
                <div class="relative" @click.outside="if (activeDropdown === 'profile') activeDropdown = null">
                    <button type="button" 
                            @click="activeDropdown = activeDropdown === 'profile' ? null : 'profile'" 
                            class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('public.profile.*') ? 'text-brand-primary bg-brand-primary-light font-bold' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                        <span>Profil</span>
                        <svg class="w-4 h-4 transition-transform duration-200 text-slate-400 group-hover:text-brand-primary" 
                             :class="{ 'rotate-180 text-brand-primary': activeDropdown === 'profile' }" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Panel -->
                    <div x-show="activeDropdown === 'profile'" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                         class="absolute left-0 mt-2.5 w-[500px] rounded-2xl bg-white/95 backdrop-blur-xl p-3 shadow-2xl border border-slate-100 ring-1 ring-black/5 z-50" 
                         style="display: none;">
                        
                        <div class="px-3 py-2 border-b border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-brand-secondary">Tentang Program Studi</span>
                            <span class="text-[11px] font-semibold text-slate-400">D-4 TRM POLITALA</span>
                        </div>

                        <div class="grid grid-cols-2 gap-1.5 pt-2">
                            <a href="{{ route('public.profile.history') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.profile.history') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-brand-primary flex items-center justify-center shrink-0 group-hover:bg-brand-primary group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Sejarah Prodi</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Perjalanan pendirian TRM</div>
                                </div>
                            </a>

                            <a href="{{ route('public.profile.vision-mission') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.profile.vision-mission') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Visi &amp; Misi</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Arah dan tujuan strategis</div>
                                </div>
                            </a>

                            <a href="{{ route('public.profile.welcome') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.profile.welcome') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Sambutan Kaprodi</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Pesan Koordinator Prodi</div>
                                </div>
                            </a>

                            <a href="{{ route('public.profile.structure') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.profile.structure') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Struktur Organisasi</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Bagan tata kelola prodi</div>
                                </div>
                            </a>

                            <a href="{{ route('public.profile.lecturers') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.profile.lecturers') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0 group-hover:bg-sky-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Dosen Pengajar</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Profil dosen ahli multimedia</div>
                                </div>
                            </a>

                            <a href="{{ route('public.profile.staff') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.profile.staff') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center shrink-0 group-hover:bg-slate-700 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Tenaga Kependidikan</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Staf &amp; laboran prodi</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Akademik Dropdown (Rich Mega Menu) -->
                <div class="relative" @click.outside="if (activeDropdown === 'academic') activeDropdown = null">
                    <button type="button" 
                            @click="activeDropdown = activeDropdown === 'academic' ? null : 'academic'" 
                            class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('public.academic.*') ? 'text-brand-primary bg-brand-primary-light font-bold' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                        <span>Akademik</span>
                        <svg class="w-4 h-4 transition-transform duration-200 text-slate-400 group-hover:text-brand-primary" 
                             :class="{ 'rotate-180 text-brand-primary': activeDropdown === 'academic' }" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Panel -->
                    <div x-show="activeDropdown === 'academic'" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                         class="absolute left-0 mt-2.5 w-[500px] rounded-2xl bg-white/95 backdrop-blur-xl p-3 shadow-2xl border border-slate-100 ring-1 ring-black/5 z-50" 
                         style="display: none;">
                        
                        <div class="px-3 py-2 border-b border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-brand-secondary">Kurikulum &amp; Pendidikan</span>
                            <span class="text-[11px] font-semibold text-slate-400">Jenjang Sarjana Terapan</span>
                        </div>

                        <div class="grid grid-cols-2 gap-1.5 pt-2">
                            <a href="{{ route('public.academic.curriculum') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.academic.curriculum') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Kurikulum</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Struktur berbasis industri</div>
                                </div>
                            </a>

                            <a href="{{ route('public.academic.courses') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.academic.courses') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Mata Kuliah</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Daftar SKS semester 1-8</div>
                                </div>
                            </a>

                            <a href="{{ route('public.academic.calendar') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.academic.calendar') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Kalender Akademik</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Jadwal kuliah &amp; ujian</div>
                                </div>
                            </a>

                            <a href="{{ route('public.academic.cpl') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.academic.cpl') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center shrink-0 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Capaian (CPL)</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Kompetensi pembelajaran</div>
                                </div>
                            </a>

                            <a href="{{ route('public.academic.graduate-profile') }}" 
                               class="group flex items-start gap-2.5 p-2.5 rounded-xl hover:bg-brand-primary-light/70 transition-colors col-span-2 {{ request()->routeIs('public.academic.graduate-profile') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Profil Lulusan</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">Prospek karir: 3D Artist, Game Developer, Web &amp; Multimedia Specialist</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Berita & Informasi Dropdown -->
                <div class="relative" @click.outside="if (activeDropdown === 'news') activeDropdown = null">
                    <button type="button" 
                            @click="activeDropdown = activeDropdown === 'news' ? null : 'news'" 
                            class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl transition-all duration-200 {{ (request()->routeIs('public.news.*') || request()->routeIs('public.announcements.*') || request()->routeIs('public.events.*')) ? 'text-brand-primary bg-brand-primary-light font-bold' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                        <span>Informasi</span>
                        <svg class="w-4 h-4 transition-transform duration-200 text-slate-400 group-hover:text-brand-primary" 
                             :class="{ 'rotate-180 text-brand-primary': activeDropdown === 'news' }" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Panel -->
                    <div x-show="activeDropdown === 'news'" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                         class="absolute left-0 mt-2.5 w-[320px] rounded-2xl bg-white/95 backdrop-blur-xl p-3 shadow-2xl border border-slate-100 ring-1 ring-black/5 z-50" 
                         style="display: none;">
                        
                        <div class="space-y-1">
                            <a href="{{ route('public.news.index') }}" 
                               class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.news.*') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-brand-primary flex items-center justify-center shrink-0 group-hover:bg-brand-primary group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Berita Terkini</div>
                                    <div class="text-[11px] text-slate-500">Artikel &amp; prestasi prodi</div>
                                </div>
                            </a>

                            <a href="{{ route('public.announcements.index') }}" 
                               class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.announcements.*') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Pengumuman</div>
                                    <div class="text-[11px] text-slate-500">Edaran akademik &amp; kampus</div>
                                </div>
                            </a>

                            <a href="{{ route('public.events.index') }}" 
                               class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/70 transition-colors {{ request()->routeIs('public.events.*') ? 'bg-brand-primary-light' : '' }}">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Agenda Kegiatan</div>
                                    <div class="text-[11px] text-slate-500">Seminar, pameran, workshop</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas -->
                <a href="{{ route('public.facilities.index') }}" 
                   class="px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('public.facilities.*') ? 'text-brand-primary bg-brand-primary-light font-bold' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                    Fasilitas
                </a>

                <!-- Galeri -->
                <a href="{{ route('public.gallery.index') }}" 
                   class="px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('public.gallery.*') ? 'text-brand-primary bg-brand-primary-light font-bold' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                    Galeri
                </a>

                <!-- Kontak -->
                <a href="{{ route('public.contact') }}" 
                   class="px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('public.contact') ? 'text-brand-primary bg-brand-primary-light font-bold' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                    Kontak
                </a>
            </div>

            <!-- Action CTA Right -->
            <div class="hidden lg:flex items-center gap-2.5">
                <a href="{{ route('login') }}" 
                   class="group relative inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-brand-primary bg-brand-primary-light hover:bg-brand-primary hover:text-white border border-brand-primary/20 shadow-2xs hover:shadow-md hover:shadow-brand-primary/25 transition-all duration-200">
                    <svg class="w-3.5 h-3.5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>Portal Admin</span>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex lg:hidden items-center gap-1.5">
                <a href="{{ route('login') }}" 
                   class="px-3 py-1.5 rounded-lg text-xs font-semibold text-brand-primary bg-brand-primary-light border border-brand-primary/20"
                   aria-label="Portal Admin">
                    Portal
                </a>
                
                <button type="button" 
                        @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="p-2 rounded-xl text-slate-700 hover:text-brand-primary hover:bg-slate-100 focus:outline-hidden transition-colors" 
                        aria-label="Buka navigasi">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden border-t border-slate-100 py-3 space-y-1.5 max-h-[75vh] overflow-y-auto" 
             style="display: none;">
            
            <a href="{{ route('home') }}" 
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('home') ? 'text-brand-primary bg-brand-primary-light' : 'text-slate-800 hover:bg-slate-50' }}">
                <span>🏠</span> Beranda
            </a>

            <!-- Mobile Profil Accordion -->
            <div x-data="{ open: false }" class="rounded-xl overflow-hidden">
                <button type="button" 
                        @click="open = !open" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-800 hover:bg-slate-50 transition-colors">
                    <span class="flex items-center gap-2.5">
                        <span>🏛️</span> Profil
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200 text-slate-400" :class="{ 'rotate-180 text-brand-primary': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" 
                     x-transition 
                     class="pl-8 pr-2 py-1 space-y-1 text-xs border-l-2 border-brand-primary-light ml-4 my-1">
                    <a href="{{ route('public.profile.history') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Sejarah Program Studi</a>
                    <a href="{{ route('public.profile.vision-mission') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Visi &amp; Misi</a>
                    <a href="{{ route('public.profile.welcome') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Sambutan Kaprodi</a>
                    <a href="{{ route('public.profile.structure') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Struktur Organisasi</a>
                    <a href="{{ route('public.profile.lecturers') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Dosen Pengajar</a>
                    <a href="{{ route('public.profile.staff') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Tenaga Kependidikan</a>
                </div>
            </div>

            <!-- Mobile Akademik Accordion -->
            <div x-data="{ open: false }" class="rounded-xl overflow-hidden">
                <button type="button" 
                        @click="open = !open" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-800 hover:bg-slate-50 transition-colors">
                    <span class="flex items-center gap-2.5">
                        <span>🎓</span> Akademik
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200 text-slate-400" :class="{ 'rotate-180 text-brand-primary': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" 
                     x-transition 
                     class="pl-8 pr-2 py-1 space-y-1 text-xs border-l-2 border-brand-primary-light ml-4 my-1">
                    <a href="{{ route('public.academic.curriculum') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Kurikulum</a>
                    <a href="{{ route('public.academic.courses') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Mata Kuliah</a>
                    <a href="{{ route('public.academic.calendar') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Kalender Akademik</a>
                    <a href="{{ route('public.academic.cpl') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Capaian Pembelajaran (CPL)</a>
                    <a href="{{ route('public.academic.graduate-profile') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Profil Lulusan</a>
                </div>
            </div>

            <!-- Mobile Berita Accordion -->
            <div x-data="{ open: false }" class="rounded-xl overflow-hidden">
                <button type="button" 
                        @click="open = !open" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-800 hover:bg-slate-50 transition-colors">
                    <span class="flex items-center gap-2.5">
                        <span>📢</span> Informasi
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200 text-slate-400" :class="{ 'rotate-180 text-brand-primary': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" 
                     x-transition 
                     class="pl-8 pr-2 py-1 space-y-1 text-xs border-l-2 border-brand-primary-light ml-4 my-1">
                    <a href="{{ route('public.news.index') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Berita Program Studi</a>
                    <a href="{{ route('public.announcements.index') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Pengumuman Akademik</a>
                    <a href="{{ route('public.events.index') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Agenda Kegiatan</a>
                </div>
            </div>

            <a href="{{ route('public.facilities.index') }}" 
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-800 hover:bg-slate-50">
                <span>🏢</span> Fasilitas
            </a>
            
            <a href="{{ route('public.gallery.index') }}" 
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-800 hover:bg-slate-50">
                <span>🖼️</span> Galeri
            </a>
            
            <a href="{{ route('public.contact') }}" 
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-800 hover:bg-slate-50">
                <span>✉️</span> Kontak
            </a>

            <div class="pt-3 mt-2 border-t border-slate-100">
                <a href="{{ route('login') }}" 
                   class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-brand-primary text-white font-bold text-xs uppercase tracking-wider shadow-md shadow-brand-primary/20 hover:bg-brand-primary-hover transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>Masuk Portal Admin</span>
                </a>
            </div>
        </div>
    </div>
</nav>
