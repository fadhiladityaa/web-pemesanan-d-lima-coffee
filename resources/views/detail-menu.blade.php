@extends('layouts.main')

@section('container')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8 pt-24">
            <div class="grid md:grid-cols-2 gap-8 p-6 md:p-10">
                
                <!-- Foto Kopi -->
                <div class="flex items-center justify-center">
                    <img 
                        src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=500&q=80" 
                        alt="Kopi Susu Gula Aren"
                        class="w-full max-w-md h-auto rounded-xl shadow-2xl object-cover hover:scale-105 transition-transform duration-300"
                    >
                </div>

                <!-- Info Kopi -->
                <div class="flex flex-col justify-center space-y-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">
                            Kopi Susu Gula Aren
                        </h1>
                        <p class="text-3xl font-bold text-amber-600 mb-4">
                            Rp 25.000
                        </p>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Perpaduan sempurna antara kopi pilihan, susu segar, dan gula aren asli yang memberikan rasa manis alami dengan sentuhan karamel yang khas. Cocok dinikmati dingin maupun hangat.
                        </p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="bg-primary text-white font-medium font-poppins rounded-xl px-4"> 
                            Tambah ke Keranjang
                        </button>
                        
                        <button 
                            type="button"
                            onclick="window.history.back()"
                            class="flex-1 sm:flex-none bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-4 px-6 rounded-lg shadow-md transition-colors duration-200 text-center"
                        >
                            Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Detail Section -->
        <div class="grid md:grid-cols-2 gap-8">
            
            <!-- Sejarah -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Sejarah</h2>
                </div>
                <p class="text-gray-600 leading-relaxed">
                    Kopi susu gula aren merupakan minuman tradisional Indonesia yang telah ada sejak era penjajahan Belanda. Perpaduan antara kopi robusta dari perkebunan Jawa dengan gula aren dari pohon aren yang tumbuh di lereng-lereng pegunungan menciptakan cita rasa khas yang tidak ditemukan di negara lain. Minuman ini menjadi favorit para petani sebagai penambah energi sebelum bekerja di sawah.
                </p>
            </div>

            <!-- Penemu -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Penemu</h2>
                </div>
                <p class="text-gray-600 leading-relaxed">
                    Resep kopi susu gula aren modern dipopulerkan oleh Pak Tarno, seorang penjual kopi keliling di Jakarta pada tahun 1980-an. Beliau bereksperimen mencampurkan susu segar dengan kopi hitam pekat dan gula aren cair, menciptakan minuman yang langsung disukai banyak orang. Kini, minuman ini telah menjadi menu wajib di berbagai kedai kopi di seluruh Indonesia.
                </p>
            </div>

            <!-- Kandungan -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Kandungan</h2>
                </div>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Kafein alami (60-80mg per porsi)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Antioksidan tinggi dari biji kopi pilihan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Gula aren organik dengan indeks glikemik rendah</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Susu segar pasteurisasi</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Vitamin B kompleks dari gula aren</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Mineral (zat besi, kalsium, magnesium)</span>
                    </li>
                </ul>
            </div>

            <!-- Manfaat -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Manfaat</h2>
                </div>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Meningkatkan fokus dan konsentrasi untuk produktivitas maksimal</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Mengandung antioksidan untuk menangkal radikal bebas</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Memberikan energi alami tanpa lonjakan gula darah</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Meningkatkan mood dan mengurangi stres</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Membantu meningkatkan metabolisme tubuh</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-amber-600 rounded-full mt-2 flex-shrink-0"></span>
                        <span class="text-gray-600">Sumber kalsium untuk kesehatan tulang</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</div>
@endsection