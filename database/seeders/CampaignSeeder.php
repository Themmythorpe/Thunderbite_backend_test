<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Campaign::truncate();

        Campaign::create([
            'timezone' => 'Europe/London',
            'name' => 'Test Campaign 1',
            'games_allowed' => 1500,
            'games_frequency' => 5,
            'three_matches' => 30,
            'four_matches' => 40,
            'five_matches' => 50,
            'starts_at' => now()->startOfDay(),
            'ends_at' => now()->addDays(7)->endOfDay(),
        ]);

        Campaign::create([
            'timezone' => 'Europe/London',
            'name' => 'Test Campaign 2',
            'games_allowed' => 1500,
            'games_frequency' => 5,
            'three_matches' => 30,
            'four_matches' => 40,
            'five_matches' => 50,
            'starts_at' => now()->startOfDay(),
            'ends_at' => now()->addDays(7)->endOfDay(),
        ]);
    }
}
