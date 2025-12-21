<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Menu - D'Lima Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">

    <!-- Navbar -->
    @auth
        <x-navbar></x-navbar>
    @endauth

    @guest
    <nav class="fixed w-full z-50 transition-all duration-300 bg-[#947257] shadow-xl border-b border-[#947257]" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Branding -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <img class="h-10 w-auto" src="{{ asset('img/Logo-DLima-Coffe.png') }}" alt="Logo">
                        <span class="font-bold text-2xl text-black tracking-wide">D'Lima Coffee</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    @guest
                        <a href="{{ url('/') }}#home" class="relative py-1 transition-all duration-300 sm:text-[16px] lg:text-[18px] font-poppins font-medium text-white/70 hover:text-white hover:border-b-2 hover:border-white/30">Beranda</a>
                    @endguest
                    <a href="{{ url('/') }}#about" class="relative py-1 transition-all duration-300 sm:text-[16px] lg:text-[18px] font-poppins font-medium text-white/70 hover:text-white hover:border-b-2 hover:border-white/30">Tentang</a>
                    <a href="{{ route('landing.menu') }}" class="relative py-1 transition-all duration-300 sm:text-[16px] lg:text-[18px] font-poppins font-medium text-white font-bold border-b-2 border-white">Menu</a>
                    <a href="{{ url('/') }}#contact" class="relative py-1 transition-all duration-300 sm:text-[16px] lg:text-[18px] font-poppins font-medium text-white/70 hover:text-white hover:border-b-2 hover:border-white/30">Kontak</a>
                    
                    <div class="h-6 w-px bg-gray-300 mx-4"></div>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-full bg-primary text-white text-sm font-semibold shadow hover:bg-opacity-90 transition-all">Dashboard</a>
                        @else
                            <div class="flex items-center gap-4">
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-white hover:text-primary transition-colors">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full bg-primary text-white text-sm font-semibold shadow hover:bg-opacity-90 transition-all transform hover:scale-105">Register</a>
                                @endif
                            </div>
                        @endauth
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button class="mobile-menu-button p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu Dropdown -->
        <div class="hidden mobile-menu md:hidden bg-white border-t">
            <div class="px-4 pt-2 pb-4 space-y-1">
                @guest
                    <a href="{{ url('/') }}#home" class="block py-3 px-3 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Beranda</a>
                @endguest
                <a href="{{ url('/') }}#about" class="block py-3 px-3 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Tentang</a>
                <a href="{{ route('landing.menu') }}" class="block py-3 px-3 text-base font-bold text-primary bg-primary/5 rounded-lg">Menu</a>
                 @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block w-full text-center mt-4 px-5 py-3 rounded-lg bg-primary text-white font-bold shadow">Dashboard</a>
                    @else
                        <div class="grid grid-cols-2 gap-3 mt-4">
                            <a href="{{ route('login') }}" class="block px-5 py-3 text-center rounded-lg border border-primary text-primary font-bold hover:bg-primary-50">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block px-5 py-3 text-center rounded-lg bg-primary text-white font-bold shadow">Register</a>
                            @endif
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </nav>
    @endguest

    <!-- Page Header -->
    <div class="pt-48 pb-10 bg-gray-50 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Daftar Menu Kami</h1>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto px-4">
            Temukan berbagai pilihan kopi dan makanan lezat yang kami sajikan khusus untuk Anda.
        </p>
    </div>

    <!-- Filter & Search Section -->
    <section class="pb-12 bg-gray-50 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <form action="{{ route('landing.menu') }}" method="GET" class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 flex flex-col md:flex-row gap-4 items-center">
                
                <!-- Search -->
                <div class="relative w-full md:w-1/2">
                    <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-4 pr-10 py-3 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-5 focus:ring-primary focus:border-primary sm:text-sm transition-all" placeholder="Cari menu favoritmu...">
                    <div class="absolute inset-y-0 right-5 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="w-full md:w-1/3">
                    <select name="category" class="block w-full pl-3 pr-10 py-3 text-base border-gray-200 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-xl appearance-none bg-white">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori ?? $category->name ?? 'Kategori ' . $loop->iteration }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="w-full md:w-auto">
                    <button type="submit" class="w-full flex justify-center py-3 px-6 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all transform hover:scale-105">
                        Terapkan
                    </button>
                </div>
                
                 @if(request('search') || request('category'))
                <div class="w-full md:w-auto">
                     <a href="{{ route('landing.menu') }}" class="w-full flex justify-center py-3 px-6 border border-gray-300 rounded-xl shadow-sm text-sm font-bold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-all">
                        Reset
                    </a>
                </div>
                @endif
            </form>
        </div>
    </section>

    <!-- Menu Grid & Cart -->
    <section class="pb-24 bg-gray-50 px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">
            
            <!-- Menu List (Left) -->
            <div class="w-full lg:w-3/4">
                @if($menus->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($menus as $menu)
                        <div class="bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group overflow-hidden border border-gray-100">
                            <!-- Image Container -->
                            <div class="h-56 relative overflow-hidden bg-gray-100">
                                 @if($menu->foto_menu)
                                    <img src="{{ asset('storage/' . $menu->foto_menu) }}" alt="{{ $menu->nama_menu }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <img src="https://via.placeholder.com/300?text=Menu" alt="{{ $menu->nama_menu }}" class="w-full h-full object-cover">
                                @endif
                                <div class="absolute top-4 right-4 bg-white/95 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm backdrop-blur-sm">
                                    Available
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-5">
                                <div class="mb-4">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 truncate" title="{{ $menu->nama_menu }}">{{ $menu->nama_menu }}</h3>
                                    <p class="text-gray-500 text-sm line-clamp-2 h-10 mb-2">{{ $menu->deskripsi_menu ?? 'Nikmati kenikmatan rasanya.' }}</p>
                                    <a href="{{ route('detail.menu', $menu->id) }}" class="text-sm text-primary font-semibold hover:text-primary-focus transition-colors flex items-center gap-1 group/link">
                                        Lihat Detail
                                        <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <span class="text-xs text-gray-400 uppercase">Harga</span>
                                        <p class="text-lg font-bold text-primary">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    </div>
                                    @auth
                                         <a href="{{ route('cart.buyNow', $menu->id) }}" class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center hover:bg-primary-focus transition-all shadow-lg transform active:scale-95" title="Beli Sekarang">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </a>
                                    @else
                                         <a href="{{ route('login') }}" class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center hover:bg-primary transition-colors shadow-lg" title="Login untuk memesan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-24">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Menu tidak ditemukan</h3>
                        <p class="text-gray-500 mt-2">Coba kata kunci lain atau reset filter Anda.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar Cart (Right) -->
            <div class="w-full lg:w-1/4 relative">
                 <div class="sticky top-24">
                    @auth
                        @livewire('cart')
                    @endauth
                </div>
            </div>

        </div>
    </section>

    @auth
        {{-- @livewire('floating-cart') --}}
        {{-- Cart component already handles mobile bottom sheet --}}
    @endauth

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-12">
                <div class="text-center md:text-left">
                     <span class="font-bold text-3xl tracking-wide text-white">D'Lima Coffee</span>
                     <p class="text-gray-400 text-base mt-2 max-w-sm">Crafting the perfect cup of coffee for your daily inspiration.</p>
                </div>
                <!-- Social Links (Identical to Landing) -->
                <div class="flex space-x-6">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-white hover:text-gray-900 transition-all transform hover:scale-110">
                        <span class="sr-only">Instagram</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.153-1.772c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468 2.53c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg></a>
                </div>
            </div>
             <div class="border-t border-gray-800 pt-8 text-center">
                 <p class="text-gray-500 text-sm">© 2025 D'Lima Coffee. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // AOS.init({
        //     once: true,
        //     duration: 800,
        //     offset: 50,
        // });

        const navbar = document.getElementById('navbar');
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
             if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
