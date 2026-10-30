@extends('layouts.public')

@section('title', 'Masuk Panel Admin - D-IV TRM')
@section('hide_navbar', true)
@section('hide_footer', true)

@section('content')
<div class="min-h-screen flex-grow flex items-center justify-center p-4 sm:p-6 bg-gradient-to-br from-slate-50 via-brand-surface/40 to-slate-100 relative overflow-hidden">
    <!-- Ambient Background Blobs -->
    <div class="absolute -top-32 -right-32 w-80 h-80 bg-brand-primary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-brand-secondary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-900/5 space-y-6 relative z-10">
        <!-- Logo & Header -->
        <div class="text-center space-y-2">
            <a href="{{ route('home') }}" class="inline-block group" title="Kembali ke Beranda">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-brand-primary via-brand-primary to-brand-secondary text-white font-black text-2xl flex items-center justify-center mx-auto shadow-md shadow-brand-primary/25 group-hover:scale-105 transition-transform duration-300">
                    TRM
                </div>
            </a>
            <h2 class="text-2xl font-bold text-brand-dark">Masuk Panel Pengelola</h2>
            <p class="text-xs text-brand-muted">Gunakan akun administrator D-IV TRM POLITALA</p>
        </div>

        <!-- Form Login Mockup -->
        <form action="{{ route('admin.dashboard') }}" method="GET" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-brand-dark mb-1.5">Alamat Email Pengelola</label>
                <input type="email" value="admin@politala.ac.id" placeholder="admin@politala.ac.id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary transition-all">
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="block text-xs font-bold text-brand-dark">Kata Sandi</label>
                    <span class="text-[11px] text-brand-secondary hover:underline cursor-pointer">Lupa sandi?</span>
                </div>
                <input type="password" value="password" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary transition-all">
            </div>

            <div class="flex items-center justify-between text-xs text-brand-muted">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" checked class="rounded border-slate-300 text-brand-primary focus:ring-brand-primary">
                    <span>Ingat sesi saya</span>
                </label>
            </div>

            <!-- Tombol Masuk langsung ke Dashboard -->
            <button type="submit" class="w-full py-3 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs font-bold shadow-md shadow-brand-primary/20 transition-all flex items-center justify-center gap-2 hover:shadow-lg">
                <span>Masuk ke Dashboard Admin</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center">
            <a href="{{ route('home') }}" class="text-xs text-brand-muted hover:text-brand-primary inline-flex items-center gap-1.5 font-medium transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Website Publik</span>
            </a>
        </div>
    </div>
</div>
@endsection
