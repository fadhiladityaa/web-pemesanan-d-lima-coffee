<div class="lg:mb-10">
    {{-- Kategori Menu --}}
    <section>
        <div
            class="category-section mt-32 lg:mt-52 scrollbar-hide flex gap-3 sm:gap-4 overflow-x-auto pb-3 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">

            @foreach ($category as $item)
                <button onclick="getElementById('{{ $item->name }}').scrollIntoView({behavior: 'smooth'})"
                    class="category-item flex-shrink-0 px-5 py-3 bg-white rounded-lg border border-gray-200 hover:border-primary hover:bg-primary/5 hover:text-primary transition-all duration-300 text-slate-700 font-medium shadow-sm">
                    {{ $item->name }}
                </button>
            @endforeach
        </div>
    </section>

    <span id="Coffee"></span>

    {{-- [BARU] SECTION BANNER PROMO (Hanya muncul jika ada promo aktif) --}}
    @if (isset($activePromo) && $activePromo)
        <div
            class="relative top-5 overflow-hidden rounded-xl bg-gradient-to-r from-[#fff8e1] to-[#fff3e0] border border-amber-200 shadow-sm p-4 sm:p-6 mb-20 mt-36 sm:mt-0 animate-fade-in-down">
            {{-- Hiasan Background --}}
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-amber-300 rounded-full opacity-20 blur-2xl">
            </div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                {{-- Info Promo --}}
                <div class="flex items-start gap-4">
                    <div class="p-3 bg-amber-100 text-amber-600 rounded-full shadow-inner shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6 sm:w-8 sm:h-8">
                            <path fill-rule="evenodd"
                                d="M12.963 2.286a.75.75 0 00-1.071-.136 9.742 9.742 0 00-3.539 6.177A7.547 7.547 0 016.648 6.61a.75.75 0 00-1.152-.082A9 9 0 1015.68 4.534a7.46 7.46 0 01-2.717-2.248zM15.75 14.25a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <span
                                class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-white bg-red-500 rounded-md">
                                SEDANG AKTIF
                            </span>
                            <h3 class="font-serif text-lg sm:text-xl font-bold text-[#5c4033]">
                                {{ $activePromo->judul }}
                            </h3>
                        </div>
                        <p class="text-[#8d6e63] text-sm leading-relaxed max-w-lg">
                            {{ $activePromo->deskripsi ?? 'Nikmati harga spesial untuk menu pilihan.' }}
                        </p>
                    </div>
                </div>

                {{-- Tombol Reset (Kembali ke Normal) --}}
                <div class="shrink-0 w-full md:w-auto">
                    <button wire:click="resetFilters"
                        class="w-full md:w-auto group flex items-center justify-center gap-2 px-5 py-2.5 bg-white border border-amber-200 text-[#5c4033] text-sm font-bold rounded-full shadow-sm hover:shadow-md hover:border-amber-400 transition-all duration-300">
                        <span>Lihat Semua Menu</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 group-hover:rotate-180 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif
    {{-- [AKHIR] SECTION BANNER PROMO --}}


    {{-- INPUT PENCARIAN (CODE ASLI) --}}
    <div class="input-gorup flex items-center gap-2 mt-6 absolute top-[9.5rem]">
        <fieldset class="fieldset">
            <input wire:model.live="search" type="text" class="input w-[265px] sm:w-[400px] text-slate-700"
                placeholder="Cari menu" />
        </fieldset>
        <button class="bg-[#C67C4E] w-[54px] h-[45px] flex justify-center items-center rounded-md">
            <img src="{{ asset('img/settings2-svgrepo-com.svg') }}" class="w-7 h-7" alt="search icon" />
        </button>
    </div>

    {{-- HASIL PENCARIAN (Jika ada) --}}
    @if ($search)
        <section
            class="border-l-[5px] border-primary mt-20 pl-5 rounded-[.130rem] shadow-sm w-[16rem] lg:w-[20rem] font-poppins">
            <div class="category-makanan text-black">
                <h2 class="text-md sm:text-3xl flex flex-col text-slate-800 py-3">
                    Cari: "{{ $search }}"
                    @if ($menus->count())
                        <span class="text-ssm italic flex items-center gap-1 text-gray-500">{{ $menus->count() }} hasil
                            ditemukan <img class="w-4 h-4" src="{{ asset('img/check-circle-svgrepo-com.svg') }}"
                                alt=""></span>
                    @endif
                </h2>
            </div>
        </section>

        <div class="grid grid-cols-2 gap-2 mt-7 lg:col-span-2">
            @forelse ($menus as $item)
                {{-- [MODIFIKASI] Menambahkan ID untuk target scroll dan scroll-mt-40 untuk margin atas --}}
                <div id="menu-{{ $item->id }}" class="flex font-poppins flex-col items-start shadow-soft sm:p-5 p-3 lg:p-6 lg:mt-5 lg:w-[22rem] scroll-mt-40">
                    <div class="w-full relative rounded-lg overflow-hidden aspect-[4/4]">
                        <img src="{{ Storage::url($item->gambar) }}"
                            class="w-full h-full object-cover rounded-lg -translate-y-4 hover:scale-110 transition-all duration-500"
                            alt="{{ $item->nama }}">

                        {{-- Badge Kategori --}}
                        <div
                            class="absolute top-2 left-2 bg-primary text-white text-[10px] sm:text-xs font-bold px-2 py-1 rounded-md shadow-md">
                            {{ $item->category->name ?? 'Menu' }}
                        </div>

                        {{-- Badge Diskon --}}
                        @if (isset($activePromo) && $activePromo)
                            <div
                                class="absolute top-2 right-2 bg-red-600 text-white text-[10px] sm:text-xs font-bold px-2 py-1 rounded-md shadow-md animate-pulse">
                                -{{ $activePromo->persentase_diskon }}%
                            </div>
                        @endif
                    </div>

                    <span
                        class="w-full py-1 text-[.6rem] sm:text-[1rem] sm:py-2 rounded-sm text-center {{ $item->pesan == 'Ringan & ramah' ? 'border border-green-500 bg-green-200' : 'border border-yellow-300 bg-yellow-50' }} flex items-center justify-center text-slate-600 gap-1">
                        {{ $item->pesan }}
                        <img src="{{ $item->pesan == 'Ringan & ramah' ? asset('img/check-circle-svgrepo-com.svg') : asset('img/warning-circle-svgrepo-com.svg') }}"
                            class="w-4 h-4 sm:w-6 sm:h-6" alt="">
                    </span>

                    <span
                        class="text-[14px] sm:text-[20px] text-gray-600 sm:mt-2 mt-1 font-semibold">{{ $item->nama_menu }}</span>

                    {{-- Bagian Harga --}}
                    @if (isset($activePromo) && $activePromo)
                        <div class="flex flex-col items-start">
                            <span
                                class="text-gray-400 text-[10px] sm:text-[14px] line-through decoration-red-500 decoration-1">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                            <span class="text-red-600 text-[12px] sm:text-[17px] font-bold">
                                Rp
                                {{ number_format($item->harga - ($item->harga * $activePromo->persentase_diskon) / 100, 0, ',', '.') }}
                            </span>
                        </div>
                    @else
                        <span class="text-primary text-[12px] sm:text-[17px] font-bold">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    @endif

                    <span
                        class="text-[12px] sm:text-[18px] text-black/70">{{ Str::limit($item->deskripsi, 40) }}</span>

                    <div class="button flex flex-col sm:gap-[10px] gap-[5px] w-full mt-2">
                        <a href="{{ route('detail.menu', $item->id) }}">
                            <button
                                class="text-[12px] sm:text-[18px] border sm:border-2 border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary text-slate-800 font-light hover:text-white transition-all duration-500 rounded-[4px]">
                                Lihat detail menu
                            </button>
                        </a>
                        @auth
                            @if (!auth()->user()->isAdmin())
                                <button wire:click="addToCart({{ $item->id }})"
                                    class="text-[12px] sm:text-[18px] text-white bg-primary w-full sm:py-2 p-[5px] font-light rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">
                                    Tambah
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full lg:text-md text-center text-gray-500 italic mt-4">
                    <p>Tidak ada menu yang cocok dengan "{{ $search }}"</p>
                    <button wire:click="resetFilters"
                        class="mt-2 px-4 py-2 bg-primary text-white rounded-full hover:bg-yellow-800 transition-colors duration-300">
                        Kembali ke Semua Menu
                    </button>
                </div>
            @endforelse
        </div>
    @endif

    {{-- TAMPILAN NORMAL PER KATEGORI (Hanya muncul jika tidak ada pencarian) --}}
    @if (!$search)
        {{-- Coffee --}}
        <section class="border-l-[5px] border-primary mt-10 pl-5 rounded-[.130rem] shadow-sm w-[16rem] font-poppins">
            <div class="category-makanan text-black mt-10">
                <h2 class="text-2xl sm:text-3xl text-slate-800 py-3">Coffee</h2>
            </div>
        </section>

        <div class="grid grid-cols-2 gap-2 mt-7 lg:col-span-2">
            @forelse ($coffee as $item)
                {{-- [MODIFIKASI] ID Target untuk Coffee --}}
                <div id="menu-{{ $item->id }}" class="flex font-poppins flex-col items-start shadow-soft sm:p-5 p-3 lg:p-6 lg:mt-5 lg:w-[22rem] scroll-mt-40">
                    <div class="w-full relative rounded-lg overflow-hidden aspect-[4/4]">
                        <img src="{{ Storage::url($item->gambar) }}"
                            class="w-full h-full object-cover rounded-lg -translate-y-4 hover:scale-110 transition-all duration-500"
                            alt="{{ $item->nama }}">

                        {{-- [BARU] Badge Diskon (Jika ada promo aktif) --}}
                        @if (isset($activePromo) && $activePromo)
                            <div
                                class="absolute top-2 right-2 bg-red-600 text-white text-[10px] sm:text-xs font-bold px-2 py-1 rounded-md shadow-md animate-pulse">
                                -{{ $activePromo->persentase_diskon }}%
                            </div>
                        @endif
                    </div>

                    <span
                        class="w-full py-1 text-[.6rem] sm:text-[1rem] sm:py-2 rounded-sm text-center {{ $item->pesan == 'Ringan & ramah' ? 'border border-green-500 bg-green-200' : 'border border-yellow-300 bg-yellow-50' }} flex items-center justify-center text-slate-600 gap-1">{{ $item->pesan }}<img
                            src="{{ $item->pesan == 'Ringan & ramah' ? asset('img/check-circle-svgrepo-com.svg') : asset('img/warning-circle-svgrepo-com.svg') }}"
                            class="w-4 h-4 sm:w-6 sm:h-6" alt=""></span>

                    <span
                        class="text-[14px] sm:text-[20px] text-gray-600 sm:mt-2 mt-1 font-semibold">{{ $item->nama_menu }}</span>

                    {{-- [MODIFIKASI] Bagian Harga (Menangani Diskon) --}}
                    @if (isset($activePromo) && $activePromo)
                        <div class="flex flex-col items-start">
                            {{-- Harga Asli (Coret) --}}
                            <span
                                class="text-gray-400 text-[10px] sm:text-[14px] line-through decoration-red-500 decoration-1">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                            {{-- Harga Diskon --}}
                            <span class="text-red-600 text-[12px] sm:text-[17px] font-bold">
                                Rp
                                {{ number_format($item->harga - ($item->harga * $activePromo->persentase_diskon) / 100, 0, ',', '.') }}
                            </span>
                        </div>
                    @else
                        {{-- Harga Normal (Code Asli) --}}
                        <span class="text-primary text-[12px] sm:text-[17px] font-bold">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    @endif

                    <span
                        class="text-[12px] sm:text-[18px] text-black/70">{{ Str::limit($item->deskripsi, 40) }}</span>

                    <div class="button flex flex-col sm:gap-[10px] gap-[5px] w-full mt-2">
                        <a href="{{ route('detail.menu', $item->id) }}">
                            <button
                                class="text-[12px] sm:text-[18px] border sm:border-2 border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary text-slate-800 font-light hover:text-white transition-all duration-500 rounded-[4px]">
                                Lihat detail menu
                            </button>
                        </a>
                        @auth
                            @if (!auth()->user()->isAdmin())
                                <button wire:click="addToCart({{ $item->id }})"
                                    class="text-[12px] sm:text-[18px] text-white bg-primary w-full sm:py-2 p-[5px] font-light rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">
                                    Tambah
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full lg:text-md text-center text-gray-500 italic mt-4">
                    {{-- [MODIFIKASI] Pesan Kosong lebih informatif saat reset --}}
                    <p>Menu tidak ditemukan.</p>
                    @if (isset($activePromo))
                        <button wire:click="resetFilters"
                            class="mt-2 text-[#947257] text-sm font-bold underline hover:text-[#5c4033]">
                            Kembali ke Semua Menu
                        </button>
                    @endif
                </div>
            @endforelse
        </div>
        {{-- end coffee --}}

        <span id="Non Coffee"></span>
        {{-- Non Coffee --}}
        <section class="border-l-[5px] border-primary mt-20 pl-5 rounded-[.130rem] shadow-sm w-[12rem] font-poppins">
            <div class="category-makanan text-black mt-10">
                <h2 class="text-2xl sm:text-3xl text-slate-800 py-3">Non Coffee</h2>
            </div>
        </section>
        <div class="grid grid-cols-2 gap-2 mt-7 lg:col-span-2">
            @forelse ($non_coffee as $item)
                {{-- [MODIFIKASI] ID Target untuk Non Coffee --}}
                <div id="menu-{{ $item->id }}" class="flex font-poppins flex-col items-start shadow-soft sm:p-5 p-3 lg:p-6 lg:mt-5 lg:w-[22rem] scroll-mt-40">
                    <div class="w-full relative rounded-lg overflow-hidden aspect-[4/4]">
                        <img src="{{ Storage::url($item->gambar) }}"
                            class="w-full h-full object-cover rounded-lg -translate-y-4 hover:scale-110 transition-all duration-500"
                            alt="{{ $item->nama }}">

                        {{-- [BARU] Badge Diskon (Jika ada promo aktif) --}}
                        @if (isset($activePromo) && $activePromo)
                            <div
                                class="absolute top-2 right-2 bg-red-600 text-white text-[10px] sm:text-xs font-bold px-2 py-1 rounded-md shadow-md animate-pulse">
                                -{{ $activePromo->persentase_diskon }}%
                            </div>
                        @endif
                    </div>

                    <span
                        class="w-full py-1 text-[.6rem] sm:text-[1rem] sm:py-2 rounded-sm text-center {{ $item->pesan == 'Ringan & ramah' ? 'border border-green-500 bg-green-200' : 'border border-yellow-300 bg-yellow-50' }} flex items-center justify-center text-slate-600 gap-1">{{ $item->pesan }}<img
                            src="{{ $item->pesan == 'Ringan & ramah' ? asset('img/check-circle-svgrepo-com.svg') : asset('img/warning-circle-svgrepo-com.svg') }}"
                            class="w-4 h-4 sm:w-6 sm:h-6" alt=""></span>

                    <span
                        class="text-[14px] sm:text-[20px] text-gray-600 sm:mt-2 mt-1 font-semibold">{{ $item->nama_menu }}</span>

                    {{-- [MODIFIKASI] Bagian Harga (Menangani Diskon) --}}
                    @if (isset($activePromo) && $activePromo)
                        <div class="flex flex-col items-start">
                            {{-- Harga Asli (Coret) --}}
                            <span
                                class="text-gray-400 text-[10px] sm:text-[14px] line-through decoration-red-500 decoration-1">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                            {{-- Harga Diskon --}}
                            <span class="text-red-600 text-[12px] sm:text-[17px] font-bold">
                                Rp
                                {{ number_format($item->harga - ($item->harga * $activePromo->persentase_diskon) / 100, 0, ',', '.') }}
                            </span>
                        </div>
                    @else
                        {{-- Harga Normal (Code Asli) --}}
                        <span class="text-primary text-[12px] sm:text-[17px] font-bold">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    @endif

                    <span
                        class="text-[12px] sm:text-[18px] text-black/70">{{ Str::limit($item->deskripsi, 40) }}</span>

                    <div class="button flex flex-col sm:gap-[10px] gap-[5px] w-full mt-2">
                        <a href="{{ route('detail.menu', $item->id) }}">
                            <button
                                class="text-[12px] sm:text-[18px] border sm:border-2 border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary text-slate-800 font-light hover:text-white transition-all duration-500 rounded-[4px]">
                                Lihat detail menu
                            </button>
                        </a>
                        @auth
                            @if (!auth()->user()->isAdmin())
                                <button wire:click="addToCart({{ $item->id }})"
                                    class="text-[12px] sm:text-[18px] text-white bg-primary w-full sm:py-2 p-[5px] font-light rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">
                                    Tambah
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full lg:text-md text-center text-gray-500 italic mt-4">
                    {{-- [MODIFIKASI] Pesan Kosong lebih informatif saat reset --}}
                    <p>Menu tidak ditemukan.</p>
                    @if (isset($activePromo))
                        <button wire:click="resetFilters"
                            class="mt-2 text-[#947257] text-sm font-bold underline hover:text-[#5c4033]">
                            Kembali ke Semua Menu
                        </button>
                    @endif
                </div>
            @endforelse
        </div>
        {{-- end non coffee --}}


        <span id="Moctail"></span>
        {{-- mocttail --}}
        <section class="border-l-[5px] border-primary mt-20 pl-5 rounded-[.130rem] shadow-sm w-[12rem] font-poppins">
            <div class="category-makanan text-black mt-10">
                <h2 class="text-2xl sm:text-3xl text-slate-800 py-3">Moctail</h2>
            </div>
        </section>
        <div class="grid grid-cols-2 gap-2 mt-7 lg:col-span-2">
            @forelse ($moctail as $item)
                {{-- [MODIFIKASI] ID Target untuk Moctail --}}
                <div id="menu-{{ $item->id }}" class="flex font-poppins flex-col items-start shadow-soft sm:p-5 p-3 lg:p-6 lg:mt-5 lg:w-[22rem] scroll-mt-40">
                    <div class="w-full relative rounded-lg overflow-hidden aspect-[4/4]">
                        <img src="{{ Storage::url($item->gambar) }}"
                            class="w-full h-full object-cover rounded-lg -translate-y-4 hover:scale-110 transition-all duration-500"
                            alt="{{ $item->nama }}">

                        {{-- [BARU] Badge Diskon (Jika ada promo aktif) --}}
                        @if (isset($activePromo) && $activePromo)
                            <div
                                class="absolute top-2 right-2 bg-red-600 text-white text-[10px] sm:text-xs font-bold px-2 py-1 rounded-md shadow-md animate-pulse">
                                -{{ $activePromo->persentase_diskon }}%
                            </div>
                        @endif
                    </div>

                    <span
                        class="w-full py-1 text-[.6rem] sm:text-[1rem] sm:py-2 rounded-sm text-center {{ $item->pesan == 'Ringan & ramah' ? 'border border-green-500 bg-green-200' : 'border border-yellow-300 bg-yellow-50' }} flex items-center justify-center text-slate-600 gap-1">{{ $item->pesan }}<img
                            src="{{ $item->pesan == 'Ringan & ramah' ? asset('img/check-circle-svgrepo-com.svg') : asset('img/warning-circle-svgrepo-com.svg') }}"
                            class="w-4 h-4 sm:w-6 sm:h-6" alt=""></span>

                    <span
                        class="text-[14px] sm:text-[20px] text-gray-600 sm:mt-2 mt-1 font-semibold">{{ $item->nama_menu }}</span>

                    {{-- [MODIFIKASI] Bagian Harga (Menangani Diskon) --}}
                    @if (isset($activePromo) && $activePromo)
                        <div class="flex flex-col items-start">
                            {{-- Harga Asli (Coret) --}}
                            <span
                                class="text-gray-400 text-[10px] sm:text-[14px] line-through decoration-red-500 decoration-1">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                            {{-- Harga Diskon --}}
                            <span class="text-red-600 text-[12px] sm:text-[17px] font-bold">
                                Rp
                                {{ number_format($item->harga - ($item->harga * $activePromo->persentase_diskon) / 100, 0, ',', '.') }}
                            </span>
                        </div>
                    @else
                        {{-- Harga Normal (Code Asli) --}}
                        <span class="text-primary text-[12px] sm:text-[17px] font-bold">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    @endif

                    <span
                        class="text-[12px] sm:text-[18px] text-black/70">{{ Str::limit($item->deskripsi, 40) }}</span>

                    <div class="button flex flex-col sm:gap-[10px] gap-[5px] w-full mt-2">
                        <a href="{{ route('detail.menu', $item->id) }}">
                            <button
                                class="text-[12px] sm:text-[18px] border sm:border-2 border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary text-slate-800 font-light hover:text-white transition-all duration-500 rounded-[4px]">
                                Lihat detail menu
                            </button>
                        </a>
                        @auth
                            @if (!auth()->user()->isAdmin())
                                <button wire:click="addToCart({{ $item->id }})"
                                    class="text-[12px] sm:text-[18px] text-white bg-primary w-full sm:py-2 p-[5px] font-light rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">
                                    Tambah
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full lg:text-md text-center text-gray-500 italic mt-4">
                    {{-- [MODIFIKASI] Pesan Kosong lebih informatif saat reset --}}
                    <p>Menu tidak ditemukan.</p>
                    @if (isset($activePromo))
                        <button wire:click="resetFilters"
                            class="mt-2 text-[#947257] text-sm font-bold underline hover:text-[#5c4033]">
                            Kembali ke Semua Menu
                        </button>
                    @endif
                </div>
            @endforelse
        </div>
        {{-- end moctail --}}


        <span id="Makanan Ringan"></span>
        {{-- Makanan Ringan --}}
        <section
            class="border-l-[5px] border-primary mt-20 pl-5 rounded-[.130rem] shadow-sm w-[16rem] lg:w-[18rem] font-poppins">
            <div class="category-makanan text-black mt-10">
                <h2 class="text-2xl sm:text-3xl text-slate-800 py-3">Makanan Ringan</h2>
            </div>
        </section>
        <div class="grid grid-cols-2 gap-2 mt-7 lg:col-span-2">
            @forelse ($makanan_ringan as $item)
                {{-- [MODIFIKASI] ID Target untuk Makanan Ringan --}}
                <div id="menu-{{ $item->id }}" class="flex font-poppins flex-col items-start shadow-soft sm:p-5 p-3 lg:p-6 lg:mt-5 lg:w-[22rem] scroll-mt-40">
                    <div class="w-full relative rounded-lg overflow-hidden aspect-[4/4]">
                        <img src="{{ Storage::url($item->gambar) }}"
                            class="w-full h-full object-cover rounded-lg -translate-y-4 hover:scale-110 transition-all duration-500"
                            alt="{{ $item->nama }}">

                        {{-- [BARU] Badge Diskon (Jika ada promo aktif) --}}
                        @if (isset($activePromo) && $activePromo)
                            <div
                                class="absolute top-2 right-2 bg-red-600 text-white text-[10px] sm:text-xs font-bold px-2 py-1 rounded-md shadow-md animate-pulse">
                                -{{ $activePromo->persentase_diskon }}%
                            </div>
                        @endif
                    </div>

                    <span
                        class="w-full py-1 text-[.6rem] sm:text-[1rem] sm:py-2 rounded-sm text-center {{ $item->pesan == 'Ringan & ramah' ? 'border border-green-500 bg-green-200' : 'border border-yellow-300 bg-yellow-50' }} flex items-center justify-center text-slate-600 gap-1">{{ $item->pesan }}<img
                            src="{{ $item->pesan == 'Ringan & ramah' ? asset('img/check-circle-svgrepo-com.svg') : asset('img/warning-circle-svgrepo-com.svg') }}"
                            class="w-4 h-4 sm:w-6 sm:h-6" alt=""></span>

                    <span
                        class="text-[14px] sm:text-[20px] text-gray-600 sm:mt-2 mt-1 font-semibold">{{ $item->nama_menu }}</span>

                    {{-- [MODIFIKASI] Bagian Harga (Menangani Diskon) --}}
                    @if (isset($activePromo) && $activePromo)
                        <div class="flex flex-col items-start">
                            {{-- Harga Asli (Coret) --}}
                            <span
                                class="text-gray-400 text-[10px] sm:text-[14px] line-through decoration-red-500 decoration-1">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                            {{-- Harga Diskon --}}
                            <span class="text-red-600 text-[12px] sm:text-[17px] font-bold">
                                Rp
                                {{ number_format($item->harga - ($item->harga * $activePromo->persentase_diskon) / 100, 0, ',', '.') }}
                            </span>
                        </div>
                    @else
                        {{-- Harga Normal (Code Asli) --}}
                        <span class="text-primary text-[12px] sm:text-[17px] font-bold">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    @endif

                    <span
                        class="text-[12px] sm:text-[18px] text-black/70">{{ Str::limit($item->deskripsi, 40) }}</span>

                    <div class="button flex flex-col sm:gap-[10px] gap-[5px] w-full mt-2">
                        <a href="{{ route('detail.menu', $item->id) }}">
                            <button
                                class="text-[12px] sm:text-[18px] border sm:border-2 border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary text-slate-800 font-light hover:text-white transition-all duration-500 rounded-[4px]">
                                Lihat detail menu
                            </button>
                        </a>
                        @auth
                            @if (!auth()->user()->isAdmin())
                                <button wire:click="addToCart({{ $item->id }})"
                                    class="text-[12px] sm:text-[18px] text-white bg-primary w-full sm:py-2 p-[5px] font-light rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">
                                    Tambah
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full lg:text-md text-center text-gray-500 italic mt-4">
                    {{-- [MODIFIKASI] Pesan Kosong lebih informatif saat reset --}}
                    <p>Menu tidak ditemukan.</p>
                    @if (isset($activePromo))
                        <button wire:click="resetFilters"
                            class="mt-2 text-[#947257] text-sm font-bold underline hover:text-[#5c4033]">
                            Kembali ke Semua Menu
                        </button>
                    @endif
                </div>
            @endforelse
        </div>
        {{-- end makanan ringan --}}


        <span id="Makanan Berat"></span>
        {{-- Makanan Berat --}}
        <section class="border-l-[5px] border-primary mt-20 pl-5 rounded-[.130rem] shadow-sm w-[16rem] font-poppins">
            <div class="category-makanan text-black mt-10">
                <h2 class="text-2xl sm:text-3xl text-slate-800 py-3">Makanan Berat</h2>
            </div>
        </section>
        <div class="grid grid-cols-2 gap-2 mt-7 lg:col-span-2">
            @forelse ($makanan_berat as $item)
                {{-- [MODIFIKASI] ID Target untuk Makanan Berat --}}
                <div id="menu-{{ $item->id }}" class="flex font-poppins flex-col items-start shadow-soft sm:p-5 p-3 lg:p-6 lg:mt-5 lg:w-[22rem] scroll-mt-40">
                    <div class="w-full relative rounded-lg overflow-hidden aspect-[4/4]">
                        <img src="{{ Storage::url($item->gambar) }}"
                            class="w-full h-full object-cover rounded-lg -translate-y-4 hover:scale-110 transition-all duration-500"
                            alt="{{ $item->nama }}">

                        {{-- [BARU] Badge Diskon (Jika ada promo aktif) --}}
                        @if (isset($activePromo) && $activePromo)
                            <div
                                class="absolute top-2 right-2 bg-red-600 text-white text-[10px] sm:text-xs font-bold px-2 py-1 rounded-md shadow-md animate-pulse">
                                -{{ $activePromo->persentase_diskon }}%
                            </div>
                        @endif
                    </div>

                    <span
                        class="w-full py-1 text-[.6rem] sm:text-[1rem] sm:py-2 rounded-sm text-center {{ $item->pesan == 'Ringan & ramah' ? 'border border-green-500 bg-green-200' : 'border border-yellow-300 bg-yellow-50' }} flex items-center justify-center text-slate-600 gap-1">{{ $item->pesan }}<img
                            src="{{ $item->pesan == 'Ringan & ramah' ? asset('img/check-circle-svgrepo-com.svg') : asset('img/warning-circle-svgrepo-com.svg') }}"
                            class="w-4 h-4 sm:w-6 sm:h-6" alt=""></span>

                    <span
                        class="text-[14px] sm:text-[20px] text-gray-600 sm:mt-2 mt-1 font-semibold">{{ $item->nama_menu }}</span>

                    {{-- [MODIFIKASI] Bagian Harga (Menangani Diskon) --}}
                    @if (isset($activePromo) && $activePromo)
                        <div class="flex flex-col items-start">
                            {{-- Harga Asli (Coret) --}}
                            <span
                                class="text-gray-400 text-[10px] sm:text-[14px] line-through decoration-red-500 decoration-1">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                            {{-- Harga Diskon --}}
                            <span class="text-red-600 text-[12px] sm:text-[17px] font-bold">
                                Rp
                                {{ number_format($item->harga - ($item->harga * $activePromo->persentase_diskon) / 100, 0, ',', '.') }}
                            </span>
                        </div>
                    @else
                        {{-- Harga Normal (Code Asli) --}}
                        <span class="text-primary text-[12px] sm:text-[17px] font-bold">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    @endif

                    <span
                        class="text-[12px] sm:text-[18px] text-black/70">{{ Str::limit($item->deskripsi, 40) }}</span>

                    <div class="button flex flex-col sm:gap-[10px] gap-[5px] w-full mt-2">
                        <a href="{{ route('detail.menu', $item->id) }}">
                            <button
                                class="text-[12px] sm:text-[18px] border sm:border-2 border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary text-slate-800 font-light hover:text-white transition-all duration-500 rounded-[4px]">
                                Lihat detail menu
                            </button>
                        </a>
                        @auth
                            @if (!auth()->user()->isAdmin())
                                <button wire:click="addToCart({{ $item->id }})"
                                    class="text-[12px] sm:text-[18px] text-white bg-primary w-full sm:py-2 p-[5px] font-light rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">
                                    Tambah
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full lg:text-md text-center text-gray-500 italic mt-4">
                    {{-- [MODIFIKASI] Pesan Kosong lebih informatif saat reset --}}
                    <p>Menu tidak ditemukan.</p>
                    @if (isset($activePromo))
                        <button wire:click="resetFilters"
                            class="mt-2 text-[#947257] text-sm font-bold underline hover:text-[#5c4033]">
                            Kembali ke Semua Menu
                        </button>
                    @endif
                </div>
            @endforelse
        </div>
        {{-- end makanan berat --}}
    @endif


</div>