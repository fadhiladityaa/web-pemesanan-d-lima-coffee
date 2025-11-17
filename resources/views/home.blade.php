@extends('layouts.main')

@section('container')
    {{-- Location Section --}}
    <section>
        <div class="w-full h-[340px] sm:h-[390px] bg-[#2C2C2C] pt-20 font-poppins text-white">
            <div class="location-grup flex flex-col px-[16px] sm:px-[32px] lg:px-[64px] mt-4">
                <span class="text-[18px] sm:text-[24px]">Location</span>
                <span class="sm:text-[18px]">Jalan Delima, Parepare</span>
                <div class="input-gorup flex items-center gap-2 mt-6">
                    <fieldset class="fieldset">
                        <input type="text" class="input w-[300px] sm:w-[400px]" placeholder="Type here" />
                    </fieldset>
                    <button class="bg-[#C67C4E] w-[54px] h-[45px] flex justify-center items-center rounded-md">
                        <img src="{{ asset('img/settings2-svgrepo-com.svg') }}" class="w-7 h-7" alt="search icon" />
                    </button>
                </div>
                <div class="kotak w-full h-40 sm:h-64 bg-white shadow-md rounded-[10px] border mt-10"></div>
            </div>
        </div>
    </section>

    <div class="rounded-full p-5 bg-primary fixed right-3 bottom-24">
        <div class="text-white font-poppins font-semibold rounded-full w-6 h-6 top-0 -left-1 flex items-center justify-center text-[0.650rem] absolute bg-red-600">1</div>
        <img class="h-7" src="{{ asset('img/cart-arrow-down-svgrepo-com.svg') }}" alt="">
    </div>


    {{-- Kategori Menu --}}
    <section>
        <div class="mt-28 sm:mt-44 w-full px-[16px] sm:px-[32px] lg:px-[64px] font-poppins">
            <div class="category-section text-black flex gap-5 text-ssm sm:text-lg mt-6">
                <div class="semua-menu bg-primary px-4 py-1 rounded-[10px] shadow-soft text-white">semua menu</div>
                <div class="semua-menu px-4 py-1 rounded-[10px] text-slate-700 shadow-soft">makanan</div>
                <div class="semua-menu px-4 py-1 rounded-[10px] text-slate-700 shadow-soft">minuman</div>
            </div>
        </div>
    </section>

    {{-- Judul Section --}}
    <section class="px-[16px] sm:px-[32px] font-poppins lg:px-[64px]">
        <div class="category-makanan text-black mt-10">
            <h2 class="text-2xl sm:text-3xl text-slate-800">makanan</h2>
        </div>
    </section>

    {{-- Grid Produk dan Keranjang --}}
    <div class="container-asli lg:grid lg:grid-cols-3 gap-2">
        {{-- Produk --}}
        <section class="px-[16px] lg:col-span-2 sm:px-[32px] lg:pl-[64px] lg:pr-0">
            <livewire:products />
        </section>

        {{-- Keranjang --}}
        <section>
            <div class="w-full px-[16px] sm:px-[32px] lg:px-0 lg:pr-[64px] mt-9 lg:mt-5 font-poppins lg:sticky top-24">
                <livewire:cart />
            </div>
        </section>
    </div>
@endsection
