<?php

namespace Database\Factories;

// use Hamcrest\FeatureMatcher;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MenuCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Daftar_menuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_menu' => fake()->word(),
            'harga' => fake()->numberBetween(10000, 50000),
            'gambar' => fake()->imageUrl(640, 480, 'food'),
            'deskripsi' => fake()->sentence(10),
            'pesan' => 'Ringan & ramah', // default lebih konsisten
            'category_id' => MenuCategory::factory(),
        ];
    }
}
