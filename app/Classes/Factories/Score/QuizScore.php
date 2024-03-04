<?php

namespace App\Classes\Factories\Score;

class QuizScore extends ScoreFactory {

    public function calculateScore(string $userId, string $gameId, int $elapsedTime): int
    {
        // TODO: Implement calculateScore() method.
        return 0;
    }

    public function calculateScoreBonus(string $userId, string $gameId, int $elapsedTime): int
    {
        // TODO: Implement calculateScoreBonus() method.
        return 0;
    }
}