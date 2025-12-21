<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - D'Lima Coffee</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts & Tailwind -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Google fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-[Poppins] min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-[#2a1a10] via-[#5c3a21] to-[#C67C4E]">

    <div class="absolute inset-0 bg-[url('/img/beans-pattern.png')] opacity-10 pointer-events-none"></div>

    <!-- Card Wrapper -->
    <div
        class="relative w-full max-w-4xl bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row transform transition-all duration-300 hover:shadow-primary/20">

        <!-- Left Side: Image (Desktop Only) -->
        <div class="hidden md:block w-1/2 bg-cover bg-center relative group"
            style="background-image: url('{{ asset('img/bg1.jpeg') }}');">
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex flex-col justify-end p-12 text-white transition-all duration-300 group-hover:bg-black/50">
                <h2 class="text-3xl font-bold mb-2 text-secondary">Welcome Back!</h2>
                <p class="text-sm opacity-90 leading-relaxed">Nikmati setiap tegukan kopi terbaik dari D'Lima Coffee.
                    Masuk untuk melanjutkan pesananmu.</p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full md:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center bg-white relative">

            <!-- Header -->
            <div class="text-center md:text-left mb-8">
                <div class="flex justify-center md:justify-start items-center gap-3 mb-2">
                    <img src="{{ asset('img/logo.png') }}" class="w-10 h-10 object-contain drop-shadow-md"
                        alt="Logo">
                    <h3 class="text-2xl font-bold text-gray-800">D'Lima Coffee</h3>
                </div>
                <p class="text-gray-500 text-sm">Silakan login member area</p>
            </div>

            <!-- Error Alert -->
            @if (session('LoginError'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm flex items-center gap-3 shadow-sm"
                    role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('LoginError') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Phone Input -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP</label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none transition-colors group-focus-within:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                        </div>
                        <input type="tel" name="noHp" placeholder="08xxxxxxxxxx" required maxlength="13"
                            minlength="8"
                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 13) this.value = this.value.slice(0, 13);"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-gray-100 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300 outline-none text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white"
                            autocomplete="username">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Password</label>
                    </div>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none transition-colors group-focus-within:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="password" name="password" placeholder="••••••••" required
                            class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-gray-100 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300 outline-none text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white"
                            autocomplete="current-password">
                    </div>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-primary hover:bg-[#A66236] text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:ring-4 focus:ring-primary/50 text-sm tracking-wide uppercase">
                    Masuk Sekarang
                </button>

                <!-- Footer -->
                <p class="text-center text-sm text-gray-500 mt-6">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="text-primary font-bold hover:text-[#A66236] transition-colors underline decoration-2 decoration-transparent hover:decoration-primary">Daftar
                        disini</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
