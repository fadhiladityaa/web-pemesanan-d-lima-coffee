@extends('layouts.admin')
@section('container')
    <div x-data="{ test: 'fadhil aditya', formData: {} }" class="p-6 bg-white rounded-lg shadow">
        <!-- Header Tabel dan Tombol Tambah -->
        @if (session()->has('success'))
            <div role="alert" class="alert alert-success mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="h-6 w-6 shrink-0 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Menu</h2>
            <a class="btn btn-primary" href="{{ route('menu.create') }}">Tambah menu</a>
        </div>

        <!-- Tabel Menu -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Menu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Harga
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Deskripsi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($menu as $m)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $m->nama_menu }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp. {{ $m->harga }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ Str::limit($m->deskripsi, 30) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                {{-- edit button --}}
                                <a class="text-blue-500" href="{{ route('menu.edit', $m) }}">Edit</a>
                                {{-- end edit button --}}

                                {{-- delete button --}}
                                <form action="{{ route('menu.destroy', $m->id) }}" method="POST" class="inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                        class="text-red-500">Delete</button>
                                </form>
                                {{-- end delete button --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
