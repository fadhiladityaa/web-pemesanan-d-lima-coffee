<!doctype html>
<html class="scroll-smooth">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="icon" href="{{ asset('img/logo-warkop 1.svg') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/app.css')
    @livewireStyles
    <title>{{ $title }}</title>
</head>

<body>

    @unless (request()->is('login') || request()->is('register'))
        <x-navbar></x-navbar>
    @endunless

    <div>
        @yield('container')
    </div>

    @unless (request()->is('login') ||
            request()->is('register') ||
            request()->is('dashboard') ||
            request()->is('dashboard/menu-management'))
        {{-- <x-footer></x-footer> --}}
    @endunless


    <x-footer></x-footer>
    @livewireScripts
</body>

</html>
