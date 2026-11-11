@extends('layouts.public')

@section('title', ($event->title ?? 'Detail Agenda') . ' - Agenda D-IV TRM POLITALA')
@section('meta_description', Str::limit(strip_tags($event->description ?? ''), 155))

@section('content')
<!-- Top Hero Header -->
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-24 sm:pt-28 lg:pt-32 pb-8 sm:pb-10 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb Navigation -->
        <nav class="flex flex-wrap items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-4">
            <a href="{{ route('home') }}" class="hover:text-brand-primary flex items-center gap-1.5 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Beranda</span>
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-brand-muted">Informasi</span>
            <span class="text-slate-300">/</span>
            <a href="{{ route('public.events.index') }}" class="hover:text-brand-primary transition-colors">
                Agenda Kegiatan
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-brand-secondary font-bold truncate max-w-xs sm:max-w-sm">{{ $event->title }}</span>
        </nav>

        <!-- Category & Status Badges -->
        <div class="flex flex-wrap items-center gap-2.5 mb-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-brand-primary text-white shadow-xs">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-sky animate-ping"></span>
                Agenda Kegiatan Resmi
            </span>
            @php
                $statusStr = $event->status ?? 'Pendaftaran Dibuka';
                $statusColor = match($statusStr) {
                    'Pendaftaran Dibuka' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'Segera Dibuka' => 'bg-amber-50 text-amber-700 border-amber-200',
                    'Selesai' => 'bg-slate-100 text-slate-600 border-slate-200',
                    default => 'bg-brand-sky-light text-brand-primary border-brand-sky/40',
                };
            @endphp
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $statusColor }}">
                <span class="w-2 h-2 rounded-full {{ $statusStr === 'Pendaftaran Dibuka' ? 'bg-emerald-500 animate-pulse' : 'bg-slate-400' }}"></span>
                {{ $statusStr }}
            </span>
        </div>

        <!-- Main Title -->
        <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-brand-dark tracking-tight leading-tight sm:leading-snug max-w-5xl">
            {{ $event->title }}
        </h1>

        <!-- Agenda Metadata Ribbon -->
        <div class="mt-6 pt-6 border-t border-slate-200/80 flex flex-wrap items-center justify-between gap-4 text-xs text-brand-muted">
            <div class="flex flex-wrap items-center gap-4 sm:gap-6">
                <!-- Date -->
                <div class="flex items-center gap-2 font-medium text-slate-700">
                    <div class="w-7 h-7 rounded-lg bg-brand-primary-light text-brand-primary flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span>{{ $event->date_formatted }}</span>
                </div>

                <div class="hidden sm:block h-6 w-px bg-slate-200"></div>

                <!-- Time -->
                <div class="flex items-center gap-2 font-medium text-slate-700">
                    <div class="w-7 h-7 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span>{{ $event->time }}</span>
                </div>

                <div class="hidden sm:block h-6 w-px bg-slate-200"></div>

                <!-- Location -->
                <div class="flex items-center gap-2 font-medium text-slate-700">
                    <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="truncate max-w-xs">{{ $event->location }}</span>
                </div>
            </div>

            <!-- Action Tools -->
            <div class="flex items-center gap-2">
                <button type="button" onclick="window.print()" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-brand-dark font-semibold transition-colors flex items-center gap-1.5 shadow-2xs" title="Cetak Brosur Agenda">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak</span>
                </button>
                <a href="{{ route('public.events.index') }}" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-brand-primary font-semibold transition-colors flex items-center gap-1.5 shadow-2xs">
                    <span>← Semua Agenda</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content & Sidebar Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
        
        <!-- Left Main Narrative Column (8 cols) -->
        <main class="lg:col-span-8 space-y-10">

            <!-- Featured Banner Card -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-primary-dark via-brand-primary to-brand-secondary text-white p-7 sm:p-10 shadow-xl">
                <div class="absolute inset-0 bg-[radial-gradient(#3AA3A3_1.2px,transparent_1.2px)] [background-size:24px_24px] opacity-15 pointer-events-none"></div>
                <div class="absolute -right-16 -bottom-16 w-80 h-80 rounded-full bg-brand-sky/20 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div class="flex items-center gap-5">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white flex flex-col items-center justify-center font-black shrink-0 shadow-lg">
                            <span class="text-3xl sm:text-4xl leading-none text-brand-cream">{{ $event->day }}</span>
                            <span class="text-xs uppercase font-extrabold tracking-widest text-brand-sky mt-1">{{ $event->month }}</span>
                            <span class="text-[10px] text-slate-300 font-mono">{{ $event->event_date ? $event->event_date->format('Y') : date('Y') }}</span>
                        </div>
                        <div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-white/15 text-[10px] font-bold uppercase tracking-wider text-brand-cream mb-1 border border-white/20">
                                Program Studi TRM POLITALA
                            </span>
                            <h2 class="text-lg sm:text-xl font-extrabold leading-snug text-white">
                                {{ $event->title }}
                            </h2>
                            <p class="text-xs text-brand-sky/90 mt-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $event->location }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 1. Deskripsi Agenda -->
            <section class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200/80 pb-3">
                    <div class="w-2 h-6 rounded-full bg-brand-primary"></div>
                    <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">Tentang Kegiatan Ini</h2>
                </div>
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed space-y-4 text-sm sm:text-base">
                    @php
                        $descParagraphs = array_filter(explode("\n", (string) $event->description), fn($p) => trim($p) !== '');
                    @endphp

                    @if(count($descParagraphs) > 0)
                        @foreach($descParagraphs as $dp)
                            <p>{{ trim($dp) }}</p>
                        @endforeach
                    @else
                        <p>{{ $event->description ?? 'Deskripsi kegiatan sedang diperbarui oleh panitia penyelenggara.' }}</p>
                    @endif
                    <p>
                        Kegiatan ini dirancang untuk memperkaya kompetensi aplikatif mahasiswa, menjembatani kolaborasi akademik dengan dunia industri kreatif (DUDI), dan mendorong inovasi teknologi multimedia terapan di lingkungan kampus Politeknik Negeri Tanah Laut.
                    </p>
                </div>
            </section>

            <!-- 2. Profil Pemateri / Narasumber -->
            @if(!empty($event->speaker))
                <section class="space-y-4">
                    <div class="flex items-center gap-2 border-b border-slate-200/80 pb-3">
                        <div class="w-2 h-6 rounded-full bg-brand-secondary"></div>
                        <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">Narasumber &amp; Pemateri</h2>
                    </div>
                    
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-xs flex flex-col sm:flex-row items-start gap-5 hover:border-brand-primary/40 transition-all">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-tr from-brand-primary to-brand-secondary text-white font-black text-xl sm:text-2xl flex items-center justify-center shrink-0 shadow-md">
                            <svg class="w-10 h-10 text-brand-cream opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>

                        <div class="space-y-1.5 flex-1">
                            <div>
                                <span class="text-[10px] uppercase font-bold tracking-wider text-brand-secondary">Narasumber Utama</span>
                                <h3 class="text-lg font-bold text-brand-dark leading-snug">{{ $event->speaker }}</h3>
                                <p class="text-xs font-semibold text-brand-primary">Praktisi / Tenaga Ahli Bidang Terapan</p>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed pt-1 border-t border-slate-100">
                                Berpengalaman di bidang teknologi media kreatif, rekayasa game, animasi, dan perancangan multimedia interaktif bersama jaringan industri mitra POLITALA.
                            </p>
                        </div>
                    </div>
                </section>
            @endif

            <!-- 3. Rundown / Susunan Acara -->
            <section class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200/80 pb-3">
                    <div class="w-2 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">Jadwal &amp; Alur Kegiatan</h2>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
                    <div class="p-4 sm:p-5 border-b border-slate-100 bg-slate-50/70 flex items-center justify-between text-xs font-bold text-slate-600 uppercase tracking-wider">
                        <span>Waktu Kegiatan</span>
                        <span>Sesi &amp; Rincian Acara</span>
                    </div>
                    <div class="divide-y divide-slate-100 text-xs sm:text-sm">
                        <div class="p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 hover:bg-slate-50/60 transition-colors">
                            <span class="font-mono font-bold text-brand-primary text-xs shrink-0 sm:w-44 bg-brand-primary-light px-2.5 py-1 rounded-lg">
                                08:30 - 09:00 WITA
                            </span>
                            <span class="font-medium text-slate-800 flex-1">
                                Check-in Peserta &amp; Verifikasi Kehadiran
                            </span>
                        </div>
                        <div class="p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 hover:bg-slate-50/60 transition-colors">
                            <span class="font-mono font-bold text-brand-primary text-xs shrink-0 sm:w-44 bg-brand-primary-light px-2.5 py-1 rounded-lg">
                                {{ $event->start_time ?? '09:00' }} - Selesai
                            </span>
                            <span class="font-medium text-slate-800 flex-1">
                                Pemaparan Materi Inti, Praktik Workshop &amp; Sesi Tanya Jawab
                            </span>
                        </div>
                        <div class="p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 hover:bg-slate-50/60 transition-colors">
                            <span class="font-mono font-bold text-brand-primary text-xs shrink-0 sm:w-44 bg-brand-primary-light px-2.5 py-1 rounded-lg">
                                Penutupan
                            </span>
                            <span class="font-medium text-slate-800 flex-1">
                                Sesi Foto Bersama, Pembagian Sertifikat &amp; Dokumentasi
                            </span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 4. Fasilitas & Manfaat Peserta -->
            <section class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200/80 pb-3">
                    <div class="w-2 h-6 rounded-full bg-emerald-500"></div>
                    <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">Benefit &amp; Fasilitas Peserta</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-white border border-slate-200/80 shadow-xs flex items-start gap-3 hover:border-emerald-500/40 transition-colors">
                        <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-xs sm:text-sm font-medium text-slate-800 leading-snug">E-Sertifikat Resmi Berbobot SKP Kemahasiswaan</span>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-slate-200/80 shadow-xs flex items-start gap-3 hover:border-emerald-500/40 transition-colors">
                        <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-xs sm:text-sm font-medium text-slate-800 leading-snug">Akses Materi Presentasi &amp; Starter File Praktikum</span>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-slate-200/80 shadow-xs flex items-start gap-3 hover:border-emerald-500/40 transition-colors">
                        <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-xs sm:text-sm font-medium text-slate-800 leading-snug">Konsumsi &amp; Coffee Break (Khusus Peserta Luring)</span>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-slate-200/80 shadow-xs flex items-start gap-3 hover:border-emerald-500/40 transition-colors">
                        <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-xs sm:text-sm font-medium text-slate-800 leading-snug">Networking Bersama Dosen, Praktisi, dan Komunitas Kreatif</span>
                    </div>
                </div>
            </section>

            <!-- Share Buttons Bar -->
            <div class="pt-6 border-t border-slate-200/80 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-slate-600">Bagikan Agenda:</span>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($event->title . ' ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="p-2 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-colors" title="Bagikan ke WhatsApp">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.044c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z" />
                        </svg>
                    </a>
                    <button type="button" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan agenda berhasil disalin ke clipboard!');" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span>Salin Link</span>
                    </button>
                </div>

                <a href="{{ route('public.events.index') }}" class="text-xs font-bold text-brand-primary hover:underline">
                    Lihat Semua Jadwal Kegiatan →
                </a>
            </div>

        </main>

        <!-- Right Sticky Sidebar Column (4 cols) -->
        <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">

            <!-- Card 1: Registration Box -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-7 shadow-lg space-y-5 relative overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-brand-primary via-brand-secondary to-brand-sky"></div>

                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-brand-secondary">Status Registrasi</span>
                    <h3 class="text-xl font-black text-brand-dark leading-tight mt-0.5">Pendaftaran Peserta</h3>
                    <p class="text-xs text-slate-500 mt-1">Biaya: <span class="font-bold text-emerald-600">Gratis (Sivitas &amp; Umum)</span></p>
                </div>

                <!-- Registration Primary CTA -->
                <div class="space-y-2.5 pt-1">
                    <a href="{{ $event->registration_url ?? 'https://pmb.politala.ac.id' }}" target="_blank" rel="noopener noreferrer" class="w-full py-3.5 px-4 rounded-xl bg-brand-primary text-white font-bold text-xs hover:bg-brand-primary-hover shadow-md hover:shadow-lg transition-all text-center flex items-center justify-center gap-2 group">
                        <span>Daftar / Registrasi Sekarang</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <!-- Add to Google Calendar Button -->
                    <a href="{{ $event->google_calendar_url }}" target="_blank" rel="noopener noreferrer" class="w-full py-2.5 px-4 rounded-xl border border-slate-200 hover:border-brand-primary/40 bg-slate-50 hover:bg-white text-slate-700 text-xs font-semibold transition-all text-center flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Simpan ke Google Calendar</span>
                    </a>
                </div>

                <!-- Contact Info -->
                <div class="pt-4 border-t border-slate-100 text-xs text-slate-500 space-y-1">
                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Sekretariat Panitia:</span>
                    <p class="font-bold text-brand-dark flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>trm@politala.ac.id</span>
                    </p>
                </div>
            </div>

            <!-- Card 2: Other Upcoming Events -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h4 class="font-extrabold text-sm text-brand-dark flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-brand-primary"></span>
                        <span>Agenda Lainnya</span>
                    </h4>
                    <a href="{{ route('public.events.index') }}" class="text-xs font-bold text-brand-primary hover:underline">Semua</a>
                </div>

                <div class="space-y-3">
                    @forelse($upcomingEvents ?? [] as $otherEv)
                        <a href="{{ route('public.events.show', $otherEv->slug) }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group">
                            <div class="w-11 h-11 rounded-lg bg-brand-primary-light text-brand-primary font-bold flex flex-col items-center justify-center shrink-0 text-center">
                                <span class="text-xs leading-none font-black">{{ $otherEv->day }}</span>
                                <span class="text-[8px] uppercase tracking-wider">{{ $otherEv->month }}</span>
                            </div>
                            <div class="space-y-0.5 min-w-0">
                                <h5 class="text-xs font-bold text-brand-dark group-hover:text-brand-primary transition-colors line-clamp-1">
                                    {{ $otherEv->title }}
                                </h5>
                                <p class="text-[10px] text-brand-muted truncate">{{ $otherEv->location }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-xs text-slate-500">Tidak ada agenda mendatang lainnya.</p>
                    @endforelse
                </div>
            </div>

        </aside>

    </div>
</div>
@endsection
