@extends('layouts.admin')
@section('container')
    <section class="max-w-3xl ml-10 p-3">
        <h1 class="font-[poppins] text-2xl my-5">Edit Menu</h1>
        <form class="flex flex-col gap-2" action="{{ route('menu.update', $id) }}" method="post">
            @csrf
            @method('PUT')
            <input value="{{ old('nama_menu', $nama_menu) }}" type="text" name="nama_menu" required placeholder="Nama Menu" class="input" />
            @error('nama_menu')
                <span class="text-red-500 font-[poppins] ml-2 text-sm">{{ $message }}</span>
            @enderror
            <input value="{{ old('harga', $harga) }}" type="text" name="harga" required placeholder="Harga" class="input" />
            @error('harga')
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
