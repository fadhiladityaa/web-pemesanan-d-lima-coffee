<nav class="bg-[#947257] w-full flex justify-between shadow-lg z-40 fixed">
    <div class="font-[Sriracha] flex items-center justify-between mx-[15px] sm:mx-[32px] lg:mx-[55px] gap-2 py-3 w-full">
        {{-- logo section --}}
        <div class="flex  justify-between w-full">
            <div class="flex gap-2 items-center">
                <img src="{{ asset('img/logo-warkop 1.svg') }}" alt="logo-warkop" class="w-10 sm:w-11 lg:w-12 mt-1">
                <a href="#beranda" class="text-xl sm:text-2xl lg:text-2xl text-white">
                    D'Lima Coffee.</span>
                </a>
            </div>

             <div class="links text-white sm:flex sm:gap-3 lg:gap-7 sm:text-[20px] items-center hidden font-poppins">
                <a class="{{ Request()->is('/#beranda') ? 'text-primary font-bold' : '' }}" href="/">Menu</a>
                <a class="" href="/berita">Edukasi</a>
                <a class="{{ Request()->is('/#menu') ? 'text-primary font-bold' : '' }}" href="#menu">About</a>
                <a href="">Berita</a>
                <a href="/dashboard">Dashboard</a>

                <a href="/profile" class="btn btn-ghost btn-circle mr-0 avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component"
                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </a>

            </div>
        </div>

        {{-- hamburger section --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="lg:hidden sm:hidden">
                <div class="w-7 rounded-full">
                    <img alt="hamburger icon" src="{{ asset('img/burger-menu.svg') }}" />

                </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li>
                    <a href="/profile" class="justify-between">
                        Profile
                    </a>
                </li>
                <li><a>Menu</a></li>

                <li class="sm:hidden">
                    <a href="/tentang-kami">About</a>
                </li>

                <li class="sm:hidden">
                    <a href="">Edukasi</a>
                </li>

                <li class="">
                    <a href="/dashboard">Dashboard</a>
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
    </div>
</nav>
