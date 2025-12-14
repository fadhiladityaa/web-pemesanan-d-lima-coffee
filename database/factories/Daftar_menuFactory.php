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
            'nama_menu' => fake()->words(2, true),
            'harga' => fake()->numberBetween(10000, 50000),
            'gambar' => fake()->image('public/img', 640, 480, 'food', false),
            'deskripsi' => fake()->sentence(30),
            'pesan' => fake()->words(2, true),
            'category_id' => MenuCategory::factory(),
        ];
    }
}
