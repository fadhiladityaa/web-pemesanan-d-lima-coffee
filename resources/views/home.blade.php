@extends('layouts.main')

@section('container')
    {{-- Location Section --}}
    <section>
        <div class="container w-full h-[340px] bg-[#2C2C2C] pt-20 font-poppins text-white">
            <div class="location-grup flex mt-4 flex-col px-[16px]">
                <span class="text-[18px]">Location</span>
                <span>Jalan Delima, Parepare</span>
                <div class="input-gorup flex items-center gap-2  mt-6">
                    <fieldset class="fieldset">
                        <input type="text" class="input w-[300px]" placeholder="Type here" />
                    </fieldset>
                    <button class="bg-[#C67C4E] w-[54px] h-[45px] flex justify-center items-center rounded-md">
                        <img src="{{ asset('img/settings2-svgrepo-com.svg') }}" class="w-7 h-7" alt="search icon" />
                    </button>
                </div>
                <div class="kotak w-full h-40 bg-white shadow-md rounded-[10px] border mt-10"></div>
                <div class="category-section text-black flex gap-3 mt-6">
                    <div class="semua-menu bg-primary px-2 py-1 rounded-[10px] text-white">Semua menu</div>
                    <div class="semua-menu px-3 py-1 rounded-[10px] shadow-md">Makanan</div>
                    <div class="semua-menu px-4 py-1 rounded-[10px] shadow-md">Minuman</div>
                </div>
                <div class="category-makanan text-black mt-10">
                    <h2 class="text-2xl">Makanan</h2>

                    <div class="card-container  grid grid-cols-2 gap-6 mb-[100px] mt-6 w-full">
                        <div class="item-container flex flex-col items-start rounded-md shadow-soft p-3">
                            <img src="{{ asset('img/contoh-kopi.png') }}" alt="">
                            <span class="text-[17px] mt-1">Espresso</span>
                            <span class="text-primary text-[17px] font-bold">Rp. 20.000</span>
                            <span class="text-[12px] text-black/50">Espresso single shot pekat dan kuat</span>

                            <div class="button  flex flex-col gap-[5px] w-full mt-2">
                                <button class="text-[12px] border border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary hover:text-white transition-all duration-500 rounded-[4px]">Lihat
                                    detail menu</button>
                                <button class="text-[12px] text-white bg-primary w-full p-[5px] rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">Tambah</button>
                            </div>
                        </div>
                        <div class="item-container flex flex-col items-start rounded-md shadow-soft p-3">
                            <img src="{{ asset('img/contoh-kopi.png') }}" alt="">
                            <span class="text-[17px] mt-1">Espresso</span>
                            <span class="text-primary text-[17px] font-bold">Rp. 20.000</span>
                            <span class="text-[12px] text-black/50">Espresso single shot pekat dan kuat</span>

                            <div class="button  flex flex-col gap-[5px] w-full mt-2">
                                <button class="text-[12px] border border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary hover:text-white transition-all duration-500 rounded-[4px]">Lihat
                                    detail menu</button>
                                <button class="text-[12px] text-white bg-primary w-full p-[5px] rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">Tambah</button>
                            </div>
                        </div>
                        <div class="item-container flex flex-col items-start rounded-md shadow-soft p-3">
                            <img src="{{ asset('img/contoh-kopi.png') }}" alt="">
                            <span class="text-[17px] mt-1">Espresso</span>
                            <span class="text-primary text-[17px] font-bold">Rp. 20.000</span>
                            <span class="text-[12px] text-black/50">Espresso single shot pekat dan kuat</span>

                            <div class="button  flex flex-col gap-[5px] w-full mt-2">
                                <button class="text-[12px] border border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary hover:text-white transition-all duration-500 rounded-[4px]">Lihat
                                    detail menu</button>
                                <button class="text-[12px] text-white bg-primary w-full p-[5px] rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">Tambah</button>
                            </div>
                        </div>
                        <div class="item-container flex flex-col items-start rounded-md shadow-soft p-3">
                            <img src="{{ asset('img/contoh-kopi.png') }}" alt="">
                            <span class="text-[17px] mt-1">Espresso</span>
                            <span class="text-primary text-[17px] font-bold">Rp. 20.000</span>
                            <span class="text-[12px] text-black/50">Espresso single shot pekat dan kuat</span>

                            <div class="button  flex flex-col gap-[5px] w-full mt-2">
                                <button class="text-[12px] border border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary hover:text-white transition-all duration-500 rounded-[4px]">Lihat
                                    detail menu</button>
                                <button class="text-[12px] text-white bg-primary w-full p-[5px] rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Location Section --}}
@endsection
