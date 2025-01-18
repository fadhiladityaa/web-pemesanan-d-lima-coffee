<div  class="bg-black  -mt-1 text-white font-poppins pt-16 flex items-center flex-col pb-32">
    <div class="w-52 sm:w-72 text-sm text-center">
        <h1 class="text-center font-bold text-lg  text-white sm:text-3xl "><span class="text-primary ">Menu</span> Kami</h1>
        <h2 class="font-extralight text-ssm sm:text-mmd sm:mb-3 mt-2">Memastikan menu yang tersedia adalah yang terbaik</h2>
    </div>


    <div class="card-container gap-3 mt-5 flex flex-col sm:flex-row sm:flex-wrap sm:items-center sm:justify-center sm:gap-3">
      @foreach ($menus as $menu)            
        <div  class="card bg-secondary font-poppins text-menu font-bold flex flex-row gap-4 pt-4 pl-4 pr-6 pb-4">
            <div class="kiri w-24 flex flex-col justify-center">
                <img class="w-24" src="img/kopi-1.png" alt="">
    
                
                <div class="counter text-black flex mx-auto mt-4 font-normal">
                    <button class="px-2.5 py-0 border border-slate-500 rounded-lg">-</button>
                    <p class="px-2.5 py-0 border border-slate-500 rounded-lg">0</p>
                    <button class="px-2.5 py-0 border border-slate-500 rounded-lg">+</button>
                </div>
            </div>
    
            <div class="kanan w-44">
                <div class="nama-menu flex justify-between mt-1.5">
                    <h3 class="text-sm">{{ $menu->nama_menu }}</h3>
                    <h3></h3>
                    <p class="text-primary">Rp.{{ $menu->harga }}</p>
                </div>
    
                <div class="deskripsi text-ssm font-extralight mt-1">
                    <p>{{ $menu->deskripsi }}</p>
                </div>
    
                <div class="level text-ssm text-black font-light flex gap-x-1.5 mt-2">
                    <span class="bg-white px-2 py-1 rounded-xl hover:bg-primary hover:text-white">Sweet</span>
                    <span class="bg-white px-2 py-1 rounded-xl hover:bg-primary hover:text-white">Medium</span>
                    <span class="bg-white px-2 py-1 rounded-xl hover:bg-primary hover:text-white">Strong</span>
                </div>

                <form method="get" action="{{ route('all.about.home', $menu->id ) }}">
                    <button class="bg-primary font-normal w-full rounded-2xl py-2 mt-3 text-white hover:bg-amber-800">
                        Add To Cart
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>