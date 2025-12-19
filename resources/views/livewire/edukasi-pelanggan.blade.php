<div class="p-4 pt-24 min-h-screen bg-[#fdfbf7]">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-bold text-[#3e2b22] mb-4 font-serif">Edukasi Kesehatan & Nutrisi</h2>
        <div class="h-1 w-24 bg-[#8a532b] mx-auto rounded-full mb-6"></div>
        <p class="text-[#8d6e63] text-lg max-w-2xl mx-auto mb-8 leading-relaxed">
            Temukan informasi berguna tentang kesehatan, nutrisi, dan gaya hidup sehat dari para ahli D'Lima Coffee.
        </p>
    </div>

    <div class="max-w-md mx-auto mb-8">
        <div class="relative group">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search"
                placeholder="Cari artikel edukasi..."
                class="w-full px-6 py-4 pl-14 pr-12 rounded-2xl border border-[#eaddcf] bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#8a532b] focus:border-transparent text-lg text-[#3e2b22] placeholder-[#9c8273]"
                style="transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                id="searchInput"
            >
            <div class="absolute left-5 top-1/2 transform -translate-y-1/2 flex items-center justify-center h-full">
                <svg class="w-6 h-6 text-[#947257]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            
            @if($search)
            <button 
                wire:click="$set('search', '')"
                class="absolute right-5 top-1/2 transform -translate-y-1/2 text-[#9c8273] hover:text-[#3e2b22]"
                style="transition: transform 0.2s ease;"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            @endif
        </div>
    </div>
    
    <div class="flex flex-wrap justify-center gap-3 mb-8">
        {{-- FIX: Menggunakan Hex Color #8a532b agar terlihat --}}
        <button 
            wire:click="$set('kategoriFilter', '')"
            class="px-6 py-3 rounded-full text-lg font-medium border-2 
            {{ !$kategoriFilter 
                ? 'bg-[#8a532b] border-[#8a532b] text-white shadow-lg' 
                : 'bg-transparent border-[#eaddcf] text-[#8d6e63] hover:border-[#8a532b] hover:text-[#8a532b]' 
            }}"
            style="transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
            id="filterSemua"
        >
            Semua
            @if(!$kategoriFilter)
                <span class="ml-2">✓</span>
            @endif
        </button>

        @if($kategoriList && $kategoriList->count() > 0)
            @foreach($kategoriList as $kategori)
                <button 
                    wire:click="$set('kategoriFilter', '{{ $kategori }}')"
                    class="px-6 py-3 rounded-full text-lg font-medium border-2
                    {{ $kategoriFilter == $kategori 
                        ? 'bg-[#8a532b] border-[#8a532b] text-white shadow-lg' 
                        : 'bg-transparent border-[#eaddcf] text-[#8d6e63] hover:border-[#8a532b] hover:text-[#8a532b]' 
                    }}"
                    style="transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                    id="filter{{ $kategori }}"
                >
                    {{ $kategori }}
                    @if($kategoriFilter == $kategori)
                        <span class="ml-2">✓</span>
                    @endif
                </button>
            @endforeach
        @endif
    </div>

    <div class="text-center mb-8">
        <p class="text-[#8d6e63] text-lg">
            <span class="font-bold text-[#8a532b]">{{ $totalEdukasi ?? 0 }}</span> artikel tersedia
            
            @if($search)
                <span class="ml-3 inline-block text-sm bg-[#fffaf5] text-[#8a532b] px-4 py-2 rounded-full border border-[#eaddcf]">
                    Pencarian: "{{ $search }}"
                </span>
            @endif
            @if($kategoriFilter && !$search)
                <span class="ml-3 inline-block text-sm bg-[#fffaf5] text-[#8a532b] px-4 py-2 rounded-full border border-[#eaddcf] font-medium">
                    Filter: {{ $kategoriFilter }}
                </span>
            @endif
        </p>
        
        @if($search || $kategoriFilter)
            <button 
                wire:click="resetFilters"
                class="mt-4 px-5 py-2 text-[#8a532b] hover:text-[#5e391f] font-medium flex items-center mx-auto hover:underline decoration-2 underline-offset-4"
                style="transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Reset Filter
            </button>
        @endif
    </div>

    @if($selectedEdukasi)
        <div class="max-w-4xl mx-auto mb-8 bg-white rounded-[2rem] shadow-xl border border-[#eaddcf] overflow-hidden" style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);">
            <div class="p-8 md:p-12">
                <button 
                    wire:click="closeDetail"
                    class="mb-6 flex items-center font-medium group mx-auto justify-center text-[#8a532b] hover:text-[#5e391f]"
                    style="transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                    id="backButton"
                >
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Artikel
                </button>
                
                <div class="mb-6">
                    <div class="flex flex-wrap items-center justify-center gap-4 mb-6">
                        <span class="inline-block text-sm font-semibold px-5 py-2 rounded-full" style="background-color: #f5e9dd; color: #8a532b;">
                            {{ $selectedEdukasi->kategori }}
                        </span>
                        <span class="text-[#9c8273] font-medium">
                            {{ $selectedEdukasi->created_at->format('d F Y') }}
                        </span>
                    </div>
                    
                    @if($selectedEdukasi->image)
                        <div class="mb-8 overflow-hidden rounded-2xl shadow-lg">
                            <img 
                                src="{{ Storage::url($selectedEdukasi->image) }}" 
                                alt="{{ $selectedEdukasi->judul }}"
                                class="w-full h-96 object-cover hover:scale-105 transition-transform duration-700"
                            >
                        </div>
                    @endif
                    
                    <h2 class="text-4xl font-bold text-[#3e2b22] mb-6 text-center font-serif leading-tight">
                        {{ $selectedEdukasi->judul }}
                    </h2>
                    
                    <div class="mb-8 p-8 rounded-2xl text-center border-l-4 border-[#8a532b]" style="background-color: #fffaf5;">
                        <p class="text-[#5e4033] text-xl italic font-serif">"{{ $selectedEdukasi->ringkasan }}"</p>
                    </div>
                    
                    <div class="prose prose-lg max-w-none text-[#5e4033] leading-loose text-lg mx-auto">
                        <div class="whitespace-pre-line">
                            {!! nl2br(e($selectedEdukasi->konten)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(!$selectedEdukasi)
        @if($edukasiList && $edukasiList->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto" id="articlesGrid">
                @foreach($edukasiList as $edukasi)
                    <div class="article-card bg-white rounded-3xl shadow-sm hover:shadow-xl overflow-hidden border border-[#eaddcf] group cursor-pointer" 
                         style="transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);" 
                         data-article-id="{{ $edukasi->id }}">
                        
                        @if($edukasi->image)
                            <div class="h-64 overflow-hidden article-image-container relative">
                                <img 
                                    src="{{ Storage::url($edukasi->image) }}" 
                                    alt="{{ $edukasi->judul }}"
                                    class="w-full h-full object-cover article-image"
                                    style="transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);"
                                >
                                <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        @else
                            <div class="h-64 bg-[#fffaf5] flex items-center justify-center text-[#d7ccc8]">
                                <span class="font-serif italic">No Image</span>
                            </div>
                        @endif
                        
                        <div class="p-8">
                            <div class="mb-4">
                                {{-- Badge Kategori --}}
                                <span class="inline-block text-xs font-bold px-3 py-1 rounded-lg uppercase tracking-wider mb-3" style="background-color: #f5e9dd; color: #8a532b;">
                                    {{ $edukasi->kategori }}
                                </span>
                                
                                <h3 class="text-2xl font-bold text-[#3e2b22] mb-3 line-clamp-2 min-h-[64px] font-serif group-hover:text-[#8a532b] transition-colors">
                                    {{ $edukasi->judul }}
                                </h3>
                                
                                <p class="text-[#8d6e63] mb-6 line-clamp-3 text-sm leading-relaxed">
                                    {{ $edukasi->ringkasan }}
                                </p>
                            </div>
                            
                            <div class="flex justify-between items-center pt-6 border-t border-[#f0ebe5]">
                                <span class="text-[#9c8273] text-xs font-bold uppercase tracking-wide">
                                    {{ $edukasi->created_at->format('d M Y') }}
                                </span>
                                <button 
                                    wire:click="showDetail({{ $edukasi->id }})"
                                    class="text-[#8a532b] hover:text-[#5e391f] font-bold text-sm flex items-center group/btn uppercase tracking-wider"
                                >
                                    Baca
                                    <svg class="w-4 h-4 ml-1 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-16 flex justify-center">
                {{ $edukasiList->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-dashed border-[#d7ccc8] max-w-4xl mx-auto">
                <div class="w-20 h-20 bg-[#fffaf5] rounded-full flex items-center justify-center mx-auto mb-6 text-[#d7ccc8]">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#3e2b22] mb-3 font-serif">
                    Belum ada artikel
                </h3>
                <p class="text-[#8d6e63] text-lg max-w-md mx-auto mb-10">
                    @if($search)
                        Tidak ditemukan hasil untuk "{{ $search }}"
                    @else
                        Admin belum menambahkan konten edukasi.
                    @endif
                </p>
                @if($search || $kategoriFilter)
                    <button 
                        wire:click="resetFilters"
                        class="px-8 py-3 font-bold rounded-full text-white shadow-lg hover:shadow-xl hover:-translate-y-0.5"
                        style="background-color: #8a532b; transition: all 0.3s;"
                    >
                        Reset Filter
                    </button>
                @endif
            </div>
        @endif
    @endif
</div>

{{-- SCRIPT YANG DIPERBAIKI UNTUK LIVEWIRE 3 --}}
<script>
document.addEventListener('livewire:init', function() {
    // 1. Jalankan efek saat halaman pertama kali dibuka
    initAllEffects();

    // 2. Jalankan efek setiap kali Livewire selesai update (Search/Filter/Page)
    Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
        succeed(({ snapshot, effect }) => {
            // Beri sedikit jeda agar DOM benar-benar sudah dirender ulang
            setTimeout(() => {
                initAllEffects();
            }, 50);
        })
    })
});

// Fungsi inisialisasi semua efek
function initAllEffects() {
    initZoomEffect();
    initFilterHover();
    initCardHover();
    initButtonHover();
    initSearchHover();
}

function initZoomEffect() {
    const images = document.querySelectorAll('.article-image');
    images.forEach(img => {
        const parent = img.closest('.h-64, .article-card');
        if (!parent) return;
        
        // Hapus listener lama agar tidak double (penting saat re-init)
        parent.onmouseenter = null;
        parent.onmouseleave = null;

        parent.onmouseenter = function() {
            const img = this.querySelector('.article-image');
            if (img) { img.style.transform = 'scale(1.1)'; img.style.transition = 'transform 0.5s ease'; }
        };
        parent.onmouseleave = function() {
            const img = this.querySelector('.article-image');
            if (img) { img.style.transform = 'scale(1)'; }
        };
    });
}

function initFilterHover() {
    const filterButtons = document.querySelectorAll('button[wire\\:click*="kategoriFilter"]');
    filterButtons.forEach(btn => {
        btn.onmouseenter = null; 
        btn.onmouseleave = null;

        btn.onmouseenter = function() {
            if (!this.classList.contains('bg-[#8a532b]')) {
                this.style.transform = 'scale(1.05)';
                this.style.boxShadow = '0 10px 25px -5px rgba(138, 83, 43, 0.3)';
                this.style.borderColor = '#8a532b';
                this.style.color = '#8a532b';
            }
        };
        btn.onmouseleave = function() {
            if (!this.classList.contains('bg-[#8a532b]')) {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = '';
                this.style.borderColor = '#eaddcf';
                this.style.color = '#8d6e63';
            }
        };
    });
}

function initCardHover() {
    const cards = document.querySelectorAll('.article-card');
    cards.forEach(card => {
        card.onmouseenter = null;
        card.onmouseleave = null;

        card.onmouseenter = function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 20px 40px -12px rgba(138, 83, 43, 0.15)';
            
            const title = this.querySelector('h3');
            if (title) title.style.color = '#8a532b';
            
            const badge = this.querySelector('span[style*="background-color: #f5e9dd"]');
            if (badge) {
                badge.style.transform = 'scale(1.1)';
                badge.style.transition = 'transform 0.3s ease';
            }
        };
        card.onmouseleave = function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
            
            const title = this.querySelector('h3');
            if (title) title.style.color = '#3e2b22';
            
            const badge = this.querySelector('span[style*="background-color: #f5e9dd"]');
            if (badge) badge.style.transform = 'scale(1)';
        };
    });
}

function initButtonHover() {
    const buttons = document.querySelectorAll('button[wire\\:click*="showDetail"]');
    buttons.forEach(btn => {
        btn.onmouseenter = null;
        btn.onmouseleave = null;

        btn.onmouseenter = function() {
            const arrow = this.querySelector('svg');
            if (arrow) arrow.style.transform = 'translateX(5px)';
        };
        btn.onmouseleave = function() {
            const arrow = this.querySelector('svg');
            if (arrow) arrow.style.transform = 'translateX(0)';
        };
    });
}

function initSearchHover() {
    const searchInput = document.querySelector('input[wire\\:model*="search"]');
    if (!searchInput) return;
    
    searchInput.onmouseenter = null;
    searchInput.onmouseleave = null;

    searchInput.onmouseenter = function() {
        this.style.boxShadow = '0 10px 25px -5px rgba(138, 83, 43, 0.1)';
    };
    searchInput.onmouseleave = function() {
        if (document.activeElement !== this) {
            this.style.boxShadow = '';
        }
    };
}
</script>