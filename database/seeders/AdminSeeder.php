<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Fadhil Aditya',
                'noHp' => '085756956684',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ],
            [
                'name' => 'Muhammad Aqmal Nurfauzi',
                'noHp' => '081243010760',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ],
            [
                'name' => 'M. Faiz Ilyas',
                'noHp' => '087734377501',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
