@extends('layouts.main')

@section('container')
    {{-- Location Section --}}
    <section>
        <div class="container w-full h-80 bg-[#2C2C2C] pt-20 font-poppins text-white">
            <div class="location-grup flex flex-col px-[16px]">
                <span class="text-[18px]">Location</span>
                <span>Jalan Delima, Parepare</span>
                <div class="input-gorup flex items-center gap-2  mt-6">
                    <fieldset class="fieldset">
                        <input type="text" class="input w-[300px]" placeholder="Type here" />
                    </fieldset>
                    <button class="bg-[#947257] w-[54px] h-[45px] flex justify-center items-center rounded-md">
                        <img src="{{ asset('img/settings2-svgrepo-com.svg') }}" class="w-7 h-7" alt="search icon" />
                    </button>
                </div>
                {{-- <div class="w-full border border-black flex justify-center mt-6"> --}}
                    <div class="kotak w-full h-40 bg-white rounded-md border mt-10 border-black">
                {{-- </div> --}}
            </div>
            </div>
        </div>
    </section>
    {{-- End Location Section --}}
@endsection
