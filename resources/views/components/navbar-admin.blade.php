<div
    class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-white transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out z-50">
    <div class="flex items-center justify-center h-20 bg-gray-950 gap-2">
        <a class="flex items-center justify-center gap-2" href="{{ route('menu') }}">
            <img src="{{ asset('img/logo-warkop 1.svg') }}" class="w-10 rounded-full" alt="">
            <span class="text-xl font-bold text-primary-400">D'Lima Coffee</span>
        </a>
    </div>
    <nav class="mt-6">
        <div class="px-6 py-3 bg-gray-900 text-primary-400 font-medium">
            <span>Menu Utama</span>
        </div>
        
        {{-- Dashboard --}}
        <a href="{{ route('dashboard.admin') }}" class="flex {{ Request()->is('dashboard/admin') ? 'bg-gray-800' : '' }} items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        {{-- Pesanan Masuk --}}
        <a href="/dashboard/pesanan-masuk"
            class="flex items-center {{ Request()->is('dashboard/pesanan-masuk') ? 'bg-gray-800' : '' }} px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white">
            <img src="{{ asset('img/logo-pesanan-masuk.svg') }}" class="w-[.9rem] h-[.9rem] mr-4" alt="">
            Pesanan Masuk
        </a>

        {{-- Menu Management --}}
        <a href="{{ route('dashboard.menu.management') }}"
            class="flex items-center px-6 py-3 text-gray-300 {{ Request()->is('dashboard/menu-management') ? 'bg-gray-800' : '' }} hover:bg-gray-800 hover:text-white">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            Menu Management
        </a>

        {{-- [BARU] Promo Management --}}
        <a href="{{ route('dashboard.promo.management') }}"
            class="flex items-center px-6 py-3 text-gray-300 {{ Request()->routeIs('dashboard.promo.management') ? 'bg-gray-800 text-white' : '' }} hover:bg-gray-800 hover:text-white">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            Promo Management
        </a>

        {{-- Edukasi Management --}}
        <a href="{{ route('dashboard.edukasi.management') }}"
            class="flex items-center px-6 py-3 text-gray-300 {{ Request()->is('dashboard/edukasi-management') ? 'bg-gray-800' : '' }} hover:bg-gray-800 hover:text-white">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            Edukasi Management
        </a>


        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" href="{{  }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Keluar
            </button>
        </form>
    </nav>
</div>

{{-- Topbar Desktop --}}
<header class="hidden md:flex fixed top-0 left-64 right-0 h-20 bg-gray-950 text-white items-center justify-between px-6 z-40">
    <h1 class="text-lg font-bold">Dashboard Admin</h1>
    <div class="flex items-center gap-4">
        <button class="relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-sm btn-ghost rounded-full">
                <img src="{{ asset('img/user-avatar.png') }}" class="w-8 h-8 rounded-full" alt="User">
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box mt-3 w-40 p-2 text-slate-800 shadow">
                <li><a href="#">Profil</a></li>
                <li><a href="#">Pengaturan</a></li>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

{{-- Mobile Header --}}
<section class="lg:hidden">
    <div class="w-full p-5 bg-[#151C2B] top-0  fixed flex justify-between text-white">
        <a href="{{ route('menu') }}">
            <h1 class="font-bold">DASHBOARD</h1>
        </a>
        <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="lg:hidden sm:hidden">
                    <div class="w-7 rounded-full">
                        <img alt="hamburger icon" src="{{ asset('img/burger-menu.svg') }}" />
                    </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 text-slate-800 shadow">
                <li>
                    <a href="/" class="justify-between">
                        Home
                    </a>
                </li>
                <li>
                    <a href="">Banner Management</a>
                </li>

                <li class="sm:hidden">
                    <a href="/dashboard/menu-management">Menu Management</a>
                </li>

                {{-- [BARU] Promo Management di Mobile --}}
                <li class="sm:hidden">
                    <a href="{{ route('dashboard.promo.management') }}">Promo Management</a>
                </li>

                <li class="sm:hidden">
                    <a href="{{ route('dashboard.edukasi.management') }}">Edukasi Management</a>
                </li>

                <li class="">
                    <a href="/pesanan-masuk">Pesanan masuk</a>
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>

            </ul>
        </div>

    </div>
</section>