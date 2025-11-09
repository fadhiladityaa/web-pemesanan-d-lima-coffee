@extends('layouts.main')

@section('container')
    {{-- Location Section --}}
    <section>
        <div class="container w-full h-80 bg-[#2C2C2C] pt-20 font-poppins text-white">
            <div class="location-grup flex gap-2 flex-col px-[16px]">
                <span>Location</span>
                <span>Jalan Delima, Parepare</span>
                <div class="input-gorup flex">
                    <fieldset class="fieldset">
                        <input type="text" class="input" placeholder="Type here" />
                    </fieldset>
                    <button>Cari</button>
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
