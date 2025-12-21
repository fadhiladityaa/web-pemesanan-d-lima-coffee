<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>D'Lima Coffee - Experience the Best</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hero-text-shadow { text-shadow: 0 4px 6px rgba(0,0,0,0.5); }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-[#947257] shadow-xl border-b border-[#947257]" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Branding -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <img class="h-10 w-auto rounded-full" src="{{ asset('img/Logo-DLima-Coffe.png') }}" alt="Logo">
                    <span class="font-bold text-2xl text-white font-[Sriracha] tracking-wide">D'Lima Coffee</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    @guest
                        <a href="#home" class="relative py-1 transition-all duration-300 sm:text-[16px] lg:text-[18px] font-poppins font-medium text-white/70 hover:text-white hover:border-b-2 hover:border-white/30">Beranda</a>
                    @endguest
                    <a href="{{ auth()->check() ? route('menu') : '#menu' }}" class="relative py-1 transition-all duration-300 sm:text-[16px] lg:text-[18px] font-poppins font-medium text-white/70 hover:text-white hover:border-b-2 hover:border-white/30">Menu</a>
                    <a href="#about" class="relative py-1 transition-all duration-300 sm:text-[16px] lg:text-[18px] font-poppins font-medium text-white/70 hover:text-white hover:border-b-2 hover:border-white/30">Tentang</a>
                    <a href="#contact" class="relative py-1 transition-all duration-300 sm:text-[16px] lg:text-[18px] font-poppins font-medium text-white/70 hover:text-white hover:border-b-2 hover:border-white/30">Kontak</a>
                    
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
                    <a href="#home" class="block py-3 px-3 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Beranda</a>
                @endguest
                <a href="#about" class="block py-3 px-3 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Tentang</a>
                <a href="{{ auth()->check() ? route('menu') : '#menu' }}" class="block py-3 px-3 text-base font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Menu</a>
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

    <!-- Hero Section -->
    <section id="home" class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden bg-black">
        <!-- Background Slider -->
        <div id="hero-slider" class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-100" style="background-image: url('{{ asset('img/bg-hero.png') }}')"></div>
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-0" style="background-image: url('{{ asset('img/bg1.jpeg') }}')"></div>
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-0" style="background-image: url('{{ asset('img/bg2.jpg') }}')"></div>
            <!-- Dark Overlay for Readability -->
            <div class="absolute inset-0 bg-black/60"></div> 
        </div>
        
        <div class="relative z-10 text-center max-w-4xl mx-auto px-4 sm:px-6">
            <div data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight hero-text-shadow">
                    Nikmati Kopi Terbaik <br> <span class="text-primary">D'Lima Coffee</span>
                </h1>
                <p class="text-lg sm:text-xl md:text-2xl text-gray-200 mb-10 max-w-2xl mx-auto font-light leading-relaxed drop-shadow">
                    Rasakan kehangatan dan kenikmatan dalam setiap tegukan. Kopi pilihan nusantara yang disajikan dengan penuh cinta.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#menu" class="px-8 py-4 rounded-full bg-primary text-white font-bold text-lg hover:bg-opacity-90 transition-transform transform hover:scale-105 shadow-xl">
                        Pesan Sekarang
                    </a>
                    <a href="#about" class="px-8 py-4 rounded-full bg-transparent border-2 border-white text-white font-bold text-lg hover:bg-white hover:text-gray-900 transition-all">
                        Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Preview Section -->
    <section id="menu" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">Menu Favorit</h2>
                <div class="w-20 h-1.5 bg-primary mx-auto rounded-full mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg leading-relaxed">
                    Jelajahi rasa yang tak terlupakan. Pilihan menu terbaik yang selalu menjadi favorit pelanggan kami.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($menus as $menu)
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-3 group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="h-64 overflow-hidden relative"> <!-- Taller image area -->
                         @if($menu->foto_menu)
                            <img src="{{ asset('storage/' . $menu->foto_menu) }}" alt="{{ $menu->nama_menu }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        @else
                            <img src="https://via.placeholder.com/300" alt="{{ $menu->nama_menu }}" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-primary px-4 py-1.5 rounded-full text-sm font-bold shadow-sm">
                            Best Seller
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 truncate" title="{{ $menu->nama_menu }}">{{ $menu->nama_menu }}</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2 leading-relaxed">{{ $menu->deskripsi_menu ?? 'Nikmati kesegaran menu ini.' }}</p>
                         <a href="{{ route('detail.menu', $menu->id) }}" class="text-sm text-primary font-semibold hover:text-primary-focus transition-colors flex items-center gap-1 group/link mb-4">
                            Lihat Detail
                            <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-primary font-bold text-xl">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                             @auth
                                <a href="{{ route('cart.buyNow', $menu->id) }}" class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white hover:bg-primary-focus transition-all shadow-sm hover:shadow-md group-hover:bg-primary group-hover:text-white" title="Beli Sekarang">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all shadow-sm hover:shadow-md group-hover:bg-primary group-hover:text-white" title="Login untuk memesan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-16">
                 <a href="{{ route('menu') }}" class="inline-block px-10 py-3 rounded-full bg-gray-900 text-white font-bold hover:bg-gray-800 transition-transform transform hover:scale-105 shadow-lg">
                    Lihat Semua Menu
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Image Column -->
                <div class="relative" data-aos="fade-right" data-aos-duration="1000">
                    <div class="aspect-w-4 aspect-h-3 rounded-2xl overflow-hidden shadow-2xl">
                         <img src="{{ asset('img/hero.png') }}" onerror="this.src='https://images.unsplash.com/photo-1554060851-f2fe77051df6?q=80&w=1887&auto=format&fit=crop'" alt="About Us" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="absolute -bottom-6 -right-6 md:-bottom-10 md:-right-10 bg-white p-6 md:p-8 rounded-xl shadow-xl border-l-[6px] border-primary hidden md:block animate-float">
                        <p class="text-3xl font-bold text-gray-900">2020</p>
                        <p class="text-primary font-medium uppercase tracking-wider text-sm">Established</p>
                    </div>
                </div>

                <!-- Text Column -->
                <div data-aos="fade-left" data-aos-duration="1000">
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-8 relative inline-block">
                        Tentang Kami
                        <span class="absolute bottom-1 left-0 w-1/2 h-1.5 bg-primary rounded-full"></span>
                    </h2>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                        <span class="font-bold text-gray-900">D'Lima Coffee</span> adalah tempat di mana gairah kopi bertemu dengan kenyamanan. Kami berkomitmen menyajikan kopi terbaik dari biji pilihan nusantara.
                    </p>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        Kami tidak hanya menjual kopi, kami menjual pengalaman. Sebuah ruang untuk produktivitas, percakapan, dan ketenangan di tengah hiruk pikuk kota.
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-primary/20 flex items-center justify-center mt-1">
                                <span class="h-2 w-2 rounded-full bg-primary"></span>
                            </div>
                            <p class="ml-4 text-lg text-gray-700">Biji kopi premium dari petani lokal terpilih.</p>
                        </div>
                        <div class="flex items-start">
                             <div class="flex-shrink-0 h-6 w-6 rounded-full bg-primary/20 flex items-center justify-center mt-1">
                                <span class="h-2 w-2 rounded-full bg-primary"></span>
                            </div>
                            <p class="ml-4 text-lg text-gray-700">Barista profesional dengan sertifikasi brewing.</p>
                        </div>
                        <div class="flex items-start">
                             <div class="flex-shrink-0 h-6 w-6 rounded-full bg-primary/20 flex items-center justify-center mt-1">
                                <span class="h-2 w-2 rounded-full bg-primary"></span>
                            </div>
                            <p class="ml-4 text-lg text-gray-700">Ambience modern yang nyaman dan inspiratif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-white relative overflow-hidden">
         <!-- Decorative Background -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="currentColor" class="text-primary"></path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">Hubungi Kami</h2>
                <div class="w-20 h-1.5 bg-primary mx-auto rounded-full"></div>
            </div>

             <div class="bg-white rounded-[2rem] p-8 md:p-12 shadow-2xl border border-gray-100 max-w-5xl mx-auto scale-100 hover:scale-[1.01] transition-transform duration-500" data-aos="zoom-in">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                     <!-- Location -->
                    <div class="flex items-start space-x-6 group">
                        <div class="flex-shrink-0 w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center group-hover:bg-primary transition-colors duration-300">
                             <svg class="w-8 h-8 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-900">Lokasi Kami</h3>
                            <p class="text-gray-600 text-lg leading-relaxed">
                                Jln. Delima, Mallusetasi <br>
                                Parepare, Sulawesi Selatan
                            </p>
                        </div>
                    </div>
                    
                    <!-- Contact -->
                    <div class="flex items-start space-x-6 group">
                         <div class="flex-shrink-0 w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center group-hover:bg-primary transition-colors duration-300">
                            <svg class="w-8 h-8 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                         <div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-900">Hubungi</h3>
                            <p class="text-gray-600 text-lg leading-relaxed mb-1">hello@dlimacoffee.com</p>
                            <p class="text-gray-900 font-bold text-lg">+62 821-8860-6007</p>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-12">
                <div class="text-center md:text-left">
                     <span class="font-bold text-3xl tracking-wide text-white">D'Lima Coffee</span>
                     <p class="text-gray-400 text-base mt-2 max-w-sm">Crafting the perfect cup of coffee for your daily inspiration.</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-white hover:text-gray-900 transition-all transform hover:scale-110">
                        <span class="sr-only">Instagram</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468 2.53c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                 <p class="text-gray-500 text-sm">© 2025 D'Lima Coffee. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800,
            offset: 50,
        });

        const navbar = document.getElementById('navbar');
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        // Robust Scroll Handler
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-md');
            } else {
                navbar.classList.remove('shadow-md');
            }
        });

        mobileMenuButton.addEventListener('click', () => {
             // Simple toggle logic
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
            }
        });

        // Hero Image Slider
        const slides = document.querySelectorAll('#hero-slider > div.bg-cover');
        let currentSlide = 0;
        
         if (slides.length > 0) {
            setInterval(() => {
                slides[currentSlide].classList.remove('opacity-100');
                slides[currentSlide].classList.add('opacity-0');
                
                currentSlide = (currentSlide + 1) % slides.length;
                
                slides[currentSlide].classList.remove('opacity-0');
                slides[currentSlide].classList.add('opacity-100');
            }, 6000); // Increased duration slightly
        }
    </script>
</body>
</html>
