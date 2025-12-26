<div class="min-h-screen bg-[#FDFBF7] py-28 px-4 sm:px-6 lg:px-8 font-sans text-[#4A403A]">
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-serif text-3xl md:text-4xl font-bold text-[#2C241B]">Manajemen Promo</h1>
                <p class="text-[#8C7B70] mt-1">Kelola voucher dan diskon spesial untuk pelanggan setia.</p>
            </div>
            
            {{-- Tombol Tambah (Toggle Form Logic) --}}
            @if(!$showForm)
                <button wire:click="create" 
                    class="inline-flex items-center justify-center px-6 py-3 bg-[#2C241B] text-[#D4B595] font-bold text-sm rounded-xl shadow-lg hover:bg-[#4A3B32] hover:scale-105 transition-all duration-300 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Buat Promo Baru
                </button>
            @endif
        </div>

        {{-- FLASH MESSAGE (Notifikasi Sukses) --}}
        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm animate-fade-in-down flex items-center gap-3" role="alert">
                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <div>
                    <p class="font-bold">Sukses!</p>
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
            </div>
        @endif

        {{-- FORM CREATE / EDIT (Card Style) --}}
        @if($showForm)
            <div class="bg-white rounded-[2rem] shadow-xl border border-[#F0EAE0] overflow-hidden mb-8 animate-fade-in-up">
                <div class="px-6 py-4 border-b border-[#F0EAE0] bg-[#FAF8F5] flex justify-between items-center">
                    <h3 class="text-xl font-serif font-bold text-[#2C241B]">
                        {{ $isEditMode ? 'Edit Promo' : 'Buat Promo Baru' }}
                    </h3>
                    <button wire:click="cancel" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <div class="p-6 md:p-8">
                    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- Judul --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-[#4A403A] mb-1">Judul Promo</label>
                                <input type="text" wire:model="judul" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-[#D4B595] focus:border-[#D4B595] transition placeholder-gray-300" placeholder="Contoh: Semangat Pagi">
                                @error('judul') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            {{-- Kode Promo --}}
                            <div>
                                <label class="block text-sm font-bold text-[#4A403A] mb-1">Kode Voucher (Unik)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                    </div>
                                    <input type="text" wire:model="kode_promo" class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-[#D4B595] focus:border-[#D4B595] uppercase font-mono tracking-wide" placeholder="DISKON50">
                                </div>
                                @error('kode_promo') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            {{-- Diskon --}}
                            <div>
                                <label class="block text-sm font-bold text-[#4A403A] mb-1">Persentase Diskon (%)</label>
                                <div class="relative">
                                    <input type="number" wire:model="persentase_diskon" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-[#D4B595] focus:border-[#D4B595]" placeholder="10-100">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-bold">%</span>
                                    </div>
                                </div>
                                @error('persentase_diskon') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            {{-- Status (Dropdown Modern) --}}
                            <div>
                                <label class="block text-sm font-bold text-[#4A403A] mb-1">Status</label>
                                <select wire:model="status" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-[#D4B595] focus:border-[#D4B595] bg-white">
                                    <option value="aktif">🟢 Aktif (Tampil di Beranda)</option>
                                    <option value="tidak_aktif">🔴 Tidak Aktif (Sembunyikan)</option>
                                </select>
                            </div>

                            {{-- Tanggal (Group) --}}
                            <div class="md:col-span-2 grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Mulai</label>
                                    <input type="date" wire:model="tanggal_mulai" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-[#D4B595] focus:border-[#D4B595] text-sm">
                                    @error('tanggal_mulai') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Selesai</label>
                                    <input type="date" wire:model="tanggal_berakhir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-[#D4B595] focus:border-[#D4B595] text-sm">
                                    @error('tanggal_berakhir') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-[#4A403A] mb-1">Deskripsi Singkat</label>
                                <textarea wire:model="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-[#D4B595] focus:border-[#D4B595] placeholder-gray-300" placeholder="Jelaskan detail promo..."></textarea>
                                @error('deskripsi') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            {{-- Pilih Menu (Dengan Checkbox Card) --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-[#4A403A] mb-2">Pilih Menu Terkait (Opsional)</label>
                                <div class="bg-gray-50 border border-gray-300 rounded-xl p-4 h-48 overflow-y-auto grid grid-cols-1 md:grid-cols-2 gap-3 custom-scrollbar">
                                    @if(isset($allMenus) && $allMenus->count() > 0)
                                        @foreach($allMenus as $menu)
                                            <label class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100 shadow-sm hover:border-[#D4B595] hover:bg-[#FDFBF7] cursor-pointer transition-all">
                                                <input type="checkbox" wire:model="selectedMenus" value="{{ $menu->id }}" class="w-5 h-5 text-[#2C241B] border-gray-300 rounded focus:ring-[#D4B595]">
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-bold text-[#2C241B]">{{ $menu->nama_menu }}</span>
                                                    <span class="text-xs text-[#8C7B70]">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    @else
                                        <p class="text-gray-500 text-sm italic col-span-2 text-center py-4">Belum ada data menu tersedia.</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Upload Gambar --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-[#4A403A] mb-2">Banner Promo</label>
                                <div class="flex items-start gap-6">
                                    {{-- Preview Area --}}
                                    <div class="flex-shrink-0">
                                        @if ($gambar)
                                            <div class="relative group">
                                                <img src="{{ $gambar->temporaryUrl() }}" class="w-32 h-32 object-cover rounded-xl shadow-md border-2 border-[#D4B595]">
                                                <div class="absolute inset-0 bg-black/50 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition text-white text-xs">Baru</div>
                                            </div>
                                        @elseif ($gambar_lama)
                                            <div class="relative group">
                                                <img src="{{ asset('storage/'.$gambar_lama) }}" class="w-32 h-32 object-cover rounded-xl shadow-md border border-gray-200">
                                                <div class="absolute inset-0 bg-black/50 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition text-white text-xs">Lama</div>
                                            </div>
                                        @else
                                            <div class="w-32 h-32 bg-gray-100 rounded-xl border-2 border-dashed border-gray-300 flex flex-col items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                <span class="text-xs">No Image</span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Input Area --}}
                                    <div class="flex-1">
                                        <input type="file" wire:model="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#F8F4E9] file:text-[#2C241B] hover:file:bg-[#EBE5DE] transition cursor-pointer">
                                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG. Maksimal ukuran: <span class="font-bold">10MB</span>.</p>
                                        <div wire:loading wire:target="gambar" class="text-sm text-[#D4B595] mt-1 font-medium animate-pulse">
                                            Sedang mengupload gambar...
                                        </div>
                                        @error('gambar') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-end mt-8 gap-3 pt-6 border-t border-gray-100">
                            <button type="button" wire:click="cancel" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition">
                                Batal
                            </button>
                            <button type="submit" wire:loading.attr="disabled" class="px-6 py-2.5 rounded-xl bg-[#2C241B] text-[#D4B595] font-bold shadow-lg hover:bg-[#4A3B32] transition disabled:opacity-50 disabled:cursor-not-allowed">
                                {{ $isEditMode ? 'Simpan Perubahan' : 'Simpan Promo' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        {{-- CONTENT LIST CARD --}}
        <div class="bg-white rounded-[2rem] shadow-xl border border-[#F0EAE0] overflow-hidden">
            
            {{-- Search & Filter Bar (Optional addition for future) --}}
            {{-- <div class="p-6 border-b border-[#F0EAE0]"> ... </div> --}}

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-[#FAF8F5]">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-[#8C7B70] uppercase tracking-wider">Info Promo</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-[#8C7B70] uppercase tracking-wider">Kode & Diskon</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-[#8C7B70] uppercase tracking-wider">Periode Aktif</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-[#8C7B70] uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-[#8C7B70] uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($promos as $promo)
                            <tr class="hover:bg-[#FDFBF7] transition-colors duration-200 group">
                                {{-- Info Promo --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-14 w-14 rounded-xl overflow-hidden border border-gray-200 shadow-sm group-hover:border-[#D4B595] transition-colors">
                                            @if($promo->gambar)
                                                <img class="h-14 w-14 object-cover" src="{{ asset('storage/'.$promo->gambar) }}" alt="">
                                            @else
                                                <div class="h-14 w-14 bg-gray-100 flex items-center justify-center text-gray-400">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-[#2C241B] group-hover:text-[#D4B595] transition-colors">{{ $promo->judul }}</div>
                                            <div class="text-xs text-gray-500 max-w-[150px] truncate" title="{{ $promo->deskripsi }}">{{ $promo->deskripsi }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kode & Diskon --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col items-start gap-1">
                                        <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-mono font-bold rounded-md bg-gray-100 text-gray-600 border border-gray-200 group-hover:bg-white group-hover:border-[#D4B595] transition-colors">
                                            {{ $promo->kode_promo }}
                                        </span>
                                        <span class="text-sm font-bold text-red-500">-{{ $promo->persentase_diskon }}% OFF</span>
                                    </div>
                                </td>

                                {{-- Periode --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-600 flex flex-col gap-1">
                                        <span class="flex items-center gap-1">
                                            <span class="w-12 text-gray-400">Mulai:</span> 
                                            <span class="font-medium">{{ $promo->tanggal_mulai->format('d M Y') }}</span>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span class="w-12 text-gray-400">Selesai:</span> 
                                            <span class="font-medium {{ $promo->tanggal_berakhir->isPast() ? 'text-red-500' : '' }}">
                                                {{ $promo->tanggal_berakhir->format('d M Y') }}
                                            </span>
                                        </span>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($promo->status == 'aktif')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-200">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-500 border border-gray-200">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <button wire:click="edit({{ $promo->id }})" class="p-2 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                        <button wire:click="delete({{ $promo->id }})" onclick="return confirm('Yakin ingin menghapus promo ini?') || event.stopImmediatePropagation()" class="p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="bg-[#F8F4E9] p-4 rounded-full mb-3 shadow-inner">
                                            <svg class="w-10 h-10 text-[#D4B595]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 text-base font-medium">Belum ada promo yang dibuat.</p>
                                        <p class="text-gray-400 text-sm mt-1">Mulai buat strategi diskonmu sekarang!</p>
                                        @if(!$showForm)
                                            <button wire:click="create" class="mt-4 text-[#2C241B] font-bold text-sm hover:underline hover:text-[#D4B595] transition-colors">
                                                + Buat Promo Pertama
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>