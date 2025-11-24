<div>
    <section class="max-w-3xl lg:ml-10 px-[16px] pt-20">
        <h1 class="font-[poppins] lg:text-2xl my-5">Tambah Menu</h1>
        <form wire:submit.prevent="createNewMenu" class="flex flex-col gap-2" action="" method="POST"
            enctype="multipart/form-data">

            <input wire:model="nama_menu" type="text" name="nama_menu" required placeholder="Nama Menu"
                class="input border border-slate-600" />
                <span class="text-red-500 font-[poppins] ml-2 text-sm"></span>
    

            <input wire:model="harga" type="text" name="harga" required placeholder="Harga" class="input border-slate-600" />
                <span class="text-red-500 font-[poppins] ml-2 text-sm"></span>
    

            <input accept="image/png, image/jpg, image/jpegs" wire:model="gambar" name="gambar" type="file" class="file-input file-input-xs" />
                <span class="text-red-500 font-[poppins] ml-2 text-sm"></span>

            @if($gambar)
                <img class="w-40 h-40" src="{{ $gambar->temporaryUrl() }}">
            @endif
    

            <template x-if="imgSrc">
                <img class="w-40" :src="imgSrc" alt="">
            </template>

            <textarea wire:model="deskripsi" name="deskripsi" placeholder="Deskripsi" class="textarea textarea-xl border-slate-600"></textarea>
                <span class="text-red-500 font-[poppins] ml-2 text-sm"></span>
    
            <button class="btn btn-primary" type="submit">Add &plus;</button>
        </form>
        <a class="text-md block  my-2 mx-2 font-[poppins]" href="">&laquo; Back</a>
    </section>
</div>
