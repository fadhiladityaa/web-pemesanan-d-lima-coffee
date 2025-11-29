<div class="shadow-soft p-5 rounded-lg mt-12 lg:max-h-[80vh] overflow-y-auto mb-20">
    <div class="flex justify-between">
        <h2 id="otw" class="sm:text-[1.7rem] lg:text-[1.3rem]">Keranjang</h2>
        <span
            class="flex items-center rounded-full px-4 py-1 text-sm bg-primary/10 text-primary font-medium border border-primary/20">
            {{ optional($cart)->cart_items?->count() ?? 0 }} items

        </span>
    </div>

    <div class="cart-items-container mt-4">
        @if($cart && $cart->cart_items && $cart->cart_items->count())
            @foreach($cart->cart_items as $item)
                <div
                    class="items-container bg-primary/5 transition-all duration-150 hover:bg-[#E8E8E8] mt-2 sm:mt-6 shadow-md rounded-md text-slate-800 p-3 lg:p-3 flex">
                    {{-- gambar produk --}}
                    <img src="{{ Storage::url($item->daftar_menu->gambar) }}"
                         class="w-24 h-24 mr-3 sm:w-36 rounded-lg lg:w-20 lg:h-20"
                         alt="{{ $item->daftar_menu->nama }}">

                    {{-- detail harga --}}
                    <div class="pricing-container flex sm:mt-1 sm:mr-[15rem] lg:mr-0 flex-col lg:mt-0 lg:ml-2 lg:gap-1 gap-1">
                        <span class="text-[.9rem] sm:text-[1.4rem] lg:text-[1rem]">
                            {{ $item->daftar_menu->nama_menu }}
                        </span>
                        <span class="text-[.7rem] text-slate-600 sm:text-[1.3rem] lg:text-[.8rem]">
                            {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }} =
                            <span class="text-primary font-bold">
                                Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </span>
                        </span>

                        {{-- counter --}}
                        <div class="counter-container flex gap-3 mt-2">
                            <span wire:click="decrementQuantity({{ $item->id }})" class="px-3 sm:px-5 sm:py-[0.1rem] lg:px-3 cursor-pointer sm:text-lg rounded-[4px] bg-[#CACACA]">-</span>
                            <span class="sm:text-lg">{{ $item->quantity }}</span>
                            <span wire:click="incrementQuantity({{ $item->id }})" class="px-3 sm:px-5 sm:py-[0.1rem] lg:px-3 cursor-pointer sm:text-lg rounded-[4px] bg-[#CACACA]">+</span>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- akumulasi --}}
            <div class="akumulasi-container mt-5 flex flex-col gap-3">
                <hr>
                <div class="subtotal-container sm:text-xl flex lg:text-[1.2rem] justify-between">
                    <span>Subtotal</span>
                    <span>
                        Rp. {{ number_format($cart->cart_items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
                    </span>
                </div>

                <div class="pajak-container sm:text-xl flex lg:text-[1.2rem] justify-between">
                    <span>Pajak (0%)</span>
                    <span>Rp. 0</span>
                </div>
                <hr>

                <div class="total-container sm:text-2xl flex lg:text-[1.2rem] justify-between">
                    <span>Total</span>
                    <span class="text-primary font-bold">
                        Rp. {{ number_format($cart->cart_items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
                    </span>
                </div>

                <a href="{{ route('checkout') }}">
                    <button
                        class="w-full bg-green-500 py-2 rounded-md text-white hover:bg-green-600 transition-all sm:text-2xl lg:text-[1.2rem] sm:mt-2 duration-300">
                        Checkout
                    </button>
                </a>
            </div>
        @else
            <p class="text-gray-500">Keranjang masih kosong.</p>
        @endif
    </div>
</div>
