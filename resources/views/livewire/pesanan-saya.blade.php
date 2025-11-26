<div class="max-w-6xl mx-auto px-6 py-10 font-[Poppins]">
    <h2 class="text-3xl font-bold mb-8 text-gray-800">Pesanan Saya</h2>

    @forelse ($orders as $order)
        <div class="bg-white rounded-xl shadow-lg mb-8 overflow-hidden border border-gray-100">
            {{-- Header Pesanan --}}
            <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-indigo-50 to-white border-b">
                <div>
                    <p class="text-xs text-gray-500">ID Pesanan</p>
                    <p class="text-lg font-semibold text-gray-800">#{{ $order->id }}</p>
                </div>
                <div>
                    <span class="px-4 py-1 text-sm font-medium rounded-full
                        @if($order->order_status === 'selesai') bg-green-100 text-green-700
                        @elseif($order->order_status === 'proses') bg-yellow-100 text-yellow-700
                        @elseif($order->order_status === 'pending') bg-gray-100 text-gray-700
                        @else bg-blue-100 text-blue-700 @endif">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>
            </div>

            {{-- Body Pesanan --}}
            <div class="px-6 py-6 flex flex-col gap-3">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Pembayaran</p>
                    <p class="text-2xl font-bold text-gray-800">
                        Rp. {{ number_format($order->total, 0, ',', '.') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Metode Pembayaran</p>
                    <p class="text-sm py-1 px-3 bg-green-500 w-16 text-center text-white rounded-xl text-gray-800">
                        {{ $order->metode_pembayaran }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Tanggal Pesanan</p>
                    <p class="text-lg font-semibold text-gray-800">
                        {{ $order->created_at->format('d M Y, H:i') }}
                    </p>
                </div>
            </div>

            {{-- Item Pesanan --}}
            <div class="px-6 pb-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-3">Item Pesanan</h4>
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="p-3 text-left">Menu</th>
                            <th class="p-3 text-center">Jumlah</th>
                            <th class="p-3 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order_items as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $item->daftar_menu->nama_menu }}</td>
                                <td class="p-3 text-center">{{ $item->quantity }}</td>
                                <td class="p-3 text-right">
                                    Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($order->metode_pembayaran != 'Cash')
                    <button class="w-full bg-green-400 px-4 rounded-lg py-2 mt-8 text-white font-semibold">Bayar</button>
                @endif
            </div>


        
        </div>
    @empty
        <div class="text-center py-16">
            <p class="text-gray-400 text-lg">Belum ada pesanan.</p>
            <a href="/" class="mt-4 inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Mulai Belanja
            </a>
        </div>
    @endforelse
</div>
