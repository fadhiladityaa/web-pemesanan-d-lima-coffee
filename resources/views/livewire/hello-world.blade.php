<div>
{{-- keranjang section --}}
<section>
    <div class="w-full px-[16px] sm:px-[32px] lg:px-0 lg:pr-[64px] mt-9 lg:mt-5 font-poppins lg:sticky top-24">
        <div class="cart-container w-full shadow-lg rounded-xl p-[20px] bg-white border border-gray-100">
            <!-- Header Keranjang -->
            <div class="topper-container flex justify-between items-center pb-4 border-b border-gray-200">
                <h2 class="sm:text-[1.7rem] text-xl font-semibold text-slate-800">Keranjang</h2>
                <span class="flex items-center rounded-full px-4 py-1 text-sm bg-primary/10 text-primary font-medium border border-primary/20">
                    2 items
                </span>
            </div>

            <div class="cart-items-container mt-4 max-h-[400px] overflow-y-auto pr-2 space-y-3">
                {{-- cart item --}}
                <div class="items-container bg-gradient-to-br from-gray-50 to-gray-100/50 hover:from-primary/5 hover:to-primary/10 transition-all duration-300 shadow-sm hover:shadow-md rounded-xl p-4 flex gap-4 group">
                    <!-- Image Container -->
                    <div class="relative w-20 h-20 sm:w-24 sm:h-24 flex-shrink-0 rounded-lg overflow-hidden shadow-sm">
                        <img src="{{ asset('img/contoh-kopi-2.png') }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" 
                             alt="contoh kopi">
                    </div>

                    <!-- Content Container -->
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-base sm:text-lg font-semibold text-slate-800 mb-1">Espresso</h3>
                            <div class="flex items-center gap-2 text-sm sm:text-base text-slate-600">
                                <span>Rp 20.000 × 1</span>
                                <span class="text-xs text-slate-400">=</span>
                                <span class="text-primary font-bold">Rp 20.000</span>
                            </div>
                        </div>

                        <!-- Counter Container -->
                        <div class="counter-container flex items-center gap-3 mt-2">
                            <button class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg bg-white border border-gray-300 hover:border-primary hover:bg-primary hover:text-white transition-all duration-300 shadow-sm cursor-pointer text-lg font-medium">
                                −
                            </button>
                            <span class="text-base sm:text-lg font-semibold text-slate-800 min-w-[24px] text-center">1</span>
                            <button class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg bg-white border border-gray-300 hover:border-primary hover:bg-primary hover:text-white transition-all duration-300 shadow-sm cursor-pointer text-lg font-medium">
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Delete Button -->
                    <button class="self-start text-red-400 hover:text-red-600 hover:bg-red-50 rounded-full p-2 transition-all duration-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                {{-- end cart item --}}

                {{-- Duplicate untuk contoh --}}
                <div class="items-container bg-gradient-to-br from-gray-50 to-gray-100/50 hover:from-primary/5 hover:to-primary/10 transition-all duration-300 shadow-sm hover:shadow-md rounded-xl p-4 flex gap-4 group">
                    <div class="relative w-20 h-20 sm:w-24 sm:h-24 flex-shrink-0 rounded-lg overflow-hidden shadow-sm">
                        <img src="{{ asset('img/contoh-kopi.png') }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" 
                             alt="contoh kopi">
                    </div>

                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-base sm:text-lg font-semibold text-slate-800 mb-1">Cappuccino</h3>
                            <div class="flex items-center gap-2 text-sm sm:text-base text-slate-600">
                                <span>Rp 20.000 × 1</span>
                                <span class="text-xs text-slate-400">=</span>
                                <span class="text-primary font-bold">Rp 20.000</span>
                            </div>
                        </div>

                        <div class="counter-container flex items-center gap-3 mt-2">
                            <button class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg bg-white border border-gray-300 hover:border-primary hover:bg-primary hover:text-white transition-all duration-300 shadow-sm cursor-pointer text-lg font-medium">
                                −
                            </button>
                            <span class="text-base sm:text-lg font-semibold text-slate-800 min-w-[24px] text-center">1</span>
                            <button class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg bg-white border border-gray-300 hover:border-primary hover:bg-primary hover:text-white transition-all duration-300 shadow-sm cursor-pointer text-lg font-medium">
                                +
                            </button>
                        </div>
                    </div>

                    <button class="self-start text-red-400 hover:text-red-600 hover:bg-red-50 rounded-full p-2 transition-all duration-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="akumulasi-container mt-5 pt-4 border-t border-gray-200 space-y-3">
                <div class="subtotal-container text-base sm:text-lg flex justify-between text-slate-600">
                    <span>Subtotal</span>
                    <span class="font-medium">Rp 40.000</span>
                </div>

                <div class="pajak-container text-base sm:text-lg flex justify-between text-slate-600">
                    <span>Pajak (0%)</span>
                    <span class="font-medium">Rp 0</span>
                </div>

                <div class="border-t border-gray-200 pt-3"></div>

                <div class="total-container text-lg sm:text-2xl flex justify-between font-bold text-slate-800">
                    <span>Total</span>
                    <span class="text-primary">Rp 40.000</span>
                </div>

                <!-- Checkout Button -->
                <button class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 py-3 sm:py-4 rounded-xl text-white font-semibold text-base sm:text-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 mt-4">
                    <span class="flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Checkout Sekarang
                    </span>
                </button>
            </div>
        </div>
    </div>
</section>
{{-- end keranjang section --}}
</div>
