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
            ['name' => 'Snack'],
            ['name' => 'Main Course'],
        ];

        foreach($category as $c) {
            MenuCategory::create($c);
        }
    }
}