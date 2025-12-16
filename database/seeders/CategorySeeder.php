<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuCategory;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $category = [
            ['name' => 'Coffee'],
            ['name' => 'Non Coffee'],
            ['name' => 'Moctail'],
            ['name' => 'Makanan Ringan'],
            ['name' => 'Makanan Berat'],
        ];

        foreach($category as $c) {
            MenuCategory::create($c);
        }
    }
}