<!doctype html>
<html class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Font logo --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">
    {{-- icons --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    {{-- PERBAIKAN 1: Judul Default --}}
    {{-- Jika $title tidak dikirim dari controller, pakai "D'Lima Coffee" --}}
    <title>{{ $title ?? "D'Lima Coffee" }}</title>

</head>


<body>

    @unless (request()->is('login') || request()->is('register'))
        <x-navbar></x-navbar>
    @endunless

    {{-- PERBAIKAN 2: Hybrid Content --}}
    <div class="min-h-screen">
        {{-- Jika ada $slot (gaya komponen), tampilkan. Jika tidak, abaikan. --}}
        {{ $slot ?? '' }}

        {{-- Jika ada @section('content') (gaya extends), tampilkan di sini. --}}
        @yield('content')
    </div>

    @unless (request()->is('login') ||
            request()->is('register') ||
            request()->is('dashboard') ||
            request()->is('dashboard/menu-management'))
        {{-- <x-footer></x-footer> --}}
    @endunless

    @livewireScripts

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    @stack('scripts')
</body>

</html>