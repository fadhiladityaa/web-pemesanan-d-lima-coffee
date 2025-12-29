<nav class="bg-[#947257] w-full flex justify-between shadow-xl z-50 fixed transition-all duration-300">
    <div class="font-[Sriracha] flex items-center justify-between mx-[15px] sm:mx-[32px] lg:mx-[55px] gap-2 py-4 w-full">

        {{-- LOGO SECTION --}}
        <div class="flex justify-between w-full items-center">
            <div class="flex gap-3 items-center group cursor-pointer">
                <img src="{{ asset('img/logo-warkop 1.svg') }}" alt="logo-warkop"
                    class="w-10 sm:w-11 lg:w-12 drop-shadow-md group-hover:scale-105 transition duration-300">
                <a href="{{ url('/') }}"
                    class="text-xl sm:text-2xl lg:text-2xl text-white group-hover:opacity-90 transition tracking-wide">
                    D'Lima Coffee.
                </a>
            </div>

            {{-- DESKTOP LINKS --}}
            <div
                class="links text-white lg:flex sm:gap-6 lg:gap-10 sm:text-[16px] lg:text-[18px] items-center sm:hidden hidden font-poppins font-medium">
                {{-- 3. EDUKASI --}}
                <a href="{{ route('dashboard') }}"
                    class="relative py-1 transition-all duration-300
                {{ Request::is('dashboard*')
                    ? 'text-white font-bold border-b-2 border-white'
                    : 'text-white/70 hover:text-white hover:border-b-2 hover:border-white/30' }}">
                    Dashboard
                </a>


                {{-- 1. MENU --}}
                <a href="{{ route('menu') }}"
                    class="relative py-1 transition-all duration-300 
                    {{ Request::routeIs('menu')
                        ? 'text-white font-bold border-b-2 border-white'
                        : 'text-white/70 hover:text-white hover:border-b-2 hover:border-white/30' }}">
                    Menu
                </a>

                {{-- 2. PESANAN SAYA --}}
                @auth
                    @if (!auth()->user()->isAdmin())
                        <a href="{{ route('pesanan.saya') }}"
                            class="relative py-1 transition-all duration-300 
                            {{ Request::routeIs('pesanan.saya')
                                ? 'text-white font-bold border-b-2 border-white'
                                : 'text-white/70 hover:text-white hover:border-b-2 hover:border-white/30' }}">
                            Pesanan Saya
                        </a>
                    @endif
                @endauth

                {{-- 3. EDUKASI --}}
                <a href="{{ url('/edukasi') }}"
                    class="relative py-1 transition-all duration-300
                    {{ Request::is('edukasi*')
                        ? 'text-white font-bold border-b-2 border-white'
                        : 'text-white/70 hover:text-white hover:border-b-2 hover:border-white/30' }}">
                    Edukasi
                </a>

                @auth
                    @if (auth()->user()->isAdmin())
                        {{-- KHUSUS ADMIN: Tampilkan Dashboard Admin --}}
                        <a href="{{ route('dashboard.pesanan.masuk') }}"
                            class="relative py-1 transition-all duration-300
                            {{ Request::is('dashboard*')
                                ? 'text-white font-bold border-b-2 border-white'
                                : 'text-white/70 hover:text-white hover:border-b-2 hover:border-white/30' }}">
                            Dashboard Admin
                        </a>
                    @endif
                @endauth

                {{-- Avatar Profile Desktop --}}
                <div class="flex items-center gap-3">
                    @auth
                        <div class="text-right hidden sm:block">
                            <p class="text-white text-sm font-medium">{{ auth()->user()->name }}</p>
                            <p class="text-white/70 text-xs">
                                @if (auth()->user()->isAdmin())
                                    <span class="bg-white/20 px-2 py-0.5 rounded-full">Admin</span>
                                @else
                                    <span class="bg-white/20 px-2 py-0.5 rounded-full">Customer</span>
                                @endif
                            </p>
                        </div>
                    @endauth

                    <a href="{{ route('profile-pengguna') }}"
                        class="btn btn-ghost btn-circle avatar transition hover:scale-105 {{ Request::is('profile*') ? 'ring-2 ring-white ring-offset-2 ring-offset-[#947257]' : '' }}">
                        <div class="w-10 h-10 rounded-full text-center py-3 border border-white/30 bg-slate-700/60
                            @auth
