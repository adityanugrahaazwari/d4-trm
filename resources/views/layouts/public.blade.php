<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Program Studi D-4 Teknik Rekayasa Multimedia') - POLITALA</title>
    <meta name="description" content="@yield('meta_description', 'Website resmi Program Studi D-4 Teknik Rekayasa Multimedia - Politeknik Negeri Tanah Laut.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-white text-brand-dark antialiased font-sans selection:bg-brand-primary selection:text-white">
    <!-- Splash Screen Page Transition -->
    @include('layouts.partials.splash-screen')

    <!-- Navbar -->
    @include('layouts.partials.public-navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.public-footer')

    @stack('scripts')
</body>
</html>
