@extends('layouts.app')

@section('content')

    {{-- Background Utama: Cream lembut agar mata nyaman --}}
    <div class="min-h-screen bg-[#FDFBF7] py-28 font-sans text-[#4A403A]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 space-y-12">

            {{-- SECTION 1: HERO CARD (PROFILE) --}}
            <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl transform hover:scale-[1.01] transition duration-500">
                {{-- Background Gradient Premium --}}
                <div class="absolute inset-0 bg-gradient-to-r from-[#2C241B] via-[#4A3B32] to-[#2C241B]"></div>
                
                {{-- Pattern Overlay (Opsional untuk tekstur) --}}
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>

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
                    
                    {{-- Tombol CTA Cepat --}}
                    <div class="hidden md:block">
                        <a href="{{ url('/menu') }}" class="group relative inline-flex h-14 w-14 items-center justify-center overflow-hidden rounded-full bg-[#D4B595] transition-all duration-300 hover:w-48 hover:bg-white">
                            <span class="inline-block transition-all duration-300 group-hover:hidden text-[#2C241B]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </span>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-all duration-300 group-hover:opacity-100">
                                <span class="whitespace-nowrap text-sm font-bold text-[#2C241B] uppercase tracking-wider">Pesan Sekarang</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: GRID LAYOUT (Status Pesanan & Promo) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KIRI: Status Pesanan Terakhir (Lebar 2 Kolom) --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="font-serif text-2xl font-bold text-[#2C241B]">Status Pesanan</h2>
                        <a href="#" class="text-sm text-[#8C7B70] hover:text-[#4A3B32] transition underline decoration-1 underline-offset-4">Riwayat</a>
                    </div>

                    @if($lastOrder)
                        <div class="bg-white rounded-[2rem] p-8 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-[#F0EAE0] flex flex-col md:flex-row items-start md:items-center justify-between gap-6 hover:border-[#D4B595] transition duration-300">
                            <div class="flex items-start gap-5">
                                <div class="w-16 h-16 rounded-2xl bg-[#F8F4E9] flex items-center justify-center text-3xl shadow-inner">
                                    ☕
                                </div>
                                <div>
                                    <p class="text-xs font-bold tracking-widest text-[#8C7B70] uppercase mb-1">ID #{{ $lastOrder->kode_pesanan ?? $lastOrder->id }}</p>
                                    <h3 class="font-serif text-xl font-bold text-[#2C241B] mb-2">
                                        {{ $lastOrder->created_at->format('d M Y, H:i') }}
                                    </h3>
                                    
                                    {{-- Status Badge Modern --}}
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold tracking-wide border
                                        {{ $lastOrder->status == 'selesai' 
                                            ? 'bg-green-50 text-green-700 border-green-200' 
                                            : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full mr-2 {{ $lastOrder->status == 'selesai' ? 'bg-green-500' : 'bg-amber-500' }}"></span>
                                        {{ strtoupper($lastOrder->status) }}
                                    </span>
                                </div>
                            </div>
                            <a href="#" class="w-full md:w-auto px-8 py-3 bg-[#2C241B] text-[#D4B595] rounded-xl font-bold text-sm hover:bg-[#4A3B32] transition shadow-lg shadow-[#2C241B]/20 text-center">
                                Detail Pesanan
                            </a>
                        </div>
                    @else
                        {{-- State Kosong --}}
                        <div class="bg-white rounded-[2rem] p-10 text-center border border-dashed border-[#D1C7BD]">
                            <p class="text-[#8C7B70] mb-4">Belum ada pesanan yang sedang berjalan.</p>
                            <a href="{{ url('/menu') }}" class="text-[#4A3B32] font-bold hover:underline">Mulai Pesan</a>
                        </div>
                    @endif
                </div>

                {{-- KANAN: Promo Card (Lebar 1 Kolom) --}}
                <div class="space-y-6">
                     <div class="flex items-center justify-between">
                        <h2 class="font-serif text-2xl font-bold text-[#2C241B]">Promo Spesial</h2>
                    </div>
                    
                    <div class="bg-gradient-to-br from-[#D4B595] to-[#C4A484] rounded-[2rem] p-6 text-white shadow-xl relative overflow-hidden min-h-[200px] flex flex-col justify-center">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-10 rounded-full blur-3xl"></div>
                        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-[#2C241B] opacity-10 rounded-full blur-3xl"></div>

                        @if(isset($promos) && count($promos) > 0)
                            @foreach($promos->take(1) as $promo)
                                <div class="relative z-10 text-center">
                                    <span class="bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase mb-3 inline-block border border-white/30">
                                        Limited Offer
                                    </span>
                                    <h3 class="font-serif text-2xl font-bold mb-1">{{ $promo->judul }}</h3>
                                    <p class="text-white/90 text-sm mb-4 line-clamp-2">{{ $promo->deskripsi ?? 'Diskon spesial untukmu!' }}</p>
                                    
                                    {{-- Kode Promo Copyable --}}
                                    <div class="bg-[#2C241B]/10 border border-[#2C241B]/10 rounded-xl p-3 mb-4 backdrop-blur-sm">
                                        <p class="text-xs font-medium opacity-70 mb-1">Gunakan Kode:</p>
                                        <p class="font-mono text-xl font-bold tracking-widest">{{ $promo->kode_promo }}</p>
                                    </div>

                                    <a href="{{ route('menu', ['promo_id' => $promo->id]) }}" class="inline-block w-full py-3 bg-white text-[#4A3B32] rounded-xl font-bold text-sm shadow-md hover:bg-[#FDFBF7] transition">
                                        Gunakan Sekarang
                                    </a>
                                </div>
                            @endforeach
                        @else
                             <div class="relative z-10 text-center py-4">
                                <p class="opacity-80">Nantikan promo menarik berikutnya!</p>
                             </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- SECTION 3: PRODUK UNGGULAN (Masonry Style) --}}
            <div>
                <div class="flex items-end justify-between mb-8">
                    <div>
                        <h2 class="font-serif text-3xl font-bold text-[#2C241B]">Pilihan Barista</h2>
                        <p class="text-[#8C7B70] mt-1 text-sm">Rekomendasi terbaik yang wajib kamu coba.</p>
                    </div>
                    <a href="{{ url('/menu') }}" class="hidden md:flex items-center gap-2 text-sm font-bold text-[#4A3B32] hover:text-[#D4B595] transition">
                        Lihat Semua
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($featuredProducts as $product)
                        <div class="group relative bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#F0EAE0] overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 ease-out">
                            
                            {{-- Image Container --}}
                            <div class="h-64 overflow-hidden relative bg-[#F4F1EA]">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-in-out">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[#D1C7BD]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                {{-- Gradient Overlay on Hover --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-[#2C241B]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                            </div>

                            {{-- Content --}}
                            <div class="p-6 relative">
                                {{-- Floating Price --}}
                                <div class="absolute -top-6 right-6 bg-[#2C241B] text-[#D4B595] px-4 py-2 rounded-xl text-sm font-bold shadow-lg transform translate-y-2 group-hover:translate-y-0 transition duration-300">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </div>

                                <h3 class="font-serif text-xl font-bold text-[#2C241B] mb-2 line-clamp-1">{{ $product->name }}</h3>
                                <p class="text-[#8C7B70] text-sm mb-6 line-clamp-2 leading-relaxed h-10">{{ $product->deskripsi }}</p>
                                
                                <button class="w-full py-3 rounded-xl border border-[#D4B595] text-[#4A3B32] font-bold text-sm hover:bg-[#D4B595] hover:text-[#2C241B] transition-colors duration-300 flex items-center justify-center gap-2">
                                    <span>Lihat Detail</span>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 text-[#8C7B70]">Belum ada produk unggulan.</div>
                    @endforelse
                </div>
            </div>

            {{-- SECTION 4: EDUKASI (Wide Card) --}}
            @if($edukasi)
                <div class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#F0EAE0] flex flex-col md:flex-row gap-10 items-center">
                    <div class="flex-1 space-y-4 text-center md:text-left">
                        <span class="inline-block text-[10px] font-bold tracking-[0.2em] text-[#D4B595] uppercase bg-[#2C241B] px-3 py-1 rounded-md">Coffee Knowledge</span>
                        <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#2C241B]">{{ $edukasi->judul }}</h2>
                        <p class="text-[#8C7B70] text-lg leading-relaxed line-clamp-3">{{ $edukasi->deskripsi }}</p>
                        <a href="#" class="inline-flex items-center gap-2 text-[#4A3B32] font-bold border-b-2 border-[#D4B595] pb-1 hover:text-[#D4B595] transition pt-2">
                            Baca Artikel Lengkap
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                    </div>
                    
                    {{-- Ilustrasi Edukasi (Placeholder Icon Besar) --}}
                    <div class="flex-shrink-0 w-full md:w-64 h-64 bg-[#F8F4E9] rounded-[2rem] flex items-center justify-center text-[#D4B595]">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" class="w-32 h-32">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                </div>
            @endif

            {{-- FOOTER CTA --}}
            <div class="py-8 text-center">
                <a href="{{ url('/menu') }}" class="group relative inline-flex items-center justify-center px-8 py-4 bg-[#2C241B] text-[#D4B595] font-bold text-lg rounded-full overflow-hidden shadow-2xl hover:scale-105 transition-transform duration-300">
                    <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-[#D4B595] rounded-full group-hover:w-56 group-hover:h-56 opacity-10"></span>
                    <span class="relative flex items-center gap-3">
                        Jelajahi Menu Lengkap
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </span>
                </a>
            </div>

        </div>
    </div>
@endsection