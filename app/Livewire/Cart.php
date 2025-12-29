<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Cart extends Component
{
    // Tambahkan property untuk notes (optional, untuk real-time binding)
    public $notes = [];

    #[On('cart_updated')]
    public function render()
    {
        $cart = CartModel::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->with('cart_items.daftar_menu')
            ->first();

        // Load existing notes jika ada
        if ($cart && $cart->cart_items) {
            foreach ($cart->cart_items as $item) {
                $this->notes[$item->id] = $item->notes ?? '';
            }
        }

        return view('livewire.cart', [
            'cart' => $cart
        ]);
    }

    // Method untuk update notes
    public function updateNotes($itemId, $notes)
    {
        $item = CartItem::find($itemId);

        // Validasi ownership - pastikan item milik cart user ini
        if ($item && $item->cart->user_id === Auth::id()) {
            $item->update(['notes' => $notes]);

            // Optional: Dispatch event untuk feedback
            $this->dispatch('notes-updated');
        }
    }

    // Atau pakai real-time binding (lebih smooth):
    public function updatedNotes($value, $key)
    {
        // $key format: "notes.123" dimana 123 adalah item ID
        $itemId = (int) str_replace('notes.', '', $key);

        $item = CartItem::find($itemId);

        if ($item && $item->cart->user_id === Auth::id()) {
            $item->update(['notes' => $value]);
        }
    }

    public function incrementQuantity($menu_id)
    {
        $item = CartItem::where('id', $menu_id)->first();
        if ($item) {
            $item->increment('quantity');
        }
        $this->dispatch('cart_updated');
    }

    public function decrementQuantity($id)
    {
        $item = CartItem::where('id', $id)->first();
        if ($item->quantity < 2) {
            $item->delete();
        } else {
            $item->decrement('quantity');
        }

        $this->dispatch('cart_updated');
    }

    public function removeItem($id)
    {
        $item = CartItem::where('id', $id)->first();
        $item->delete();

        $this->dispatch('cart_updated');
    }
}
