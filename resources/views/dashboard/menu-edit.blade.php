@extends('layouts.admin')
@section('container')
    <section class="max-w-3xl ml-10 p-3 pt-28">
        <h1 class="font-[poppins] text-2xl my-5">Edit Menu</h1>
        <form class="flex flex-col gap-2" action="{{ route('menu.update', $id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="oldImage" value="{{ $gambar }}">

            <input value="{{ old('nama_menu', $nama_menu) }}" type="text" name="nama_menu" required placeholder="Nama Menu"
                class="input" />
            @error('nama_menu')
                <span class="text-red-500 font-[poppins] ml-2 text-sm">{{ $message }}</span>
            @enderror

            <input value="{{ old('harga', $harga) }}" type="text" name="harga" required placeholder="Harga"
                class="input" />
            @error('harga')
                <span class="text-red-500 font-[poppins] ml-2 text-sm">{{ $message }}</span>
            @enderror

            <input @change="changeImage($event)" name="gambar" type="file" class="file-input file-input-xs" />
            @if ($gambar)
                <img class="w-40" src="{{ asset('storage/' . $gambar) }}" alt="">
            @else
                <img src="" alt="">
            @endif
            @error('gambar')
                <span class="text-red-500 font-[poppins] ml-2 text-sm">{{ $message }}</span>
            @enderror

            <textarea name="deskripsi" required placeholder="Deskripsi" class="textarea textarea-xl">{{ old('deskripsi', $deskripsi) }}</textarea>
            @error('deskripsi')
                <span class="text-red-500 font-[poppins] ml-2 text-sm">{{ $message }}</span>
            @enderror
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
        <a class="text-md block  my-2 mx-2 font-[poppins]" href="{{ route('menu.index') }}">&laquo; Back</a>
    </section>
@endsection
