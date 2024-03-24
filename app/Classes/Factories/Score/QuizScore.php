<?php

namespace App\Classes\Factories\Score;

use App\Models\QuizAnswer;

class QuizScore extends ScoreFactory {

    public function calculateScore(string $userId, array $game, int $elapsedTime): array
    {
        $answers = json_decode($game['answers'], true);
        $maxScore = 1000;
        $quizAnswer = new QuizAnswer();
        $rightAnswersAmount = $quizAnswer
            ->whereIn('id', array_values($answers))
            ->where('is_right', 1)
            ->count();
        $score = ($maxScore / count($answers)) * $rightAnswersAmount;
        return [
            'score' => min($score, $maxScore),
            'bonus' => 0,
            'total' => min($score, $maxScore)
        ];
    }

    /**
     * Quiz game doesn't have a bonus for anything yet.
     */
    public function calculateScoreBonus(string $userId, array $game, int $elapsedTime): int
    {
        return 0;
    }
}
