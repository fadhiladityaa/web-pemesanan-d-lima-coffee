<div class="p-4 pt-24">
    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">📋 Manajemen Edukasi</h2>
            <p class="text-gray-600">Kelola konten edukasi untuk pelanggan</p>
        </div>
        <a 
            href="{{ route('edukasi.pelanggan') }}" 
            target="_blank"
            class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 font-medium text-sm"
        >
            👁️ Lihat Halaman Pelanggan
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow border">
            <div class="text-sm text-gray-500">Total Artikel</div>
            <div class="text-2xl font-bold">{{ $totalEdukasi }}</div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Section -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow border">
                <h3 class="text-lg font-semibold mb-4">
                    {{ $selectedId ? '✏️ Edit Edukasi' : '➕ Tambah Edukasi' }}
                </h3>

                <!-- Judul -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul *</label>
                    <input type="text" wire:model="judul" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Masukkan judul edukasi">
                    @error('judul') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                    <select wire:model="kategori" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoriOptions as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('kategori') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Ringkasan -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ringkasan *</label>
                    <textarea wire:model="ringkasan" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Ringkasan singkat (20-200 karakter)"></textarea>
                    @error('ringkasan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <div class="text-xs text-gray-500 mt-1">
                        {{ strlen($ringkasan) }}/200 karakter
                    </div>
                </div>

                <!-- Konten -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konten Lengkap *</label>
                    <textarea wire:model="konten" rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Isi konten edukasi"></textarea>
                    @error('konten') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Gambar -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar (Opsional)</label>
                    
                    @if($image)
                        <div class="mb-2">
                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-32 object-cover rounded-lg mb-2">
                            <p class="text-xs text-gray-500">Preview gambar baru</p>
                        </div>
                    @elseif($selectedId)
                        @php
                            $currentItem = $dataEdukasi->firstWhere('id', $selectedId);
                        @endphp
                        @if($currentItem && $currentItem->image)
                            <div class="mb-2">
                                <div class="flex space-x-2">
                                    <div class="flex-1">
                                        @php
                                            $path = str_replace('//', '/', $currentItem->image);
                                            $url = asset('storage/' . $path);
                                        @endphp
                                        <img src="{{ $url }}" 
                                            class="w-full h-32 object-cover rounded-lg border"
                                            onerror="console.error('Preview gagal:', this.src)">
                                        <p class="text-xs text-gray-500 mt-1 text-center">Gambar Saat Ini</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    
                    <input type="file" wire:model="image" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <p class="text-xs text-gray-500 mt-1">Max 2MB. Format: JPG, PNG, GIF</p>
                </div>

                <!-- Buttons -->
                <div class="flex space-x-2">
                    @if($selectedId)
                        <button wire:click="save" 
                            wire:loading.attr="disabled"
                            class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium disabled:opacity-50">
                            <span wire:loading.remove wire:target="save">Update</span>
                            <span wire:loading wire:target="save">
                                <svg class="animate-spin h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                        
                        <button wire:click="cancelEdit"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 font-medium">
                            Batal
                        </button>
                    @else
                        <button wire:click="save" 
                            wire:loading.attr="disabled"
                            class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium disabled:opacity-50">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save">
                                <svg class="animate-spin h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Menyimpan...
                            </span>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Data List Section -->
        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-lg shadow border">
                <h3 class="text-lg font-semibold mb-4">📝 Daftar Edukasi ({{ $totalEdukasi }})</h3>

                @if($totalEdukasi > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($dataEdukasi as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                @if($item->image)
                                                    @php
                                                        // PERBAIKI path double slash
                                                        $path = str_replace('//', '/', $item->image);
                                                        $url = asset('storage/' . $path);
                                                    @endphp
                                                    <img src="{{ $url }}" 
                                                        class="w-10 h-10 object-cover rounded mr-3"
                                                        alt="{{ $item->judul }}"
                                                        onerror="console.error('Gambar gagal load:', this.src); this.style.display='none';">
                                                @else
                                                    <div class="w-10 h-10 bg-gray-200 rounded mr-3 flex items-center justify-center">
                                                        <span class="text-gray-400 text-xs">No img</span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="font-medium">{{ $item->judul }}</div>
                                                    <div class="text-sm text-gray-500 truncate max-w-xs">
                                                        {{ Str::limit($item->ringkasan, 50) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                {{ $item->kategori }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-500">
                                            {{ $item->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex space-x-2">
                                                <button wire:click="edit({{ $item->id }})"
                                                    wire:loading.attr="disabled"
                                                    class="px-3 py-1 text-sm bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 disabled:opacity-50">
                                                    Edit
                                                </button>
                                                <button wire:click="delete({{ $item->id }})" 
                                                    onclick="return window.confirm('Yakin hapus artikel ini?')"
                                                    wire:loading.attr="disabled"
                                                    class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200 disabled:opacity-50">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p>Belum ada data edukasi.</p>
                        <p class="text-sm mt-1">Mulai dengan menambahkan edukasi pertama Anda.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Loading Indicator -->
    @if($image)
        <div wire:loading wire:target="image">
            <div class="fixed top-0 left-0 right-0 bg-blue-500 h-1 z-50">
                <div class="bg-blue-700 h-full animate-pulse"></div>
            </div>
        </div>
    @endif
</div>