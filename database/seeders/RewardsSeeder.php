<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rewards = config('static.rewards', []);
        if (DB::table('rewards')->count() != count($rewards)) {
            foreach ($rewards as $reward) {
                Reward::updateOrCreate(['name' => $reward['name']], $reward);
            }
        }
    }
}
