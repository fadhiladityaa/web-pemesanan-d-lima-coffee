<div class="p-4 pt-24">
    <h2 class="text-lg font-bold mb-3">Manajemen Edukasi</h2>

    @if (session()->has('success'))
        <div class="mb-3 text-green-700">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <input wire:model="judul" placeholder="Judul" class="w-full mb-2 p-2 border rounded">
        <textarea wire:model="konten" placeholder="Konten" class="w-full p-2 border rounded" rows="5"></textarea>
        <div class="mt-2">
            @if ($selectedId)
                <button wire:click="update" class="px-3 py-1 bg-blue-600 text-white rounded">Update</button>
                <button wire:click="resetForm" class="px-3 py-1 bg-gray-400 text-white rounded">Batal</button>
            @else
                <button wire:click="save" class="px-3 py-1 bg-green-600 text-white rounded">Simpan</button>
            @endif
        </div>
    </div>

    <table class="w-full border-collapse">
        <thead><tr class="bg-gray-100"><th class="p-2 text-left">Judul</th><th class="p-2 text-left">Konten</th><th class="p-2">Aksi</th></tr></thead>
        <tbody>
        @forelse($dataEdukasi as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->judul }}</td>
                <td class="p-2">{{ \Illuminate\Support\Str::limit($item->konten, 120) }}</td>
                <td class="p-2">
                    <button wire:click="edit({{ $item->id }})" class="px-2 py-1 bg-yellow-400 rounded">Edit</button>
                    <button wire:click="delete({{ $item->id }})" class="px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="p-2 text-center">Belum ada data edukasi.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
