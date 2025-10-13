@extends('layouts.main')

@section('container')

<style>
    body {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }
    
    .glass-card {
        background: rgba(30, 30, 30, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
    }
    
    .coffee-accent {
        color: #c17a3d;
    }
    
    .coffee-border {
        border-color: #c17a3d;
    }
    
    .btn-coffee {
        background: linear-gradient(135deg, #c17a3d 0%, #8b5a2b 100%);
        color: white;
        transition: all 0.3s;
    }
    
    .btn-coffee:hover {
        background: linear-gradient(135deg, #8b5a2b 0%, #6b4423 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(193, 122, 61, 0.3);
    }
    
    .payment-option {
        transition: all 0.3s;
    }
    
    .payment-option:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    
    .quantity-btn {
        transition: all 0.2s;
    }
    
    .quantity-btn:hover {
        color: #c17a3d !important;
        transform: scale(1.1);
    }
</style>

<body class="text-gray-200">
    <!-- Checkout Content -->
    <div x-data="checkout()" class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-3xl font-bold coffee-accent mb-2">Checkout Pesanan</h1>
        <p class="text-gray-400 mb-8">Silakan review pesanan Anda sebelum melakukan pembayaran</p>

        <!-- Customer & Order Info -->
        <div class="glass-card p-6 mb-6">
            <h2 class="text-xl font-semibold coffee-accent mb-4">Informasi Pemesan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-400">Nama</p>
                    <p class="font-medium" x-text="customer.name"></p>
                </div>
                <div>
                    <p class="text-gray-400">ID Pesanan</p>
                    <p class="font-medium" x-text="orderId"></p>
                </div>
                <div>
                    <p class="text-gray-400">Email</p>
                    <p class="font-medium" x-text="customer.email"></p>
                </div>
                <div>
                    <p class="text-gray-400">No. Telepon</p>
                    <p class="font-medium" x-text="customer.phone"></p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="glass-card p-6 mb-6">
            <h2 class="text-xl font-semibold coffee-accent mb-4">Detail Pesanan</h2>
            <template x-for="item in items">
                <div class="border-b border-gray-700 pb-4 mb-4">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium" x-text="item.name"></p>
                                    <p class="text-sm text-gray-400" x-text="item.description"></p>
                                </div>
                                <p class="font-medium ml-4 coffee-accent" x-text="formatCurrency(item.price)"></p>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <div class="flex items-center">
                                    <button @click="decreaseQuantity(item)" class="quantity-btn text-gray-400 hover:text-coffee-accent">
                                        <i class="fas fa-minus-circle"></i>
                                    </button>
                                    <span class="mx-2 w-8 text-center" x-text="item.quantity"></span>
                                    <button @click="increaseQuantity(item)" class="quantity-btn text-gray-400 hover:text-coffee-accent">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </div>
                                <p class="font-medium coffee-accent" x-text="formatCurrency(item.price * item.quantity)"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Order Summary -->
        <div class="glass-card p-6 mb-6">
            <h2 class="text-xl font-semibold coffee-accent mb-4">Ringkasan Pembayaran</h2>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <p class="text-gray-400">Subtotal</p>
                    <p class="font-medium" x-text="formatCurrency(subtotal)"></p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-400">Pajak (10%)</p>
                    <p class="font-medium" x-text="formatCurrency(tax)"></p>
                </div>
                <div class="flex justify-between border-t border-gray-700 pt-2 mt-2">
                    <p class="text-lg font-semibold coffee-accent">Total</p>
                    <p class="text-lg font-bold coffee-accent" x-text="formatCurrency(total)"></p>
                </div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="glass-card p-6 mb-6">
            <h2 class="text-xl font-semibold coffee-accent mb-4">Metode Pembayaran</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div 
                    @click="selectedPayment = 'bank_transfer'" 
                    :class="{'border-coffee-border bg-gray-800': selectedPayment === 'bank_transfer', 'border-gray-700': selectedPayment !== 'bank_transfer'}" 
                    class="payment-option border rounded-lg p-4 text-center cursor-pointer transition-all"
                >
                    <i class="fas fa-building text-3xl coffee-accent mb-2"></i>
                    <p>Transfer Bank</p>
                </div>
                <div 
                    @click="selectedPayment = 'e_wallet'" 
                    :class="{'border-coffee-border bg-gray-800': selectedPayment === 'e_wallet', 'border-gray-700': selectedPayment !== 'e_wallet'}" 
                    class="payment-option border rounded-lg p-4 text-center cursor-pointer transition-all"
                >
                    <i class="fas fa-mobile-alt text-3xl coffee-accent mb-2"></i>
                    <p>E-Wallet</p>
                </div>
                <div 
                    @click="selectedPayment = 'cash'" 
                    :class="{'border-coffee-border bg-gray-800': selectedPayment === 'cash', 'border-gray-700': selectedPayment !== 'cash'}" 
                    class="payment-option border rounded-lg p-4 text-center cursor-pointer transition-all"
                >
                    <i class="fas fa-money-bill-wave text-3xl coffee-accent mb-2"></i>
                    <p>Tunai di Tempat</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row justify-between gap-4 mt-8">
            <a href="#" class="px-6 py-3 border border-coffee-border text-coffee-accent rounded-lg text-center font-medium hover:bg-gray-800 transition-colors">
                Kembali ke Menu
            </a>
            <button @click="processPayment" class="px-6 py-3 btn-coffee rounded-lg text-white font-medium">
                Konfirmasi & Bayar
            </button>
        </div>
    </div>

    <script>
        function checkout() {
            return {
                customer: {
                    name: 'Ahmad Rizki',
                    email: 'ahmad@example.com',
                    phone: '08123456789'
                },
                orderId: 'DLM-' + Math.floor(Math.random() * 10000),
                items: [
                    {
                        id: 1,
                        name: 'Espresso',
                        description: 'Single shot',
                        price: 18000,
                        quantity: 2
                    },
                    {
                        id: 2,
                        name: 'Cappuccino',
                        description: 'Regular size',
                        price: 25000,
                        quantity: 1
                    },
                    {
                        id: 3,
                        name: 'Croissant',
                        description: 'Almond',
                        price: 15000,
                        quantity: 1
                    }
                ],
                selectedPayment: 'bank_transfer',
                
                get subtotal() {
                    return this.items.reduce((total, item) => total + (item.price * item.quantity), 0);
                },
                
                get tax() {
                    return this.subtotal * 0.1;
                },
                
                get total() {
                    return this.subtotal + this.tax;
                },
                
                formatCurrency(amount) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(amount);
                },
                
                increaseQuantity(item) {
                    item.quantity++;
                },
                
                decreaseQuantity(item) {
                    if (item.quantity > 1) {
                        item.quantity--;
                    }
                },
                
                processPayment() {
                    alert('Pembayaran berhasil! ID Pesanan: ' + this.orderId);
                    // Di aplikasi Laravel yang sebenarnya, ini akan mengirim data ke backend
                }
            }
        }
    </script>
</body>
@endsection