<div class="px-6 sm:px-12 lg:px-24 py-12 font-poppins pt-24">
    <h1 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-8">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        {{-- Form Data Pembeli --}}
        <section class="bg-white shadow-soft rounded-lg p-6 space-y-6">
            <h2 class="text-xl font-semibold text-slate-700">Data Pembeli</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600">Nomor Telepon</label>
                    <input type="text" wire:model="no_hp" class="w-full border rounded-md px-3 py-2 mt-1 focus:ring focus:ring-primary" placeholder="08xxxxxxxxxx">
                    @error('no_hp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

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
        </section>

        {{-- Ringkasan Pesanan --}}
        <aside class="bg-white shadow-md rounded-lg p-6 space-y-6">
            <h2 class="text-xl font-semibold text-slate-700">Ringkasan Pesanan</h2>
            {{-- Simulasi item pesanan bisa diganti dengan loop --}}
            <div class="space-y-4">
                <div class="border-b pb-3">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-700 font-medium">Brown Sugar x1</span>
                        <span class="font-semibold text-primary">Rp 25.000</span>
                    </div>
                    <div class="mt-1 pl-4 text-sm text-gray-500 space-y-1">
                        <div class="flex justify-between">
                            <span>+ Susu</span>
                            <span>Rp 5.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>+ Extra Ice</span>
                            <span>Rp 2.000</span>
                        </div>
                    </div>
                </div>

                <div class="border-b pb-3">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-700 font-medium">Latte x2</span>
                        <span class="font-semibold text-primary">Rp 40.000</span>
                    </div>
                    <div class="mt-1 pl-4 text-sm text-gray-500">
                        <span>+ Oat Milk</span>
                        <span class="float-right">Rp 6.000</span>
                    </div>
                </div>
            </div>

            {{-- Total --}}
            <div class="space-y-2 pt-4 border-t">
                <div class="flex justify-between text-slate-600">
                    <span>Subtotal</span>
                    <span>Rp 78.000</span>
                </div>
                <div class="flex justify-between text-slate-600">
                    <span>Pajak (10%)</span>
                    <span>Rp 7.800</span>
                </div>
                <div class="flex justify-between text-lg font-bold text-slate-800 pt-2 border-t">
                    <span>Total</span>
                    <span class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Tombol Checkout --}}
            <button wire:click="submitCheckout" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-md transition-all duration-300">
                Konfirmasi & Bayar
            </button>
        </aside>
    </div>
</div>
