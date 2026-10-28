@php
    $currentSection = request()->route('section') ?? '';
    $isProfile = in_array($currentSection, ['sejarah', 'visi-misi', 'sambutan', 'struktur']);
    $isStaff = in_array($currentSection, ['dosen', 'tendik']);
    $isAcademic = in_array($currentSection, ['kurikulum', 'mata-kuliah', 'kalender', 'cpl', 'profil-lulusan']);
    $isNews = in_array($currentSection, ['berita', 'kategori-berita', 'pengumuman', 'agenda']);
    $isGallery = in_array($currentSection, ['album-galeri', 'foto-galeri']);
    $isConfig = in_array($currentSection, ['identitas', 'homepage', 'kontak-sosmed', 'logo-favicon']);
    $isMedia = in_array($currentSection, ['media-list', 'media-upload']);
    $isRbac = in_array($currentSection, ['users', 'roles', 'permissions']);
@endphp

<aside class="w-72 bg-brand-dark text-white flex-shrink-0 flex flex-col h-screen sticky top-0 border-r border-slate-700/50 shadow-xl overflow-hidden">
    <!-- Brand / Logo -->
    <div class="h-20 px-6 flex items-center gap-3.5 border-b border-slate-700/60 bg-brand-dark/95">
        <div class="w-10 h-10 rounded-xl bg-brand-primary flex items-center justify-center text-white font-extrabold text-lg shadow-sm">
            TRM
        </div>
        <div class="flex flex-col">
            <span class="font-bold text-sm tracking-wide text-white leading-tight">Panel Pengelola</span>
            <span class="text-[11px] text-brand-sky font-medium">D-IV Rekayasa Multimedia</span>
        </div>
    </div>

    <!-- Scrollable Navigation Menus -->
    <div class="flex-1 overflow-y-auto px-4 py-5 space-y-6 text-sm custom-scrollbar" x-data="{
        profileOpen: {{ $isProfile ? 'true' : 'false' }},
        staffOpen: {{ $isStaff ? 'true' : 'false' }},
        academicOpen: {{ $isAcademic ? 'true' : 'false' }},
        newsOpen: {{ $isNews ? 'true' : 'false' }},
        galleryOpen: {{ $isGallery ? 'true' : 'false' }},
        configOpen: {{ $isConfig ? 'true' : 'false' }},
        mediaOpen: {{ $isMedia ? 'true' : 'false' }},
        rbacOpen: {{ $isRbac ? 'true' : 'false' }}
    }">
        <!-- Menu Utama -->
        <div>
            <div class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">
                Menu Utama
            </div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-brand-primary text-white shadow-sm font-bold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Konten Website -->
        <div class="space-y-1">
            <div class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">
                Konten Website
            </div>

            <!-- Profil Prodi Accordion -->
            <div>
                <button type="button" @click="profileOpen = !profileOpen" class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition-colors {{ $isProfile ? 'text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-3 font-medium">
                        <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span>Profil Program Studi</span>
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': profileOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="profileOpen" class="pl-7 pr-2 py-1 space-y-1 text-xs text-slate-300 border-l border-slate-700 ml-4 my-1">
                    <a href="{{ route('admin.crud.sample', ['section' => 'sejarah']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'sejarah' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Sejarah Program Studi</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'visi-misi']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'visi-misi' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Visi dan Misi</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'sambutan']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'sambutan' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Sambutan Ketua Prodi</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'struktur']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'struktur' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Struktur Organisasi</a>
                </div>
            </div>

            <!-- SDM Accordion -->
            <div>
                <button type="button" @click="staffOpen = !staffOpen" class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition-colors {{ $isStaff ? 'text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-3 font-medium">
                        <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Sumber Daya Manusia</span>
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': staffOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="staffOpen" class="pl-7 pr-2 py-1 space-y-1 text-xs text-slate-300 border-l border-slate-700 ml-4 my-1">
                    <a href="{{ route('admin.crud.sample', ['section' => 'dosen']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'dosen' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Data Dosen</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'tendik']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'tendik' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Tenaga Kependidikan</a>
                </div>
            </div>

            <!-- Akademik Accordion -->
            <div>
                <button type="button" @click="academicOpen = !academicOpen" class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition-colors {{ $isAcademic ? 'text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-3 font-medium">
                        <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Akademik</span>
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': academicOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="academicOpen" class="pl-7 pr-2 py-1 space-y-1 text-xs text-slate-300 border-l border-slate-700 ml-4 my-1">
                    <a href="{{ route('admin.crud.sample', ['section' => 'kurikulum']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'kurikulum' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Kurikulum</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'mata-kuliah']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'mata-kuliah' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Mata Kuliah</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'kalender']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'kalender' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Kalender Akademik</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'cpl']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'cpl' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Capaian Pembelajaran (CPL)</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'profil-lulusan']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'profil-lulusan' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Profil Lulusan</a>
                </div>
            </div>

            <!-- Berita & Pengumuman Accordion -->
            <div>
                <button type="button" @click="newsOpen = !newsOpen" class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition-colors {{ $isNews ? 'text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-3 font-medium">
                        <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <span>Berita &amp; Informasi</span>
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': newsOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="newsOpen" class="pl-7 pr-2 py-1 space-y-1 text-xs text-slate-300 border-l border-slate-700 ml-4 my-1">
                    <a href="{{ route('admin.crud.sample', ['section' => 'berita']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'berita' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Semua Berita</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'kategori-berita']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'kategori-berita' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Kategori Berita</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'pengumuman']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'pengumuman' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Pengumuman</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'agenda']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'agenda' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Agenda Kegiatan</a>
                </div>
            </div>

            <!-- Fasilitas Link -->
            <a href="{{ route('admin.crud.sample', ['section' => 'fasilitas']) }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ $currentSection === 'fasilitas' ? 'bg-brand-primary text-white font-bold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                </svg>
                <span>Fasilitas</span>
            </a>

            <!-- Galeri Accordion -->
            <div>
                <button type="button" @click="galleryOpen = !galleryOpen" class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition-colors {{ $isGallery ? 'text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-3 font-medium">
                        <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Galeri Dokumentasi</span>
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': galleryOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="galleryOpen" class="pl-7 pr-2 py-1 space-y-1 text-xs text-slate-300 border-l border-slate-700 ml-4 my-1">
                    <a href="{{ route('admin.crud.sample', ['section' => 'album-galeri']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'album-galeri' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Album Galeri</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'foto-galeri']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'foto-galeri' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Foto &amp; Dokumentasi</a>
                </div>
            </div>
        </div>

        <!-- Konfigurasi Website -->
        <div class="space-y-1">
            <div class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">
                Konfigurasi Website
            </div>

            <div>
                <button type="button" @click="configOpen = !configOpen" class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition-colors {{ $isConfig ? 'text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-3 font-medium">
                        <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Pengaturan Website</span>
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': configOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="configOpen" class="pl-7 pr-2 py-1 space-y-1 text-xs text-slate-300 border-l border-slate-700 ml-4 my-1">
                    <a href="{{ route('admin.crud.sample', ['section' => 'identitas']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'identitas' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Identitas Website</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'homepage']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'homepage' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Pengaturan Homepage</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'kontak-sosmed']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'kontak-sosmed' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Kontak &amp; Media Sosial</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'logo-favicon']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'logo-favicon' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Logo &amp; Favicon</a>
                </div>
            </div>

            <div>
                <button type="button" @click="mediaOpen = !mediaOpen" class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition-colors {{ $isMedia ? 'text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-3 font-medium">
                        <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span>Manajemen Media</span>
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': mediaOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="mediaOpen" class="pl-7 pr-2 py-1 space-y-1 text-xs text-slate-300 border-l border-slate-700 ml-4 my-1">
                    <a href="{{ route('admin.crud.sample', ['section' => 'media-list']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'media-list' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Daftar Media</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'media-upload']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'media-upload' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Unggah Media</a>
                </div>
            </div>
        </div>

        <!-- Administrasi -->
        <div class="space-y-1">
            <div class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">
                Administrasi
            </div>

            <div>
                <button type="button" @click="rbacOpen = !rbacOpen" class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition-colors {{ $isRbac ? 'text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-3 font-medium">
                        <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Pengguna &amp; Peran</span>
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': rbacOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="rbacOpen" class="pl-7 pr-2 py-1 space-y-1 text-xs text-slate-300 border-l border-slate-700 ml-4 my-1">
                    <a href="{{ route('admin.crud.sample', ['section' => 'users']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'users' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Daftar Pengguna</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'roles']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'roles' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Peran (Roles)</a>
                    <a href="{{ route('admin.crud.sample', ['section' => 'permissions']) }}" class="block px-2.5 py-1.5 rounded-lg transition-colors {{ $currentSection === 'permissions' ? 'bg-brand-primary text-white font-bold' : 'hover:text-white hover:bg-slate-800' }}">Hak Akses (Permissions)</a>
                </div>
            </div>

            <a href="{{ route('admin.crud.sample', ['section' => 'my-profile']) }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ $currentSection === 'my-profile' ? 'bg-brand-primary text-white font-bold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Profil Akun Saya</span>
            </a>

            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-4 h-4 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                <span>Lihat Website Publik</span>
            </a>
        </div>
    </div>

    <!-- User Mini Profile Footer -->
    <div class="p-4 border-t border-slate-700/60 bg-slate-900/40 flex items-center justify-between">
        <div class="flex items-center gap-3 overflow-hidden">
            <div class="w-9 h-9 rounded-full bg-brand-primary flex items-center justify-center font-bold text-xs text-white uppercase shrink-0">
                AD
            </div>
            <div class="truncate">
                <div class="text-xs font-semibold text-white truncate">Administrator</div>
                <div class="text-[11px] text-brand-sky truncate">Super Admin</div>
            </div>
        </div>
        <a href="{{ route('login') }}" title="Keluar / Ganti Akun" class="text-slate-400 hover:text-rose-400 p-1.5 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
        </a>
    </div>
</aside>
