<div class="py-28 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        {{-- Header Halaman --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Promo</h2>
            @if(!$showForm)
                <button wire:click="create" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                    + Tambah Promo Baru
                </button>
            @endif
        </div>

        {{-- Pesan Sukses --}}
        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm" role="alert">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        {{-- FORM CREATE / EDIT --}}
        @if($showForm)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    {{ $isEditMode ? 'Edit Promo' : 'Buat Promo Baru' }}
                </h3>
                
                <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Judul --}}
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Judul Promo</label>
                            <input type="text" wire:model="judul" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                            @error('judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Kode Promo --}}
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Kode Voucher (Unik)</label>
                            <input type="text" wire:model="kode_promo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1 uppercase" placeholder="CONTOH: DISKON50">
                            @error('kode_promo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Diskon --}}
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Persentase Diskon (%)</label>
                            <input type="number" wire:model="persentase_diskon" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                            @error('persentase_diskon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Status</label>
                            <select wire:model="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                                <option value="aktif">Aktif (Tampil di Beranda)</option>
                                <option value="tidak_aktif">Tidak Aktif (Sembunyikan)</option>
                            </select>
                        </div>

                        {{-- Tanggal Mulai --}}
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Tanggal Mulai</label>
                            <input type="date" wire:model="tanggal_mulai" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                            @error('tanggal_mulai') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Tanggal Berakhir --}}
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Tanggal Berakhir</label>
                            <input type="date" wire:model="tanggal_berakhir" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                            @error('tanggal_berakhir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-gray-700">Deskripsi Singkat</label>
                            <textarea wire:model="deskripsi" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" rows="3"></textarea>
                        </div>

                        {{-- Upload Gambar --}}
                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Banner Promo</label>
                            
                            @if ($gambar)
                                <div class="mb-2">
                                    <p class="text-xs text-green-600 mb-1">Preview Gambar Baru:</p>
                                    <img src="{{ $gambar->temporaryUrl() }}" class="w-48 h-auto rounded shadow">
                                </div>
                            @elseif ($gambar_lama)
                                <div class="mb-2">
                                    <p class="text-xs text-gray-500 mb-1">Gambar Saat Ini:</p>
                                    <img src="{{ asset('storage/'.$gambar_lama) }}" class="w-48 h-auto rounded shadow">
                                </div>
                            @endif

                            <input type="file" wire:model="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('gambar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-6 gap-3">
                        <button type="button" wire:click="cancel" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow-md transition">
                            Batal
                        </button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-md transition">
                            {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Promo' }}
                        </button>
                    </div>
                </form>
            </div>
        @endif

        {{-- TABEL LIST PROMO --}}
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Info Promo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode & Diskon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Masa Berlaku</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($promos as $promo)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($promo->gambar)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/'.$promo->gambar) }}" alt="">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-xs">No Pic</div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $promo->judul }}</div>
                                        <div class="text-sm text-gray-500 truncate w-32">{{ $promo->deskripsi }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $promo->kode_promo }}
                                </span>
                                <div class="text-sm text-gray-500 mt-1">{{ $promo->persentase_diskon }}% OFF</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $promo->tanggal_mulai->format('d M') }} - {{ $promo->tanggal_berakhir->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($promo->status == 'aktif')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button wire:click="edit({{ $promo->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                <button wire:click="delete({{ $promo->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus promo ini?') || event.stopImmediatePropagation()">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 italic">
                                Belum ada promo yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>