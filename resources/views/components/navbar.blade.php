<nav class="bg-[#947257] w-full flex justify-between shadow-lg z-40 fixed">
    <div class="font-[Sriracha] flex items-center justify-between mx-[16px] sm:mx-[32px] gap-2 py-3 w-full">
        {{-- logo section --}}
        <div class="flex items-center gap-2">
            <img src="{{ asset('img/logo-warkop 1.svg') }}" alt="logo-warkop" class="w-10 sm:w-11 lg:w-12 mt-1">
            <a href="#beranda" class="text-xl sm:text-2xl lg:text-2xl text-white">
                D'Lima Coffee.</span>
            </a>
        </div>

        {{-- hamburger section --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="lg:hidden sm:hidden">
                <div class="w-7 rounded-full">
                    <img alt="hamburger icon" src="{{ asset('img/burger-menu.svg') }}" />

                </div>
            </div>
            <div class="links text-white sm:flex gap-7 sm:text-[20px] items-center hidden font-poppins">
                <a class="{{ Request()->is('/#beranda') ? 'text-primary font-bold' : '' }}" href="/">Menu</a>
                <a class="" href="/berita">Edukasi</a>
                <a class="{{ Request()->is('/#menu') ? 'text-primary font-bold' : '' }}" href="#menu">About</a>
                <a href="">Berita</a>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
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

    <!-- Dropdown Content -->
    <div class="card card-compact absolute bg-base-100 z-[1] mt-3 -right-12 w-96 shadow" x-show="!open" x-cloak
        x-transition @click.outside="open = !open">
    </div>
    </div>



    </div>
    </div>
</nav>
