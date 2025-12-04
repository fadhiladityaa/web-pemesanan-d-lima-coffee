<div>
    <div class="p-4 pt-24">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-50 to-blue-50 py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4"> Edukasi Kesehatan & Nutrisi</h1>
                <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">
                    Temukan informasi berguna tentang kesehatan, nutrisi, dan gaya hidup sehat dari para ahli D'Lima Coffee.
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto mb-8">
                    <div class="relative">
                        <input 
                            type="text" 
                            wire:model.live.debounce.300ms="search"
                            placeholder="Cari artikel edukasi..."
                            class="w-full px-6 py-4 pl-14 pr-12 rounded-2xl border border-gray-200 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-transparent text-lg"
                        >
                        <div class="absolute left-5 top-4">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        @if($search)
                        <button 
                            wire:click="$set('search', '')"
                            class="absolute right-5 top-4 text-gray-400 hover:text-gray-600"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        @endif
                    </div>
                </div>
                
                <!-- Kategori Filter -->
                @if($kategoriList->count() > 0)
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        <button 
                            wire:click="$set('kategoriFilter', '')"
                            class="px-4 py-2 rounded-full {{ !$kategoriFilter ? 'bg-green-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }} border border-gray-200 transition-colors"
                        >
                            Semua
                        </button>
                        @foreach($kategoriList as $kategori)
                            <button 
                                wire:click="$set('kategoriFilter', '{{ $kategori }}')"
                                class="px-4 py-2 rounded-full {{ $kategoriFilter == $kategori ? 'bg-green-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }} border border-gray-200 transition-colors"
                            >
                                {{ $kategori }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Info Stats -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-gray-600">
                    <span class="font-semibold">{{ $totalEdukasi }}</span> artikel tersedia
                    @if($search)
                        <span class="ml-2">• Hasil pencarian: "{{ $search }}"</span>
                    @endif
                    @if($kategoriFilter)
                        <span class="ml-2">• Kategori: {{ $kategoriFilter }}</span>
                    @endif
                </p>
            </div>
            
            @if($search || $kategoriFilter)
                <button 
                    wire:click="resetFilters"
                    class="px-4 py-2 text-sm bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 flex items-center"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset Filter
                </button>
            @endif
        </div>

        <!-- Jika ada selected edukasi (detail view) -->
        @if($selectedEdukasi)
            <div class="mb-8 bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <button 
                        wire:click="closeDetail"
                        class="mb-6 flex items-center text-green-600 hover:text-green-800 font-medium"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar Artikel
                    </button>
                    
                    <div class="mb-6">
                        <div class="flex flex-wrap items-center gap-4 mb-4">
                            <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-4 py-2 rounded-full">
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
                            <div class="mb-8">
                                <img 
                                    src="{{ Storage::url($selectedEdukasi->image) }}" 
                                    alt="{{ $selectedEdukasi->judul }}"
                                    class="w-full h-96 object-cover rounded-xl"
                                >
                            </div>
                        @endif
                        
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $selectedEdukasi->judul }}</h2>
                        
                        <div class="mb-8 p-6 bg-green-50 rounded-xl">
                            <p class="text-gray-700 text-lg italic">"{{ $selectedEdukasi->ringkasan }}"</p>
                        </div>
                        
                        <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
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
            @if($edukasiList->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($edukasiList as $edukasi)
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100 group">
                            @if($edukasi->image)
                                <div class="h-56 overflow-hidden">
                                    <img 
                                        src="{{ Storage::url($edukasi->image) }}" 
                                        alt="{{ $edukasi->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    >
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="mb-4">
                                    <span class="inline-block bg-green-100 text-green-700 text-sm font-semibold px-3 py-1 rounded-full mb-3">
                                        {{ $edukasi->kategori }}
                                    </span>
                                    <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-green-600 transition-colors">
                                        {{ $edukasi->judul }}
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        {{ $edukasi->ringkasan }}
                                    </p>
                                </div>
                                
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <span class="text-gray-500 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $edukasi->created_at->format('d M Y') }}
                                    </span>
                                    <button 
                                        wire:click="showDetail({{ $edukasi->id }})"
                                        class="text-green-600 hover:text-green-800 font-medium text-sm flex items-center group/btn"
                                    >
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $edukasiList->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mb-6">
                        <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-3">Belum ada artikel edukasi</h3>
                    <p class="text-gray-500 max-w-md mx-auto mb-8">
                        @if($search)
                            Tidak ditemukan artikel dengan kata kunci "{{ $search }}"
                        @else
                            Admin belum menambahkan konten edukasi. Silakan check kembali nanti.
                        @endif
                    </p>
                    @if($search || $kategoriFilter)
                        <button 
                            wire:click="resetFilters"
                            class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors"
                        >
                            Reset Pencarian
                        </button>
                    @endif
                </div>
            @endif
        @endif
    </div>
</div>