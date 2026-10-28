<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design System - D-4 TRM</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-brand-dark min-h-screen p-8">
    <!-- Splash Screen Page Transition -->
    @include('layouts.partials.splash-screen')

    <div class="max-w-5xl mx-auto space-y-10">
        <!-- Header -->
        <div class="border-b border-brand-border pb-6">
            <h1 class="text-3xl font-bold text-brand-primary">Design System & Token D-4 TRM</h1>
            <p class="text-brand-muted mt-2">Fondasi palet warna, tipografi, dan komponen dasar website D-4 Teknik Rekayasa Multimedia.</p>
        </div>

        <!-- Palette Showcase -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold text-brand-dark">Palet Warna Resmi</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="bg-brand-primary text-white p-4 rounded-xl shadow-sm">
                    <span class="block font-semibold">Primary</span>
                    <span class="text-xs opacity-90">#086288</span>
                </div>
                <div class="bg-brand-secondary text-white p-4 rounded-xl shadow-sm">
                    <span class="block font-semibold">Secondary</span>
                    <span class="text-xs opacity-90">#4D8DBA</span>
                </div>
                <div class="bg-brand-sky text-brand-dark p-4 rounded-xl shadow-sm">
                    <span class="block font-semibold">Light Blue (Sky)</span>
                    <span class="text-xs opacity-90">#97D7FF</span>
                </div>
                <div class="bg-brand-cream text-brand-dark p-4 rounded-xl shadow-sm">
                    <span class="block font-semibold">Cream</span>
                    <span class="text-xs opacity-90">#FFEFC4</span>
                </div>
                <div class="bg-white border border-brand-border text-brand-dark p-4 rounded-xl shadow-sm">
                    <span class="block font-semibold">White / Surface</span>
                    <span class="text-xs text-brand-muted">#FFFFFF</span>
                </div>
            </div>
        </section>

        <!-- Buttons Showcase -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold text-brand-dark">Gaya Tombol</h2>
            <div class="flex flex-wrap gap-4 items-center">
                <button type="button" class="px-5 py-2.5 rounded-lg bg-brand-primary hover:bg-brand-primary-hover text-white font-semibold shadow-sm transition-colors">
                    Tombol Utama (Primary)
                </button>
                <button type="button" class="px-5 py-2.5 rounded-lg bg-brand-secondary hover:bg-brand-secondary-hover text-white font-semibold shadow-sm transition-colors">
                    Tombol Sekunder
                </button>
                <button type="button" class="px-5 py-2.5 rounded-lg border border-brand-primary text-brand-primary hover:bg-brand-primary-light font-semibold transition-colors">
                    Tombol Outline
                </button>
                <button type="button" class="px-5 py-2.5 rounded-lg bg-brand-cream text-brand-dark font-semibold hover:brightness-95 transition-all">
                    Tombol Aksen (Krem)
                </button>
            </div>
        </section>

        <!-- Form Elements -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold text-brand-dark">Komponen Formulir</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-2xl border border-brand-border">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-brand-dark">Label Form Normal</label>
                    <input type="text" placeholder="Masukkan teks..." class="w-full px-4 py-2.5 rounded-lg border border-brand-border focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary text-sm text-brand-dark">
                    <span class="text-xs text-brand-muted">Bantuan atau catatan kecil.</span>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-brand-dark">Label Form Error</label>
                    <input type="text" value="Input yang keliru" class="w-full px-4 py-2.5 rounded-lg border border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 text-sm text-brand-dark">
                    <span class="text-xs text-red-600 font-medium">Format input yang Anda masukkan tidak valid.</span>
                </div>
            </div>
        </section>

        <!-- Badges & Alerts -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold text-brand-dark">Badge Status & Kartu</h2>
            <div class="flex flex-wrap gap-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                    Dipublikasikan
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-brand-sky-light text-brand-primary">
                    Draf
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                    Menunggu Verifikasi
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-800">
                    Ditolak / Arsip
                </span>
            </div>

            <div class="p-4 rounded-xl bg-brand-sky-light border border-brand-sky/40 text-brand-dark text-sm">
                <strong>Informasi:</strong> Ini adalah contoh kotak alert/pengumuman menggunakan latar biru muda aksen TRM.
            </div>
        </section>
    </div>
</body>
</html>
