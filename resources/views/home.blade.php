@extends('layouts.main')

@section('container')
    {{-- hero section --}}
    <div class="hero-section  font-poppins relative flex bg-center sm:bg-bottom items-start lg:h-screen lg:bg-bottom ">
        <img src="{{ asset('img/hero.png') }}" class="lg:bg-cover relative brightness-90 -z-10 lg:-top-32" alt="">
        <div
            class="text pt-12 sm:pt-[7rem] pl-7 text-xl absolute font-semibold text-white w-72 sm:text-3xl sm:w-2/3 lg:text-5xl lg:pt-28 lg:leading-tight">
            <h1>Sambut hangatnya <span class="text-primary sm:text-red-300">ngopi</span> bersama kami</h1>
            <p class="font-extralight text-sm sm:text-lg lg:text-3xl">Rasakan hangatnya kopi dimanapun anda berada</p>
            <a class="text-sm bg-primary px-5 py-2 rounded-lg mt-3 absolute sm:text-lg lg:mt-5 lg:text-2xl"
                href="/#menu">
                Beli Sekarang
            </a>
        </div>
    </div>
    {{-- end hero section --}}

    {{-- about section --}}
    <div class="bg-black -mt-1 font-poppins pt-14 pb-8 text-white flex-col sm:items-center">
        <h1 class="text-lg font-bold text-center text-white sm:text-3xl">
            <span class="text-primary">Tentang</span> Kami
        </h1>

        <div class="content flex flex-col items-center p-3 gap-2 sm:flex-row sm:justify-center sm:gap-6">
            <div class="img-wrapper pt-1">
                <img class="w-60 sm:w-72" src="img/about.png" alt="">
            </div>
            <div class="text-wrapper flex flex-col items-start gap-1 w-60 sm:w-72 mt-7 text-justify">
                <h2 class="text-sm text-center sm:text-xl">
                    Kenapa Memilih Kopi Kami?
                </h2>
                <p class="font-extralight text-ssm sm:text-mmd sm:text-justify">
                    karena dipilih langsung dari biji kopi berkualitas tinggi,
                </p>

                <p class="font-extralight text-ssm sm:text-justify sm:text-mmd">
                    memastikan setiap pelanggan tidak hanya menikmati kopi yang lezat, tetapi juga memahami kandungannya
                    dan memilih kopi yang tepat untuk kebutuhan pelanggan.
                </p>
            </div>
        </div>
    </div>
    {{-- end about section --}}

    {{-- menu section --}}
    <div id="menu" class="bg-black  -mt-1 text-white font-poppins  flex items-center flex-col pb-32 pt-28">
        <div class="w-52 sm:w-72 text-sm text-center">
            <h1 class="text-center font-bold text-lg  text-white sm:text-3xl "><span class="text-primary ">Menu</span>
                Kami</h1>
            <h2 class="font-extralight text-ssm sm:text-mmd sm:mb-3  mt-2">Memastikan menu yang tersedia adalah yang
                terbaik</h2>
            <h2 class="font-extralight text-ssm sm:text-mmd sm:mb-3 pb-24 mt-2"></h2>
        </div>


        <div
            class="card-container gap-3 mt-5 flex flex-col sm:flex-row sm:flex-wrap sm:items-center sm:justify-center sm:gap-3">
            @foreach ($menus as $menu)
                <div 
                    class="card bg-secondary font-poppins text-menu font-bold flex flex-row gap-4 pt-4 pl-4 pr-6 pb-4">
                    <div class="kiri w-24 flex flex-col justify-center">
                        @if ($menu->gambar)
                            <img class="w-24" src="{{ asset('storage/' . $menu->gambar) }}" alt="">
                        @else
                            <img class="w-24" src="img/kopi-1.png" alt="">
                        @endif


                        <div class="counter text-black flex mx-auto mt-4 font-normal">
                            <button class="px-2.5 py-0 border border-slate-500 rounded-lg">-</button>
                            <span class="px-2.5 py-0 border border-slate-500 rounded-lg">0</span>
                            <button @click="$store.data.test"
                                class="px-2.5 py-0 border border-slate-500 rounded-lg">+</button>
                        </div>
                    </div>

                    <div class="kanan w-44">
                        <div class="nama-menu flex justify-between mt-1.5">
                            <h3 class="text-sm">{{ $menu->nama_menu }}</h3>
                            <h3></h3>
                            <p class="text-primary">Rp.{{ $menu->harga }}</p>
                        </div>

                        <div class="deskripsi text-ssm font-extralight mt-1">
                            <p>{{ $menu->deskripsi }}</p>
                        </div>

                        <div class="level text-ssm text-black font-light flex gap-x-1.5 mt-2">
                            <span class="bg-white px-2 py-1 rounded-xl hover:bg-primary hover:text-white">Sweet</span>
                            <span class="bg-white px-2 py-1 rounded-xl hover:bg-primary hover:text-white">Medium</span>
                            <span class="bg-white px-2 py-1 rounded-xl hover:bg-primary hover:text-white">Strong</span>
                        </div>

                            <button x-data @click.prevent="addToCart({{ json_encode($menu) }})"  type="button"
                                class="bg-primary font-normal w-full rounded-2xl py-2 mt-3 text-white hover:bg-amber-800">
                                Add To Cart
                            </button>
                    </div>
                </div>
            @endforeach
        </div>


        {{-- contact section --}}
        <section class="py-16 bg-gray-800  mt-28 rounded-md">
            <div class="container mx-auto px-4 items-center">
                <h2 class="text-3xl font-semibold text-primary mx-auto text-center mb-8 ">Hubungi <span
                        class="text-white">Kami</span></h2>
                <div class="flex flex-col lg:flex-row gap-12 mt-12">
                    <!-- Info Kontak -->
                    <div class="lg:w-1/3">
                        <div class="bg-gray-700 p-8 rounded-lg shadow-lg">
                            <h3 class="text-xl font-bold text-primary mb-6">Informasi Kontak</h3>

                            <div class="space-y-6">
                                <!-- Alamat -->
                                <div class="flex items-start">
                                    <div class="bg-primary bg-opacity-20 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-primary-100">Warkop Delima</h4>
                                        <p class="text-gray-300 mt-1">Jl. Abdul Kadir Parepare</p>
                                    </div>
                                </div>

                                <!-- Telepon -->
                                <div class="flex items-start">
                                    <div class="bg-primary bg-opacity-20 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-primary-100">Telepon</h4>
                                        <p class="text-gray-300 mt-1">(024) 1234 5678</p>
                                        <p class="text-gray-300">0812 3456 7890 (WhatsApp)</p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="flex items-start">
                                    <div class="bg-primary bg-opacity-20 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-primary-100">Email</h4>
                                        <p class="text-gray-300 mt-1">info@warkopdelima.com</p>
                                    </div>
                                </div>

                                <!-- Jam Buka -->
                                <div class="flex items-start">
                                    <div class="bg-primary bg-opacity-20 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-primary-100">Jam Operasional</h4>
                                        <p class="text-gray-300 mt-1">Senin - Jumat: 08.00 - 22.00</p>
                                        <p class="text-gray-300">Sabtu - Minggu: 07.00 - 23.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Kontak -->
                    <div class="lg:w-2/3">
                        <div class="bg-gray-700 p-8 rounded-lg shadow-lg h-full">
                            <h3 class="text-xl font-bold text-primary mb-6">Kirim Pesan</h3>
                            <form class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="name" class="block text-primary-100 mb-2">Nama Lengkap</label>
                                        <input type="text" id="name"
                                            class="w-full px-4 py-3 rounded bg-gray-600 border border-gray-500 focus:border-primary focus:ring-2 focus:ring-primary focus:outline-none text-primary-100 placeholder-gray-400">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-primary-100 mb-2">Alamat Email</label>
                                        <input type="email" id="email"
                                            class="w-full px-4 py-3 rounded bg-gray-600 border border-gray-500 focus:border-primary focus:ring-2 focus:ring-primary focus:outline-none text-primary-100 placeholder-gray-400">
                                    </div>
                                </div>

                                <div>
                                    <label for="subject" class="block text-primary-100 mb-2">Subjek</label>
                                    <input type="text" id="subject"
                                        class="w-full px-4 py-3 rounded bg-gray-600 border border-gray-500 focus:border-primary focus:ring-2 focus:ring-primary focus:outline-none text-primary-100 placeholder-gray-400">
                                </div>

                                <div>
                                    <label for="message" class="block text-primary-100 mb-2">Pesan Anda</label>
                                    <textarea id="message" rows="5"
                                        class="w-full px-4 py-3 rounded bg-gray-600 border border-gray-500 focus:border-primary focus:ring-2 focus:ring-primary focus:outline-none text-primary-100 placeholder-gray-400"></textarea>
                                </div>

                                <div>
                                    <button type="submit"
                                        class="px-8 py-3 bg-primary hover:bg-primary-dark text-white font-medium rounded transition-colors w-full md:w-auto">Kirim
                                        Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- end contact section --}}
    </div>
    @endsection
