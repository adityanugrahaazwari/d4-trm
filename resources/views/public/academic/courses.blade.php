@extends('layouts.public')

@section('title', 'Daftar Mata Kuliah - D-IV TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Akademik</span>
            <span>/</span>
            <span class="text-brand-dark">Mata Kuliah</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Daftar Mata Kuliah</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Struktur sebaran mata kuliah teori dan praktikum per semester program sarjana terapan</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Mata Kuliah]
            </span>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-10" x-data="{ activeSemester: 1 }">
    <!-- Semester Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 border-b border-slate-200 scrollbar-none">
        @for ($sem = 1; $sem <= 8; $sem++)
            <button type="button" 
                    @click="activeSemester = {{ $sem }}" 
                    :class="activeSemester === {{ $sem }} ? 'bg-brand-primary text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap">
                Semester {{ $sem }}
            </button>
        @endfor
    </div>

    <!-- Course Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-base text-brand-dark">
                Sebaran Mata Kuliah â€” <span x-text="'Semester ' + activeSemester"></span>
            </h3>
            <span class="text-xs text-brand-muted">Total SKS: ~18 SKS</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 uppercase tracking-wider font-semibold">
                    <tr>
                        <th class="py-3 px-6 w-28">Kode MK</th>
                        <th class="py-3 px-4">Nama Mata Kuliah</th>
                        <th class="py-3 px-4 text-center">Teori (SKS)</th>
                        <th class="py-3 px-4 text-center">Praktik (SKS)</th>
                        <th class="py-3 px-4 text-center">Total (SKS)</th>
                        <th class="py-3 px-6 text-center">Sifat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    <!-- Sample Course Rows -->
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-6 font-mono font-bold text-brand-primary">TRM101</td>
                        <td class="py-3.5 px-4 font-bold text-brand-dark">Algoritma &amp; Pemrograman Multimedia</td>
                        <td class="py-3.5 px-4 text-center">1</td>
                        <td class="py-3.5 px-4 text-center">2</td>
                        <td class="py-3.5 px-4 text-center font-bold">3</td>
                        <td class="py-3.5 px-6 text-center">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700">Wajib</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-6 font-mono font-bold text-brand-primary">TRM102</td>
                        <td class="py-3.5 px-4 font-bold text-brand-dark">Dasar Desain Grafis &amp; Tipografi Digital</td>
                        <td class="py-3.5 px-4 text-center">1</td>
                        <td class="py-3.5 px-4 text-center">2</td>
                        <td class="py-3.5 px-4 text-center font-bold">3</td>
                        <td class="py-3.5 px-6 text-center">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700">Wajib</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-6 font-mono font-bold text-brand-primary">TRM103</td>
                        <td class="py-3.5 px-4 font-bold text-brand-dark">Matematika Komputasi &amp; Vektor</td>
                        <td class="py-3.5 px-4 text-center">2</td>
                        <td class="py-3.5 px-4 text-center">0</td>
                        <td class="py-3.5 px-4 text-center font-bold">2</td>
                        <td class="py-3.5 px-6 text-center">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700">Wajib</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-6 font-mono font-bold text-brand-primary">TRM104</td>
                        <td class="py-3.5 px-4 font-bold text-brand-dark">Pengantar Teknologi Media Interaktif &amp; Game</td>
                        <td class="py-3.5 px-4 text-center">2</td>
                        <td class="py-3.5 px-4 text-center">1</td>
                        <td class="py-3.5 px-4 text-center font-bold">3</td>
                        <td class="py-3.5 px-6 text-center">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700">Wajib</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-6 font-mono font-bold text-brand-primary">TRM105</td>
                        <td class="py-3.5 px-4 font-bold text-brand-dark">Fotografi Digital &amp; Sinematografi Dasar</td>
                        <td class="py-3.5 px-4 text-center">1</td>
                        <td class="py-3.5 px-4 text-center">2</td>
                        <td class="py-3.5 px-4 text-center font-bold">3</td>
                        <td class="py-3.5 px-6 text-center">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700">Wajib</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-6 font-mono font-bold text-brand-primary">WKW101</td>
                        <td class="py-3.5 px-4 font-bold text-brand-dark">Pendidikan Karakter &amp; Etika Profesi Vokasi</td>
                        <td class="py-3.5 px-4 text-center">2</td>
                        <td class="py-3.5 px-4 text-center">0</td>
                        <td class="py-3.5 px-4 text-center font-bold">2</td>
                        <td class="py-3.5 px-6 text-center">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">Institusi</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
