<div class="lg:mb-10">
    <div class="input-gorup flex items-center gap-2 mt-6 absolute top-[9.5rem]">
        <fieldset class="fieldset">
            <input wire:model.live="search" type="text" class="input w-[300px] sm:w-[400px] text-slate-700"
                placeholder="Cari menu" />
        </fieldset>
        <button class="bg-[#C67C4E] w-[54px] h-[45px] flex justify-center items-center rounded-md">
            <img src="{{ asset('img/settings2-svgrepo-com.svg') }}" class="w-7 h-7" alt="search icon" />
        </button>
    </div>

    <div class="grid grid-cols-2 gap-2 mt-7 lg:col-span-2">
        @forelse ($menus as $item)

        {{-- {{dd($item->warning)}} --}}
            <div
                class="flex font-poppins flex-col items-start rounded-lg shadow-soft sm:p-5 p-3 lg:p-6 lg:mt-5 lg:w-[22rem]">
                <div class="w-full relative rounded-lg overflow-hidden aspect-[4/4]">
                    <img src="{{ asset('img/kopi-susu.jpg') }}"
                        class="w-full h-full object-cover -translate-y-4 hover:scale-110 transition-all duration-500"
                        alt="{{ $item->nama }}">
                </div>

                <span class="w-full py-1 text-[.6rem] rounded-sm text-center {{ $item->pesan == 'Ringan & ramah' ? 'border border-green-500 bg-green-200' : 'border border-yellow-300 bg-yellow-50' }} flex items-center justify-center text-slate-600 gap-1">{{ $item->pesan }}<img src="{{ $item->pesan == 'Ringan & ramah' ? asset('img/check-circle-svgrepo-com.svg') : asset('img/warning-circle-svgrepo-com.svg') }}" class="w-4 h-4" alt=""></span>

                <span class="text-[14px] sm:text-[20px] text-gray-600 sm:mt-2 mt-1 font-semibold">{{ $item->nama_menu }}</span>
                <span class="text-primary text-[12px] sm:text-[17px] font-bold">Rp
                    {{ number_format($item->harga, 0, ',', '.') }}</span>
                <span class="text-[12px] sm:text-[18px] text-black/70">{{ Str::limit($item->deskripsi, 40) }}</span>

                <div class="button flex flex-col sm:gap-[10px] gap-[5px] w-full mt-2">
                    <a href="{{ route('detail.menu', $item->id) }}">
                        <button
                            class="text-[12px] sm:text-[18px] border sm:border-2 border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary text-slate-800 font-light hover:text-white transition-all duration-500 rounded-[4px]">
                            Lihat detail menu
                        </button>
                    </a>
                    <button wire:click="addToCart({{ $item->id }})"
                        class="text-[12px] sm:text-[18px] text-white bg-primary w-full p-[5px] font-light rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">
                        Tambah
                    </button>


                </div>
            </div>
        @empty
            <div class="col-span-full lg:text-md text-center text-gray-500 italic mt-4">
                Menu tidak ditemukan.
            </div>
        @endforelse
    </div>
</div>
