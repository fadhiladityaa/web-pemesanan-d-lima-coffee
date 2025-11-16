<div class="shadow-soft p-5 rounded-lg">
    <div class="flex justify-between">
        <h2 class="sm:text-[1.7rem] lg:text-[1.3rem]">Keranjang</h2>
        <span
            class="flex items-center rounded-full px-4 py-1 text-sm bg-primary/10 text-primary font-medium border border-primary/20">
            2 items
        </span>
    </div>
    <div class="cart-items-container mt-4">
        {{-- cart item --}}
        <div
            class="items-container bg-primary/5 transition-all duration-150 hover:bg-[#E8E8E8] mt-2 sm:mt-6 shadow-md rounded-md text-slate-800 p-3 lg:p-2 flex justify-between">
            <img src="{{ asset('img/contoh-kopi-2.png') }}" class="sm:w-36 lg:w-24 lg:h-24" alt="contoh kopi">
            <div class="pricing-container flex sm:mt-1 sm:mr-[15rem] lg:mr-0 flex-col lg:mt-0 lg:ml-2 lg:gap-1 gap-2">
                <span class="text-[18px] sm:text-[1.4rem] lg:text-[1.2rem]">Espresso</span>
                <span class="text-[14px]  sm:text-[1.3rem] lg:text-[.8rem]">20.000 x 1 = <span
                        class="text-primary font-bold">Rp.
                        20.0000</span></span>
                <div class="counter-container flex gap-3 mt-2">
                    <span
                        class="px-3 sm:px-5 sm:py-[0.1rem] lg:px-3 cursor-pointer sm:text-lg rounded-[4px] bg-[#CACACA]">+</span>
                    <span class="sm:text-lg">1</span>
                    <span
                        class="px-3 sm:px-5 sm:py-[0.1rem] sm:text-lg  lg:px-3 rounded-[4px] cursor-pointer bg-[#CACACA]">-</span>
                </div>
            </div>
            <span class="text-red-500 sm:text-3xl cursor-pointer">×</span>
        </div>
        {{-- end cart item --}}

        <div class="akumulasi-container mt-5 flex flex-col gap-3">
            <hr>
            <div class="subtotal-container sm:text-xl flex lg:text-[1.2rem] justify-between">
                <span>Subtotal</span>
                <span>Rp. 40.000</span>
            </div>

            <div class="pajak-container sm:text-xl flex lg:text-[1.2rem] justify-between">
                <span>Pajak (0%)</span>
                <span>Rp. 0</span>
            </div>
            <hr>

            <div class="total-container sm:text-2xl flex lg:text-[1.2rem] justify-between">
                <span>Total</span>
                <span class="text-primary font-bold">Rp. 40.000</span>
            </div>

            <button
                class="w-full bg-green-500 py-2 rounded-md text-white hover:bg-green-600 transition-all sm:text-2xl lg:text-[1.2rem] sm:mt-2  duration-300">Checkout</button>
        </div>


    </div>
