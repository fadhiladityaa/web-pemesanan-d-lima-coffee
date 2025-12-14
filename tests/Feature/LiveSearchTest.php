<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Daftar_menu;

class LiveSearchTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_search_with_valid_keyword_shows_results(): void
    {
        Daftar_menu::factory()->create(['name' => 'Latte']);

        $response = $this->get('/search?query=Latte');

        $response->assertSee('Latte');
    }
}
