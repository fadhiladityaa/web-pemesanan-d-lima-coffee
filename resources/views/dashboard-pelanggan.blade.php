@extends('layouts.app')

@section('content')

    {{-- Background Utama --}}
    <div class="min-h-screen bg-[#FDFBF7] py-28 font-sans text-[#4A403A]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 space-y-16">

            {{-- SECTION 1: HERO CARD --}}
            <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl group">
                <div class="absolute inset-0 bg-gradient-to-r from-[#2C241B] via-[#4A3B32] to-[#2C241B]"></div>
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
                </div>
                <div
                    class="relative z-10 px-8 py-12 md:px-16 md:py-16 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left">
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
                        <a href="{{ url('/menu') }}"
                            class="inline-flex h-14 px-8 items-center justify-center rounded-full bg-[#D4B595] text-[#2C241B] font-bold uppercase tracking-wider hover:bg-white hover:scale-105 transition-all duration-300 shadow-lg">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: Status & Promo --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Status Pesanan --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="font-serif text-2xl font-bold text-[#2C241B]">Status Seduhan</h2>
                        <a href="{{ route('pesanan.saya') }}"
                            class="text-sm text-[#8C7B70] hover:text-[#4A3B32] underline decoration-1 underline-offset-4">Lihat
                            Semua</a>
                    </div>
                    @if ($lastOrder)
                        <div
                            class="bg-white rounded-[2rem] p-8 shadow-sm border border-[#F0EAE0] flex flex-col md:flex-row items-center justify-between gap-6 hover:shadow-md transition duration-300">
                            <div class="flex items-center gap-5">
                                <div
                                    class="w-16 h-16 rounded-2xl bg-[#F8F4E9] flex items-center justify-center text-3xl shadow-inner">
                                    ☕</div>
                                <div>
                                    <p class="text-xs font-bold tracking-widest text-[#8C7B70] uppercase mb-1">ID
                                        #{{ $lastOrder->kode_pesanan ?? $lastOrder->id }}</p>
                                    <h3 class="font-serif text-xl font-bold text-[#2C241B] mb-1">
                                        {{ ucfirst($lastOrder->status) }}</h3>
                                    <p class="text-xs text-gray-400">{{ $lastOrder->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            <a href="{{ route('pesanan.saya', $lastOrder->id) }}"
                                class="w-full md:w-auto px-8 py-3 bg-[#2C241B] text-[#D4B595] rounded-xl font-bold text-sm hover:bg-[#4A3B32] transition shadow-lg text-center">
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

                {{-- Promo Card --}}
                <div class="space-y-6">
                    <h2 class="font-serif text-2xl font-bold text-[#2C241B]">Promo Spesial</h2>
                    @if (isset($promos) && count($promos) > 0)
                        @foreach ($promos->take(1) as $promo)
                            <div
                                class="relative rounded-[2rem] overflow-hidden shadow-xl min-h-[250px] flex flex-col justify-end group">
                                <div class="absolute inset-0">
                                    <img src="{{ $promo->gambar ? asset('storage/' . $promo->gambar) : 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=600' }}"
                                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent">
                                    </div>
                                </div>
                                <div class="relative z-10 p-6 text-white">
                                    <span
                                        class="bg-[#D4B595] text-[#2C241B] px-3 py-1 rounded-full text-[10px] font-bold uppercase mb-2 inline-block">Limited
                                        Offer</span>
                                    <h3 class="font-serif text-2xl font-bold mb-1">{{ $promo->judul }}</h3>
                                    <div
                                        class="flex items-center justify-between bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-3 mt-4">
                                        <div>
                                            <p class="text-[10px] opacity-70 uppercase">Kode</p>
                                            <p class="font-mono text-lg font-bold tracking-widest">{{ $promo->kode_promo }}
                                            </p>
                                        </div>
                                        <a href="{{ route('menu', ['promo_id' => $promo->id]) }}"
                                            class="bg-white text-[#2C241B] px-4 py-2 rounded-lg text-xs font-bold hover:bg-[#D4B595] transition">Pakai</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div
                            class="bg-[#EBE5DE] rounded-[2rem] p-8 text-center h-[250px] flex flex-col items-center justify-center">
                            <p class="text-[#8C7B70]">Nantikan promo menarik berikutnya!</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- SECTION 3: REKOMENDASI MENU --}}
            <div>
                <div class="flex items-end justify-between mb-8">
                    <div>
                        <h2 class="font-serif text-3xl font-bold text-[#2C241B]">Rekomendasi Menu</h2>
                        <p class="text-[#8C7B70] mt-1 text-sm">Pilihan spesial rekomendasi barista kami.</p>
                    </div>
                    <a href="{{ url('/menu') }}"
                        class="hidden md:flex items-center gap-2 text-sm font-bold text-[#4A3B32] hover:text-[#D4B595] transition">Lihat
                        Semua →</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($featuredProducts as $product)
                        <div
                            class="group relative bg-white rounded-[2rem] shadow-sm border border-[#F0EAE0] overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                            <div class="h-64 overflow-hidden relative bg-[#F4F1EA]">
                                <img src="{{ $product->gambar ? asset('storage/' . $product->gambar) : 'https://via.placeholder.com/400x300' }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                <div
                                    class="absolute top-4 right-4 bg-white/90 backdrop-blur text-[#2C241B] px-3 py-1 rounded-lg text-sm font-bold shadow-sm">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-serif text-xl font-bold text-[#2C241B] mb-2 line-clamp-1">
                                    {{ $product->nama_menu }}</h3>
                                <p class="text-[#8C7B70] text-sm mb-6 line-clamp-2 h-10">{{ $product->deskripsi }}</p>
                                <a href="{{ route('menu.show', $product->id) }}"
                                    class="flex items-center justify-center w-full py-3 rounded-xl border border-[#D4B595] text-[#4A3B32] font-bold text-sm hover:bg-[#D4B595] hover:text-[#2C241B] transition-colors duration-300">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 py-12 text-center rounded-[2rem] border border-dashed border-[#D1C7BD]">
                            <p class="text-[#8C7B70]">Belum ada rekomendasi menu saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- SECTION 4: EDUKASI --}}
            @if ($edukasi)
                <div
                    class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-sm border border-[#F0EAE0] flex flex-col md:flex-row gap-10 items-center">
                    <div class="flex-1 space-y-4 text-center md:text-left">
                        <span
                            class="inline-block text-[10px] font-bold tracking-[0.2em] text-[#D4B595] uppercase bg-[#2C241B] px-3 py-1 rounded-md">Coffee
                            Knowledge</span>
                        <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#2C241B]">{{ $edukasi->judul }}</h2>
                        <p class="text-[#8C7B70] text-lg leading-relaxed line-clamp-3">{{ $edukasi->deskripsi }}</p>
                        <a href="{{ route('edukasi') }}"
                            class="inline-flex items-center gap-2 text-[#4A3B32] font-bold border-b-2 border-[#D4B595] pb-1 hover:text-[#D4B595] transition pt-2">
                            Baca Artikel Lengkap
                        </a>
                    </div>
                    <div
                        class="flex-shrink-0 w-full md:w-64 h-64 bg-[#F8F4E9] rounded-[2rem] flex items-center justify-center text-[#D4B595]">
                        @if ($edukasi->image)
                            <img src="{{ asset('storage/' . $edukasi->image) }}"
                                class="w-full h-full object-cover rounded-[2rem]">
                        @else
                            <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25">
                                </path>
                            </svg>
                        @endif
                    </div>
                </div>
            @endif

            {{-- FOOTER CTA --}}
            <div class="py-8 text-center">
                <a href="{{ url('/menu') }}"
                    class="inline-flex items-center justify-center px-8 py-4 bg-[#2C241B] text-[#D4B595] font-bold text-lg rounded-full shadow-2xl hover:scale-105 transition-transform duration-300">
                    Jelajahi Menu Lengkap
                </a>
            </div>

        </div>
    </div>
@endsection