@if (auth()->user()->profile_picture && file_exists(public_path('storage/' . auth()->user()->profile_picture)))
                                    <img alt="User Avatar" src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                        class="w-full h-full object-cover rounded-full" />
                                @else
                                    {{-- Tampilkan inisial nama --}}
                                    <span class="text-white font-bold text-lg">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                @endif
                            @else
                                <span class="text-white font-bold text-lg">?</span> @endauth
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- HAMBURGER MENU (MOBILE) --}}
        <div class="dropdown
                            dropdown-end">
                            <div tabindex="0" role="button" class="lg:hidden">
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center bg-white/10 hover:bg-white/20 transition text-white">
                                    <img alt="hamburger icon" src="{{ asset('img/burger-menu.svg') }}"
                                        class="w-5" />
                                </div>
                            </div>

                            <ul tabindex="0"
                                class="menu menu-sm dropdown-content bg-white rounded-xl z-[1] mt-4 w-56 p-3 shadow-2xl text-[#947257] font-poppins">

                                {{-- Profile Mobile --}}
                                <li class="mb-1 border py-1 border-primary rounded-md">
                                    <a href="{{ route('profile-pengguna') }}"
                                        class="flex items-center gap-3 {{ Request::is('profile*') ? 'bg-[#947257] text- white font-bold' : 'hover:bg-[#f3e9e2]' }}">
                                        <div class="avatar">
                                            <div class="w-8 rounded-full bg-gradient-to-br from-[#947257] to-[#7a5c44]">
                                                @auth
                                                    @if (auth()->user()->profile_picture)
                                                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                                            alt="{{ auth()->user()->name }}" />
                                                    @else
                                                        <div
                                                            class="w-full h-full flex items-center justify-center text-white font-bold">
                                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                        <div>
                                            @auth
                                                <p class="text-xs text-gray-500 text-end">{{ auth()->user()->name }}</p>
                                            @endauth
                                        </div>
                                    </a>
                                </li>

                                <div class="divider my-0"></div>



                                {{-- Menu Mobile --}}
                                <li>
                                    <a href="{{ route('menu') }}"
                                        class="{{ Request::routeIs('menu') ? 'bg-[#947257] text-white font-bold' : 'hover:bg-[#f3e9e2]' }}">
                                        ☕ Menu
                                    </a>
                                </li>

                                {{-- Edukasi Mobile --}}
                                <li>
                                    <a href="{{ url('/edukasi') }}"
                                        class="{{ Request::is('edukasi*') ? 'bg-[#947257] text-white font-bold' : 'hover:bg-[#f3e9e2]' }}">
                                        📚 Edukasi
                                    </a>
                                </li>

                                @auth
                                    @if (auth()->user()->isAdmin())
                                        <li>
                                            <a href="{{ route('dashboard.pesanan.masuk') }}"
                                                class="{{ Request::is('dashboard*') ? 'bg-[#947257] text-white font-bold' : 'hover:bg-[#f3e9e2]' }}">
                                                🛠️ Dashboard Admin
                                            </a>
                                        </li>
                                    @endif
                                @endauth

                                @auth
                                    @if (!auth()->user()->isAdmin())
                                        <li>
                                            <a href="{{ url('/pesanan-saya') }}"
                                                class="{{ Request::routeIs('pesanan.saya') ? 'bg-[#947257] text-white font-bold' : 'hover:bg-[#f3e9e2]' }}">
                                                📦 Pesanan Saya
                                            </a>
                                        </li>
                                    @endif
                                @endauth

                                <div class="divider my-0"></div>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 font-semibold hover:bg-red-50">🚪
                                            Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                </div>
</nav>
