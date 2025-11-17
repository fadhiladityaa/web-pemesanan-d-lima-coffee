@extends('layouts.main')

@section('container')
<div class="text-center pt-24">
    <h1 class="text-2xl font-bold text-green-600">Checkout Berhasil!</h1>
    <p class="mt-4 text-slate-700">Terima kasih atas pesanan Anda. Kami sedang memprosesnya.</p>
    <a href="{{ route('all.about.home') }}" class="mt-6 inline-block px-4 py-2 bg-primary text-white rounded">Kembali ke Beranda</a>
</div>
@endsection
