@extends('layouts.public')

@section('title', 'Profil Lulusan - D-4 TRM POLITALA')

@section('content')
<div class="bg-gradient-to-b from-brand-primary/10 via-brand-surface to-white border-b border-slate-100 pt-28 sm:pt-32 lg:pt-36 pb-12 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold text-brand-muted uppercase tracking-wider mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Beranda</a>
            <span>/</span>
            <span class="text-brand-secondary">Akademik</span>
            <span>/</span>
            <span class="text-brand-dark">Profil Lulusan</span>
        </nav>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-dark tracking-tight">Profil Lulusan &amp; Prospek Karier</h1>
                <p class="mt-2 text-sm sm:text-base text-brand-muted">Peluang profesi sarjana terapan (S.Tr.Kom.) di industri kreatif digital dan teknologi informasi</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                [Data Simulasi Profil Lulusan]
            </span>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    <!-- Grid Profil Profesi -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Profesi 1 -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-brand-primary text-white flex items-center justify-center font-bold text-xl shadow-sm">
                01
            </div>
            <h3 class="text-xl font-bold text-brand-dark">Game Developer &amp; Gameplay Engineer</h3>
            <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                Bertanggung jawab dalam merancang arsitektur permainan, kecerdasan buatan (Game AI), fisika objek, dan gameplay logic menggunakan Unity atau Unreal Engine.
            </p>
            <div class="pt-2 border-t border-slate-100 text-xs">
                <strong class="text-brand-dark block mb-1">Peluang Instansi / Perusahaan:</strong>
                <span class="text-slate-600">Studio Game Nasional &amp; Internasional, Perusahaan Simulasi Militer/Aviasi, Edutech Games.</span>
            </div>
        </div>

        <!-- Profesi 2 -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-brand-secondary text-white flex items-center justify-center font-bold text-xl shadow-sm">
                02
            </div>
            <h3 class="text-xl font-bold text-brand-dark">3D Technical Artist &amp; Animator</h3>
            <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                Menghubungkan aspek seni dan pemrograman melalui pemodelan 3D, shader visual, rigging karakter, dan optimalisasi aset real-time render.
            </p>
            <div class="pt-2 border-t border-slate-100 text-xs">
                <strong class="text-brand-dark block mb-1">Peluang Instansi / Perusahaan:</strong>
                <span class="text-slate-600">Studio Animasi Film, Perusahaan Periklanan/CGI, Agensi Visual Efek, Industri Arsitektur 3D.</span>
            </div>
        </div>

        <!-- Profesi 3 -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-brand-sky text-brand-dark flex items-center justify-center font-bold text-xl shadow-sm">
                03
            </div>
            <h3 class="text-xl font-bold text-brand-dark">Interactive Media &amp; Immersive Tech Specialist (XR)</h3>
            <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                Membangun aplikasi virtual reality, augmented reality, dan interactive museum/exhibition untuk pelatihan industri, pariwisata, dan edukasi interaktif.
            </p>
            <div class="pt-2 border-t border-slate-100 text-xs">
                <strong class="text-brand-dark block mb-1">Peluang Instansi / Perusahaan:</strong>
                <span class="text-slate-600">Perusahaan Teknologi Imersif, BUMN, Sektor Pertambangan &amp; Energi (VR Safety Training).</span>
            </div>
        </div>

        <!-- Profesi 4 -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-xs hover:border-brand-primary/40 hover:shadow-md transition-all space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-brand-cream text-brand-dark flex items-center justify-center font-bold text-xl shadow-sm">
                04
            </div>
            <h3 class="text-xl font-bold text-brand-dark">UI/UX Designer &amp; Creative Technologist</h3>
            <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                Mendesain pengalaman interaksi pengguna yang intuitif, visual storytelling digital, serta prototipe interaktif untuk web, mobile, dan sistem pintar.
            </p>
            <div class="pt-2 border-t border-slate-100 text-xs">
                <strong class="text-brand-dark block mb-1">Peluang Instansi / Perusahaan:</strong>
                <span class="text-slate-600">Startup Digital, Perbankan/Fintech, Software House, Digital Creative Agency.</span>
            </div>
        </div>
    </div>
</div>
@endsection
