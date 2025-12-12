<div>
    <section class="max-w-3xl lg:ml-10 px-[16px] pt-20">
        <h1 class="font-[poppins] lg:text-2xl my-5">Tambah Menu</h1>

        <form wire:submit.prevent="createNewMenu" class="flex flex-col gap-2" enctype="multipart/form-data">

            {{-- Menu Utama --}}
            <input wire:model="nama_menu" type="text" placeholder="Nama Menu" class="input border border-slate-600" />
            @error('nama_menu')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <span>Pilih Kategori</span>
            <select wire:model="category_id" class="border border-black py-3 w-5/12 px-1 rounded-md" name="warning"
                id="warning">
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <input wire:model="harga" type="number" placeholder="Harga" class="input border border-slate-600" />
            @error('harga')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <input accept="image/png, image/jpg, image/jpeg" wire:model="gambar" type="file"
                class="file-input file-input-xs" />
            @error('gambar')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            @if ($gambar)
                <img class="w-40 h-40" src="{{ $gambar->temporaryUrl() }}">
            @endif

            <textarea wire:model="deskripsi" placeholder="Deskripsi" class="textarea textarea-xl border-slate-600"></textarea>
            @error('deskripsi')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <Label for="pesan">Small Warning</Label>

            <select name="pesan" wire:model="pesan" class="border border-black py-3 w-5/12 px-1 rounded-md" name="warning"
                id="warning">
                <option value="Ringan & ramah">Ringan & ramah</option>
                <option value="Pahit & kuat">Kuat & pahit</option>
            </select>
            @error('pesan')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            {{-- Kandungan Gizi --}}
            <h2 class="font-[poppins] text-lg my-6">Kandungan Gizi</h2>

            <span>Energi total</span>
            <input wire:model="energi_total" type="number" placeholder="Energi Total (kkal)"
                class="input border-slate-600" />
            @error('energi_total')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <span>Takaran saji</span>
            <input wire:model="takaran_saji" type="number" placeholder="Takaran Saji (gr/ml)"
                class="input border-slate-600" />
            @error('takaran_saji')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <span>Protein</span>
            <input wire:model="protein" type="number" step="0.1" placeholder="Protein (g)"
                class="input border-slate-600" />
            <span>Lemak total</span>
            <input wire:model="lemak_total" type="number" step="0.1" placeholder="Lemak Total (g)"
                class="input border-slate-600" />
            <span>Lemak jenuh</span>
            <input wire:model="lemak_jenuh" type="number" step="0.1" placeholder="Lemak Jenuh (g)"
                class="input border-slate-600" />
            <span>Karbohidrat</span>
            <input wire:model="karbohidrat" type="number" step="0.1" placeholder="Karbohidrat (g)"
                class="input border-slate-600" />
            <span>Gula</span>
            <input wire:model="gula" type="number" step="0.1" placeholder="Gula (g)"
                class="input border-slate-600" />
            <span>Garam natrium</span>
            <input wire:model="garam_natrium" type="number" placeholder="Garam/Natrium (mg)"
                class="input border-slate-600" />
            <span>Kafein</span>
            <input wire:model="kafein" type="number" placeholder="Kafein (mg)" class="input border-slate-600" />

            <span>Batas konsumsi</span>
            <textarea wire:model="batas_konsumsi" placeholder="Batas Konsumsi" class="textarea border-slate-600"></textarea>

            {{-- Bahan Baku Dinamis --}}
            <h2 class="font-[poppins] text-lg mt-6">Bahan Baku</h2>

            @foreach ($bahanBaku as $index => $bahan)
                <div class="flex gap-2 mb-2">
                    <input wire:model="bahanBaku.{{ $index }}.nama_bahan" type="text"
                        placeholder="Nama Bahan" class="input border-slate-600" />
                    <input wire:model="bahanBaku.{{ $index }}.takaran" type="text" placeholder="Takaran"
                        class="input border-slate-600" />
                    <button type="button" wire:click="removeBahanBaku({{ $index }})"
                        class="btn btn-error text-white btn-sm">Hapus</button>
                </div>
                @error('bahanBaku.' . $index . '.nama_bahan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            @endforeach

            <button type="button" wire:click="addBahanBaku" class="btn btn-secondary btn-sm">+ Tambah Bahan</button>

            {{-- Submit --}}
            <button class="btn btn-primary mt-4" type="submit">Simpan Menu</button>
        </form>

        @if (session()->has('success'))
            <div class="text-green-600 mt-3">{{ session('success') }}</div>
        @endif

        <a class="text-md block my-2 mx-2 font-[poppins]" href="">&laquo; Back</a>
    </section>
</div>
