<div>
    <div class="p-6 bg-white rounded-lg shadow pt-28">
        @if (session()->has('success'))
            <div role="alert" class="alert alert-success text-white mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="h-6 w-6 shrink-0 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session()->has('message'))
            <div role="alert" class="alert alert-success text-white mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="h-6 w-6 shrink-0 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        @endif
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Menu</h2>
            <a class="btn btn-primary" href="/dashboard/create-menu">Tambah menu</a>
        </div>

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
                        
                        {{-- [BARU] Header Kolom Rekomendasi --}}
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rekomendasi
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
                                {{ Str::limit($m->deskripsi, 30) }}
                            </td>

                            {{-- [BARU] Tombol Bintang Rekomendasi --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button wire:click="toggleFeatured({{ $m->id }})" 
                                        class="focus:outline-none transition transform hover:scale-110"
                                        title="Klik untuk jadikan rekomendasi">
                                    @if($m->is_featured)
                                        {{-- BINTANG NYALA (Kuning) --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        {{-- BINTANG MATI (Abu-abu) --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300 hover:text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif
                                </button>
                            </td>
                            {{-- [AKHIR BARU] --}}

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                {{-- edit button --}}
                                <a class="text-blue-500" href="{{ route('dashboard.edit.menu', $m->id) }}">Edit</a>
                                {{-- end edit button --}}

                                {{-- delete button --}}
                                <form wire:click.prevent="delete({{$m->id}})" action="" class="inline-block ml-2">
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
</div>