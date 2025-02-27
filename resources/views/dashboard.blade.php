<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="w-full h-screen bg-slate-600 font-[poppins] text-slate-50">
        <div class="bg-slate-400 p-5 shadow-md flex justify-between items-center">
            <h1 class="text-xl">Daftar Menu</h1>
            <!-- You can open the modal using ID.showModal() method -->
            <button class="text-md bg-green-500 p-2 rounded-lg shadow-lg hover:bg-green-600" onclick="my_modal_3.showModal()">Tambah Menu</button>
            <dialog id="my_modal_3" class="modal">
            <div class="modal-box bg-slate-500">
                <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>


                <h1 class="text-center text-xl">Masukkan Menu Baru</h1>
                <div class="w-4/5 mx-auto py-2">                    
                    <form class="flex mt-3 flex-col text-slate-500 gap-4 justify-center items-center" method="post" action="{{ route('tambah.menu') }}">
                        @csrf
                        <input name="nama_menu" type="text" placeholder="Nama Menu" class="input input-bordered w-full max-w-xs shadow-xl" />       
                        <input name="harga" type="text" placeholder="Harga" class="input input-bordered w-full max-w-xs shadow-xl" />   
                        <input name="gambar" type="file" class="file-input file-input-bordered w-full max-w-xs shadow-xl" />    
                        <textarea name="deskripsi" class="textarea w-80 textarea-bordered shadow-xl" placeholder="Deskripsi Menu"></textarea>
                        <button class="btn shadow-xl w-full bg-slate-950/20 border-none text-slate-200 hover:bg-slate-950/50">Tambah</button>
                    </form>
                </div>
            </div>
            </dialog>
        </div>

        @if (session()->has('success'))        
        <div role="alert" class="alert alert-info flex text-slate-50/78 rounded-none">
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


    
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead  class="text-slate-50/70">
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($menus as $menu)
                    <tbody>
                        <!-- row 1 -->
                        <tr class="">
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $menu->nama_menu }}</td>
                            <td>{{ $menu->deskripsi }}</td>
                        </tr>
                    </tbody>
            @endforeach
                </table>
            </div>
       </div>

</x-layout>