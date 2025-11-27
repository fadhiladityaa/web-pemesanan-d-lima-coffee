<div>
    <section class="max-w-3xl ml-10 p-3 pt-28">
        <h1 class="font-[poppins] text-2xl my-5">Edit Menu</h1>

        <form wire:submit.prevent="edit" class="flex flex-col gap-4" enctype="multipart/form-data">
            {{-- Nama Menu --}}
            <div>
                <input wire:model="nama_menu" type="text" placeholder="Nama Menu"
                    class="input w-full" />
                @error('nama_menu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Harga --}}
            <div>
                <input wire:model="harga" type="number" placeholder="Harga"
                    class="input w-full" />
                @error('harga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Upload Gambar --}}
            <div>
                <input wire:model="gambar" type="file" class="file-input file-input-xs" />

                @if ($gambar instanceof \Livewire\TemporaryUploadedFile)
                    <img class="w-40 mt-2 rounded" src="{{ $gambar->temporaryUrl() }}" alt="Preview baru">
                @elseif ($oldImage)
                    <img class="w-40 mt-2 rounded" src="{{ asset('storage/' . $oldImage) }}" alt="Gambar lama">
                @endif

                @error('gambar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <textarea wire:model="deskripsi" placeholder="Deskripsi"
                    class="textarea textarea-xl w-full"></textarea>
                @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Kandungan Gizi --}}
            <h2 class="font-[poppins] text-lg mt-6">Kandungan Gizi</h2>
            <div class="grid grid-cols-2 gap-2">
                <input wire:model="energi_total" type="number" placeholder="Energi Total (kkal)" class="input border-slate-600" />
                <input wire:model="takaran_saji" type="number" placeholder="Takaran Saji (gr/ml)" class="input border-slate-600" />
                <input wire:model="protein" type="number" step="0.1" placeholder="Protein (g)" class="input border-slate-600" />
                <input wire:model="lemak_total" type="number" step="0.1" placeholder="Lemak Total (g)" class="input border-slate-600" />
                <input wire:model="lemak_jenuh" type="number" step="0.1" placeholder="Lemak Jenuh (g)" class="input border-slate-600" />
                <input wire:model="karbohidrat" type="number" step="0.1" placeholder="Karbohidrat (g)" class="input border-slate-600" />
                <input wire:model="gula" type="number" step="0.1" placeholder="Gula (g)" class="input border-slate-600" />
                <input wire:model="garam_natrium" type="number" placeholder="Garam/Natrium (mg)" class="input border-slate-600" />
                <input wire:model="kafein" type="number" placeholder="Kafein (mg)" class="input border-slate-600" />
            </div>
            <textarea wire:model="batas_konsumsi" placeholder="Batas Konsumsi"
                class="textarea border-slate-600"></textarea>

            {{-- Bahan Baku Dinamis --}}
            <h2 class="font-[poppins] text-lg mt-6">Bahan Baku</h2>
            @foreach($bahanBaku as $index => $bahan)
                <div class="flex gap-2 mb-2">
                    <input wire:model="bahanBaku.{{ $index }}.nama_bahan" type="text"
                        placeholder="Nama Bahan" class="input border-slate-600 w-1/2" />
                    <input wire:model="bahanBaku.{{ $index }}.takaran" type="text"
                        placeholder="Takaran" class="input border-slate-600 w-1/3" />
                    <button type="button" wire:click="removeBahanBaku({{ $index }})"
                        class="btn btn-error btn-sm">Hapus</button>
                </div>
                @error('bahanBaku.'.$index.'.nama_bahan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            @endforeach

            <button type="button" wire:click="addBahanBaku" class="btn btn-secondary btn-sm">+ Tambah Bahan</button>

            {{-- Tombol Update --}}
            <button class="btn btn-primary mt-4" type="submit">Update</button>
        </form>

        @if(session()->has('success'))
            <div class="text-green-600 mt-3">{{ session('success') }}</div>
        @endif

        <a class="text-md block my-2 mx-2 font-[poppins] text-blue-500" href="/dashboard/menu-management">
            &laquo; Back
        </a>
    </section>
</div>
