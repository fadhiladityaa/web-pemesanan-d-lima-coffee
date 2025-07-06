<x-dashboard.dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    @section('content')
    <div x-data="{test: 'fadhil aditya', formData: {}}" class="p-6 bg-white rounded-lg shadow">
        <!-- Header Tabel dan Tombol Tambah -->
        @if (session()->has('success'))
            <div role="alert" class="alert alert-success mb-5">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                class="h-6 w-6 shrink-0 stroke-current">
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Menu</h2>
            <button class="btn btn-primary" onclick="menu_modal.showModal()">Tambah Menu</button>
        </div>

        <!-- Tabel Menu -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Menu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp. {{ $m->harga}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ Str::limit($m->deskripsi, 30) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button @click="
                                selectedId = {{ $m->id }};
                                formData = JSON.parse('{{ json_encode($m) }}');
                                edit_modal.showModal();
                                " class="text-blue-600 hover:text-blue-900 mr-3">Edit
                            </button>

                            <form action="{{ route('menu.destroy', $m->id) }}" method="POST" class="inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
            {{-- modal edit --}}
            <dialog id="edit_modal" class="modal">
            <div class="modal-box w-11/12 max-w-2xl">
                <h3 class="font-bold text-lg mb-4">Edit Menu</h3>
                
                <form action="{{ route('menu.store') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Menu -->
                    <div class="form-control mb-4">
                        <label for="nama_menu" class="label">
                            <span class="label-text">Nama Menu</span>
                        </label>
                        <input 
                            x-model="formData.nama_menu"
                            type="text" 
                            name="nama_menu" 
                            id="nama_menu"
                            required
                            class="input input-bordered w-full"
                        >
                    </div>

                    <!-- Harga -->
                    <div class="form-control mb-4">
                        <label for="harga" class="label">
                            <span class="label-text">Harga (Rp)</span>
                        </label>
                        <input 
                            x-model="formData.harga"
                            type="number" 
                            name="harga" 
                            id="harga"
                            required
                            min="0"
                            class="input input-bordered w-full"
                        >
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-control mb-4">
                        <label for="deskripsi" class="label">
                            <span class="label-text">Deskripsi</span>
                        </label>
                        <textarea 
                            x-model="formData.deskripsi"
                            name="deskripsi" 
                            id="deskripsi"
                            rows="3"
                            class="textarea textarea-bordered w-full"
                        ></textarea>
                    </div>

                    <!-- Footer Modal -->
                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="edit_modal.close()" class="btn">Batal</button>
                    </div>
                </form>
            </div>
            
            <!-- Click outside to close -->
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

            </div>
    </div>

    <!-- Modal Form Tambah Menu -->
    <dialog id="menu_modal" class="modal">
        <div class="modal-box w-11/12 max-w-2xl">
            <h3 class="font-bold text-lg mb-4">Tambah Menu Baru</h3>
            
            <form action="{{ route('menu.store') }}" method="POST">
                @csrf
                
                <!-- Nama Menu -->
                <div class="form-control mb-4">
                    <label for="nama_menu" class="label">
                        <span class="label-text">Nama Menu</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_menu" 
                        id="nama_menu"
                        required
                        placeholder="Masukkan nama menu"
                        class="input input-bordered w-full"
                    >
                </div>

                <!-- Harga -->
                <div class="form-control mb-4">
                    <label for="harga" class="label">
                        <span class="label-text">Harga (Rp)</span>
                    </label>
                    <input 
                        type="number" 
                        name="harga" 
                        id="harga"
                        required
                        min="0"
                        placeholder="Masukkan harga"
                        class="input input-bordered w-full"
                    >
                </div>

                <!-- Deskripsi -->
                <div class="form-control mb-4">
                    <label for="deskripsi" class="label">
                        <span class="label-text">Deskripsi</span>
                    </label>
                    <textarea 
                        name="deskripsi" 
                        id="deskripsi"
                        rows="3"
                        placeholder="Masukkan deskripsi menu"
                        class="textarea textarea-bordered w-full"
                    ></textarea>
                </div>

                <!-- Footer Modal -->
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" onclick="menu_modal.close()" class="btn">Batal</button>
                </div>
            </form>
        </div>
        
        <!-- Click outside to close -->
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    

    @endsection
</x-dashboard.dashboard>