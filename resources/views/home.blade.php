@extends('layouts.main')

@section('container')
    {{-- Location Section --}}
    <section>
        <div x-data="{ info: 'Location' }" class="w-full h-[340px] sm:h-[390px] lg:h-[500px] bg-[#2C2C2C] pt-20 font-poppins text-white">
            <div class="location-grup flex flex-col px-[16px] sm:px-[32px] lg:px-[64px] mt-4">
                <span x-text="info" class="text-[18px] sm:text-[24px]"></span>
                <span class="sm:text-[18px]">Jalan Delima, Parepare</span>
                <!-- Container dengan aspect ratio 16:9 -->
                <div
                    class="kotak w-full lg:w-4/5 lg:mx-auto h-40 lg:h-96 sm:h-64 bg-white rounded-xl shadow-lg border border-gray-200 mt-[7rem] overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    <img src="{{ asset('img/promo_5.png') }}" alt="Banner Lokasi"
                        class="w-full h-full object-cover object-center" <!-- object-center bisa diganti: object-top,
                        object-bottom, object-left, dll -->
                    >
                </div>

            </div>
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
            <div class="w-full sm:px-[32px] lg:px-0 lg:pr-[64px] mt-9 lg:mt-5 font-poppins lg:sticky top-24">
                <livewire:cart />
            </div>
        </section>
    </div>
@endsection
