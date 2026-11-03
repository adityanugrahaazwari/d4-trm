<footer class="bg-brand-dark text-white border-t border-brand-primary/30 mt-20 relative overflow-hidden">
    {{-- Ambient Top Glow Line --}}
    <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-brand-sky/40 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Kolom 1: Profil Brand -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-white p-1.5 flex items-center justify-center shadow-md ring-2 ring-white/20 shrink-0">
                        <img src="{{ asset('assets/logo.png') }}" alt="Logo D-IV TRM POLITALA" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="block text-xs uppercase tracking-wider text-brand-cream font-bold">Program Studi</span>
                        <h3 class="font-extrabold text-base text-white leading-tight">D-IV Teknik Rekayasa Multimedia</h3>
                    </div>
                </div>
                <p class="text-sm text-slate-300 leading-relaxed">
                    Menghasilkan lulusan sarjana terapan yang kompeten dan adaptif di bidang rekayasa multimedia, animasi 3D, game development, dan teknologi imersif.
                </p>
                <div class="pt-2 text-xs text-slate-400 font-medium">
                    Politeknik Negeri Tanah Laut (POLITALA)
                </div>
            </div>

            <!-- Kolom 2: Tautan Akademik -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold uppercase tracking-wider text-brand-cream border-b border-white/10 pb-2">Akademik</h4>
                <ul class="space-y-2.5 text-sm text-slate-300">
                    <li><a href="{{ route('public.academic.curriculum') }}" class="hover:text-white hover:translate-x-0.5 inline-flex transition-all">Kurikulum &amp; Mata Kuliah</a></li>
                    <li><a href="{{ route('public.academic.calendar') }}" class="hover:text-white hover:translate-x-0.5 inline-flex transition-all">Kalender Akademik</a></li>
                    <li><a href="{{ route('public.academic.cpl') }}" class="hover:text-white hover:translate-x-0.5 inline-flex transition-all">Capaian Pembelajaran (CPL)</a></li>
                    <li><a href="{{ route('public.academic.graduate-profile') }}" class="hover:text-white hover:translate-x-0.5 inline-flex transition-all">Profil Lulusan</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Informasi & Publikasi -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold uppercase tracking-wider text-brand-cream border-b border-white/10 pb-2">Informasi</h4>
                <ul class="space-y-2.5 text-sm text-slate-300">
                    <li><a href="{{ route('public.news.index') }}" class="hover:text-white hover:translate-x-0.5 inline-flex transition-all">Berita Terkini</a></li>
                    <li><a href="{{ route('public.announcements.index') }}" class="hover:text-white hover:translate-x-0.5 inline-flex transition-all">Pengumuman Resmi</a></li>
                    <li><a href="{{ route('public.events.index') }}" class="hover:text-white hover:translate-x-0.5 inline-flex transition-all">Agenda Kegiatan</a></li>
                    <li><a href="{{ route('public.facilities.index') }}" class="hover:text-white hover:translate-x-0.5 inline-flex transition-all">Fasilitas &amp; Lab</a></li>
                    <li><a href="{{ route('public.gallery.index') }}" class="hover:text-white hover:translate-x-0.5 inline-flex transition-all">Galeri Dokumentasi</a></li>
                </ul>
            </div>

            <!-- Kolom 4: Kontak & Alamat -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold uppercase tracking-wider text-brand-cream border-b border-white/10 pb-2">Kontak Kami</h4>
                <div class="space-y-3 text-sm text-slate-300">
                    <p class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 mt-1 shrink-0 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="leading-relaxed">Jl. A. Yani KM. 06, Desa Panggung, Kec. Pelaihari, Kab. Tanah Laut, Kalsel 70815</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 shrink-0 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:trm@politala.ac.id" class="hover:text-white transition-colors">trm@politala.ac.id</a>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 shrink-0 text-brand-sky" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:05122021065" class="hover:text-white transition-colors">(0512) 2021065</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4">
            <p>&copy; {{ date('Y') }} Program Studi D-IV Teknik Rekayasa Multimedia - Politeknik Negeri Tanah Laut. Seluruh hak cipta dilindungi.</p>
            <div class="flex items-center gap-5 font-medium">
                <a href="{{ route('public.contact') }}" class="hover:text-white transition-colors">Bantuan</a>
                <a href="{{ route('login') }}" class="hover:text-white transition-colors">Akses Pengelola</a>
            </div>
        </div>
    </div>
</footer>
