<?php

namespace App\Classes\Factories\GameTemplateData;

use App\Models\QuizQuestion;

class QuizTemplateData extends GameTemplateDataFactory {
    public function addToTemplate(array &$data): void
    {
        $quiz = new QuizQuestion();
        $data['quiz'] = $quiz->getManyRandomisedTranslated(5, 'FR');
    }
}