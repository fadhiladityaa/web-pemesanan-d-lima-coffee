@extends('layouts.main')

@section('container')
<div class="min-h-screen bg-gray-50 pt-32 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Alerts -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm" role="alert" data-aos="fade-down">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md shadow-sm" role="alert" data-aos="fade-down">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                    <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8" data-aos="fade-down">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-primary/10 text-primary flex items-center justify-center text-3xl font-bold border-4 border-white shadow-md">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div class="text-center md:text-left">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $user->name }}</h1>

                        <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                             {{ $user->isAdmin() ? 'Administrator' : 'Verified Member' }}
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                     <button onclick="document.getElementById('editProfileModal').showModal()" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                        Edit Profil
                    </button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-red-50 text-red-600 font-semibold hover:bg-red-100 transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Info & Address -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Personal Info Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Informasi Pribadi
                    </h2>
                    <div class="space-y-4">
                        <div>
                            <span class="text-sm text-gray-500 block">Nama Lengkap</span>
                            <span class="font-medium text-gray-900">{{ $user->name }}</span>
                        </div>
            
                        <div>
                            <span class="text-sm text-gray-500 block">Nomor Telepon</span>
                            <span class="font-medium text-gray-900">{{ $user->noHp ?? '-' }}</span>
                        </div>
                        <div>
                             <span class="text-sm text-gray-500 block">Bergabung Sejak</span>
                            <span class="font-medium text-gray-900">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Address Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Alamat Utama
                        </h2>
                         @if($latestAddress)
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-md uppercase">Default</span>
                        @endif
                    </div>
                    
                    @if($latestAddress)
                        <p class="text-gray-600 leading-relaxed mb-4">
                            {{ $latestAddress }}
                        </p>
                         <button onclick="alert('Untuk saat ini alamat diambil otomatis dari pesanan terakhir Anda.')" class="text-sm text-primary font-bold hover:underline">
                            Ubah Alamat
                        </button>
                    @else
                        <div class="text-center py-4 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                            <p class="text-gray-500 text-sm mb-2">Belum ada alamat tersimpan</p>
                            <span class="text-xs text-gray-400">Alamat akan otomatis tersimpan setelah pesanan pertama Anda.</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Order History & Settings -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Recent Orders -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                             <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Riwayat Pesanan Terbaru
                        </h2>
                        <a href="{{ route('pesanan.saya') }}" class="text-sm text-primary font-bold hover:underline flex items-center">
                            Lihat Semua
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>

                    @if($orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-100">
                                <tr>
                                    <th class="py-3 px-4 font-semibold text-gray-600 text-xs uppercase tracking-wider">ID Pesanan</th>
                                    <th class="py-3 px-4 font-semibold text-gray-600 text-xs uppercase tracking-wider">Tanggal</th>
                                     <th class="py-3 px-4 font-semibold text-gray-600 text-xs uppercase tracking-wider">Total</th>
                                    <th class="py-3 px-4 font-semibold text-gray-600 text-xs uppercase tracking-wider">Status</th>
                                    <th class="py-3 px-4 font-semibold text-gray-600 text-xs uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($orders as $order)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4">
                                        <span class="font-bold text-gray-900">#{{ $order->id }}</span>
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-600">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </td>
                                     <td class="py-3 px-4 font-bold text-primary text-sm">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4">
                                        @php
                                            $badges = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'paid' => 'bg-blue-100 text-blue-800',
                                                'siap' => 'bg-indigo-100 text-indigo-800',
                                                'completed' => 'bg-green-100 text-green-800',
                                                'canceled' => 'bg-red-100 text-red-800',
                                                'failed' => 'bg-red-100 text-red-800',
                                            ];
                                            $status = $order->order_status == 'completed' || $order->order_status == 'selesai' ? 'Selesai' : ucfirst($order->order_status);
                                             if($order->payment_status == 'pending') $status = 'Menunggu Pembayaran';
                                        @endphp
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badges[$order->order_status] ?? ($order->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <a href="{{ route('detail.pesanan', $order->id) }}" class="text-sm font-semibold text-primary hover:text-primary/80">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-12 bg-gray-50 rounded-xl">
                        <svg class="h-12 w-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <p class="text-gray-500 font-medium">Belum ada riwayat pesanan.</p>
                         <a href="{{ route('menu') }}" class="mt-3 inline-block text-primary font-bold hover:underline">Pesan Sekarang</a>
                    </div>
                    @endif
                </div>

                <!-- Account Settings -->
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl shadow-lg p-6 text-white" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                         <div>
                            <h2 class="text-lg font-bold mb-2">Keamanan Akun</h2>
                            <p class="text-gray-300 text-sm max-w-md">Jaga keamanan akun Anda dengan mengganti password secara berkala.</p>
                        </div>
                        <button onclick="document.getElementById('changePasswordModal').showModal()" class="px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold transition-all backdrop-blur-sm whitespace-nowrap">
                            Ganti Password
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
<dialog id="editProfileModal" class="modal">
  <div class="modal-box bg-white">
    <h3 class="font-bold text-lg mb-4 text-gray-900">Edit Profil</h3>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nama Lengkap
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="noHp">
                Nomor Telepon
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="noHp" type="text" name="noHp" value="{{ old('noHp', $user->noHp) }}" required>
        </div>

        <div class="modal-action">
             <button type="button" class="btn btn-ghost" onclick="document.getElementById('editProfileModal').close()">Batal</button>
            <button type="submit" class="btn bg-primary text-white hover:bg-primary/90">Simpan Perubahan</button>
        </div>
    </form>
  </div>
   <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<!-- Modal Ganti Password -->
<dialog id="changePasswordModal" class="modal">
  <div class="modal-box bg-white">
    <h3 class="font-bold text-lg mb-4 text-gray-900">Ganti Password</h3>
    <form action="{{ route('profile.password') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="current_password">
                Password Saat Ini
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="current_password" type="password" name="current_password" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password Baru
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                Konfirmasi Password Baru
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <div class="modal-action">
             <button type="button" class="btn btn-ghost" onclick="document.getElementById('changePasswordModal').close()">Batal</button>
            <button type="submit" class="btn bg-primary text-white hover:bg-primary/90">Simpan Password</button>
        </div>
    </form>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

@endsection