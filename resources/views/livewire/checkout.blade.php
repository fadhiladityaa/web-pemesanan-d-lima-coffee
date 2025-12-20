<div class="px-6 w-full sm:px-12 lg:px-24 py-12 font-poppins pt-24">
    
    <div class="w-full gap-10">
        {{-- Form Data Pembeli --}}
        <section class="shadow-soft rounded-lg lg:w-6/12 lg:mx-auto  p-6 space-y-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800 py-3 mx-auto text-center">Checkout</h1>
            <h2 class="text-xl font-semibold text-slate-700">Data Pembeli</h2>
            <div class="space-y-4">
                

                <div>
                    <label class="block text-sm font-medium text-slate-600">Alamat Pengiriman</label>
                    <textarea wire:model="alamat" class="w-full border rounded-md px-3 py-2 mt-1 focus:ring focus:ring-primary" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                    @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600">Metode Pembayaran</label>
                    <select wire:model.live="metode_pembayaran" class="w-full border rounded-md px-3 py-2 mt-1 focus:ring focus:ring-primary">
                        <option value="">Pilih metode</option>
                        <option value="Cash">Cash</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="OVO">OVO</option>
                        <option value="DANA">DANA</option>
                        <option value="GoPay">GoPay</option>
                    </select>
                    @error('metode_pembayaran') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Form Uang Dibayar jika Cash --}}
                @if ($metode_pembayaran === 'Cash')
                    <div>
                        <label class="block text-sm font-medium text-slate-600">Uang Dibayarkan</label>
                        <input type="number" wire:model.live="uang_dibayar" class="w-full border rounded-md px-3 py-2 mt-1 focus:ring focus:ring-primary" placeholder="Contoh: 100000">
                        @error('uang_dibayar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    @if ($uang_dibayar >= $total)
                        <div class="text-sm text-green-600 mt-2">
                            Kembalian: Rp {{ number_format($kembalian, 0, ',', '.') }}
                        </div>
                    @endif
                @endif
            </div>
            {{-- Tombol Checkout --}}
            <button wire:click="submitCheckout" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-md transition-all duration-300">
                Konfirmasi & Bayar
            </button>
        </section>
    </div>
</div>
