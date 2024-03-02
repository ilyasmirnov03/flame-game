<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GameTranslation;
use App\Models\Language;
use Illuminate\Database\Seeder;

class GameTranslationSeeder extends Seeder
{
    /**
     * Create translations for games
     */
    public function run(): void
    {
        $languages = Language::get();
        $languagesAmount = $languages->count();

        $games = Game::get();

        foreach ($games as $game) {
            GameTranslation::factory($languagesAmount)
                ->set('game_id', $game->id)
                ->sequence(
                    ['language_id' => $languages[0]['id']],
                    ['language_id' => $languages[1]['id']],
                    ['language_id' => $languages[2]['id']],
                )
                ->create();
        }
    }
}
