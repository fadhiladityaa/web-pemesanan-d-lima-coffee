@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-[#f8f4e9] py-28">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 px-4 space-y-10">

            {{-- HEADER JUDUL --}}
            <div class="text-center">
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#5c4033] leading-tight">
                    {{ __('Dashboard Pelanggan') }}
                </h2>
                <div class="mt-2 h-1 w-24 bg-[#c4a484] mx-auto rounded-full"></div>
            </div>
            
            {{-- SECTION 1 — Profil Singkat --}}
            <div class="relative overflow-hidden rounded-3xl shadow-xl">
                <div class="absolute inset-0 bg-gradient-to-br from-[#6d4c41] to-[#5c4033]"></div>
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/coffee.png')]"></div>
                
                <div class="relative p-8 md:p-10 text-center text-[#fffdfa]">
                    <h2 class="font-serif text-3xl md:text-4xl font-bold mb-3 tracking-wide">Halo, {{ $user->name }}!</h2>
                    <p class="text-amber-100 text-lg font-light max-w-2xl mx-auto">
                        Selamat datang kembali. Nikmati keaslian biji kopi pilihan yang diolah dengan sepenuh hati untuk Anda.
                    </p>
                </div>
            </div>

            {{-- SECTION 2 — Status Pesanan Terakhir --}}
            <div class="bg-white rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-[#e8dfd8]">
                <h2 class="font-serif text-2xl font-bold mb-6 text-[#5c4033] flex items-center gap-3">
                    <span class="text-3xl">📦</span> Status Pesanan Terakhir
                </h2>

                @if($lastOrder)
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-[#fffaf5] p-6 rounded-2xl border border-[#d7ccc8]">
                        <div class="mb-4 md:mb-0 space-y-2">
                            <p class="text-[#8d6e63] text-sm uppercase tracking-widest font-semibold">Kode Pesanan</p>
                            <p class="text-[#5c4033] font-serif font-bold text-2xl tracking-wide">#{{ $lastOrder->kode_pesanan ?? $lastOrder->id }}</p>
                            <div class="mt-2">
                                {{-- PERBAIKAN DI SINI: Komentar // dihapus --}}
                                <span class="px-4 py-1.5 rounded-full text-sm font-bold shadow-sm
                                    {{ $lastOrder->status == 'selesai' 
                                        ? 'bg-[#e8f5e9] text-[#2e7d32] border border-[#c8e6c9]'
                                        : 'bg-[#fff8e1] text-[#f57f17] border border-[#ffe0b2]'
                                    }}">
                                    {{ ucfirst($lastOrder->status) }}
                                </span>
                            </div>
                        </div>
                        <a href="#" class="group flex items-center gap-2 px-6 py-3 bg-white border-2 border-[#c4a484] rounded-full text-[#8d6e63] font-bold hover:bg-[#c4a484] hover:text-white transition-all duration-300">
                            Lihat Detail
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 group-hover:translate-x-1 transition">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                              </svg>
                        </a>
                    </div>
                @else
                    <div class="text-center py-12 text-[#8d6e63] bg-[#fffaf5] rounded-2xl border border-dashed border-[#d7ccc8]">
                        <p class="text-lg mb-4">Belum ada pesanan yang dilakukan.</p>
                        <a href="{{ url('/menu') }}" class="inline-block px-8 py-3 bg-[#6d4c41] text-amber-50 font-bold rounded-full shadow-md hover:bg-[#5c4033] hover:shadow-lg transition">
                            Mulai Pesan Kopi
                        </a>
                    </div>
                @endif
            </div>

            {{-- SECTION 3 — Produk Unggulan --}}
            <div>
                <div class="text-center mb-8">
                    <h2 class="font-serif text-3xl font-bold text-[#5c4033]">Pilihan Favorit</h2>
                    <p class="text-[#8d6e63] mt-2">Rekomendasi terbaik kami untuk hari Anda</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($featuredProducts as $product)
                        <div class="group bg-white rounded-[2rem] border border-[#e8dfd8] shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgb(92,64,51,0.1)] transition-all duration-500 overflow-hidden flex flex-col">
                            <div class="h-64 bg-[#f4eeee] overflow-hidden relative">
                                @if($product->image)
                                     <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-in-out">
                                @else
                                     <div class="flex flex-col items-center justify-center h-full text-[#bcaaa4] bg-[#fffaf5]">
                                        No Image
                                     </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-[#5c4033]/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>

                            <div class="p-6 flex flex-col flex-grow bg-white relative z-10">
                                <h3 class="font-serif font-bold text-xl text-[#5c4033] mb-2 line-clamp-1 group-hover:text-[#8d6e63] transition">{{ $product->name }}</h3>
                                <p class="text-[#8d6e63] text-sm mb-6 line-clamp-2 flex-grow">{{ $product->deskripsi }}</p>
                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-[#f0e6e0]">
                                    <p class="font-serif font-bold text-2xl text-[#6d4c41]">Isi: Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                                    <button class="w-12 h-12 rounded-full bg-[#6d4c41] text-amber-50 flex items-center justify-center shadow-md hover:bg-[#5c4033] hover:scale-110 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-[#8d6e63] col-span-3 text-center py-12 bg-[#fffaf5] rounded-2xl border border-dashed border-[#d7ccc8]">Belum ada produk unggulan saat ini.</p>
                    @endforelse
                </div>
            </div>

            {{-- SECTION 4 — Edukasi & Promo --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- Edukasi Card --}}
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-[#e8dfd8]">
                    <h2 class="font-serif text-2xl font-bold mb-6 text-[#5c4033] flex items-center gap-3">
                        <span class="text-3xl">💡</span> Edukasi Kopi
                    </h2>
                    @if($edukasi)
                        <div class="bg-[#fffaf5] p-6 rounded-3xl border border-[#f0e6e0] hover:border-[#d7ccc8] transition duration-300">
                            <span class="inline-block text-xs font-bold tracking-wider text-amber-900 bg-amber-100 px-3 py-1.5 rounded-full mb-4">ARTIKEL TERBARU</span>
                            <h3 class="font-serif font-bold text-xl text-[#5c4033] mb-3">{{ $edukasi->judul }}</h3>
                            <p class="text-[#8d6e63] leading-relaxed line-clamp-3 mb-6">{{ $edukasi->deskripsi }}</p>
                            <a href="#" class="inline-flex items-center gap-2 text-[#6d4c41] font-bold hover:underline hover:text-[#5c4033] transition">
                                Baca Selengkapnya 
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <p class="text-[#8d6e63] text-center py-6">Belum ada konten edukasi.</p>
                    @endif
                </div>

                {{-- Promo Card --}}
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-[#e8dfd8] relative overflow-hidden">
                    <h2 class="font-serif text-3xl font-bold mb-8 text-[#5c4033] text-center italic relative z-10" style="font-family: 'Playfair Display', serif;">
                        Penawaran Spesial
                    </h2>
                    
                    <div class="absolute inset-0 opacity-[0.03] bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] z-0"></div>

                    @if(isset($promos) && count($promos) > 0)
                        <div class="space-y-6 relative z-10">
                            @foreach($promos as $promo)
                                <div class="group flex flex-col sm:flex-row items-center gap-6 bg-gradient-to-r from-[#fffaf5] to-[#fffdfa] p-5 rounded-[1.5rem] border border-[#f0e6e0] shadow-sm hover:shadow-md transition-all duration-300">
                                    <div class="flex-1 text-center sm:text-left">
                                        <h3 class="font-serif font-bold text-lg text-[#5c4033] group-hover:text-[#8d6e63] transition">{{ $promo->judul }}</h3>
                                        <div class="inline-block mt-2 px-3 py-1 bg-amber-100 border border-amber-200 rounded-lg">
                                            <p class="text-amber-900 text-xs font-bold tracking-wider uppercase">Kode: {{ $promo->kode_promo }}</p>
                                        </div>
                                    </div>
                                    <a href="#" class="px-6 py-2.5 bg-[#6d4c41] text-amber-50 text-sm font-bold rounded-full shadow hover:bg-[#5c4033] hover:shadow-md active:scale-95 transition-all">
                                        Cek Sekarang!
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-[#8d6e63] text-center py-6 relative z-10">Tidak ada promo saat ini.</p>
                    @endif
                </div>
            </div>

            {{-- SECTION 5 — Navigasi Cepat --}}
            <div class="text-center py-12">
                <a href="{{ url('/menu') }}" class="group inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-[#6d4c41] to-[#5c4033] text-amber-50 font-bold text-lg rounded-full shadow-[0_10px_30px_rgb(92,64,51,0.3)] hover:shadow-[0_15px_40px_rgb(92,64,51,0.4)] hover:-translate-y-1 transition-all duration-300">
                    <span>Jelajahi Menu Lengkap</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 group-hover:rotate-12 transition-transform duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>                      
                </a>
            </div>

        </div>
    </div>
@endsection