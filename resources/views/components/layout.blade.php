<!doctype html>
<html class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- Font logo --}}
  <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  <title>{{ $title }}</title>
</head>
<body x-data="data">
  
  @unless (request()->is('login') || request()->is('register') )
  <div id="beranda" class="">
    <x-navbar></x-navbar>
  </div>
  @endunless

  <div>
    {{ $slot }}
  </div>
  
   @unless (request()->is('login') || request()->is('register') || request()->is('dashboard') || request()->is('dashboard/menu-management'))
   <x-footer></x-footer>
  @endunless

  <script>
    // Inisialisasi store sebelum Alpine.js berjalan
    document.addEventListener('alpine:init', () => {
      Alpine.data('data', () => ({
            coba: 'halo ini adlaah data dari data',
            toggle() {
                this.open = ! this.open
            }
        }))


        Alpine.store('data', {
           menus : [],
           test() {
            console.log('halo'); 
           },
            addToCart(menu) {
              this.menus.push(menu)
            }
        });
    });
  </script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>