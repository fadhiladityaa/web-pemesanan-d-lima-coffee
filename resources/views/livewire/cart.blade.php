<div class="">
    {{-- Cart untuk desktop --}}
    <div
        class="shadow-soft p-5 rounded-lg hidden lg:mt-[26rem] md:block lg:max-h-[80vh] overflow-y-auto bg-white border border-gray-100">
        <div class="flex justify-between">
            <h2 id="otw" class="sm:text-[1.7rem] lg:text-[1.3rem]">Keranjang</h2>
            <span
                class="flex items-center rounded-full px-4 py-1 text-sm bg-primary/10 text-primary font-medium border border-primary/20">
                {{ optional($cart)->cart_items?->sum('quantity') ?? 0 }} items

            </span>
        </div>

        <div class="cart-items-container mt-4">
            @if ($cart && $cart->cart_items && $cart->cart_items->count())
                @foreach ($cart->cart_items as $item)
                    <div x-data="{ showNotes: false }"
                        class="items-container bg-primary/5 transition-all duration-150 hover:bg-[#E8E8E8] mt-2 sm:mt-6 shadow-md rounded-md text-slate-800 p-3 lg:p-3 flex">
                        {{-- gambar produk --}}
                        @if($item->daftar_menu)
                            <img src="{{ Storage::url($item->daftar_menu->gambar) }}"
                                class="w-24 h-24 mr-3 sm:w-36 rounded-lg lg:w-20 lg:h-20"
                                alt="{{ $item->daftar_menu->nama_menu }}">
                        @else
                           <div class="w-24 h-24 mr-3 sm:w-36 rounded-lg lg:w-20 lg:h-20 bg-gray-200 flex items-center justify-center text-xs text-center text-gray-500">
                                Produk Tidak Tersedia
                            </div>
                        @endif

                        {{-- detail harga --}}
                        <div
                            class="pricing-container flex sm:mt-1 sm:mr-[15rem] lg:mr-0 flex-col lg:mt-0 lg:ml-2 lg:gap-1 gap-3 flex-1">
                            <span class="text-[.9rem] sm:text-[1.4rem] lg:text-[1rem] font-medium">
                                {{ $item->daftar_menu ? $item->daftar_menu->nama_menu : 'Item dihapus' }}
                            </span>
                            <span class="text-[.7rem] text-slate-600 sm:text-[1.3rem] lg:text-[.8rem]">
                                {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }} =
                                <span class="text-primary font-bold">
                                    Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </span>
                            </span>

                            {{-- counter --}}
                            <div class="counter-container flex gap-3 mt-2">
                                <span wire:click="decrementQuantity({{ $item->id }})"
                                    class="px-3 sm:px-5 sm:py-[0.1rem] lg:px-3 cursor-pointer sm:text-lg rounded-[4px] bg-[#CACACA] hover:bg-gray-400 transition-colors">-</span>
                                <span class="sm:text-lg font-medium">{{ $item->quantity }}</span>
                                <span wire:click="incrementQuantity({{ $item->id }})"
                                    class="px-3 sm:px-5 sm:py-[0.1rem] lg:px-3 cursor-pointer sm:text-lg rounded-[4px] bg-[#CACACA] hover:bg-gray-400 transition-colors">+</span>
                            </div>

                            {{-- NOTES SECTION (Expandable) --}}
                            <div class="notes-container mt-3 pt-3 border-t border-gray-300">
                                <button @click="showNotes = !showNotes"
                                    class="flex items-center gap-1 text-xs text-gray-700 hover:text-primary transition-colors w-full text-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span class="font-medium">Catatan</span>
                                    @if ($item->notes)
                                        <span
                                            class="ml-1 inline-flex items-center px-1.5 py-0.5 rounded-full text-xs bg-primary/10 text-primary">
                                            ✓
                                        </span>
                                    @endif
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-auto transition-transform"
                                        :class="{ 'rotate-180': showNotes }" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                {{-- Notes Preview (if exists) --}}
                                @if ($item->notes)
                                    <div x-show="!showNotes" class="mt-2">
                                        <p class="text-xs text-gray-600 bg-gray-50 p-2 rounded border border-gray-200">
                                            {{ Str::limit($item->notes, 50) }}
                                        </p>
                                    </div>
                                @endif

                                {{-- Notes Textarea (Expandable) --}}
                                {{-- Notes Textarea (Expandable) --}}
                                <div x-show="showNotes" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95" class="mt-2">

                                    <textarea wire:model.debounce.500ms="notes.{{ $item->id }}"
                                        wire:change="updateNotes({{ $item->id }}, $event.target.value)" rows="2"
                                        placeholder="Contoh: Kurangi gula, tambah es, dll..."
                                        class="w-full text-xs border border-gray-300 rounded p-2 focus:outline-none focus:border-primary resize-none"
                                        maxlength="200">{{ $item->notes }}</textarea>

                                    <div class="flex justify-between mt-1">
                                        <span class="text-xs text-gray-500">
                                            Maks. 200 karakter
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ strlen($item->notes ?? '') }}/200
                                        </span>
                                    </div>
                                </div>
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
                            Rp.
                            {{ number_format($cart->cart_items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
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
                            Rp.
                            {{ number_format($cart->cart_items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
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
    {{-- End cart untuk desktop --}}

    {{-- Cart Bottom Sheet untuk Mobile --}}
    @if ($cart && $cart->cart_items && $cart->cart_items->count() > 0)
        <div x-data="{
            isOpen: false,
            itemCount: {{ $cart->cart_items->count() }},
            totalAmount: {{ $cart->cart_items->sum(fn($i) => $i->price * $i->quantity) }}
        }"
            x-effect="itemCount = {{ $cart->cart_items->count() }}; totalAmount = {{ $cart->cart_items->sum(fn($i) => $i->price * $i->quantity) }}"
            class="fixed inset-x-0 bottom-0 z-50 md:hidden" x-cloak>

            {{-- Trigger Button (Tampil sedikit - FULL WIDTH) --}}
            <div x-show="!isOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0"
                x-transition:leave-end="translate-y-full" class="w-full">
                <button @click="isOpen = true"
                    class="w-full bg-primary text-white p-4 flex items-center rounded-t-xl  justify-between shadow-lg hover:bg-primary/90 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span
                                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ optional($cart)->cart_items?->sum('quantity') ?? 0 }}
                            </span>
                        </div>
                        <div class="text-left">
                            <p class="font-semibold">Keranjang</p>
                            <p class="text-sm opacity-90">
                                Rp.
                                {{ number_format($cart->cart_items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform"
                        :class="{ 'rotate-180': isOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </button>
            </div>

            {{-- Bottom Sheet Content (Height Intrinsic) --}}
            <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0"
                x-transition:leave-end="translate-y-full"
                class="fixed bottom-0 left-0 right-0 bg-white rounded-t-xl shadow-2xl z-50 max-h-[85vh] flex flex-col">

                {{-- Header dengan drag handle --}}
                <div class="sticky top-0 bg-white rounded-t-xl pt-3 z-10">
                    {{-- Drag Handle --}}
                    <div class="flex justify-center mb-2">
                        <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
                    </div>

                    {{-- Title --}}
                    <div class="px-4 pb-3 border-b">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span x-text="itemCount"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    </span>
                                </div>
                                <h2 class="font-bold text-lg text-gray-800">Keranjang</h2>
                            </div>
                            <button @click="isOpen = false"
                                class="p-1.5 rounded-full hover:bg-gray-100 transition-colors text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ optional($cart)->cart_items?->sum('quantity') ?? 0 }} items
                        </p>
                    </div>
                </div>

                {{-- Cart Items (Scrollable) --}}
                <div class="flex-1 overflow-y-auto px-4 py-3">
                    @foreach ($cart->cart_items as $item)
                        {{-- Di dalam @foreach ($cart->cart_items as $item) --}}
                        <div
                            class="flex items-start gap-3 p-3 rounded-lg border border-gray-200 mb-3 bg-white hover:bg-gray-50 transition-colors">
                            {{-- Gambar --}}
                            @if($item->daftar_menu)
                                <img src="{{ Storage::url($item->daftar_menu->gambar) }}"
                                    class="w-16 h-16 rounded-lg object-cover flex-shrink-0"
                                    alt="{{ $item->daftar_menu->nama_menu }}">
                            @else
                                <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0 text-[10px] text-center text-gray-500">
                                    N/A
                                </div>
                            @endif

                            {{-- Detail --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-medium text-gray-800 truncate">
                                        {{ $item->daftar_menu ? $item->daftar_menu->nama_menu : 'Item dihapus' }}
                                    </h3>
                                    <p class="text-primary font-bold text-sm ml-2 whitespace-nowrap">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </p>
                                </div>

                                <p class="text-xs text-gray-500 mt-1">
                                    Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}
                                </p>

                                {{-- Tombol + - --}}
                                <div class="flex items-center gap-3 mt-2">
                                    <div class="flex items-center gap-2">
                                        <button wire:click="decrementQuantity({{ $item->id }})"
                                            class="w-7 h-7 rounded-md bg-gray-100 flex items-center justify-center hover:bg-gray-200 active:scale-95 transition-all font-bold text-gray-700"
                                            aria-label="Kurangi jumlah">
                                            –
                                        </button>
                                        <span
                                            class="w-8 text-center font-medium text-gray-800">{{ $item->quantity }}</span>
                                        <button wire:click="incrementQuantity({{ $item->id }})"
                                            class="w-7 h-7 rounded-md bg-gray-100 flex items-center justify-center hover:bg-gray-200 active:scale-95 transition-all font-bold text-gray-700"
                                            aria-label="Tambah jumlah">
                                            +
                                        </button>
                                    </div>
                                </div>

                                {{-- NOTES MOBILE --}}
                                <div class="notes-mobile mt-3 pt-3 border-t border-gray-200">
                                    <div x-data="{ showNotes: false }" class="w-full">
                                        {{-- Notes Toggle Button --}}
                                        <button @click="showNotes = !showNotes" type="button"
                                            class="flex items-center gap-1.5 text-xs text-gray-600 hover:text-primary transition-colors w-full justify-between">
                                            <div class="flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                <span
                                                    class="font-medium">{{ $item->notes ? 'Edit Catatan' : 'Tambah Catatan' }}</span>
                                                @if ($item->notes)
                                                    <span
                                                        class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs bg-primary/10 text-primary ml-1">
                                                        ✓
                                                    </span>
                                                @endif
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 transition-transform"
                                                :class="{ 'rotate-180': showNotes }" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        {{-- Notes Textarea (Expandable) --}}
                                        <div x-show="showNotes" x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95" class="mt-2">
                                            <textarea wire:model.debounce.500ms="notes.{{ $item->id }}"
                                                wire:change="updateNotes({{ $item->id }}, $event.target.value)" rows="2"
                                                placeholder="Contoh: Kurangi gula, tanpa es, pakai susu almond..."
                                                class="w-full text-xs border border-gray-300 rounded-lg p-2.5 focus:ring-1 focus:ring-primary/30 focus:border-primary resize-none bg-gray-50"
                                                maxlength="200">{{ $item->notes }}</textarea>
                                            <div class="flex justify-between items-center mt-1 px-1">
                                                <span class="text-xs text-gray-400">
                                                    Maks. 200 karakter
                                                </span>
                                                <span class="text-xs text-gray-500">
                                                    {{ strlen($item->notes ?? '') }}/200
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Notes Preview (if exists) --}}
                                        @if ($item->notes && !$item->notes->isDirty())
                                            <div x-show="!showNotes" class="mt-1.5">
                                                <p
                                                    class="text-xs text-gray-700 bg-gray-50 p-2 rounded border border-gray-200">
                                                    {{ Str::limit($item->notes, 60) }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Footer (Sticky di bottom) --}}
                <div class="sticky bottom-0 bg-white border-t border-gray-200 p-4 space-y-3 shadow-lg">
                    {{-- Summary --}}
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium text-gray-800"
                                x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(totalAmount)"></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Pajak (0%)</span>
                            <span class="text-gray-600">Rp 0</span>
                        </div>
                        <div class="border-t border-gray-300 pt-2 flex justify-between">
                            <span class="font-bold text-gray-800">Total</span>
                            <span class="text-primary font-bold text-lg"
                                x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(totalAmount)"></span>
                        </div>
                    </div>

                    {{-- Checkout Button --}}
                    <a href="{{ route('checkout') }}" class="block">
                        <button
                            class="w-full bg-green-500 hover:bg-green-600 active:bg-green-700 text-white py-3.5 rounded-xl font-semibold transition-all active:scale-[0.98] flex items-center justify-center gap-2 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Checkout Sekarang
                        </button>
                    </a>
                </div>
            </div>

            {{-- Backdrop (Untuk close) --}}
            <div x-show="isOpen" @click="isOpen = false" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/40 z-40 backdrop-blur-sm"></div>
        </div>

        {{-- Style untuk x-cloak --}}
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    @endif
</div>
