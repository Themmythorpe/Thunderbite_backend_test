<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Symbol;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SymbolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Symbol::create([
            'name' => 'Dog',
            'symbol_image' => '/symbols/dog1.jpg',
            'user_id' =>  User::inRandomOrder()->first()->id,
        ]);

        Symbol::create([
            'name' => 'fish',
            'symbol_image' => '/symbols/fish.jpg',
            'user_id' =>  User::inRandomOrder()->first()->id,
        ]);

        Symbol::create([
            'name' => 'Dog',
            'symbol_image' => '/symbols/dog1.jpg',
            'user_id' =>  User::inRandomOrder()->first()->id,
        ]);

        Symbol::create([
            'name' => 'fish',
            'symbol_image' => '/symbols/fish.jpg',
            'user_id' =>  User::inRandomOrder()->first()->id,
        ]);

        Symbol::create([
            'name' => 'Dog',
            'symbol_image' => '/symbols/dog1.jpg',
            'user_id' =>  User::inRandomOrder()->first()->id,
        ]);

        Symbol::create([
            'name' => 'fish',
            'symbol_image' => '/symbols/fish.jpg',
            'user_id' =>  User::inRandomOrder()->first()->id,
        ]);
        Symbol::create([
            'name' => 'Dog',
            'symbol_image' => '/symbols/dog1.jpg',
            'user_id' =>  User::inRandomOrder()->first()->id,
        ]);
        Symbol::create([
            'name' => 'fish',
            'symbol_image' => '/symbols/fish.jpg',
            'user_id' =>  User::inRandomOrder()->first()->id,
        ]);
        Symbol::create([
            'name' => 'fish',
            'symbol_image' => '/symbols/fish.jpg',
            'user_id' =>  User::inRandomOrder()->first()->id,
        ]);
    }
}
