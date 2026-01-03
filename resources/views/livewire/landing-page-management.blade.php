<div>
    <div class="mb-6 flex flex-col mt-20 p-7 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Landing Page</h1>
            <p class="text-gray-600 mt-1">Atur gambar slider pada halaman utama (Maksimal 4 gambar)</p>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if (session()->has('message'))
        <div class="mx-7 mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mx-7 mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mx-7 mb-10">
        {{-- List Images --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Gambar Aktif ({{ $heroes->count() }}/4)</h2>
            <div class="space-y-4">
                @forelse ($heroes as $hero)
                    <div class="flex items-center gap-4 p-3 border rounded-lg hover:shadow-md transition bg-gray-50">
                        <img src="{{ asset('storage/' . $hero->image_path) }}" class="w-24 h-16 object-cover rounded-md" alt="Hero Image">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-700 text-sm">{{ $hero->title ?? 'Tanpa Judul' }}</p>
                            <p class="text-xs text-gray-400">Diupdate: {{ $hero->created_at->diffForHumans() }}</p>
                        </div>
                        <button wire:click="delete({{ $hero->id }})" 
                            wire:confirm="Yakin ingin menghapus gambar ini?"
                            class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-400 border-2 border-dashed rounded-lg">
                        <p>Belum ada gambar yang diupload.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Upload Form --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 h-fit">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Tambah Gambar Baru</h2>
            
            @if($heroes->count() >= 4)
                <div class="bg-yellow-50 text-yellow-800 p-4 rounded-lg text-sm mb-4">
                    Slot gambar sudah penuh (4/4). Hapus salah satu gambar untuk menambahkan yang baru.
                </div>
            @else
                <form wire:submit="store">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar (Max 2MB)</label>
                        <input type="file" wire:model="images" class="file-input file-input-bordered file-input-primary w-full max-w-xs" accept="image/*" />
                        @error('images.*') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul (Opsional)</label>
                        <input type="text" wire:model="titles.0" class="input input-bordered w-full" placeholder="Contoh: Promo Spesial Hari Ini" />
                        @error('titles.*') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Preview --}}
                    @if ($images)
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Preview:</p>
                            <div class="grid grid-cols-2 gap-2">
                                @if(is_array($images))
                                    @foreach($images as $img)
                                        <img src="{{ $img->temporaryUrl() }}" class="w-full h-48 object-cover rounded-lg shadow-sm">
                                    @endforeach
                                @else
                                    <img src="{{ $images->temporaryUrl() }}" class="w-full h-48 object-cover rounded-lg shadow-sm">
                                @endif
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary w-full text-white" wire:loading.attr="disabled">
                        <span wire:loading.remove>Simpan Gambar</span>
                        <span wire:loading>Menyimpan...</span>
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
