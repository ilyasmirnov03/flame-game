<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder
{
    /**
     * Create or update games from static games data.
     */
    public function run(): void
    {
        $games = config('static.minigames', []);
        if (DB::table('games')->count() != count($games)) {
            foreach ($games as $game_name => $game) {
                Game::updateOrCreate(['label' => $game_name], $game);
            }
        }
    }
}
