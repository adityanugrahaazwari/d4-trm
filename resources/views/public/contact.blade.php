@extends('layouts.public')

@section('title', 'Kontak Kami - D-4 TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Informasi</span>
            <span>/</span>
            <span class="text-brand-dark">Kontak</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Hubungi Kami</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Layanan informasi akademik, kemitraan industri, dan sekretariat program studi</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Kontak Resmi POLITALA]
            </span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <!-- Contact Information Cards -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-xs space-y-6">
                <h2 class="text-xl font-bold text-brand-dark">Sekretariat Program Studi</h2>
                <div class="space-y-5 text-sm">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-brand-dark block">Alamat Kampus:</span>
                            <span class="text-brand-muted text-xs leading-relaxed block mt-0.5">
                                Gedung Teknologi Informasi, Lantai 2, Politeknik Negeri Tanah Laut.<br>
                                Jl. A. Yani KM. 06, Desa Panggung, Kec. Pelaihari, Kab. Tanah Laut, Kalimantan Selatan 70815.
                            </span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-brand-dark block">Surel (Email):</span>
                            <span class="text-brand-muted text-xs block mt-0.5">trm@politala.ac.id</span>
                            <span class="text-brand-muted text-xs block">humas@politala.ac.id</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-brand-dark block">Telepon / Fax:</span>
                            <span class="text-brand-muted text-xs block mt-0.5">(0512) 2021065</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-brand-dark block">Jam Layanan:</span>
                            <span class="text-brand-muted text-xs block mt-0.5">Senin – Jumat: 08:00 – 16:30 WITA</span>
                            <span class="text-rose-500 text-xs block">Sabtu, Minggu &amp; Libur Nasional: Tutup</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interactive Contact Form Mockup -->
        <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-10 shadow-xs space-y-6" x-data="{ sent: false }">
            <div>
                <h2 class="text-xl font-bold text-brand-dark">Kirimkan Pesan atau Pertanyaan</h2>
                <p class="text-xs text-brand-muted mt-1">Isi formulir di bawah ini untuk konsultasi pendaftaran, kerjasama industri, atau informasi program studi.</p>
            </div>

            <div x-show="sent" class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2" style="display: none;">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>[Simulasi Form Berhasil] Pesan Anda telah terkirim ke sekretariat D-4 TRM POLITALA. Terima kasih!</span>
            </div>

            <form @submit.prevent="sent = true" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-brand-dark mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <input type="text" required placeholder="Nama Anda..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-brand-dark mb-1.5">Alamat Email <span class="text-rose-500">*</span></label>
                        <input type="email" required placeholder="email@contoh.com" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-brand-dark mb-1.5">Nomor WhatsApp / Telp</label>
                        <input type="tel" placeholder="08xxxxxxxxxx" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-brand-dark mb-1.5">Kategori Pertanyaan</label>
                        <select class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary">
                            <option value="pmb">Informasi Penerimaan Mahasiswa Baru</option>
                            <option value="kerjasama">Kemitraan Industri / Magang</option>
                            <option value="akademik">Informasi Kurikulum &amp; Perkuliahan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-brand-dark mb-1.5">Pesan / Uraian Pertanyaan <span class="text-rose-500">*</span></label>
                    <textarea rows="4" required placeholder="Tuliskan pesan Anda secara lengkap..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary"></textarea>
                </div>

                <button type="submit" class="px-6 py-3 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-sm transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    <span>Kirim Pesan</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
