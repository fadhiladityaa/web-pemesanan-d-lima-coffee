<?php

namespace Database\Factories;

// use Hamcrest\FeatureMatcher;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'harga' => fake()->randomFloat(),
            'gambar' => fake()->imageUrl(640, 480, 'animals', true),
            'deskripsi' => fake()->sentence(30)
        ];
    }
}
