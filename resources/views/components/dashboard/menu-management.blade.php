<x-dashboard.dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    @section('content')
    <div class="p-6 bg-white rounded-lg shadow">
        <!-- Header Tabel dan Tombol Tambah -->
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
                            <div class="text-sm font-medium text-gray-900">{{ $m["nama_menu"] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp. {{ $m["harga"]}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ Str::limit($m["deskripsi"], 30) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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