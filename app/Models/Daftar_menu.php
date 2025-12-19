<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\KandunganMenu;

class Daftar_menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function cart_item()
    {
        return $this->hasMany(CartItem::class);
    }

    public function kandungan()
    {
        return $this->hasOne(KandunganMenu::class);
    }

    public function bahanBaku()
    {
        return $this->hasMany(BahanBakuMenu::class);
    }

    public function category()
    {
        return $this->belongsTo(MenuCategory::class);
    }

    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'menu_promo', 'daftar_menu_id', 'promo_id');
    }

    public function toggleFeatured($id)
    {
        $menu = Daftar_menu::find($id);
        
        if ($menu) {
            // Logika Saklar: Kalau 0 jadi 1, Kalau 1 jadi 0
            $menu->is_featured = !$menu->is_featured; 
            $menu->save();
            
            // Opsional: Kirim notifikasi sukses
            session()->flash('message', 'Status rekomendasi menu diperbarui!');
        }
    }

}
