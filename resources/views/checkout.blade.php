@extends('layouts.main')

@section('container')
<div class="px-6 sm:px-12 lg:px-24 py-12 font-poppins pt-24">
    <h1 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-8">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        {{-- Form Alamat & Data Pembeli --}}
        <section class="bg-white shadow-soft rounded-lg p-6 space-y-6">
            <h2 class="text-xl font-semibold text-slate-700">Data Pembeli</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600">Nama Lengkap</label>
                    <input type="text" class="w-full border rounded-md px-3 py-2 mt-1 focus:ring focus:ring-primary" placeholder="Masukkan nama anda">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600">Email</label>
                    <input type="email" class="w-full border rounded-md px-3 py-2 mt-1 focus:ring focus:ring-primary" placeholder="Masukkan email anda">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600">Nomor Telepon</label>
                    <input type="text" class="w-full border rounded-md px-3 py-2 mt-1 focus:ring focus:ring-primary" placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600">Alamat Pengiriman</label>
                    <textarea class="w-full border rounded-md px-3 py-2 mt-1 focus:ring focus:ring-primary" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600">Metode Pembayaran</label>
                    <select class="w-full border rounded-md px-3 py-2 mt-1 focus:ring focus:ring-primary">
                        <option>Pilih metode</option>
                        <option>Transfer Bank</option>
                        <option>OVO</option>
                        <option>DANA</option>
                        <option>GoPay</option>
                    </select>
                </div>
            </div>
        </section>

       {{-- Ringkasan Pesanan --}}
<aside class="bg-white shadow-md rounded-lg p-6 space-y-6">
    <h2 class="text-xl font-semibold text-slate-700">Ringkasan Pesanan</h2>
    <div class="space-y-4">
        {{-- Item Pesanan --}}
        <div class="border-b pb-3">
            <div class="flex justify-between items-center">
                <span class="text-slate-700 font-medium">Brown Sugar x1</span>
                <span class="font-semibold text-primary">Rp 25.000</span>
            </div>
            {{-- Opsi tambahan --}}
            <div class="mt-1 pl-4 text-sm text-gray-500 space-y-1">
                <div class="flex justify-between">
                    <span>+ Susu</span>
                    <span>Rp 5.000</span>
                </div>
                <div class="flex justify-between">
                    <span>+ Extra Ice</span>
                    <span>Rp 2.000</span>
                </div>
            </div>
        </div>

        <div class="border-b pb-3">
            <div class="flex justify-between items-center">
                <span class="text-slate-700 font-medium">Latte x2</span>
                <span class="font-semibold text-primary">Rp 40.000</span>
            </div>
            {{-- Opsi tambahan --}}
            <div class="mt-1 pl-4 text-sm text-gray-500">
                <span>+ Oat Milk</span>
                <span class="float-right">Rp 6.000</span>
            </div>
        </div>
    </div>

    {{-- Akumulasi --}}
    <div class="space-y-2 pt-4 border-t">
        <div class="flex justify-between text-slate-600">
            <span>Subtotal</span>
            <span>Rp 78.000</span>
        </div>
        <div class="flex justify-between text-slate-600">
            <span>Pajak (10%)</span>
            <span>Rp 7.800</span>
        </div>
        <div class="flex justify-between text-lg font-bold text-slate-800 pt-2 border-t">
            <span>Total</span>
            <span class="text-primary">Rp 85.800</span>
        </div>
    </div>

    {{-- Tombol Checkout --}}
    <button class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-md transition-all duration-300">
        Konfirmasi & Bayar
    </button>
</aside>

    </div>
</div>
@endsection
