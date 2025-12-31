<div class="max-w-4xl mx-auto p-8 mt-28  bg-white shadow-lg rounded-lg font-[Poppins]">
    {{-- Header --}}
    <div class="flex items-center justify-between border-b pb-4  mb-6">
        <h2 class="text-3xl font-bold text-gray-800">
            Detail Pesanan #{{ $order->id }}
        </h2>
        <span class="text-sm text-gray-500">
            {{ $order->created_at->format('d M Y, H:i') }}
        </span>
    </div>

    {{-- Informasi User --}}
    <div class="flex flex-col gap-6 mb-6">
        <div>
            <p class="text-gray-600">Pelanggan</p>
            <p class="text-lg font-semibold">{{ $order->user->name }}</p>
        </div>
        <div>
            <p class="text-gray-600">Metode Pembayaran</p>
            <p class="text-sm text-white text-center px-3 py-1 w-20 bg-green-500 rounded-xl">{{ $order->metode_pembayaran }}</p>
        </div>
    </div>

    {{-- Status Pesanan --}}
    <div class="mb-6">
        <p class="text-gray-600">Status Pesanan</p>
        <span class="inline-block px-3 py-1 mt-1 text-sm font-medium rounded-full
            @if($order->order_status === 'selesai') bg-green-100 text-green-700
            @elseif($order->order_status === 'proses') bg-yellow-100 text-yellow-700
            @elseif($order->order_status === 'diantar') bg-blue-100 text-blue-700
            @else bg-[#f3f4f6] text-[#374151] @endif">
            {{ ucfirst($order->order_status) }}
        </span>
    </div>

    {{-- Item Pesanan --}}
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-3">Item Pesanan</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-3 text-left">Menu</th>
                    <th class="p-3 text-center">Jumlah</th>
                    <th class="p-3 text-right">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->order_items as $item)
                    <tr class="border-b">
                        <td class="p-3">{{ $item->daftar_menu->nama_menu }}</td>
                        <td class="p-3 text-center">{{ $item->quantity }}</td>
                        <td class="p-3 text-right">
                            Rp. {{ number_format($item->harga, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Total --}}
    <div class="flex justify-end mb-6">
        <div class="text-right">
            <p class="text-gray-600">Total Pembayaran</p>
            <p class="text-2xl font-bold text-gray-800">
                Rp. {{ number_format($order->total, 0, ',', '.') }}
            </p>
        </div>
    </div>

    {{-- Update Status --}}
    <div class="flex gap-3 justify-end">
        <button wire:click="updateStatus('canceled')" 
                class="px-5 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
            Tandai Cancel
        </button>
        <button wire:click="updateStatus('proses')" 
                class="px-5 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
            Tandai Proses
        </button>
        <button wire:click="updateStatus('sedang diantar')" 
                class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
            Tandai Diantar
        </button>
        <button wire:click="updateStatus('completed')" 
                class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
            Tandai Selesai
        </button>
    </div>
</div>
