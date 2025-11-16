<div class="grid grid-cols-2 gap-2 lg:col-span-2">
    @foreach ($menus as $item)
        <div class="flex font-poppins flex-col items-start rounded-lg shadow-soft sm:p-5 p-3 lg:mt-5 lg:w-[22rem]">
            <div class="w-full relative rounded-lg overflow-hidden sm:h-48">
                <img src="{{ asset('img/contoh-kopi.png') }}"
                    class="w-full sm:rounded-lg sm:h-48 sm:object-cover hover:scale-110 transition-all duration-500"
                    alt="">
            </div>
            <span class="text-[14px] sm:text-[20px] text-slate-800 sm:mt-2 mt-1">{{ $item->nama_menu }}</span>
            <span class="text-primary text-[12px] sm:text-[17px] font-bold">Rp. {{ $item->harga }}</span>
            <span class="text-[12px] sm:text-[18px] text-black/50">{{ $item->deskripsi }}</span>
    
            <div class="button flex flex-col sm:gap-[10px] gap-[5px] w-full mt-2">
                <button class="text-[12px] sm:text-[18px] border sm:border-2 border-[#CE8F69]/50 w-full p-[5px] hover:bg-primary text-slate-800 font-light hover:text-white transition-all duration-500 rounded-[4px]">
                    Lihat detail menu
                </button>
                <button wire:click="addToCart({{ $item->id }})"
                    class="text-[12px] sm:text-[18px] text-white bg-primary w-full p-[5px] font-light rounded-[4px] hover:bg-yellow-800 transition-colors duration-500">
                    Tambah
                </button>
            </div>
        </div>
    @endforeach
</div>
