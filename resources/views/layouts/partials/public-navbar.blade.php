<header x-data="{ 
    mobileMenuOpen: false, 
    activeDropdown: null,
    scrolled: false,
    searchOpen: false,
    searchQuery: '',
    quickLinks: [
        { title: 'Kurikulum & Silabus', desc: 'Struktur kurikulum berbasis industri', url: '{{ route('public.academic.curriculum') }}', tag: 'Akademik' },
        { title: 'Mata Kuliah TRM', desc: 'Daftar SKS semester 1-8 prodi multimedia', url: '{{ route('public.academic.courses') }}', tag: 'Akademik' },
        { title: 'Dosen & Pengajar', desc: 'Profil dosen ahli animasi, game & web', url: '{{ route('public.profile.lecturers') }}', tag: 'Profil' },
        { title: 'Tenaga Kependidikan', desc: 'Staf administrasi dan laboran prodi', url: '{{ route('public.profile.staff') }}', tag: 'Profil' },
        { title: 'Visi & Misi', desc: 'Arah dan tujuan strategis program studi', url: '{{ route('public.profile.vision-mission') }}', tag: 'Profil' },
        { title: 'Sejarah Program Studi', desc: 'Perjalanan pendirian D-IV TRM POLITALA', url: '{{ route('public.profile.history') }}', tag: 'Profil' },
        { title: 'Fasilitas & Laboratorium', desc: 'Studio multimedia, lab rendering & game', url: '{{ route('public.facilities.index') }}', tag: 'Profil' },
        { title: 'Galeri Dokumentasi', desc: 'Showcase animasi, visual efek & game', url: '{{ route('public.gallery.index') }}', tag: 'Profil' },
        { title: 'Berita Terkini', desc: 'Kabar terbaru, artikel dan prestasi', url: '{{ route('public.news.index') }}', tag: 'Informasi' },
        { title: 'Agenda Kegiatan', desc: 'Seminar, pameran karya, workshop', url: '{{ route('public.events.index') }}', tag: 'Informasi' },
        { title: 'Pengumuman Akademik', desc: 'Edaran resmi kampus dan perkuliahan', url: '{{ route('public.announcements.index') }}', tag: 'Informasi' },
        { title: 'Kontak & Lokasi', desc: 'Narahubung resmi dan alamat kampus', url: '{{ route('public.contact') }}', tag: 'Kontak' }
    ],
    get filteredLinks() {
        if (!this.searchQuery.trim()) return this.quickLinks.slice(0, 6);
        const q = this.searchQuery.toLowerCase();
        return this.quickLinks.filter(item => 
            item.title.toLowerCase().includes(q) || 
            item.desc.toLowerCase().includes(q) || 
            item.tag.toLowerCase().includes(q)
        );
    }
}" 
@scroll.window="scrolled = (window.pageYOffset > 20)"
@keydown.window.prevent.ctrl.k="searchOpen = true"
@keydown.window.prevent.cmd.k="searchOpen = true"
@keydown.escape.window="searchOpen = false; mobileMenuOpen = false; activeDropdown = null"
class="fixed top-0 inset-x-0 z-50 pointer-events-none transition-all duration-300">

    <!-- Floating Pill Container -->
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 transition-all duration-300"
         :class="scrolled ? 'pt-2 sm:pt-2.5' : 'pt-2.5 sm:pt-3'">
        
        <div class="pointer-events-auto transition-all duration-300 rounded-2xl lg:rounded-full border backdrop-blur-xl shadow-lg"
             :class="scrolled 
                 ? 'bg-white/95 border-slate-200/90 shadow-slate-900/10 px-4 sm:px-6 py-2 sm:py-2.5' 
                 : 'bg-white/90 border-slate-200/75 shadow-slate-900/5 px-4 sm:px-6 py-2.5 sm:py-3'">
            
            <div class="flex items-center justify-between gap-3 lg:gap-6">
                
                <!-- Brand Logo & Identity -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3 group shrink-0" title="D-IV Teknik Rekayasa Multimedia POLITALA">
                    <div class="relative flex items-center justify-center">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-tr from-brand-primary via-brand-primary to-brand-secondary text-white font-black text-xs sm:text-sm flex items-center justify-center shadow-md shadow-brand-primary/25 group-hover:scale-105 transition-all duration-300 ring-2 ring-brand-sky/40">
                            TRM
                        </div>
                        <span class="absolute -bottom-0.5 -right-0.5 flex h-2 w-2 sm:h-2.5 sm:w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emeralD-IV00 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-full w-full bg-emerald-500 ring-2 ring-white"></span>
                        </span>
                    </div>

                    <div class="flex flex-col">
                        <div class="flex items-center gap-1.5">
                            <span class="font-extrabold text-xs sm:text-sm text-brand-dark tracking-tight leading-none group-hover:text-brand-primary transition-colors">
                                D-IV Teknik Rekayasa Multimedia
                            </span>
                        </div>
                        <span class="text-[9px] sm:text-[10px] font-medium text-slate-400 leading-none mt-1 hidden sm:block">
                            Politeknik Negeri Tanah Laut
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Menu Links (5 Grouped Items, Pill Style) -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-1.5 text-xs font-semibold text-brand-dark">
                    
                    <!-- 1. Beranda -->
                    <a href="{{ route('home') }}" 
                       class="relative px-3.5 py-1.5 rounded-full transition-all duration-200 {{ request()->routeIs('home') ? 'text-brand-primary bg-brand-primary-light font-bold ring-1 ring-brand-primary/20 shadow-2xs' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                        Beranda
                    </a>

                    <!-- 2. Profil Mega Menu (Dikelompokkan: Profil, Dosen, Fasilitas, Galeri) -->
                    <div class="relative" @click.outside="if (activeDropdown === 'profile') activeDropdown = null">
                        <button type="button" 
                                @click="activeDropdown = activeDropdown === 'profile' ? null : 'profile'" 
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full transition-all duration-200 {{ (request()->routeIs('public.profile.*') || request()->routeIs('public.facilities.*') || request()->routeIs('public.gallery.*')) ? 'text-brand-primary bg-brand-primary-light font-bold ring-1 ring-brand-primary/20 shadow-2xs' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                            <span>Profil</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200 text-slate-400" 
                                 :class="{ 'rotate-180 text-brand-primary': activeDropdown === 'profile' }" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Profil Mega Panel -->
                        <div x-show="activeDropdown === 'profile'" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             class="absolute left-0 mt-3 w-[680px] rounded-3xl bg-white/95 backdrop-blur-2xl p-4 shadow-2xl border border-slate-100 ring-1 ring-black/5 z-50 grid grid-cols-12 gap-4" 
                             style="display: none;">
                            
                            <div class="col-span-8 space-y-2">
                                <div class="px-2 py-1 flex items-center justify-between border-b border-slate-100">
                                    <span class="text-xs font-bold uppercase tracking-wider text-brand-secondary">Tentang &amp; Sarana Prodi</span>
                                    <span class="text-[10px] font-semibold text-slate-400">D-IV TRM POLITALA</span>
                                </div>

                                <div class="grid grid-cols-2 gap-1 pt-1">
                                    <a href="{{ route('public.profile.history') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.profile.history') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-blue-50 text-brand-primary flex items-center justify-center shrink-0 group-hover:bg-brand-primary group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Sejarah Prodi</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Kilas awal pendirian</div>
                                        </div>
                                    </a>

                                    <a href="{{ route('public.profile.vision-mission') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.profile.vision-mission') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Visi &amp; Misi</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Tujuan strategis</div>
                                        </div>
                                    </a>

                                    <a href="{{ route('public.profile.welcome') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.profile.welcome') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Sambutan Kaprodi</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Pesan pimpinan prodi</div>
                                        </div>
                                    </a>

                                    <a href="{{ route('public.profile.structure') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.profile.structure') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Struktur Organisasi</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Bagan tata kelola</div>
                                        </div>
                                    </a>

                                    <a href="{{ route('public.profile.lecturers') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.profile.lecturers') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0 group-hover:bg-sky-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Dosen Pengajar</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Pendidik ahli industri</div>
                                        </div>
                                    </a>

                                    <a href="{{ route('public.profile.staff') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.profile.staff') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center shrink-0 group-hover:bg-slate-700 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Tenaga Kependidikan</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Staf &amp; laboran prodi</div>
                                        </div>
                                    </a>

                                    <!-- Fasilitas (Dikelompokkan ke Profil) -->
                                    <a href="{{ route('public.facilities.index') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.facilities.*') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Fasilitas &amp; Lab</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Studio &amp; lab multimedia</div>
                                        </div>
                                    </a>

                                    <!-- Galeri (Dikelompokkan ke Profil) -->
                                    <a href="{{ route('public.gallery.index') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.gallery.*') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Galeri Dokumentasi</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Foto kegiatan &amp; showcase</div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Right: Featured Highlight Card -->
                            <div class="col-span-4 bg-gradient-to-br from-brand-primary to-brand-primary-dark rounded-2xl p-4 text-white flex flex-col justify-between relative overflow-hidden">
                                <div class="absolute -right-4 -bottom-4 w-28 h-28 rounded-full bg-brand-sky/20 blur-xl pointer-events-none"></div>
                                <div class="relative z-10 space-y-2">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-white/15 text-[9px] font-bold uppercase tracking-wider text-brand-sky border border-white/20">
                                        Keunggulan Prodi
                                    </span>
                                    <h4 class="font-extrabold text-xs sm:text-sm leading-snug">
                                        Pendidikan Vokasi Berbasis Karya Digital
                                    </h4>
                                    <p class="text-[11px] text-slate-200/90 leading-relaxed">
                                        Fokus kompetensi: Pembuatan Game, Animasi 3D, Web Multimedia, dan Interaktif Media.
                                    </p>
                                </div>
                                <div class="relative z-10 pt-3 border-t border-white/10">
                                    <a href="{{ route('public.profile.vision-mission') }}" class="text-xs font-bold text-brand-sky hover:text-white flex items-center gap-1 group/btn">
                                        <span>Pelajari Visi &amp; Misi</span>
                                        <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Akademik Mega Menu -->
                    <div class="relative" @click.outside="if (activeDropdown === 'academic') activeDropdown = null">
                        <button type="button" 
                                @click="activeDropdown = activeDropdown === 'academic' ? null : 'academic'" 
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full transition-all duration-200 {{ request()->routeIs('public.academic.*') ? 'text-brand-primary bg-brand-primary-light font-bold ring-1 ring-brand-primary/20 shadow-2xs' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                            <span>Akademik</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200 text-slate-400" 
                                 :class="{ 'rotate-180 text-brand-primary': activeDropdown === 'academic' }" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Akademik Mega Panel -->
                        <div x-show="activeDropdown === 'academic'" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             class="absolute left-0 mt-3 w-[660px] rounded-3xl bg-white/95 backdrop-blur-2xl p-4 shadow-2xl border border-slate-100 ring-1 ring-black/5 z-50 grid grid-cols-12 gap-4" 
                             style="display: none;">
                            
                            <div class="col-span-8 space-y-2">
                                <div class="px-2 py-1 flex items-center justify-between border-b border-slate-100">
                                    <span class="text-xs font-bold uppercase tracking-wider text-brand-secondary">Kurikulum &amp; Pendidikan</span>
                                    <span class="text-[10px] font-semibold text-slate-400">Jenjang Sarjana Terapan</span>
                                </div>

                                <div class="grid grid-cols-2 gap-1.5 pt-1">
                                    <a href="{{ route('public.academic.curriculum') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.academic.curriculum') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Kurikulum</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Struktur berbasis industri</div>
                                        </div>
                                    </a>

                                    <a href="{{ route('public.academic.courses') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.academic.courses') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Mata Kuliah</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Daftar SKS semester 1-8</div>
                                        </div>
                                    </a>

                                    <a href="{{ route('public.academic.calendar') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.academic.calendar') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Kalender Akademik</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Jadwal kuliah &amp; ujian</div>
                                        </div>
                                    </a>

                                    <a href="{{ route('public.academic.cpl') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.academic.cpl') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center shrink-0 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Capaian (CPL)</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Kompetensi pembelajaran</div>
                                        </div>
                                    </a>

                                    <a href="{{ route('public.academic.graduate-profile') }}" 
                                       class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors col-span-2 {{ request()->routeIs('public.academic.graduate-profile') ? 'bg-brand-primary-light' : '' }}">
                                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Profil Lulusan</div>
                                            <div class="text-[10px] text-slate-500 line-clamp-1">Karir: 3D Artist, Game Developer, Multimedia Specialist</div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Right: Industry & Internship Highlight -->
                            <div class="col-span-4 bg-gradient-to-br from-slate-900 to-brand-dark rounded-2xl p-4 text-white flex flex-col justify-between relative overflow-hidden">
                                <div class="absolute -right-4 -bottom-4 w-28 h-28 rounded-full bg-brand-primary/30 blur-xl pointer-events-none"></div>
                                <div class="relative z-10 space-y-2">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-white/10 text-[9px] font-bold uppercase tracking-wider text-brand-sky border border-white/15">
                                        Praktek Industri
                                    </span>
                                    <h4 class="font-extrabold text-xs sm:text-sm leading-snug">
                                        Magang Industri &amp; Proyek Nyata
                                    </h4>
                                    <p class="text-[11px] text-slate-300 leading-relaxed">
                                        Mahasiswa dibekali portofolio riil bekerja sama dengan studio animasi &amp; agensi digital.
                                    </p>
                                </div>
                                <div class="relative z-10 pt-3 border-t border-white/10">
                                    <a href="{{ route('public.academic.curriculum') }}" class="text-xs font-bold text-brand-sky hover:text-white flex items-center gap-1 group/btn">
                                        <span>Lihat Kurikulum</span>
                                        <svg class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Informasi Dropdown -->
                    <div class="relative" @click.outside="if (activeDropdown === 'news') activeDropdown = null">
                        <button type="button" 
                                @click="activeDropdown = activeDropdown === 'news' ? null : 'news'" 
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full transition-all duration-200 {{ (request()->routeIs('public.news.*') || request()->routeIs('public.announcements.*') || request()->routeIs('public.events.*')) ? 'text-brand-primary bg-brand-primary-light font-bold ring-1 ring-brand-primary/20 shadow-2xs' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                            <span>Informasi</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200 text-slate-400" 
                                 :class="{ 'rotate-180 text-brand-primary': activeDropdown === 'news' }" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="activeDropdown === 'news'" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             class="absolute left-0 mt-3 w-80 rounded-3xl bg-white/95 backdrop-blur-2xl p-3 shadow-2xl border border-slate-100 ring-1 ring-black/5 z-50" 
                             style="display: none;">
                            
                            <div class="space-y-1">
                                <a href="{{ route('public.news.index') }}" 
                                   class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.news.*') ? 'bg-brand-primary-light' : '' }}">
                                    <div class="w-7 h-7 rounded-lg bg-blue-50 text-brand-primary flex items-center justify-center shrink-0 group-hover:bg-brand-primary group-hover:text-white transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Berita Terkini</div>
                                        <div class="text-[10px] text-slate-500">Artikel &amp; prestasi prodi</div>
                                    </div>
                                </a>

                                <a href="{{ route('public.announcements.index') }}" 
                                   class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.announcements.*') ? 'bg-brand-primary-light' : '' }}">
                                    <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Pengumuman</div>
                                        <div class="text-[10px] text-slate-500">Edaran akademik kampus</div>
                                    </div>
                                </a>

                                <a href="{{ route('public.events.index') }}" 
                                   class="group flex items-start gap-2.5 p-2 rounded-xl hover:bg-brand-primary-light/80 transition-colors {{ request()->routeIs('public.events.*') ? 'bg-brand-primary-light' : '' }}">
                                    <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 group-hover:text-brand-primary transition-colors">Agenda Kegiatan</div>
                                        <div class="text-[10px] text-slate-500">Seminar, workshop &amp; expo</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Kontak -->
                    <a href="{{ route('public.contact') }}" 
                       class="px-3.5 py-1.5 rounded-full transition-all duration-200 {{ request()->routeIs('public.contact') ? 'text-brand-primary bg-brand-primary-light font-bold ring-1 ring-brand-primary/20 shadow-2xs' : 'text-slate-700 hover:text-brand-primary hover:bg-slate-100/70' }}">
                        Kontak
                    </a>
                </nav>

                <!-- Desktop Action Right: Search Icon + Portal Admin (Clean & Compact) -->
                <div class="hidden lg:flex items-center gap-2">
                    
                    <!-- Quick Search Trigger -->
                    <button type="button" 
                            @click="searchOpen = true"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200/80 hover:text-brand-primary transition-all duration-200 border border-slate-200/60"
                            title="Buka Pencarian (Ctrl + K)">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="text-[11px] text-slate-500">Cari</span>
                        <kbd class="hidden xl:inline-block px-1.5 py-0.2 text-[9px] font-mono font-medium text-slate-500 bg-white rounded border border-slate-300 shadow-2xs">âŒ˜K</kbd>
                    </button>

                    <!-- Portal Admin Button -->
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-semibold text-slate-700 hover:text-brand-primary bg-slate-100 hover:bg-slate-200 transition-colors border border-slate-200/60"
                       title="Masuk ke Portal Admin">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Portal</span>
                    </a>
                </div>

                <!-- Mobile Action & Hamburger Controls -->
                <div class="flex lg:hidden items-center gap-1.5">
                    <button type="button" 
                            @click="searchOpen = true" 
                            class="p-2 rounded-full text-slate-600 hover:text-brand-primary hover:bg-slate-100 transition-colors"
                            aria-label="Cari">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <a href="{{ route('login') }}" 
                       class="px-2.5 py-1 rounded-full text-xs font-semibold text-slate-700 bg-slate-100 border border-slate-200"
                       title="Portal">
                        Portal
                    </a>
                    
                    <button type="button" 
                            @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="p-2 rounded-full text-slate-700 hover:text-brand-primary hover:bg-slate-100 focus:outline-hidden transition-colors" 
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

            <!-- Mobile Drawer Menu (Grouped cleanly, no PMB button) -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-3"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-3"
                 class="lg:hidden border-t border-slate-100 mt-3 pt-3 space-y-1.5 max-h-[75vh] overflow-y-auto" 
                 style="display: none;">
                
                <!-- Beranda -->
                <a href="{{ route('home') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('home') ? 'text-brand-primary bg-brand-primary-light font-bold' : 'text-slate-800 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Beranda</span>
                </a>

                <!-- Mobile Profil Accordion (Termasuk Fasilitas & Galeri) -->
                <div x-data="{ open: false }" class="rounded-xl overflow-hidden">
                    <button type="button" 
                            @click="open = !open" 
                            class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold text-slate-800 hover:bg-slate-50 transition-colors">
                        <span class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>Profil Program Studi</span>
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-200 text-slate-400" :class="{ 'rotate-180 text-brand-primary': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="pl-9 pr-3 py-1 space-y-1 text-xs border-l-2 border-brand-primary-light ml-4 my-1">
                        <a href="{{ route('public.profile.history') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Sejarah Program Studi</a>
                        <a href="{{ route('public.profile.vision-mission') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Visi &amp; Misi</a>
                        <a href="{{ route('public.profile.welcome') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Sambutan Kaprodi</a>
                        <a href="{{ route('public.profile.structure') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Struktur Organisasi</a>
                        <a href="{{ route('public.profile.lecturers') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Dosen Pengajar</a>
                        <a href="{{ route('public.profile.staff') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Tenaga Kependidikan</a>
                        <a href="{{ route('public.facilities.index') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Fasilitas &amp; Lab</a>
                        <a href="{{ route('public.gallery.index') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Galeri Dokumentasi</a>
                    </div>
                </div>

                <!-- Mobile Akademik Accordion -->
                <div x-data="{ open: false }" class="rounded-xl overflow-hidden">
                    <button type="button" 
                            @click="open = !open" 
                            class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold text-slate-800 hover:bg-slate-50 transition-colors">
                        <span class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                            <span>Akademik</span>
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-200 text-slate-400" :class="{ 'rotate-180 text-brand-primary': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="pl-9 pr-3 py-1 space-y-1 text-xs border-l-2 border-brand-primary-light ml-4 my-1">
                        <a href="{{ route('public.academic.curriculum') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Kurikulum</a>
                        <a href="{{ route('public.academic.courses') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Mata Kuliah</a>
                        <a href="{{ route('public.academic.calendar') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Kalender Akademik</a>
                        <a href="{{ route('public.academic.cpl') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Capaian Pembelajaran (CPL)</a>
                        <a href="{{ route('public.academic.graduate-profile') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Profil Lulusan</a>
                    </div>
                </div>

                <!-- Mobile Informasi Accordion -->
                <div x-data="{ open: false }" class="rounded-xl overflow-hidden">
                    <button type="button" 
                            @click="open = !open" 
                            class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold text-slate-800 hover:bg-slate-50 transition-colors">
                        <span class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span>Informasi &amp; Berita</span>
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-200 text-slate-400" :class="{ 'rotate-180 text-brand-primary': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="pl-9 pr-3 py-1 space-y-1 text-xs border-l-2 border-brand-primary-light ml-4 my-1">
                        <a href="{{ route('public.news.index') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Berita Terkini</a>
                        <a href="{{ route('public.announcements.index') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Pengumuman Akademik</a>
                        <a href="{{ route('public.events.index') }}" class="block py-1.5 text-slate-600 hover:text-brand-primary font-medium">Agenda Kegiatan</a>
                    </div>
                </div>

                <!-- Kontak -->
                <a href="{{ route('public.contact') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('public.contact') ? 'text-brand-primary bg-brand-primary-light font-bold' : 'text-slate-800 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Kontak &amp; Lokasi</span>
                </a>

                <!-- Mobile Action: Portal Link Only -->
                <div class="pt-3 mt-2 border-t border-slate-100">
                    <a href="{{ route('login') }}" 
                       class="flex items-center justify-center gap-2 w-full py-2.5 rounded-full text-slate-700 bg-slate-100 hover:bg-slate-200 font-semibold text-xs transition-colors">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Portal Masuk Staf / Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Search Command Modal (Ctrl + K) -->
    <div x-show="searchOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto p-4 sm:p-6 md:p-20 bg-slate-900/60 backdrop-blur-md flex items-start justify-center pointer-events-auto"
         style="display: none;">
        
        <div @click.outside="searchOpen = false" 
             class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden mt-10">
            
            <!-- Search Bar Input Header -->
            <div class="relative flex items-center px-4 sm:px-6 py-4 border-b border-slate-100">
                <svg class="w-5 h-5 text-brand-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" 
                       x-model="searchQuery" 
                       x-ref="searchInput"
                       x-init="$watch('searchOpen', value => { if (value) setTimeout(() => $refs.searchInput.focus(), 100); })"
                       placeholder="Ketik untuk mencari mata kuliah, profil dosen, fasilitas, galeri..." 
                       class="w-full pl-3 pr-8 py-1 text-sm sm:text-base font-medium text-slate-800 placeholder-slate-400 focus:outline-hidden bg-transparent">
                
                <button type="button" 
                        @click="searchOpen = false" 
                        class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors text-xs font-bold">
                    ESC
                </button>
            </div>

            <!-- Quick Filter Results -->
            <div class="p-3 sm:p-4 max-h-96 overflow-y-auto space-y-1">
                <div class="px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 flex justify-between items-center">
                    <span>Navigasi Cepat</span>
                    <span x-text="filteredLinks.length + ' item ditemukan'"></span>
                </div>

                <template x-for="item in filteredLinks" :key="item.title">
                    <a :href="item.url" 
                       class="group flex items-center justify-between p-3 rounded-2xl hover:bg-brand-primary-light/80 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0 group-hover:bg-brand-primary group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-slate-800 group-hover:text-brand-primary transition-colors" x-text="item.title"></div>
                                <div class="text-xs text-slate-500" x-text="item.desc"></div>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 group-hover:bg-white group-hover:text-brand-primary transition-colors" x-text="item.tag"></span>
                    </a>
                </template>

                <div x-show="filteredLinks.length === 0" class="p-8 text-center text-slate-400">
                    <p class="text-sm">Tidak ada menu atau halaman yang cocok dengan kata kunci.</p>
                </div>
            </div>

            <!-- Modal Footer Hints -->
            <div class="px-6 py-2.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                <span>Tips: Gunakan kata kunci seperti <b>kurikulum</b>, <b>fasilitas</b>, atau <b>dosen</b></span>
                <span class="hidden sm:inline">Tekan <b>ESC</b> untuk menutup</span>
            </div>
        </div>
    </div>
</header>