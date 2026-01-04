<a href="{{ $url ?? '/' }}" 
   class="fixed left-4 z-[60] flex items-center gap-2 px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-full shadow-md hover:shadow-lg hover:bg-white text-gray-700 hover:text-primary transition-all duration-300 group {{ $class ?? 'top-6' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
    </svg>
    <span class="font-semibold text-xs">Kembali</span>
</a>
