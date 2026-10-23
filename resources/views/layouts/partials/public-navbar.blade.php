<nav x-data="{ mobileMenuOpen: false, activeDropdown: null }" class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Logo & Name -->
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                <div class="w-11 h-11 rounded-xl bg-brand-primary flex items-center justify-center text-white font-extrabold text-xl shadow-md shadow-brand-primary/20 group-hover:bg-brand-primary-hover transition-colors">
                    TRM
                </div>
                <div class="flex flex-col">
                    <span class="text-xs uppercase tracking-wider font-semibold text-brand-secondary">Program Studi</span>
                    <span class="font-bold text-base sm:text-lg text-brand-dark leading-tight group-hover:text-brand-primary transition-colors">
                        D-4 Teknik Rekayasa Multimedia
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Items -->
            <div class="hidden lg:flex items-center gap-1 xl:gap-2">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'text-brand-primary bg-brand-primary-light' : 'text-brand-dark hover:text-brand-primary hover:bg-slate-50' }}">
                    Beranda
                </a>

                <!-- Profil Dropdown -->
                <div class="relative" @click.outside="if (activeDropdown === 'profile') activeDropdown = null">
                    <button type="button" @click="activeDropdown = activeDropdown === 'profile' ? null : 'profile'" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-semibold text-brand-dark hover:text-brand-primary hover:bg-slate-50 transition-colors">
                        <span>Profil</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': activeDropdown === 'profile' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="activeDropdown === 'profile'" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-2 w-64 rounded-xl bg-white p-2 shadow-xl border border-slate-100 space-y-1 text-sm font-medium z-50" style="display: none;">
                        <a href="{{ route('public.profile.history') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Sejarah Program Studi</a>
                        <a href="{{ route('public.profile.vision-mission') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Visi &amp; Misi</a>
                        <a href="{{ route('public.profile.welcome') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Sambutan Kaprodi</a>
                        <a href="{{ route('public.profile.structure') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Struktur Organisasi</a>
                        <a href="{{ route('public.profile.lecturers') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Dosen Pengajar</a>
                        <a href="{{ route('public.profile.staff') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Tenaga Kependidikan</a>
                    </div>
                </div>

                <!-- Akademik Dropdown -->
                <div class="relative" @click.outside="if (activeDropdown === 'academic') activeDropdown = null">
                    <button type="button" @click="activeDropdown = activeDropdown === 'academic' ? null : 'academic'" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-semibold text-brand-dark hover:text-brand-primary hover:bg-slate-50 transition-colors">
                        <span>Akademik</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': activeDropdown === 'academic' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="activeDropdown === 'academic'" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-2 w-64 rounded-xl bg-white p-2 shadow-xl border border-slate-100 space-y-1 text-sm font-medium z-50" style="display: none;">
                        <a href="{{ route('public.academic.curriculum') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Kurikulum</a>
                        <a href="{{ route('public.academic.courses') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Mata Kuliah</a>
                        <a href="{{ route('public.academic.calendar') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Kalender Akademik</a>
                        <a href="{{ route('public.academic.cpl') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Capaian Pembelajaran (CPL)</a>
                        <a href="{{ route('public.academic.graduate-profile') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Profil Lulusan</a>
                    </div>
                </div>

                <!-- Berita & Pengumuman Dropdown -->
                <div class="relative" @click.outside="if (activeDropdown === 'news') activeDropdown = null">
                    <button type="button" @click="activeDropdown = activeDropdown === 'news' ? null : 'news'" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-semibold text-brand-dark hover:text-brand-primary hover:bg-slate-50 transition-colors">
                        <span>Berita &amp; Informasi</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': activeDropdown === 'news' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="activeDropdown === 'news'" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-2 w-64 rounded-xl bg-white p-2 shadow-xl border border-slate-100 space-y-1 text-sm font-medium z-50" style="display: none;">
                        <a href="{{ route('public.news.index') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Berita Program Studi</a>
                        <a href="{{ route('public.announcements.index') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Pengumuman Akademik</a>
                        <a href="{{ route('public.events.index') }}" class="block px-3 py-2 rounded-lg hover:bg-brand-primary-light hover:text-brand-primary text-slate-700 transition-colors">Agenda Kegiatan</a>
                    </div>
                </div>

                <a href="{{ route('public.facilities.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold text-brand-dark hover:text-brand-primary hover:bg-slate-50 transition-colors">
                    Fasilitas
                </a>

                <a href="{{ route('public.gallery.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold text-brand-dark hover:text-brand-primary hover:bg-slate-50 transition-colors">
                    Galeri
                </a>

                <a href="{{ route('public.contact') }}" class="px-3 py-2 rounded-lg text-sm font-semibold text-brand-dark hover:text-brand-primary hover:bg-slate-50 transition-colors">
                    Kontak
                </a>
            </div>

            <!-- Action CTA -->
            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider text-brand-primary hover:text-brand-primary-hover bg-brand-primary-light hover:bg-brand-sky/30 transition-all border border-brand-primary/20">
                    Portal Admin
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex lg:hidden">
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-brand-dark hover:text-brand-primary hover:bg-slate-100 transition-colors" aria-label="Buka navigasi">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
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
         class="lg:hidden border-b border-slate-200 bg-white px-4 pt-2 pb-6 space-y-2 shadow-lg" style="display: none;">
        
        <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-brand-dark hover:bg-slate-50">Beranda</a>

        <!-- Mobile Profil Accordion -->
        <div x-data="{ open: false }">
            <button type="button" @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-semibold text-brand-dark hover:bg-slate-50">
                <span>Profil</span>
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" class="pl-4 pr-2 py-1 space-y-1 text-sm border-l-2 border-brand-primary-light ml-3 my-1">
                <a href="{{ route('public.profile.history') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Sejarah Program Studi</a>
                <a href="{{ route('public.profile.vision-mission') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Visi &amp; Misi</a>
                <a href="{{ route('public.profile.welcome') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Sambutan Kaprodi</a>
                <a href="{{ route('public.profile.structure') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Struktur Organisasi</a>
                <a href="{{ route('public.profile.lecturers') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Dosen Pengajar</a>
                <a href="{{ route('public.profile.staff') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Tenaga Kependidikan</a>
            </div>
        </div>

        <!-- Mobile Akademik Accordion -->
        <div x-data="{ open: false }">
            <button type="button" @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-semibold text-brand-dark hover:bg-slate-50">
                <span>Akademik</span>
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" class="pl-4 pr-2 py-1 space-y-1 text-sm border-l-2 border-brand-primary-light ml-3 my-1">
                <a href="{{ route('public.academic.curriculum') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Kurikulum</a>
                <a href="{{ route('public.academic.courses') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Mata Kuliah</a>
                <a href="{{ route('public.academic.calendar') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Kalender Akademik</a>
                <a href="{{ route('public.academic.cpl') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Capaian Pembelajaran (CPL)</a>
                <a href="{{ route('public.academic.graduate-profile') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Profil Lulusan</a>
            </div>
        </div>

        <!-- Mobile Berita Accordion -->
        <div x-data="{ open: false }">
            <button type="button" @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-semibold text-brand-dark hover:bg-slate-50">
                <span>Berita &amp; Informasi</span>
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" class="pl-4 pr-2 py-1 space-y-1 text-sm border-l-2 border-brand-primary-light ml-3 my-1">
                <a href="{{ route('public.news.index') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Berita Program Studi</a>
                <a href="{{ route('public.announcements.index') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Pengumuman Akademik</a>
                <a href="{{ route('public.events.index') }}" class="block px-2 py-1.5 text-brand-muted hover:text-brand-primary">Agenda Kegiatan</a>
            </div>
        </div>

        <a href="{{ route('public.facilities.index') }}" class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-brand-dark hover:bg-slate-50">Fasilitas</a>
        <a href="{{ route('public.gallery.index') }}" class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-brand-dark hover:bg-slate-50">Galeri</a>
        <a href="{{ route('public.contact') }}" class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-brand-dark hover:bg-slate-50">Kontak</a>

        <div class="pt-4 mt-2 border-t border-slate-100">
            <a href="{{ route('login') }}" class="block w-full text-center py-2.5 rounded-lg bg-brand-primary text-white font-semibold text-sm">
                Masuk Portal Admin
            </a>
        </div>
    </div>
</nav>
