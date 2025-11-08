<nav class="navbar bg-black shadow-lg flex justify-between z-40 lg:p-4 fixed">
    <div class="title">
        <a href="#beranda" class="btn btn-ghost text-xl lg:text-2xl text-white font-poppins font-bold">
            D'Lima<span class="text-primary italic">Coffee<span class="text-white">.</span></span>
        </a>
    </div>

    <div class="links text-white sm:flex gap-7 hidden font-poppins">
        <a class="{{ Request()->is('/#beranda') ? 'text-primary font-bold' : '' }}" href="/">Beranda</a>
        <a class="" href="/berita">Berita</a>
        <a class="{{ Request()->is('/#menu') ? 'text-primary font-bold' : '' }}" href="#menu">Menu</a>
        <a href="">Kontak</a>
    </div>

            <!-- Dropdown Content -->
            <div class="card card-compact absolute bg-base-100 z-[1] mt-3 -right-12 w-96 shadow" x-show="!open" x-cloak x-transition @click.outside="open = !open">

                <!-- Keranjang -->
                <div class="card-body flex flex-col justify-between">
                    <div class="topper flex flex-row-reverse items-end gap-2">
                        <button @click="open = !open"
                            class="font-bold text-lg border border-black-100 px-2 hover:bg-slate-500">
                            X
                        </button>
                        <p class="">Keranjang Anda</p>
                    </div>

                    
            
                    
                    <div class="checkout flex  items-center ">
                        <span class="bg-yellow-300 w-full p-2 rounded-sm">Total: <span x-text="totalPrice"></span></span>
                        <form method="POST" action="{{ route('checkout.store') }}">
                            @csrf
                            <input type="hidden" name="menu" :value="JSON.stringify(cart)">
                            <input type="hidden" name="username" value="{{ auth()->user()->name }}">
                            <input type="hidden" name="userphone" value="{{ auth()->user()->noHp }}">
                            <button type="submit">Buat pesanan</button>
                        </form>
                    </div>
                </div>
                {{-- end keranjang --}}
            </div>
        </div>


        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-9 rounded-full">
                    <img alt="Tailwind CSS Navbar component"
                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
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
    </div>
</nav>
