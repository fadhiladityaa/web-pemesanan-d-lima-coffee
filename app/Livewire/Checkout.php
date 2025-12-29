<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $alamat = '';
    public $no_hp = '';
    public $metode_pembayaran = '';
    public $uang_dibayar = 0;
    public $total = 0;
    public $kembalian = 0;
    public $tipe_pesanan = '';

    public function mount()
    {
        $this->no_hp = Auth::user()->noHp;
    }

    protected $rules = [
        'alamat' => 'required|string',
        'no_hp' => 'required|string',
        'metode_pembayaran' => 'required|string',
        'uang_dibayar' => 'nullable|numeric|min:0',
    ];

    public function updatedMetodePembayaran($value)
    {
        if ($value !== 'Cash') {
            $this->uang_dibayar = null;
        }
    }

    public function getKembalianProperty()
    {
        return ($this->metode_pembayaran === 'Cash' && $this->uang_dibayar >= $this->total)
            ? $this->uang_dibayar - $this->total : 0;
    }

    public function submitCheckout()
    {
        $this->validate();

        $user = Auth::user();

        $cart = Cart::with('cart_items')->where('user_id', $user->id)->where('status', 'pending')->first();

        if (!$cart || $cart->cart_items->isEmpty()) {
            session()->flash('error', 'Keranjang tidak ditemukan atau kosong.');
            return;
        }

        // hitung total dari cart_items
        $this->total = $cart->cart_items->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $order = Order::create([
            'user_id' => $user->id,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
            'tipe_pesanan' => $this->tipe_pesanan,
            'metode_pembayaran' => $this->metode_pembayaran,
            'payment_status' => $this->metode_pembayaran === 'Cash' ? 'paid' : 'pending',
            'order_status' => 'proses',
            'total' => $this->total,
            'uang_dibayar' => $this->uang_dibayar,
            'kembalian' => $this->getKembalianProperty(),
        ]);

        foreach ($cart->cart_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'daftar_menu_id' => $item->daftar_menu_id,
                'quantity' => $item->quantity,
                'harga' => $item->price,
                'sub_total' => $item->quantity * $item->price,
                'notes' => $item->notes, // ← TAMBAH INI
            ]);
        }

        $cart->update(['status' => 'completed']);

        return redirect()->route('pesanan.saya');
    }



    public function render()
    {
        $cart = Cart::with('cart_items')->where('user_id', Auth::id())->where('status', 'pending')->first();

        $this->total = $cart
            ? $cart->cart_items->sum(fn($item) => $item->quantity * $item->price)
            : 0;

        $this->kembalian = $this->getKembalianProperty();
        return view('livewire.checkout');
    }
}
