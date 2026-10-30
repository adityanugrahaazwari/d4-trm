<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Akses Ditolak | D-IV Teknik Rekayasa Multimedia</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-brand-dark flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-md w-full text-center space-y-6">
        <!-- Shield Warning Icon -->
        <div class="w-20 h-20 rounded-3xl bg-rose-50 border border-rose-100 text-rose-500 mx-auto flex items-center justify-center shadow-xs">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m11-3.5a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <div class="space-y-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-rose-100 text-rose-800 tracking-wider uppercase">
                Kode 403 &bull; Akses Ditolak
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-brand-dark tracking-tight">
                Wewenang Tidak Mencukupi
            </h1>
            <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                {{ $exception->getMessage() ?: 'Modul ini dilindungi oleh sistem keamanan RBAC. Hanya Super Administrator yang memiliki hak istimewa untuk mengelola modul ini.' }}
            </p>
        </div>

        @auth
            <div class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-xs text-left space-y-2 text-xs">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Informasi Akun Anda</div>
                <div class="flex items-center justify-between">
                    <span class="text-brand-muted">Nama Pengguna:</span>
                    <span class="font-bold text-brand-dark">{{ auth()->user()->name }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-brand-muted">Peran / Role:</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-primary-light text-brand-primary">
                        {{ auth()->user()->role_label }}
                    </span>
                </div>
            </div>
        @endauth

        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <a href="{{ route('admin.dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Dashboard</span>
            </a>
            <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-xs transition-colors">
                <span>Halaman Utama Publik</span>
            </a>
        </div>
    </div>
</body>
</html>
