@extends('layouts.main')

@section('container')
    {{-- Location Section --}}
    <section>
        <div class="w-full h-[340px] sm:w-full sm:h-[390px] bg-[#2C2C2C] pt-20 font-poppins text-white">
            <div class="location-grup flex mt-4 flex-col px-[16px] sm:px-[32px] lg:px-[64px]">
                <span class="text-[18px] sm:text-[24px]">Location</span>
                <span class="sm:text-[18px]">Jalan Delima, Parepare</span>
                <div class="input-gorup flex items-center gap-2  mt-6">
                    <fieldset class="fieldset">
                        <input type="text" class="input w-[300px] sm:w-[400px]" placeholder="Type here" />
                    </fieldset>
                    <button class="bg-[#C67C4E] w-[54px] h-[45px] flex justify-center items-center rounded-md">
                        <img src="{{ asset('img/settings2-svgrepo-com.svg') }}" class="w-7 h-7" alt="search icon" />
                    </button>
                </div>
                <div class="kotak w-full h-40 sm:h-64 bg-white shadow-md rounded-[10px] border mt-10"></div>
    </section>
    {{-- End Location Section --}}


    {{-- daftar menu section --}}
    <section>
        <div class=" mt-28 sm:mt-44 w-full px-[16px] sm:px-[32px] lg:px-[64px] font-poppins">
            <div class="category-section text-black flex gap-5 text-ssm sm:text-lg mt-6">
                <div class="semua-menu bg-primary px-4 py-1 rounded-[10px] shadow-soft text-white">semua menu</div>
                <div class="semua-menu px-4 py-1 rounded-[10px] text-slate-700 shadow-soft">makanan</div>
                <div class="semua-menu px-4 py-1 rounded-[10px] text-slate-700 shadow-soft">minuman</div>
            </div>
    </section>

    <section class="px-[16px] sm:px-[32px] font-poppins lg:px-[64px]">
        <div class="category-makanan text-black mt-10">
            <h2 class="text-2xl sm:text-3xl text-slate-800">makanan</h2>
            <div class="card-container grid grid-cols-2 gap-6 mt-6 w-full">
    </section>

<div class="container-asli lg:grid lg:grid-cols-3 lg:gap-8">
    <section class="grid grid-cols-2 lg:col-span-2 px-[16px] gap-2 sm:px-[32px] lg:pl-[64px] lg:pr-0">
        @foreach ($menus as $item)
            {{-- item container --}}
            <div class="flex font-poppins flex-col items-start rounded-lg shadow-soft sm:p-5 p-3 lg:mt-5 lg:w-[22rem]">
                <div class="w-full relative rounded-lg overflow-hidden sm:h-48">
                    <img src="{{ asset('img/contoh-kopi.png') }}"
                        class="w-full sm:rounded-lg sm:h-48 sm:object-cover hover:scale-110 transition-all duration-500"
                        alt="">
                </div>
                <span class="text-[14px] sm:text-[20px] text-slate-800 sm:mt-2 mt-1">{{ $item->nama_menu }}</span>
                <span class="text-primary text-[12px] sm:text-[17px] font-bold">Rp. {{ $item->harga }}</span>
                <span class="text-[12px] sm:text-[18px] text-black/50">{{ $item->deskripsi }}</span>

                <div class="button  flex flex-col sm:gap-[10px] gap-[5px] w-full mt-2">
                    <button
                        class="text-[12px] sm:text-[18px] border sm:border-2 border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary text-slate-800 font-light hover:text-white transition-all duration-500 rounded-[4px]">Lihat
                        detail menu</button>
                    <button
                        class="text-[12px] sm:text-[18px] text-white bg-primary w-full p-[5px] font-light rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">Tambah</button>
                </div>
            </div>
            {{-- end item container --}}
        @endforeach
    </section>
    {{-- end daftar menu section --}}

    {{-- keranjang section --}}
    <section>
        <div class="w-full px-[16px] sm:px-[32px] lg:px-0 lg:pr-[64px]  mt-9 lg:mt-5 font-poppins lg:sticky lg:top-">
            <div class="cart-container w-full shadow-medium rounded-md p-[16px]">
                <div class="topper-container flex justify-between">
                    <h2 class="sm:text-[1.7rem]">Keranjang</h2>
                    <span class="border flex items-center rounded-full px-3 text-ssm lg:text-sm border-primary">2 items</span>
                </div>
                <div class="cart-items-container mt-4">
                    {{-- cart item --}}
                    <div class="items-container bg-[#E8E8E8] mt-2 sm:mt-6 shadow-md rounded-md text-slate-800 p-3 lg:p-2 flex justify-between">
                        <img src="{{ asset('img/contoh-kopi-2.png') }}" class="sm:w-36 lg:w-24 lg:h-24" alt="contoh kopi">
                        <div class="pricing-container flex sm:mt-1 sm:mr-[15rem] lg:mr-0 flex-col lg:mt-0 lg:ml-2 lg:gap-1 gap-2">
                            <span class="text-[18px] sm:text-[1.4rem] lg:text-[1.2rem]">Espresso</span>
                            <span class="text-[14px]  sm:text-[1.3rem] lg:text-[.8rem]">20.000 x 1 = <span class="text-primary font-bold">Rp.
                                    20.0000</span></span>
                            <div class="counter-container flex gap-3 mt-2">
                                <span class="px-3 sm:px-5 sm:py-[0.1rem] lg:px-3 cursor-pointer sm:text-lg rounded-[4px] bg-[#CACACA]">+</span>
                                <span class="sm:text-lg">1</span>
                                <span class="px-3 sm:px-5 sm:py-[0.1rem] sm:text-lg  lg:px-3 rounded-[4px] cursor-pointer bg-[#CACACA]">-</span>
                            </div>
                        </div>
                        <span class="text-red-500 sm:text-3xl cursor-pointer">×</span>
                    </div>
                    {{-- end cart item --}}

                    <div class="akumulasi-container mt-5 flex flex-col gap-3">
                        <hr>
                        <div class="subtotal-container sm:text-xl flex justify-between">
                            <span>Subtotal</span>
                            <span>Rp. 40.000</span>
                        </div>

                        <div class="pajak-container sm:text-xl flex justify-between">
                            <span>Pajak (0%)</span>
                            <span>Rp. 0</span>
                        </div>
                        <hr>

                        <div class="total-container sm:text-2xl flex justify-between">
                            <span>Total</span>
                            <span class="text-primary font-bold">Rp. 40.000</span>
                        </div>

                        <button
                            class="w-full bg-green-500 py-2 rounded-md text-white hover:bg-green-600 transition-all sm:text-2xl sm:mt-2  duration-300">Checkout</button>
                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- end keranjang section --}}
 </div>
@endsection
