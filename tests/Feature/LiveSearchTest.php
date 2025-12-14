<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Daftar_menu;
use App\Models\MenuCategory;
use Livewire\Livewire;
use App\Livewire\Products;


class LiveSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_with_valid_keyword(): void
    {
        $category = MenuCategory::factory()->create(['name' => 'Coffee']);
        Daftar_menu::factory()->create(['nama_menu' => 'Latte', 'pesan' => 'test pesan', 'category_id' => $category->id]);

        Livewire::test(Products::class)
            ->set('search', 'Latte')
            ->assertSee('Latte');
    }
}
