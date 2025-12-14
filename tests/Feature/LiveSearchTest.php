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

    public function test_search_with_invalid_keyword_shows_message(): void
    {
        Livewire::test(Products::class)
            ->set('search', 'Teh Hijau')
            ->assertSee('Menu tidak ditemukan');
    }

    public function test_search_is_case_insensitive(): void
    {
        $category = MenuCategory::factory()->create(['name' => 'Coffee']);
        Daftar_menu::factory()->create(['nama_menu' => 'Espresso', 'pesan' => 'test pesan', 'category_id' => $category->id]);

        Livewire::test(Products::class)
            ->set('search', 'espresso')
            ->assertSee('Espresso');
    }

    public function test_search_with_empty_input_shows_all_menu(): void
    {
        Daftar_menu::factory()->count(3)->create();

        Livewire::test(Products::class)
            ->set('search', '')
            ->assertSee(Daftar_menu::first()->nama_menu);
    }
}
