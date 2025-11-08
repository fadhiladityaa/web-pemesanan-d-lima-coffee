<!doctype html>
<html class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Font logo --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">
        {{-- icons --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
    <style>
            @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
            }
            @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
            }
            @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
            }
            .animate-fadeIn { animation: fadeIn 0.5s ease-out; }
            .animate-slideIn { animation: slideIn 0.3s ease-out; }
            .cart-item { animation: slideIn 0.3s ease-out; }
            .glass-effect {
            background: rgba(28, 32, 41, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(97, 95, 255, 0.3);
            }
            .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            }
            .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            box-shadow: 0 10px 25px rgba(97, 95, 255, 0.4);
            }
            .cart-badge {
            animation: pulse 2s infinite;
            }
            .scroll-smooth { scroll-behavior: smooth; }
  </style>
</head>

<body x-data="data">

    @unless (request()->is('login') || request()->is('register'))
        <x-navbar></x-navbar>
    @endunless

    <div>
        @yield('container')
    </div>

    @unless (request()->is('login') ||
            request()->is('register') ||
            request()->is('dashboard') ||
            request()->is('dashboard/menu-management'))
        <x-footer></x-footer>
    @endunless
</body>

{{-- <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('data', () => ({
            nama: 'fadil',
            cart: JSON.parse(localStorage.getItem('cart')) || [],
            quantity: 0,
            totalPrice: 0,
            addToCart(newItem) {
               const duplicate = this.cart.find(item => item.nama_menu == newItem.nama_menu)
               const {deskripsi, created_at, updated_at, ...newItems} = newItem

               if(!duplicate) {
                    this.cart.push({...newItems, quantity: 1, subTotal: newItems.harga})
                    this.totalPrice += newItems.harga
                    this.quantity++
                    
               } else {
                    this.cart = this.cart.map(oldItem => {
                        if(oldItem.nama_menu != newItems.nama_menu) {
                            return oldItem
                        } else {
                            oldItem.quantity++
                            oldItem.subTotal = oldItem.quantity * newItems.harga
                            this.quantity++
                            this.totalPrice += newItems.harga
                            return oldItem
                        }
                    })
               }

               saveCart()
            }, 

            decreaseQuantity(newItem) {
                if (newItem.quantity <= 1) {
                    const confirmasi = confirm('Apakah anda yakin ingin menghapus item dari keranjang?')
                    confirmasi ? this.cart = this.cart.filter(item => item != newItem) : ''
                } else {
                    this.cart = this.cart.map(oldItem => {
                        if (oldItem.id != newItem.id) {
                            return oldItem
                        } else {
                            oldItem.quantity--
                            oldItem.subTotal -= newItem.harga
                            this.totalPrice -= newItem.harga
                            this.quantity--
                            return oldItem
                        }
                    })
                }
            },
             saveCart() {
                localStorage.setItem('cart', JSON.stringify(this.cart));
            }
        }))
    })
</script> --}}

{{-- <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('data', () => ({
            nama: 'fadil',
            
            cart: JSON.parse(localStorage.getItem('cart')) || [],
            quantity: 0,  
            totalPrice: 0,  

            init() {
                this.calculateTotals();
            },

            calculateTotals() {
                this.quantity = this.cart.reduce((sum, item) => sum + item.quantity, 0);
                this.totalPrice = this.cart.reduce((sum, item) => sum + item.subTotal, 0);
            },

            addToCart(newItem) {
                const duplicate = this.cart.find(item => item.nama_menu == newItem.nama_menu)
                const { deskripsi, created_at, updated_at, ...newItems } = newItem

                if (!duplicate) {
                    this.cart.push({ ...newItems, quantity: 1, subTotal: newItems.harga })
                } else {
                    this.cart = this.cart.map(oldItem => {
                        if (oldItem.nama_menu != newItems.nama_menu) {
                            return oldItem
                        } else {
                            oldItem.quantity++
                            oldItem.subTotal = oldItem.quantity * newItems.harga
                            return oldItem
                        }
                    })
                }

                this.calculateTotals();
                this.saveCart();
            },

            decreaseQuantity(newItem) {
                if (newItem.quantity <= 1) {
                    const confirmasi = confirm('Apakah anda yakin ingin menghapus item dari keranjang?')
                    if (confirmasi) {
                        this.cart = this.cart.filter(item => item.nama_menu !== newItem.nama_menu)
                    }
                } else {
                    this.cart = this.cart.map(oldItem => {
                        if (oldItem.id != newItem.id) {
                            return oldItem
                        } else {
                            oldItem.quantity--
                            oldItem.subTotal -= newItem.harga
                            return oldItem
                        }
                    })
                }

                this.calculateTotals();
                this.saveCart();
            },

            saveCart() {
                localStorage.setItem('cart', JSON.stringify(this.cart));
            }
        }))
    })
</script> --}}

</html>
