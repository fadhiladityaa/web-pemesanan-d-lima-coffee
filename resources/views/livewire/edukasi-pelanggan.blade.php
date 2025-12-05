<div class="p-4 pt-24">
    <!-- Header Sederhana di Tengah -->
    <div class="text-center mb-10">
        <!-- JUDUL UTAMA SAJA (tanpa logo) -->
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Edukasi Kesehatan & Nutrisi</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">
            Temukan informasi berguna tentang kesehatan, nutrisi, dan gaya hidup sehat dari para ahli D'Lima Coffee.
        </p>
    </div>

    <!-- Search Bar di Tengah -->
    <div class="max-w-md mx-auto mb-8">
        <div class="relative">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search"
                placeholder="Cari artikel edukasi..."
                class="w-full px-6 py-4 pl-14 pr-12 rounded-2xl border border-gray-300 bg-white shadow-sm focus:ring-2 focus:border-transparent text-lg"
                style="transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
            >
            <!-- Icon Search -->
            <div class="absolute left-5 top-1/2 transform -translate-y-1/2">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            
            <!-- Clear Button -->
            @if($search)
            <button 
                wire:click="$set('search', '')"
                class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                style="transition: transform 0.2s ease;"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            @endif
        </div>
    </div>
    
    <!-- Kategori Filter di Tengah -->
    <div class="flex flex-wrap justify-center gap-3 mb-8">
        <button 
            wire:click="$set('kategoriFilter', '')"
            class="px-6 py-3 rounded-full text-lg font-medium {{ !$kategoriFilter ? 'bg-brown-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
            style="transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
        >
            Semua
        </button>
        @if($kategoriList && $kategoriList->count() > 0)
            @foreach($kategoriList as $kategori)
                <button 
                    wire:click="$set('kategoriFilter', '{{ $kategori }}')"
                    class="px-6 py-3 rounded-full text-lg font-medium {{ $kategoriFilter == $kategori ? 'bg-brown-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                    style="transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    {{ $kategori }}
                </button>
            @endforeach
        @endif
    </div>

    <!-- Info Stats di Tengah -->
    <div class="text-center mb-8">
        <p class="text-gray-600 text-lg">
            <span class="font-semibold text-brown-600">{{ $totalEdukasi ?? 0 }}</span> artikel tersedia
            @if($search)
                <span class="ml-3 inline-block text-sm bg-brown-50 text-brown-700 px-4 py-2 rounded-full">
                    Pencarian: "{{ $search }}"
                </span>
            @endif
        </p>
        
        @if($search || $kategoriFilter)
            <button 
                wire:click="resetFilters"
                class="mt-4 px-5 py-2 text-brown-600 hover:text-brown-800 font-medium flex items-center mx-auto"
                style="transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Reset Filter
            </button>
        @endif
    </div>

    <!-- Jika ada selected edukasi (detail view) -->
    @if($selectedEdukasi)
        <div class="max-w-4xl mx-auto mb-8 bg-white rounded-3xl shadow-lg overflow-hidden" style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);">
            <div class="p-8">
                <button 
                    wire:click="closeDetail"
                    class="mb-6 flex items-center font-medium group mx-auto justify-center"
                    style="color: #8a532b; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Artikel
                </button>
                
                <div class="mb-6">
                    <div class="flex flex-wrap items-center justify-center gap-4 mb-6">
                        <span class="inline-block text-sm font-semibold px-5 py-2 rounded-full" style="background-color: #f5e9dd; color: #8a532b; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                            {{ $selectedEdukasi->kategori }}
                        </span>
                        <span class="text-gray-500">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $selectedEdukasi->created_at->format('d F Y') }}
                        </span>
                    </div>
                    
                    @if($selectedEdukasi->image)
                        <div class="mb-8 overflow-hidden rounded-2xl">
                            <img 
                                src="{{ Storage::url($selectedEdukasi->image) }}" 
                                alt="{{ $selectedEdukasi->judul }}"
                                class="w-full h-96 object-cover"
                                style="transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);"
                            >
                        </div>
                    @endif
                    
                    <h2 class="text-4xl font-bold text-gray-800 mb-6 text-center" style="transition: color 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                        {{ $selectedEdukasi->judul }}
                    </h2>
                    
                    <div class="mb-8 p-8 rounded-2xl text-center" style="background-color: #fdf8f3; transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);">
                        <p class="text-gray-700 text-xl italic">"{{ $selectedEdukasi->ringkasan }}"</p>
                    </div>
                    
                    <div class="prose max-w-none text-gray-700 leading-relaxed text-lg mx-auto">
                        <div class="whitespace-pre-line">
                            {!! nl2br(e($selectedEdukasi->konten)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Grid Artikel (jika tidak sedang melihat detail) -->
    @if(!$selectedEdukasi)
        @if($edukasiList && $edukasiList->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                @foreach($edukasiList as $edukasi)
                    <div class="bg-white rounded-3xl shadow-md overflow-hidden border border-gray-100 group" style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);">
                        @if($edukasi->image)
                            <div class="h-64 overflow-hidden rounded-t-3xl">
                                <img 
                                    src="{{ Storage::url($edukasi->image) }}" 
                                    alt="{{ $edukasi->judul }}"
                                    class="w-full h-full object-cover"
                                    style="transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);"
                                >
                            </div>
                        @endif
                        
                        <div class="p-8">
                            <div class="mb-6">
                                <span class="inline-block text-sm font-semibold px-4 py-2 rounded-full mb-4" style="background-color: #f5e9dd; color: #8a532b; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                                    {{ $edukasi->kategori }}
                                </span>
                                <h3 class="text-2xl font-bold text-gray-800 mb-4 line-clamp-2 min-h-[72px]" style="transition: color 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                                    {{ $edukasi->judul }}
                                </h3>
                                <p class="text-gray-600 mb-6 line-clamp-3 text-lg">
                                    {{ $edukasi->ringkasan }}
                                </p>
                            </div>
                            
                            <div class="flex justify-between items-center pt-6 border-t border-gray-100">
                                <span class="text-gray-500 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $edukasi->created_at->format('d M Y') }}
                                </span>
                                <button 
                                    wire:click="showDetail({{ $edukasi->id }})"
                                    class="text-brown-600 hover:text-brown-800 font-medium text-lg flex items-center group/btn"
                                    style="transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                                >
                                    Baca Selengkapnya
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination di Tengah -->
            <div class="mt-12 flex justify-center">
                {{ $edukasiList->links() }}
            </div>
        @else
            <!-- Empty State di Tengah -->
            <div class="text-center py-20 bg-white rounded-3xl shadow-sm max-w-4xl mx-auto">
                <div class="mb-8" style="transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);">
                    <svg class="w-32 h-32 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-semibold text-gray-700 mb-4" style="transition: color 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                    Belum ada artikel edukasi
                </h3>
                <p class="text-gray-500 text-lg max-w-md mx-auto mb-10">
                    @if($search)
                        Tidak ditemukan artikel dengan kata kunci "{{ $search }}"
                    @else
                        Admin belum menambahkan konten edukasi. Silakan check kembali nanti.
                    @endif
                </p>
                @if($search || $kategoriFilter)
                    <button 
                        wire:click="resetFilters"
                        class="px-8 py-4 font-medium rounded-xl text-lg"
                        style="background-color: #8a532b; color: white; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        Reset Pencarian
                    </button>
                @endif
            </div>
        @endif
    @endif
    
    <!-- JavaScript untuk efek hover -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Efek hover untuk tombol kategori
        const categoryButtons = document.querySelectorAll('button[wire\\:click*="kategoriFilter"]');
        categoryButtons.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
                this.style.boxShadow = '0 10px 25px -5px rgba(138, 83, 43, 0.3)';
            });
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
            });
        });
        
        // Efek hover untuk kartu artikel
        const cards = document.querySelectorAll('.bg-white.rounded-3xl.shadow-md');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
                this.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.25)';
                
                // Efek gambar zoom
                const img = this.querySelector('img');
                if(img) img.style.transform = 'scale(1.1)';
                
                // Efek teks berubah warna
                const title = this.querySelector('h3');
                if(title) title.style.color = '#8a532b';
                
                // Efek badge scale
                const badge = this.querySelector('span[style*="background-color: #f5e9dd"]');
                if(badge) badge.style.transform = 'scale(1.1)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)';
                
                // Reset gambar
                const img = this.querySelector('img');
                if(img) img.style.transform = 'scale(1)';
                
                // Reset teks
                const title = this.querySelector('h3');
                if(title) title.style.color = '#1f2937';
                
                // Reset badge
                const badge = this.querySelector('span[style*="background-color: #f5e9dd"]');
                if(badge) badge.style.transform = 'scale(1)';
            });
        });
        
        // Efek hover untuk tombol baca selengkapnya
        const readButtons = document.querySelectorAll('button[wire\\:click*="showDetail"]');
        readButtons.forEach(btn => {
            const arrow = btn.querySelector('svg');
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
                if(arrow) arrow.style.transform = 'translateX(10px)';
            });
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                if(arrow) arrow.style.transform = 'translateX(0)';
            });
        });
        
        // Efek hover untuk tombol reset
        const resetBtn = document.querySelector('button[wire\\:click*="resetFilters"]');
        if(resetBtn) {
            resetBtn.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
                this.style.boxShadow = '0 10px 25px -5px rgba(138, 83, 43, 0.3)';
            });
            resetBtn.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
            });
        }
        
        // Efek hover untuk input search
        const searchInput = document.querySelector('input[wire\\:model*="search"]');
        if(searchInput) {
            searchInput.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.1)';
            });
            searchInput.addEventListener('mouseleave', function() {
                if(document.activeElement !== this) {
                    this.style.boxShadow = '0 1px 3px 0 rgba(0, 0, 0, 0.1)';
                }
            });
        }
    });
    </script>
</div>