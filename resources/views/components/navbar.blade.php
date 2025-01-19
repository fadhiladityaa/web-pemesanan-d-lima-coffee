<div class="navbar bg-black shadow-lg flex justify-between fixed z-40 lg:p-4">

    <div class="title">
          <a href="/" class="btn btn-ghost text-xl lg:text-2xl text-white font-poppins font-bold">
            D'Lima<span class="text-primary italic">Coffee<span class="text-white">.</span></span>
        </a>
    </div>
    
    <div class="links text-white sm:flex gap-7 hidden font-poppins">
      <a href="">Home</a>
      <a href="">Tentang Kami</a>
      <a href="">Kontak</a>
    </div>


    <div class="flex-3 gap-0">
      <div class="dropdown dropdown-end">
        <button class="btn btn-ghost  p-0">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-5"
            fill="none"
            viewBox="0 0 20 20"
            stroke="white">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
  
      </div>

      <div x-data="{ open: true }" class="dropdown dropdown-end relative">
        <div @click="open = !open" role="button" class="btn btn-ghost p-3">
          <div class="indicator">
            <svg 
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              fill="none"
              viewBox="0 0 20 20"
              stroke="white">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="badge badge-sm indicator-item">1</span>
          </div>
        </div>
      
        <!-- Dropdown Content -->
        <div
          x-show="open"
          x-transition
          class="card card-compact absolute bg-base-100 z-[1] mt-3 -right-12 w-80 shadow"
          @click.outside="open = false">
          <div class="card-body flex flex-col justify-between">
            <!-- Tombol Close -->
            <div class="topper flex flex-col items-end gap-2">
              <button @click="open = false" class="font-bold text-lg border border-black-100 px-2 hover:bg-slate-500">
                X
              </button>
            </div>
            <p>Keranjang Anda</p> 

            <div class="belanjaan flex justify-between border border-blue-300 p-3">
              <span>Coppucino</span>
              <span>Rp. 20000</span>
              <div  x-data="{counter: 1}" class="counter flex gap items-center">
                <button class="border-2 border-slate rounded-md px-2" @click=counter++>+</button>
                <span class="border-2 border-slate rounded-md px-2" x-text="counter"></span>
                <button class="border-2 border-slate rounded-md px-2" class="text-lg" @click=counter-->-</button>
              </div>
            </div>

          </div>
        </div>
      </div>
      
      
      <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
          <div class="w-9 rounded-full">
            <img
              alt="Tailwind CSS Navbar component"
              src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
          </div>
        </div>
        <ul
          tabindex="0"
          class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
          <li>
            <a href="/profile" class="justify-between">
              Profile
            </a>
          </li>
          <li><a>Settings</a></li>

          <li class="sm:hidden">
            <a href="/tentang-kami">Tentang Kami</a>
          </li>

          <li class="sm:hidden">
            <a href="">Kontak</a>
          </li>

          <li>
            <form action="/logout" method="POST">
              @csrf
              <button type="submit">Logout</button>
            </form>
          </li>

        </ul>
      </div>
    </div>
  </div>


</div>