<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Reward;
use App\Models\RewardTranslation;
use Illuminate\Database\Seeder;

class RewardsSeeder extends Seeder
{

    /**
     * Rewards amount to generate
     * @var int
     */
    private int $rewardsAmount = 25;

    /**
     * Create rewards and their translations
     */
    public function run(): void
    {
        $languages = Language::get();
        $languagesAmount = $languages->count();

        Reward::factory($this->rewardsAmount)
            ->has(RewardTranslation::factory($languagesAmount)
                ->sequence(
                    ['language_id' => $languages[0]->id],
                    ['language_id' => $languages[1]->id],
                    ['language_id' => $languages[2]->id],
                ),
                'translations'
            )
            ->create();
    }
}
