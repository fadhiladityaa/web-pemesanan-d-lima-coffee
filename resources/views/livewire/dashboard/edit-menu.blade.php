<div>
    <section class="max-w-3xl ml-10 p-3 pt-28">
        <h1 class="font-[poppins] text-2xl my-5">Edit Menu</h1>

        <form wire:submit.prevent="edit" class="flex flex-col gap-4" enctype="multipart/form-data">
            {{-- Nama Menu --}}
            <div>
                <input wire:model="nama_menu" type="text" name="nama_menu" required placeholder="Nama Menu"
                    class="input w-full" />
                @error('nama_menu')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Harga --}}
            <div>
                <input wire:model="harga" type="text" name="harga" required placeholder="Harga"
                    class="input w-full" />
                @error('harga')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Upload Gambar --}}
            <div>
                <input wire:model="gambar" type="file" class="file-input file-input-xs" />

                {{-- Preview gambar baru kalau ada upload --}}
                @if ($gambar instanceof \Livewire\TemporaryUploadedFile)
                    <img class="w-40 mt-2 rounded" src="{{ $gambar->temporaryUrl() }}" alt="Preview baru">
                {{-- Kalau tidak ada upload, tampilkan gambar lama dari DB --}}
                @elseif ($oldImage)
                    <img class="w-40 mt-2 rounded" src="{{ asset('storage/' . $oldImage) }}" alt="Gambar lama">
                @endif

                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <textarea wire:model="deskripsi" name="deskripsi" required placeholder="Deskripsi"
                    class="textarea textarea-xl w-full"></textarea>
                @error('deskripsi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tombol Update --}}
            <button class="btn btn-primary" type="submit">Update</button>
        </form>

        <a class="text-md block my-2 mx-2 font-[poppins] text-blue-500" href="/dashboard/menu-management">
            &laquo; Back
        </a>
    </section>
</div>
