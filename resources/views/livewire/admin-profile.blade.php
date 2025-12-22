<div>
    <div class="mb-6 flex flex-col mt-20 p-7 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Pengaturan Profil</h1>
            <p class="text-gray-600 mt-1">Kelola informasi akun dan keamanan Anda</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mx-7 pb-10">
        
        <!-- Profile Information Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Informasi Akun
                </h2>
            </div>
            
            <div class="p-6">
                @if (session()->has('success'))
                    <div class="mb-4 bg-green-50 text-green-700 px-4 py-3 rounded-lg border border-green-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit="updateProfile">
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input wire:model="name" type="text" id="name" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 transition duration-200">
                            @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="noHp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input wire:model="noHp" type="text" id="noHp" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 transition duration-200">
                            @error('noHp') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors w-full sm:w-auto">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden h-fit">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Ganti Password
                </h2>
            </div>

            <div class="p-6">
                @if (session()->has('password_success'))
                    <div class="mb-4 bg-green-50 text-green-700 px-4 py-3 rounded-lg border border-green-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('password_success') }}
                    </div>
                @endif

                <form wire:submit="updatePassword">
                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                            <input wire:model="current_password" type="password" id="current_password" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 transition duration-200">
                            @error('current_password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                            <input wire:model="password" type="password" id="password" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 transition duration-200">
                            @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                            <input wire:model="password_confirmation" type="password" id="password_confirmation" class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 transition duration-200">
                        </div>

                        <div class="pt-2">
                             <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors w-full sm:w-auto">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
