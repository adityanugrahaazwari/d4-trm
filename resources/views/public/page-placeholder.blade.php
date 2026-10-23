@extends('layouts.public')

@section('title', $title ?? 'Halaman')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/5 via-brand-surface to-white border-b border-slate-100 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-4">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">{{ $category ?? 'Halaman' }}</span>
            <span>/</span>
            <span class="text-brand-dark">{{ $title ?? 'Detail' }}</span>
        </nav>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">
            {{ $title ?? 'Halaman' }}
        </h1>
        @if(!empty($description))
            <p class="mt-3 text-base sm:text-lg text-brand-muted max-w-3xl">
                {{ $description }}
            </p>
        @endif
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl border border-slate-200/80 p-8 sm:p-12 shadow-xs">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200 mb-6">
            <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Kerangka Halaman Publik (Data resmi akan dihubungkan pada tahap integrasi backend)
        </div>

        <div class="prose max-w-none text-slate-700 leading-relaxed space-y-4">
            <p>
                Bagian <strong>{{ $title ?? 'ini' }}</strong> memuat informasi resmi terkait Program Studi D-4 Teknik Rekayasa Multimedia, Jurusan Komputer dan Bisnis, Politeknik Negeri Tanah Laut.
            </p>
            <p class="text-brand-muted text-sm italic">
                * Konten dinamis pada modul ini akan dikelola melalui Panel Admin pada tahap implementasi fitur backend.
            </p>
        </div>
    </div>
</div>
@endsection
