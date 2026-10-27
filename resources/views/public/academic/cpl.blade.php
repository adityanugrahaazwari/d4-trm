@extends('layouts.public')

@section('title', 'Capaian Pembelajaran Lulusan (CPL) - D-4 TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Akademik</span>
            <span>/</span>
            <span class="text-brand-dark">CPL</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Capaian Pembelajaran Lulusan (CPL)</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Standar kompetensi dan kualifikasi lulusan D-4 TRM sesuai Kerangka Kualifikasi Nasional Indonesia (KKNI Level 6)</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi CPL]
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    <!-- Sikap (Attitude) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-brand-primary flex items-center justify-center font-bold">
                S
            </div>
            <div>
                <h2 class="text-lg font-bold text-brand-dark">Unsur Sikap &amp; Tata Nilai (CPL 1)</h2>
                <p class="text-xs text-brand-muted">Integritas moral, profesionalisme vokasi, dan etika kerja industri</p>
            </div>
        </div>
        <ul class="space-y-2 text-xs sm:text-sm text-slate-700 list-disc list-inside leading-relaxed">
            <li>Bertaqwa kepada Tuhan Yang Maha Esa dan mampu menunjukkan sikap religius dalam kehidupan profesional.</li>
            <li>Menjunjung tinggi penegakan hukum, hak cipta (HaKI), dan etika profesi di industri kreatif serta teknologi digital.</li>
            <li>Menunjukkan sikap bertanggung jawab atas pekerjaan di bidang keahliannya secara mandiri maupun tim kerja multidisiplin.</li>
        </ul>
    </div>

    <!-- Keterampilan Khusus (Special Skills) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-brand-primary-light text-brand-primary flex items-center justify-center font-bold">
                KK
            </div>
            <div>
                <h2 class="text-lg font-bold text-brand-dark">Keterampilan Khusus (CPL 2)</h2>
                <p class="text-xs text-brand-muted">Keahlian teknis utama bidang rekayasa multimedia dan game development</p>
            </div>
        </div>
        <ul class="space-y-2 text-xs sm:text-sm text-slate-700 list-disc list-inside leading-relaxed">
            <li>Mampu merancang dan mengimplementasikan sistem multimedia interaktif berbasis arsitektur komputasi modern.</li>
            <li>Mampu memproduksi aset 2D/3D, animasi digital, visual effect (VFX), dan audio sound design berstandar industri.</li>
            <li>Mampu mengembangkan logika mekanik permainan (gameplay mechanics) menggunakan game engine standar industri (Unity / Unreal Engine).</li>
            <li>Mampu membangun aplikasi imersif berbasis teknologi Virtual Reality (VR), Augmented Reality (AR), dan Mixed Reality (MR).</li>
            <li>Mampu menerapkan prinsip UI/UX design thinking untuk menghasilkan prototipe interaktif yang berorientasi pada kepuasan pengguna.</li>
        </ul>
    </div>

    <!-- Pengetahuan (Knowledge) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">
                P
            </div>
            <div>
                <h2 class="text-lg font-bold text-brand-dark">Penguasaan Pengetahuan (CPL 3)</h2>
                <p class="text-xs text-brand-muted">Landasan konseptual rekayasa komputasi dan grafika komputer</p>
            </div>
        </div>
        <ul class="space-y-2 text-xs sm:text-sm text-slate-700 list-disc list-inside leading-relaxed">
            <li>Menguasai konsep teoretis grafika komputer, rendering pipa (render pipeline), dan pemrosesan citra digital.</li>
            <li>Menguasai struktur data, algoritma pengoptimalan media, dan arsitektur komputasi awan untuk streaming multimedia.</li>
            <li>Menguasai metodologi pengembangan proyek perangkat lunak interaktif secara tangkas (Agile/Scrum).</li>
        </ul>
    </div>
</div>
@endsection
