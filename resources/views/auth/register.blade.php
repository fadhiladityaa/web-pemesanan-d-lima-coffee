  @extends('layouts.main')
  
  <div class="main-container w-full h-screen flex justify-center items-center" style="background-image: url('/img/bg1.jpeg'); background-repeat: no-repeat; background-size: cover; filter: brightness(85%)">
    <div class="form-container  w-4/5  p-5 rounded-lg flex flex-col items-center sm:w-2/3 md:w-2/5  backdrop-blur-lg border border-cyan-100">
      <form autocomplete="on" action="/register" method="POST" class="flex relative flex-col items-center gap-4">
        @csrf
        <div>
          <img src="/img/logo.png" class="w-20" alt="">
        </div>
        <h2 class="text-2xl text-white lg:text-3xl">Registrasi</h2>
        <div class="w-3/4">
          <p class="font-normal text-md text-center text-gray-400 lg:text-lg">Sambut Hangatnya Ngopi Bersama Kami - Registrasi Sekarang!</p>
        </div>
        
        <input
        required
        name="name"
        type="text"
        placeholder="Nama"
        class="input input-bordered input-sm w-full max-w-xs valid:ring-0 focus:ring-white invalid:border invalid:border-red-200" />
        
        @error('name')
        <div class="w-full font-normal text-red-400 flex justify-center pl-5 text-sm" >
          <p class="">{{ $message }}</p>
        </div>
      @enderror


        <input
        required
        name="noHp"
        type="tel"
        placeholder="No Handphone"
        class="input input-bordered input-sm w-full max-w-xs" />
        
        @error('noHp')          
        <div class="w-full font-normal text-red-400 flex  justify-center pl-5 text-sm">
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
        <div class="w-full font-normal text-red-400 flex  justify-center pl-5 text-sm">
          <p class="">{{ $message }}</p>
        </div>
        @enderror


        <button class="btn btn-sm btn-info block w-full  max-w-xs text-white">Register</button>
      </form>
        <p class="text-sm text-gray-400 font-normal mt-2">Sudah punya akun? Silahkan <a class="text-blue-400" href="/login">login</a></p>
    </div>
  </div>
