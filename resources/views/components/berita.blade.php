<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="warkop-news bg-gray-900 min-h-screen text-primary-100">
        <!-- Header -->
        <header class="bg-gray-900 py-6 border-primary">
            <div class="container mx-auto px-4">
                <h1 class="text-3xl font-bold text-white">Berita D'Lima</h1>
                <p class="text-white mt-2">Informasi terbaru seputar warkop dan kopi</p>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">
            <!-- Featured News -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-primary mb-6 pb-2 border-b border-primary">Berita Utama</h2>
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5" alt="Featured News" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 bg-primary-dark text-primary-50 rounded-full text-sm mb-2">Terbaru</span>
                        <h3 class="text-xl font-bold mb-2 text-primary-100">Harga Biji Kopi Dunia Naik 15% di Awal Tahun</h3>
                        <p class="text-gray-300 mb-4">Kenaikan harga biji kopi dipengaruhi oleh perubahan iklim di Brazil dan meningkatnya permintaan global...</p>
                        <a href="#" class="text-primary-light hover:text-primary font-medium">Baca selengkapnya →</a>
                    </div>
                </div>
            </section>

            <!-- News Grid -->
            <section>
                <h2 class="text-2xl font-semibold text-primary mb-6 pb-2 border-b border-primary">Berita Terkini</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- News Item 1 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                        <img src="https://images.unsplash.com/photo-1447933601403-0c6688de566e" alt="News 1" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-2 text-primary-100">Event Seduh Kopi Manual Bulan Ini</h3>
                            <p class="text-gray-300 text-sm mb-4">Pelajari teknik seduh manual dari para ahli di event bulanan warkop kita...</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-primary-light">2 hari lalu</span>
                                <a href="#" class="text-primary hover:text-primary-light text-sm font-medium">Baca →</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Item 2 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                        <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348" alt="News 2" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-2 text-primary-100">Menu Baru: Kopi Rempah Khas Warkop</h3>
                            <p class="text-gray-300 text-sm mb-4">Coba varian baru kopi dengan campuran rempah-rempah khas nusantara...</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-primary-light">1 minggu lalu</span>
                                <a href="#" class="text-primary hover:text-primary-light text-sm font-medium">Baca →</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Item 3 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                        <img src="https://images.unsplash.com/photo-1461988091159-192b6df7054f" alt="News 3" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-2 text-primary-100">Tips Menyimpan Biji Kopi di Rumah</h3>
                            <p class="text-gray-300 text-sm mb-4">Agar biji kopi tetap segar dan aromatik, simak tips penyimpanan berikut...</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-primary-light">2 minggu lalu</span>
                                <a href="#" class="text-primary hover:text-primary-light text-sm font-medium">Baca →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Newsletter -->
            <section class="mt-16 bg-primary bg-opacity-10 rounded-lg p-8 border border-primary">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="text-xl font-bold text-primary mb-4">Dapatkan Update Berita Terbaru</h2>
                    <p class="text-white mb-6">Berlangganan newsletter kami untuk mendapatkan informasi terbaru seputar warkop dan dunia kopi</p>
                    <form class="flex flex-col sm:flex-row gap-4">
                        <input type="email" placeholder="Alamat email Anda" class="flex-grow px-4 py-2 rounded bg-gray-700 text-primary-50 border border-primary focus:outline-none focus:ring-2 focus:ring-primary">
                        <button type="submit" class="px-6 py-2 bg-primary hover:bg-primary-dark text-white font-medium rounded transition-colors">Berlangganan</button>
                    </form>
                </div>
            </section>
        </main>
    </div>
</x-layout>