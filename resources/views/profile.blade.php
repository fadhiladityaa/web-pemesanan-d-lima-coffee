<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>


    <div class="profile-container">
        <div class="hero-section flex flex-col w-full items-center p-6 bg-blue-200">
            <div class="avatar">
                <div class="ring-accent mb-4 ring-offset-base-100 w-24 rounded-full ring ring-offset-2">
                  <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
              </div>
            <div class="profile-name">
                <h1 class="font-bold">{{ auth()->user()->name }}</h1>
            </div>
        </div>
    </div>

</x-layout>