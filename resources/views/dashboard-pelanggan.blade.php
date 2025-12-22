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
                        {{-- [UBAH DI SINI] Judul yang lebih menarik --}}
                        <h2 class="font-serif text-2xl font-bold text-[#2C241B]">Status Seduhan</h2>
                        <a href="{{ route('pesanan.saya') }}" class="text-sm text-[#8C7B70] hover:text-[#4A3B32] underline decoration-1 underline-offset-4">Lihat Semua</a>
                    </div>

                    @if($lastOrder)
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
                            
                            {{-- Tombol Detail ke Route Livewire 'pesanan.detail' --}}
                            {{-- Pastikan Anda sudah membuat route ini di web.php: Route::get('/pesanan/{id}', App\Livewire\DetailPesanan::class)->name('pesanan.saya'); --}}
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
                <div class="space-y-6">
                     <h2 class="font-serif text-2xl font-bold text-[#2C241B]">Promo Spesial</h2>
                    
                    @if(isset($promos) && count($promos) > 0)
                        @foreach($promos->take(1) as $promo)
                            <div class="relative rounded-[2rem] overflow-hidden shadow-xl min-h-[250px] flex flex-col justify-end group">
                                <div class="absolute inset-0">
                                    @if($promo->gambar)
                                        <img src="{{ asset('storage/'.$promo->gambar) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                                </div>

                                <div class="relative z-10 p-6 text-white">
                                    <span class="bg-[#D4B595] text-[#2C241B] px-3 py-1 rounded-full text-[10px] font-bold uppercase mb-2 inline-block">Limited Offer</span>
                                    <h3 class="font-serif text-2xl font-bold mb-1">{{ $promo->judul }}</h3>
                                    <p class="text-white/80 text-sm mb-4 line-clamp-2">{{ $promo->deskripsi }}</p>
                                    
                                    <div class="flex items-center justify-between bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-3">
                                        <div>
                                            <p class="text-[10px] opacity-70 uppercase">Kode Voucher</p>
                                            <p class="font-mono text-lg font-bold tracking-widest">{{ $promo->kode_promo }}</p>
                                        </div>
                                        <a href="{{ route('menu', ['promo_id' => $promo->id]) }}" class="bg-white text-[#2C241B] px-4 py-2 rounded-lg text-xs font-bold hover:bg-[#D4B595] transition">Pakai</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="bg-[#EBE5DE] rounded-[2rem] p-8 text-center h-[250px] flex flex-col items-center justify-center">
                            <p class="text-[#8C7B70]">Nantikan promo menarik berikutnya!</p>
                        </div>
                    @endif
                </div>
            </div>
            {{-- ================================================== --}}
            {{-- SECTION 3: REKOMENDASI MENU --}}
            {{-- ================================================== --}}
            <div>
                <div class="flex items-end justify-between mb-8">
                    <div>
                        <h2 class="font-serif text-3xl font-bold text-[#2C241B]">Rekomendasi Menu</h2>
                        <p class="text-[#8C7B70] mt-1 text-sm">Pilihan spesial rekomendasi barista kami.</p>
                    </div>
                    <a href="{{ url('/menu') }}" class="hidden md:flex items-center gap-2 text-sm font-bold text-[#4A3B32] hover:text-[#D4B595] transition">
                        Lihat Semua →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($featuredProducts as $product)
                        <div class="group bg-white rounded-[2rem] border border-[#F0EAE0] overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                            
                            {{-- GAMBAR PRODUK --}}
                            <div class="h-64 overflow-hidden relative bg-[#F4F1EA]">
                                {{-- [PERBAIKAN] Gunakan 'gambar', bukan 'image' --}}
                                @if($product->gambar)
                                    <img src="{{ asset('storage/'.$product->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[#D1C7BD] bg-gray-100">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                
                                {{-- HARGA --}}
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-[#2C241B] px-3 py-1 rounded-lg text-sm font-bold shadow-sm">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </div>
                            </div>

                            {{-- KONTEN --}}
                            <div class="p-6">
                                {{-- [PERBAIKAN] Gunakan 'nama_menu', bukan 'name' --}}
                                <h3 class="font-serif text-xl font-bold text-[#2C241B] mb-2 line-clamp-1">
                                    {{ $product->nama_menu }}
                                </h3>
                                
                                {{-- Deskripsi --}}
                                <p class="text-[#8C7B70] text-sm mb-6 line-clamp-2 h-10">
                                    {{ $product->deskripsi }}
                                </p>
                                
                                {{-- Tombol Lihat Detail --}}
                               <a href="{{ route('menu') }}#menu-{{ $product->id }}" 
                                class="flex items-center justify-center w-full py-3 rounded-xl border border-[#D4B595] text-[#4A3B32] font-bold text-sm hover:bg-[#D4B595] hover:text-[#2C241B] transition-colors duration-300">
                                    Lihat di Menu
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 py-12 text-center rounded-[2rem] border border-dashed border-[#D1C7BD] bg-[#FDFBF7]">
                            <p class="text-[#8C7B70] font-medium">Belum ada rekomendasi menu saat ini.</p>
                            <a href="{{ url('/menu') }}" class="text-[#4A3B32] text-sm font-bold hover:underline mt-2 inline-block">Cek Daftar Menu Lengkap</a>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- ================================================== --}}
            {{-- SECTION 4: EDUKASI (LINK LIVEWIRE AKTIF) --}}
            {{-- ================================================== --}}
            @if($edukasi)
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="font-serif text-2xl font-bold text-[#2C241B]">💡 Cerita Kopi</h2>
                    <div class="h-px flex-1 bg-[#E8DFD8]"></div>
                </div>

                <div class="relative group cursor-pointer h-[400px] rounded-[2.5rem] overflow-hidden shadow-xl border border-[#F0EAE0]">
                    <div class="absolute inset-0 bg-gray-800">
                         @if($edukasi->image)
                            <img src="{{ asset('storage/'.$edukasi->image) }}" class="w-full h-full object-cover opacity-70 group-hover:scale-110 group-hover:opacity-60 transition duration-1000 ease-out">
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

                        {{-- [FIXED] LINK KE LIVEWIRE EDUKASI --}}
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
@endsection