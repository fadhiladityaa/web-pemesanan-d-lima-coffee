<div>
    <div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Detail Pesanan #{{ $order->id }}</h2>

    <p><strong>Pelanggan:</strong> {{ $order->user->name }}</p>
    <p><strong>No HP:</strong> {{ $order->no_hp }}</p>
    <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran }}</p>
    <p><strong>Status:</strong> {{ $order->order_status }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>

    <h3 class="mt-4 font-semibold">Item Pesanan:</h3>
    <ul class="list-disc ml-6">
        @foreach ($order->order_items as $item)
            <li>
                {{ $item->quantity }} x {{ $item->daftar_menu->nama_menu }}
                (Rp {{ number_format($item->harga, 0, ',', '.') }})
            </li>
        @endforeach
    </ul>

    <div class="mt-6 flex gap-2">
        <button wire:click="updateStatus('proses')" class="px-4 py-2 bg-yellow-500 text-white rounded">Proses</button>
        <button wire:click="updateStatus('diantar')" class="px-4 py-2 bg-blue-500 text-white rounded">Diantar</button>
        <button wire:click="updateStatus('selesai')" class="px-4 py-2 bg-green-600 text-white rounded">Selesai</button>
    </div>
</div>
</div>
