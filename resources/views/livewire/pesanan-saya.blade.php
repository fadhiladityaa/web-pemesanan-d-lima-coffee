<div>
    <h2 class="text-xl font-bold mb-4 pt-10">Pesanan Saya</h2>

    @forelse ($orders as $order)
        <div class="border p-4 mb-3 rounded shadow-sm bg-white">
            <p><strong>ID Pesanan:</strong> {{ $order->id }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->order_status) }}</p>
            <p><strong>Total:</strong> Rp{{ number_format($order->total, 0, ',', '.') }}</p>

            <h4 class="mt-2 font-semibold">Item:</h4>
            <ul class="list-disc ml-5">
                @foreach ($order->order_items as $item)
                    <li>{{ $item->quantity }} x {{ $item->daftar_menu->nama_menu }}</li>
                @endforeach
            </ul>

            <a href="{{ route('detail.pesanan', $order->id) }}" 
               class="text-blue-600 hover:underline mt-2 inline-block">
                Lihat Detail
            </a>
        </div>
    @empty
        <p class="text-gray-500">Belum ada pesanan.</p>
    @endforelse
</div>
