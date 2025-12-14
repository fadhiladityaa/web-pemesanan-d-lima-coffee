<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\MenuCategory;
use Livewire\Livewire;
use App\Livewire\CreateMenu;
use Illuminate\Http\UploadedFile;
use App\Models\Daftar_menu;
use App\Livewire\EditMenu;
use App\Livewire\MenuManagement;

class MenuManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_menu(): void
    {

        $category = MenuCategory::factory()->create();
        $file = UploadedFile::fake()->image('latte.jpg');

        Livewire::test(CreateMenu::class)
            ->set('nama_menu', 'Latte')
            ->set('harga', 25000)
            ->set('gambar', $file)
            ->set('deskripsi', 'Kopi susu lembut')
            ->set('pesan', 'Best seller')
            ->set('category_id', (string) $category->id)
            ->set('energi_total', 100)
            ->set('takaran_saji', 200)
            ->set('protein', 5)
            ->set('lemak_total', 2)
            ->set('lemak_jenuh', 1)
            ->set('karbohidrat', 10)
            ->set('gula', 3)
            ->set('garam_natrium', 1)
            ->set('kafein', 0)
            ->set('batas_konsumsi', 'Aman dikonsumsi')
            ->set('bahanBaku', [
                ['nama_bahan' => 'Kopi Arabica', 'takaran' => '50gr'],
                ['nama_bahan' => 'Susu Full Cream', 'takaran' => '100ml'],
            ])
            ->call('createNewMenu')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('daftar_menus', ['nama_menu' => 'Latte']);
        $this->assertDatabaseHas('bahan_baku_menus', ['nama_bahan' => 'Kopi Arabica']);
    }

    public function test_admin_can_update_menu(): void
    {
        $menu = Daftar_menu::factory()->create(['nama_menu' => 'Espresso']);

        Livewire::test(EditMenu::class, ['id' => $menu->id])
            ->set('nama_menu', 'Espresso Double')
            ->set('harga', 30000)
            ->set('energi_total', 100)
            ->set('takaran_saji', 200)
            ->set('protein', 5)
            ->set('lemak_total', 2)
            ->set('karbohidrat', 10)
            ->set('bahanBaku', [
                ['nama_bahan' => 'Kopi Arabica', 'takaran' => '50gr'],
            ])
            ->call('edit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('daftar_menus', ['nama_menu' => 'Espresso Double']);
    }

    public function test_admin_can_delete_menu(): void
    {
        $menu = Daftar_menu::factory()->create(['nama_menu' => 'Cappuccino']);

        Livewire::test(MenuManagement::class)
            ->call('delete', $menu->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('daftar_menus', ['nama_menu' => 'Cappuccino']);
    }


    public function test_create_menu_validation_fails_without_harga(): void
    {
        $category = MenuCategory::factory()->create();

        Livewire::test(CreateMenu::class)
            ->set('nama_menu', 'Mocha')
            ->set('deskripsi', 'Coklat + kopi')
            ->set('pesan', 'Promo spesial')
            ->set('category_id', $category->id)
            ->set('energi_total', 120)
            ->set('takaran_saji', 200)
            ->set('protein', 5)
            ->set('lemak_total', 2)
            ->set('lemak_jenuh', 1)
            ->set('karbohidrat', 15)
            ->set('gula', 8)
            ->set('garam_natrium', 1)
            ->set('kafein', 0)
            ->set('batas_konsumsi', 'Aman dikonsumsi')
            ->set('bahanBaku', [
                ['nama_bahan' => 'Coklat Bubuk', 'takaran' => '20gr'],
                ['nama_bahan' => 'Kopi Arabica', 'takaran' => '50gr'],
            ])
            // sengaja tidak set harga
            ->call('createNewMenu')
            ->assertHasErrors(['harga']);
    }
}
