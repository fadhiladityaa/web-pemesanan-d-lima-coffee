@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    {{-- Judul --}}
    <h1 class="text-2xl font-bold mb-6">Dashboard Pelanggan</h1>

    {{-- SECTION 1 — Profil Singkat --}}
    <div class="bg-white p-5 rounded-xl shadow mb-6">
        <h2 class="text-lg font-semibold mb-2">Selamat Datang, {{ $user->name }}</h2>
        <p class="text-gray-600 text-sm">Terima kasih telah berbelanja di D'LIMA Coffee.</p>
    </div>

    {{-- SECTION 2 — Status Pesanan Terakhir --}}
    <div class="bg-white p-5 rounded-xl shadow mb-6">
        <h2 class="text-lg font-semibold mb-3">Status Pesanan Terakhir</h2>

        @if($lastOrder)
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-700 font-medium">Kode Pesanan: {{ $lastOrder->kode_pesanan }}</p>
                    <p class="text-gray-600 text-sm">Status: 
                        <span class="font-bold text-green-600">{{ $lastOrder->status }}</span>
                    </p>
                </div>
                <a href="{{ route('order.show', $lastOrder->id) }}" class="text-blue-600 text-sm font-semibold">Lihat Detail</a>
            </div>
        @else
            <p class="text-gray-500 text-sm">Belum ada pesanan.</p>
        @endif
    </div>

    {{-- SECTION 3 — Produk Unggulan --}}
    <div class="bg-white p-5 rounded-xl shadow mb-6">
        <h2 class="text-lg font-semibold mb-3">Produk Unggulan</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($featuredProducts as $product)
                <div class="rounded-xl border p-3 hover:shadow">
                    <img src="{{ asset('storage/'.$product->image) }}" class="rounded-lg mb-3">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $product->deskripsi }}</p>
                    <p class="font-bold text-coffee">Rp {{ number_format($product->harga) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- SECTION 4 — Edukasi Terbaru --}}
    <div class="bg-white p-5 rounded-xl shadow mb-6">
        <h2 class="text-lg font-semibold mb-3">Edukasi Kopi</h2>

        @if($edukasi)
            <div>
                <h3 class="font-semibold">{{ $edukasi->judul }}</h3>
                <p class="text-gray-600 text-sm line-clamp-3">{{ $edukasi->deskripsi }}</p>
                <a href="{{ route('edukasi.show', $edukasi->id) }}" class="text-blue-600 text-sm font-semibold">Baca Selengkapnya</a>
            </div>
        @else
            <p class="text-gray-500 text-sm">Belum ada konten edukasi.</p>
        @endif
    </div>

    {{-- SECTION 5 — Promo --}}
    <div class="bg-white p-5 rounded-xl shadow mb-6">
        <h2 class="text-lg font-semibold mb-3">Promo Untuk Anda</h2>

        @if(count($promos) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($promos as $promo)
                    <div class="bg-yellow-50 p-4 rounded-lg border">
                        <h3 class="font-bold text-yellow-700">{{ $promo->judul }}</h3>
                        <p class="text-gray-700 text-sm line-clamp-2">{{ $promo->deskripsi }}</p>
                        <a href="{{ route('promo.show', $promo->id) }}" class="text-blue-600 text-sm">Lihat Detail</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-sm">Tidak ada promo saat ini.</p>
        @endif
    </div>

    {{-- SECTION 6 — Navigasi Cepat --}}
    <div class="bg-white p-5 rounded-xl shadow mb-6 text-center">
        <a href="{{ route('menu') }}" class="px-5 py-3 bg-coffee text-white rounded-lg shadow">
            Lihat Menu Sekarang
        </a>
    </div>

</div>
@endsection
