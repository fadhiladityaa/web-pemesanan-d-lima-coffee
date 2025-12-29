<div class="max-w-3xl mx-auto pt-1">
    <div class="bg-gray-50 min-h-screen py-6 pt-24 font-poppins">
        <div class="max-w-4xl mx-auto px-4">
            <div class="mb-6">
                <button class="flex items-center gap-2 text-[#8B6F47] hover:text-[#A0826D] font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <a href="{{ route('menu') }}">Kembali ke Menu</a> 
                </button>
            </div>
            
            <div class="bg-primary mb-5 p-6 rounded-lg bg-opacity-20 border-2 text-slate-700 shadow-lg border-yellow-700 border-dashed">
                <h1 class="text-2xl font-bold text-center">📑 Detail Menu</h1>
                <p class="text-sm opacity-90 mt-1 text-center">Informasi lengkap produk dan kandungan gizi</p>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                
                <div class="p-6 bg-[url('../../public/img/kotak3.svg')]">
                    
                    <div class="flex flex-col md:flex-row gap-6 mb-8">
                        <img src="{{ Storage::url($menu->gambar)}}" alt="{{ $menu->nama_menu }}" class="w-full md:w-64 h-64 object-cover rounded-lg shadow-md">
                        <div class="flex-1">
                            <h2 class="text-3xl font-bold text-gray-800 mb-3">{{ $menu->nama_menu }}</h2>
                            <p class="text-[#A0826D] text-2xl font-semibold mb-3">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                            
                            {{-- [PERBAIKAN 1] Cek apakah data kandungan ada --}}
                            @if($menu->kandungan)
                                <div class="bg-amber-50 border-l-4 border-[#A0826D] p-4 mb-4 rounded">
                                    <p class="text-sm text-gray-700 leading-relaxed">
                                        <span class="font-semibold">Takaran Saji:</span> {{ $menu->kandungan->takaran_saji }} ml
                                    </p>
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed italic">
                                    "{{ $menu->kandungan->batas_konsumsi }}"
                                </p>
                            @else
                                {{-- Tampilan jika data gizi kosong --}}
                                <div class="bg-gray-100 border-l-4 border-gray-400 p-4 mb-4 rounded">
                                    <p class="text-sm text-gray-500 italic">
                                        Informasi detail gizi belum tersedia.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-8 bg-gray-50 rounded-lg border-pink-300 border-dashed border-2 p-5">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                            <span class="text-xl">🥄</span>
                            Bahan Baku
                        </h3>
                        <ul class="list-disc list-inside space-y-1 text-sm text-gray-700">
                            {{-- Gunakan forelse agar aman jika bahan baku kosong --}}
                            @forelse ($menu->bahanbaku as $bahan)
                                <li>{{ $bahan->nama_bahan }} {{ $bahan->takaran }}</li>
                            @empty
                                <li class="italic text-gray-400">Data bahan baku belum diinput.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="pt-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Informasi Nilai Gizi</h3>
                        
                        {{-- [PERBAIKAN 2] Bungkus SELURUH bagian Gizi dengan @if --}}
                        @if($menu->kandungan)
                            <p class="text-sm text-gray-500 mb-6">Per Takaran Saji ({{ $menu->kandungan->takaran_saji }}ml)</p>

                            <div class="bg-sky-50 text-slate-600 border border-sky-400 rounded-lg p-6 mb-6 shadow-white text-center">
                                <p class="text-sm mb-2 text-slate-600 opacity-90">⚡ Energi Total</p>
                                <p class="text-4xl font-bold">{{ $menu->kandungan->energi_total }}</p>
                            </div>

                            <h4 class="text-md font-semibold text-gray-800 mb-4">Ringkasan Nutrisi</h4>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                                    <div class="text-3xl mb-2">⚡</div>
                                    <div class="text-xs text-gray-600 mb-1">Energi</div>
                                    <div class="font-bold text-gray-800">{{ $menu->kandungan->energi_total }}<span class="text-xs font-normal">kkal</span></div>
                                </div>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                                    <div class="text-3xl mb-2">🥑</div>
                                    <div class="text-xs text-gray-600 mb-1">Lemak Jenuh</div>
                                    <div class="font-bold text-gray-800">{{ $menu->kandungan->lemak_jenuh }}<span class="text-xs font-normal">g</span></div>
                                </div>
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
                                    <div class="text-3xl mb-2">🥩</div>
                                    <div class="text-xs text-gray-600 mb-1">Protein</div>
                                    <div class="font-bold text-gray-800">{{ $menu->kandungan->protein }}<span class="text-xs font-normal">g</span></div>
                                </div>
                                <div class="bg-pink-50 border border-pink-200 rounded-lg p-4 text-center">
                                    <div class="text-3xl mb-2">🌾</div>
                                    <div class="text-xs text-gray-600 mb-1">Karbo</div>
                                    <div class="font-bold text-gray-800">{{ $menu->kandungan->karbohidrat }}<span class="text-xs font-normal">g</span></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-8">
                                <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-2xl">🍬</span>
                                        <span class="text-sm text-gray-600 font-medium">Gula</span>
                                    </div>
                                    <p class="font-bold text-gray-800 text-lg">{{ $menu->kandungan->gula }} g</p>
                                </div>
                                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-2xl">☕</span>
                                        <span class="text-sm text-gray-600 font-medium">Kafein</span>
                                    </div>
                                    <p class="font-bold text-[#A0826D] text-lg">{{ $menu->kandungan->kafein }} mg</p>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-5 mb-8">
                                <h4 class="text-md font-semibold text-gray-800 mb-4">Kandungan Nutrisi Detail</h4>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center pb-3 border-b">
                                        <span class="text-gray-700 font-medium">Lemak Total</span>
                                        <span class="font-semibold text-gray-800">{{ $menu->kandungan->lemak_total }} g</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-3 border-b pl-6">
                                        <span class="text-gray-600 text-sm">• Lemak Jenuh</span>
                                        <span class="text-sm text-gray-700">{{ $menu->kandungan->lemak_jenuh }} g</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-3 border-b">
                                        <span class="text-gray-700 font-medium">Protein</span>
                                        <span class="font-semibold text-gray-800">{{ $menu->kandungan->protein }} g</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-3 border-b">
                                        <span class="text-gray-700 font-medium">Karbohidrat</span>
                                        <span class="font-semibold text-gray-800">{{ $menu->kandungan->karbohidrat }} g</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-3 border-b pl-6">
                                        <span class="text-gray-600 text-sm">• Gula</span>
                                        <span class="text-sm text-gray-700">{{ $menu->kandungan->gula }} g</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-3 border-b">
                                        <span class="text-gray-700 font-medium">Garam (Natrium)</span>
                                        <span class="font-semibold text-gray-800">{{ $menu->kandungan->garam_natrium }} mg</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 font-medium">Kafein</span>
                                        <span class="font-bold text-[#A0826D]">{{ $menu->kandungan->kafein }} mg</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 border border-green-300 rounded-lg p-5 mb-6">
                                <div class="flex items-start gap-3">
                                    <span class="text-3xl">💡</span>
                                    <div class="flex-1">
                                        <h5 class="font-semibold text-gray-800 mb-2 text-lg">Saran Konsumsi</h5>
                                        <p class="text-sm text-gray-700 leading-relaxed">
                                           {{ $menu->kandungan->batas_konsumsi }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <p class="text-xs text-gray-500 italic text-center">
                                Informasi nilai gizi dapat bervariasi tergantung bahan dan takaran yang digunakan
                            </p>
                        @else
                            {{-- [PERBAIKAN 3] Tampilan Pengganti jika Data Gizi Kosong --}}
                            <div class="py-12 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <div class="text-5xl mb-3">🧪</div>
                                <h4 class="text-lg font-bold text-gray-700">Data Nutrisi Belum Tersedia</h4>
                                <p class="text-gray-500 text-sm mt-2 px-6">
                                    Tim dapur kami sedang melakukan perhitungan gizi untuk menu ini. 
                                    Silakan cek kembali nanti.
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 pt-6 w-full">
                        <button class="w-full">
                             <a href="{{ route('menu') }}" class="block w-full border-2 border-[#A0826D] text-[#A0826D] hover:bg-[#A0826D] hover:text-white py-3 rounded-lg font-semibold transition text-center">
                                &laquo; Kembali
                             </a>
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>