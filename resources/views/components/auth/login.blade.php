<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
  
    <div class="main-container w-full h-screen flex justify-center items-center" style="background-image: url('/img/bg1.jpeg'); background-repeat: no-repeat; background-size: cover; filter: brightness(85%)">
      <div class="form-container  w-4/5  p-5 rounded-lg flex flex-col items-center sm:w-2/3 md:w-2/5  backdrop-blur-lg border border-cyan-100">

        @if (session()->has('success'))
        <div role="alert" class="alert alert-info">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            class="h-6 w-6 shrink-0 stroke-current">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <span>{{ session('success') }}</span>
        </div>
        @endif

        @if (session()->has('LoginError'))
        <div role="alert" class="alert alert-error">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            class="h-6 w-6 shrink-0 stroke-current">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <span>{{ session('LoginError') }}</span>
        </div>
        @endif

        <form autocomplete="on" action="/login" method="POST" class="flex relative flex-col items-center gap-4">
          @csrf
          <div>
            <img src="/img/logo.png" class="w-20" alt="">
          </div>
          <h2 class="text-2xl text-white lg:text-3xl">Login</h2>
          <div class="w-3/4">
            <p class="font-normal text-md text-center text-gray-400 lg:text-lg">Sudah membuat akun? Login sekarang!</p>
          </div>
  
          <input
          required
          value="{{ old('noHp') }}"
          name="noHp"
          type="tel"
          placeholder="No Handphone"
          class="input input-bordered input-sm w-full max-w-xs" />
          
          @error('noHp')          
          <div class="w-full font-normal text-red-400 flex items-start pl-5 text-sm">
            <p class="">{{ $message }}</p>
          </div>
          @enderror
  
          
          <input
          required
          name="password"
          type="password"
          placeholder="Password"
          class="input input-bordered input-sm w-full max-w-xs" />
  
          @error('password')          
          <div class="w-full font-normal text-red-400 flex items-start pl-5 text-sm">
            <p class="">{{ $message }}</p>
          </div>
          @enderror
  
  
          <button class="btn btn-sm btn-info block w-full  max-w-xs text-white">Login</button>
        </form>
          <p class="text-sm text-gray-400 font-normal mt-2">Belum memiliki akun? <a class="text-blue-400" href="/register">Register.</a></p>
      </div>
    </div>
  
  </x-layout>