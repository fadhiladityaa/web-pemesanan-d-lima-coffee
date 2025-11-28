<div class="max-w-3xl mx-auto mt-6">
    @if($menu)
        <div class="card bg-base-100 shadow-md">
            <figure>
                <img src="{{ asset('images/'.$menu->gambar) }}" 
                     alt="{{ $menu->nama_menu }}" 
                     class="w-full h-64 object-cover">
            </figure>
            <div class="card-body">
                <h2 class="card-title">{{ $menu->nama_menu }}</h2>
                <p class="text-sm text-gray-500">Rp{{ number_format($menu->harga) }}</p>
                <p class="mt-2">{{ $menu->deskripsi }}</p>

                <h3 class="mt-4 font-semibold">Detail Kandungan:</h3>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($menu->bahanbaku as $detail)
                        <li>
                            <strong>{{ $detail->bahan_baku }}</strong>  
                            ({{ $detail->energi_total }} kkal, {{ $detail->kafein }} mg kafein)
                            <br>
                            <span class="text-xs text-gray-500">{{ $detail->batas_konsumsi }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-primary">Tambah ke Keranjang</button>
                </div>
            </div>
        </div>
    @else
        <p class="text-center text-gray-500">Menu tidak ditemukan.</p>
    @endif
</div>
