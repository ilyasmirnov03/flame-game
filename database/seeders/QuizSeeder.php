<?php

namespace Database\Seeders;

use App\Models\FunFact;
use App\Models\FunFactTranslation;
use App\Models\Language;
use App\Models\QuizAnswer;
use App\Models\QuizAnswersTranslation;
use App\Models\QuizQuestion;
use App\Models\QuizTranslation;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{

    /**
     * How many quizzes to generate.
     * @var int
     */
    private int $quizAmount = 100;

    /**
     * How many languages to generate.
     * @var int
     */
    private int $languagesAmount = 3;

    /**
     * How many quiz answers to generate.
     * @var int
     */
    private int $quizAnswersAmount = 4;

    /**
     * Fun facts amount to generate.
     * @var int
     */
    private int $funFactsAmount = 30;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::factory($this->languagesAmount)
            ->create()
            ->toArray();

        QuizQuestion::factory($this->quizAmount)
            ->has(QuizTranslation::factory($this->languagesAmount)
                ->sequence(
                    ['language_id' => $languages[0]['id']],
                    ['language_id' => $languages[1]['id']],
                    ['language_id' => $languages[2]['id']],
                ),
                'translations'
            )
            ->has(QuizAnswer::factory($this->quizAnswersAmount)
                ->has(QuizAnswersTranslation::factory($this->languagesAmount)
                    ->sequence(
                        ['language_id' => $languages[0]['id']],
                        ['language_id' => $languages[1]['id']],
                        ['language_id' => $languages[2]['id']],
                    ),
                    'translations'
                ),
                'answers'
            )
            ->create();

        FunFact::factory($this->funFactsAmount)
            ->has(FunFactTranslation::factory($this->languagesAmount)
                ->sequence(
                    ['language_id' => $languages[0]['id']],
                    ['language_id' => $languages[1]['id']],
                    ['language_id' => $languages[2]['id']],
                ),
                'translations'
            )
            ->create();

    }
}
