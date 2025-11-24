<div class="lg:hidden relative z-10" onclick="getElementById('otw').scrollIntoView({behavior: 'smooth'})">
    @if ($itemCount)
    <div class="rounded-full sm:p-7 p-5 bg-primary fixed right-3 bottom-44 sm:bottom-80  cursor-pointer">
   <div class="text-white font-poppins font-semibold rounded-full w-6 h-6 top-0 sm:w-8 sm:h-8 -left-1 flex items-center justify-center text-[0.650rem] absolute bg-red-600">{{ $itemCount
}}</div>
       <img class="h-7" src="{{ asset('img/cart-arrow-down-svgrepo-com.svg') }}" alt="">
   </div>
    @endif
</div>