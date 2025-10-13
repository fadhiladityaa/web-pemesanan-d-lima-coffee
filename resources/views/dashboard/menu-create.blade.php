@extends('layouts.admin')
@section('container')
    <section class="max-w-3xl ml-10 p-3 pt-28">
        <h1 class="font-[poppins] text-2xl my-5">Tambah Menu</h1>
        <form x-data="{
            imgSrc: '',
            changeImage(event) {
                const file = event.target.files[0]
                if (file) {
                    this.imgSrc = URL.createObjectURL(file)
                }
            }
        }" class="flex flex-col gap-2" action="{{ route('menu.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            
            <input type="text" name="nama_menu" required placeholder="Nama Menu" class="input border border-slate-600" />
            @error('nama_menu')
                <span class="text-red-500 font-[poppins] ml-2 text-sm">{{ $message }}</span>
            @enderror

            <input type="text" name="harga" required placeholder="Harga" class="input border-slate-600" />
            @error('harga')
                <span class="text-red-500 font-[poppins] ml-2 text-sm">{{ $message }}</span>
            @enderror

            <input @change="changeImage($event)" name="gambar" type="file" class="file-input file-input-xs" />
             @error('gambar')
                <span class="text-red-500 font-[poppins] ml-2 text-sm">{{ $message }}</span>
            @enderror

            <template x-if="imgSrc">
                <img class="w-40" :src="imgSrc" alt="">
            </template>

            <textarea name="deskripsi" placeholder="Deskripsi" class="textarea textarea-xl border-slate-600"></textarea>
            @error('deskripsi')
                <span class="text-red-500 font-[poppins] ml-2 text-sm">{{ $message }}</span>
            @enderror
            <button class="btn btn-primary" type="submit">Add &plus;</button>
        </form>
        <a class="text-md block  my-2 mx-2 font-[poppins]" href="{{ route('menu.index') }}">&laquo; Back</a>
    </section>
@endsection
