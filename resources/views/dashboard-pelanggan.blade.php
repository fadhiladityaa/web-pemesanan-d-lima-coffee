@extends('layouts.app')

@section('content')

    {{-- Background Utama: Cream lembut --}}
    <div class="min-h-screen bg-[#FDFBF7] py-28 font-sans text-[#4A403A]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 space-y-16">

            {{-- ================================================== --}}
            {{-- SECTION 1: HERO CARD (PROFILE) --}}
            {{-- ================================================== --}}
            <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl group">
                <div class="absolute inset-0 bg-gradient-to-r from-[#2C241B] via-[#4A3B32] to-[#2C241B]"></div>
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
                </div>

                <div class="relative z-10 px-8 py-12 md:px-16 md:py-16 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left">
                    <div>
                        <p class="text-[#D4B595] font-serif italic text-lg mb-2">Selamat datang kembali,</p>
                        <h1 class="text-4xl md:text-6xl font-serif font-bold text-white tracking-tight mb-4">
                            {{ explode(' ', $user->name)[0] }}
                        </h1>
                        <p class="text-gray-300 font-light max-w-lg text-sm md:text-base leading-relaxed">
                            Nikmati racikan kopi terbaik hari ini. Mulai harimu dengan semangat baru bersama Cerita D'Lima.
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <a href="{{ url('/menu') }}" class="inline-flex h-14 px-8 items-center justify-center rounded-full bg-[#D4B595] text-[#2C241B] font-bold uppercase tracking-wider hover:bg-white hover:scale-105 transition-all duration-300 shadow-lg">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>

            {{-- ================================================== --}}
            {{-- SECTION 2: GRID LAYOUT (Status & Promo) --}}
            {{-- ================================================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- KIRI: Status Pesanan --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="font-serif text-2xl font-bold text-[#2C241B]">Status Seduhan</h2>
                        <a href="{{ route('pesanan.saya') }}" class="text-sm text-[#8C7B70] hover:text-[#4A3B32] underline decoration-1 underline-offset-4">Lihat Semua</a>
                    </div>

                    @if ($lastOrder)
                        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-[#F0EAE0] flex flex-col md:flex-row items-center justify-between gap-6 hover:shadow-md transition duration-300">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 rounded-2xl bg-[#F8F4E9] flex items-center justify-center text-3xl shadow-inner">☕</div>
                                <div>
                                    <p class="text-xs font-bold tracking-widest text-[#8C7B70] uppercase mb-1">ID #{{ $lastOrder->kode_pesanan ?? $lastOrder->id }}</p>
                                    <h3 class="font-serif text-xl font-bold text-[#2C241B] mb-1">
                                        {{ ucfirst($lastOrder->status) }}
                                    </h3>
                                    <p class="text-xs text-gray-400">{{ $lastOrder->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <a href="{{ route('pesanan.saya', $lastOrder->id) }}" class="w-full md:w-auto px-8 py-3 bg-[#2C241B] text-[#D4B595] rounded-xl font-bold text-sm hover:bg-[#4A3B32] transition shadow-lg text-center">
                                Cek Progres
                            </a>
                        </div>
                    @else
                        <div class="bg-white rounded-[2rem] p-10 text-center border border-dashed border-[#D1C7BD]">
                            <p class="text-[#8C7B70] mb-4">Gelasmu masih kosong. Pesan sesuatu?</p>
                            <a href="{{ url('/menu') }}" class="text-[#4A3B32] font-bold hover:underline">Mulai Pesan</a>
                        </div>
                    @endif
                </div>

                {{-- KANAN: Promo Card --}}
                <div class="space-y-4 overflow-hidden">
                    <div class="flex items-center justify-between">
                        <h2 class="font-serif text-2xl font-bold text-[#2C241B]">Promo Spesial</h2>
                        
                        {{-- Indikator Geser (Visual Cue) --}}
                        @if(isset($promos) && count($promos) > 1)
                            <span class="text-xs text-[#8C7B70] animate-pulse hidden md:block">Geser untuk lihat lainnya &rarr;</span>
                        @endif
                    </div>

                    @if (isset($promos) && count($promos) > 0)
                        {{-- Container Scroll --}}
                        <div class="flex overflow-x-auto gap-4 pb-4 snap-x snap-mandatory scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
                            
                            @foreach ($promos as $promo)
                                {{-- Card Item (Fixed Width) --}}
                                <div class="relative flex-shrink-0 w-[85%] md:w-[350px] snap-center rounded-[2rem] overflow-hidden shadow-xl min-h-[300px] flex flex-col justify-end group transition-transform duration-300 hover:scale-[1.01]">

                                    {{-- Background Image --}}
                                    <div class="absolute inset-0">
                                        @if ($promo->gambar)
                                            <img src="{{ asset('storage/' . $promo->gambar) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                                    </div>

                                    {{-- Content --}}
                                    <div class="relative z-10 p-6 md:p-8 text-white">
                                        <div class="flex flex-wrap items-center gap-2 mb-3">
                                            <span class="bg-[#D4B595] text-[#2C241B] px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                                -{{ $promo->persentase_diskon }}%
                                            <!-- </span> -->
                                            <!-- <span class="text-xs font-mono opacity-80 border border-white/30 px-2 py-0.5 rounded">
                                                {{ $promo->kode_promo }}
                                            </span> -->
                                        </div>

                                        <h3 class="font-serif text-2xl md:text-3xl font-bold mb-2 leading-tight line-clamp-2">{{ $promo->judul }}</h3>
                                        <p class="text-white/80 text-sm mb-6 line-clamp-2 leading-relaxed">{{ $promo->deskripsi }}</p>

                                        {{-- LOGIKA ID MENU (Tetap Dipertahankan) --}}
                                        @php
                                            $targetId = null;
                                            if ($promo->menus && $promo->menus->isNotEmpty()) {
                                                $targetId = $promo->menus->first()->id;
                                            }
                                        @endphp

                                        <a href="{{ route('menu', ['promo_id' => $promo->id]) }}{{ $targetId ? '#menu-' . $targetId : '' }}" 
                                           class="flex items-center justify-center w-full py-3 md:py-4 bg-white text-[#2C241B] rounded-xl font-bold text-xs md:text-sm uppercase tracking-widest hover:bg-[#D4B595] hover:shadow-lg transition-all duration-300">
                                            <span>Pakai Promo</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @else
                        {{-- State Kosong --}}
                        <div class="bg-[#EBE5DE] rounded-[2rem] p-8 text-center h-[250px] flex flex-col items-center justify-center border border-dashed border-[#D1C7BD]">
                            <p class="text-[#8C7B70] font-medium">Belum ada promo aktif saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ================================================== --}}
            {{-- SECTION 3: REKOMENDASI MENU (SLIDER) --}}
            {{-- ================================================== --}}
            <div class="overflow-hidden">
                <div class="flex items-end justify-between mb-6">
                    <div>
                        <h2 class="font-serif text-3xl font-bold text-[#2C241B]">Rekomendasi Menu</h2>
                        <p class="text-[#8C7B70] mt-1 text-sm">Pilihan spesial rekomendasi barista kami.</p>
                    </div>
                    
                    {{-- Navigasi / Link --}}
                    <div class="flex items-center gap-4">
                        {{-- Indikator Geser (Hanya muncul jika item banyak) --}}
                        @if($featuredProducts->count() > 3)
                            <span class="text-xs text-[#8C7B70] animate-pulse hidden md:block">Geser &rarr;</span>
                        @endif
                        <a href="{{ url('/menu') }}" class="hidden md:flex items-center gap-2 text-sm font-bold text-[#4A3B32] hover:text-[#D4B595] transition">
                            Lihat Semua →
                        </a>
                    </div>
                </div>

                {{-- CONTAINER SLIDER (Flex) --}}
                <div class="flex overflow-x-auto gap-6 pb-8 snap-x snap-mandatory scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
                    
                    @forelse($featuredProducts as $product)
                        {{-- CARD ITEM (Fixed Width) --}}
                        <div class="relative flex-shrink-0 w-[85%] md:w-[300px] snap-center group bg-white rounded-[2rem] border border-[#F0EAE0] overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                            
                            {{-- GAMBAR PRODUK --}}
                            <div class="h-56 overflow-hidden relative bg-[#F4F1EA]">
                                @if ($product->gambar)
                                    <img src="{{ asset('storage/' . $product->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[#D1C7BD] bg-gray-100">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif

                                {{-- Badge Harga --}}
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-[#2C241B] px-3 py-1 rounded-lg text-sm font-bold shadow-sm">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </div>
                            </div>

                            {{-- KONTEN --}}
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="font-serif text-xl font-bold text-[#2C241B] mb-2 line-clamp-1" title="{{ $product->nama_menu }}">
                                    {{ $product->nama_menu }}
                                </h3>
                                <p class="text-[#8C7B70] text-sm mb-6 line-clamp-2 h-10 flex-grow leading-relaxed">
                                    {{ $product->deskripsi }}
                                </p>

                                {{-- TOMBOL AKSI (Tetap Scroll Otomatis) --}}
                                <a href="{{ route('menu') }}#menu-{{ $product->id }}" 
                                   class="flex items-center justify-center w-full py-3 rounded-xl border border-[#D4B595] text-[#4A3B32] font-bold text-sm hover:bg-[#D4B595] hover:text-[#2C241B] transition-colors duration-300 mt-auto group-hover:shadow-md">
                                    Lihat di Menu
                                </a>
                            </div>
                        </div>
                    @empty
                        {{-- State Kosong --}}
                        <div class="w-full py-12 text-center rounded-[2rem] border border-dashed border-[#D1C7BD] bg-[#FDFBF7]">
                            <p class="text-[#8C7B70] font-medium">Belum ada rekomendasi menu saat ini.</p>
                            <a href="{{ url('/menu') }}" class="text-[#4A3B32] text-sm font-bold hover:underline mt-2 inline-block">Cek Daftar Menu Lengkap</a>
                        </div>
                    @endforelse
                </div>
            </div>
            
            {{-- ================================================== --}}
            {{-- SECTION 4: EDUKASI (LINK LIVEWIRE AKTIF) --}}
            {{-- ================================================== --}}
            @if ($edukasi)
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="font-serif text-2xl font-bold text-[#2C241B]">💡 Cerita Kopi</h2>
                        <div class="h-px flex-1 bg-[#E8DFD8]"></div>
                    </div>

                    <div class="relative group cursor-pointer h-[400px] rounded-[2.5rem] overflow-hidden shadow-xl border border-[#F0EAE0]">
                        <div class="absolute inset-0 bg-gray-800">
                            @if ($edukasi->image)
                                <img src="{{ asset('storage/' . $edukasi->image) }}" class="w-full h-full object-cover opacity-70 group-hover:scale-110 group-hover:opacity-60 transition duration-1000 ease-out">
                            @else
                                <img src="https://images.unsplash.com/photo-1447933601403-0c60e017bc32?q=80&w=1000" class="w-full h-full object-cover opacity-70 group-hover:scale-110 group-hover:opacity-60 transition duration-1000 ease-out">
                            @endif
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>

                        <div class="absolute top-6 left-6 bg-white/20 backdrop-blur-md border border-white/30 text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">
                            {{ $edukasi->kategori ?? 'Knowledge' }}
                        </div>

                        <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full transform translate-y-2 group-hover:translate-y-0 transition duration-500">
                            <h3 class="font-serif text-3xl md:text-5xl font-bold text-white mb-4 leading-tight group-hover:text-amber-50 transition">
                                {{ $edukasi->judul }}
                            </h3>

                            <p class="text-gray-300 text-sm md:text-lg line-clamp-2 mb-6 max-w-2xl group-hover:text-white transition">
                                {{ $edukasi->ringkasan }}
                            </p>

                            <a href="{{ route('edukasi') }}" class="inline-flex items-center gap-2 text-[#D4B595] font-bold uppercase tracking-widest text-sm border-b border-[#D4B595] pb-1 hover:text-white hover:border-white transition">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- FOOTER BUTTON --}}
            <div class="py-8 text-center">
                <a href="{{ url('/menu') }}" class="inline-flex items-center justify-center px-8 py-4 bg-[#2C241B] text-[#D4B595] font-bold text-lg rounded-full shadow-2xl hover:scale-105 transition-transform duration-300">
                    Jelajahi Menu Lengkap
                </a>
            </div>

        </div>
    </div>

   {{-- ================================================== --}}
    {{-- POP-UP CAROUSEL (REVISI: GAMBAR AMAN & LIMIT BANYAK) --}}
    {{-- ================================================== --}}
    
    @php
        // Logika Penyelamat: Pastikan data berbentuk Collection
        $finalPromos = collect([]);
        
        if(isset($popupPromos) && $popupPromos->count() > 0) {
            $finalPromos = $popupPromos;
        } elseif(isset($popupPromo) && $popupPromo) {
            $finalPromos = collect([$popupPromo]);
        }
    @endphp

    @if($finalPromos->count() > 0)
        <div x-data="{ 
                show: false, 
                activeSlide: 0, 
                total: {{ $finalPromos->count() }},
                next() { 
                    this.activeSlide = (this.activeSlide === this.total - 1) ? 0 : this.activeSlide + 1 
                },
                prev() { 
                    this.activeSlide = (this.activeSlide === 0) ? this.total - 1 : this.activeSlide - 1 
                }
             }" 
             {{-- Timer muncul otomatis (tanpa anti-spam dulu biar enak testing) --}}
             x-init="setTimeout(() => show = true, 500)"
             x-show="show"
             style="display: none;"
             class="fixed inset-0 z-[999] flex items-center justify-center px-4 font-sans">

            {{-- 1. Backdrop Blur --}}
            <div x-show="show"
                 class="absolute inset-0 bg-[#1a1510]/80 backdrop-blur-sm"
                 @click="show = false">
            </div>

            {{-- 2. Modal Card --}}
            <div x-show="show"
                 x-transition:enter="transition ease-out duration-700 delay-100"
                 x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 class="relative w-full max-w-lg bg-[#FDFBF7] rounded-[2rem] shadow-2xl overflow-hidden border border-[#D4B595]/30">

                {{-- Tombol Close --}}
                <div class="absolute top-0 right-0 z-30 p-4">
                    <button @click="show = false" 
                            class="group bg-white/20 backdrop-blur-md border border-white/40 rounded-full p-2 hover:bg-[#2C241B] hover:border-[#2C241B] transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white group-hover:text-[#D4B595]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- LOOPING SLIDES --}}
                @foreach($finalPromos as $index => $promo)
                    <div x-show="activeSlide === {{ $index }}" class="flex flex-col h-full">

                        {{-- AREA GAMBAR (YANG DIMINTA DIUBAH) --}}
                        <div class="relative h-72 sm:h-80 overflow-hidden bg-[#2C241B]">
                            
                            {{-- LOGIKA GAMBAR: Hanya tampilkan jika file ASLI ada di storage --}}
                            @if ($promo->gambar)
                                <img src="{{ asset('storage/' . $promo->gambar) }}" class="w-full h-full object-cover">
                            @else
                                {{-- JIKA TIDAK ADA GAMBAR: Tampilkan Polos/Gradient Elegan --}}
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#2C241B] to-[#4A3B32]">
                                    {{-- Ikon/Logo Samar --}}
                                    <svg class="w-24 h-24 text-[#D4B595] opacity-20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            {{-- Gradient Overlay (Agar teks di atasnya terbaca) --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-[#2C241B] via-transparent to-transparent opacity-90"></div>
                            
                            {{-- Badge Diskon Besar --}}
                            <div class="absolute bottom-6 left-8 flex items-end gap-3 z-10">
                                <span class="text-6xl font-serif font-bold text-[#D4B595] leading-none drop-shadow-lg">
                                    {{ $promo->persentase_diskon }}<span class="text-3xl">%</span>
                                </span>
                                <span class="text-white font-medium text-sm mb-2 tracking-widest uppercase opacity-90">Off</span>
                            </div>
                        </div>

                        {{-- KONTEN BAWAH --}}
                        <div class="p-8 pt-6 text-center relative">
                            {{-- Indikator Slide (Dots) --}}
                            @if($finalPromos->count() > 1)
                                <div class="flex justify-center gap-2 mb-6 absolute -top-12 left-0 right-0 z-20">
                                    @foreach($finalPromos as $dotIndex => $dot)
                                        <button @click="activeSlide = {{ $dotIndex }}" 
                                                class="w-2 h-2 rounded-full transition-all duration-300 {{ $index == $dotIndex ? 'bg-[#D4B595] w-6' : 'bg-white/30 hover:bg-white' }}"></button>
                                    @endforeach
                                </div>
                            @endif

                            <h3 class="font-serif text-3xl font-bold text-[#2C241B] mb-3 leading-tight">
                                {{ $promo->judul }}
                            </h3>
                            
                            <!-- <div class="inline-block bg-[#F0EAE0] px-4 py-1.5 rounded-lg mb-4">
                                <span class="text-xs text-[#8C7B70] uppercase font-bold tracking-wider">Kode:</span>
                                <span class="font-mono text-[#2C241B] font-bold ml-1 tracking-widest">{{ $promo->kode_promo }}</span> -->
                            <!-- </div> --> 

                            <p class="text-[#8C7B70] text-sm leading-relaxed mb-8 line-clamp-2 px-4">
                                {{ $promo->deskripsi }}
                            </p>

                            {{-- Tombol Navigasi --}}
                            <div class="flex items-center gap-3">
                                @if($finalPromos->count() > 1)
                                    <button @click="prev()" class="p-4 rounded-xl border border-[#D4B595] text-[#D4B595] hover:bg-[#F8F4E9] transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                @endif

                                @php
                                    $targetId = null;
                                    if ($promo->menus && $promo->menus->isNotEmpty()) {
                                        $targetId = $promo->menus->first()->id;
                                    }
                                @endphp

                                <a href="{{ route('menu', ['promo_id' => $promo->id]) }}{{ $targetId ? '#menu-' . $targetId : '' }}"
                                   class="flex-1 py-4 bg-[#2C241B] text-[#D4B595] rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-[#4A3B32] hover:shadow-xl transition-all flex items-center justify-center gap-2 group">
                                    <span>Pakai Sekarang</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>

                                @if($finalPromos->count() > 1)
                                    <button @click="next()" class="p-4 rounded-xl border border-[#D4B595] text-[#D4B595] hover:bg-[#F8F4E9] transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endif
@endsection