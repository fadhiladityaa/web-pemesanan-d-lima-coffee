<x-layout>
     <x-slot:title>{{ $title }}</x-slot:title>

     <x-hero></x-hero>
     <x-about></x-about>
     <x-menu :menus=$menus></x-menu>

</x-layout>