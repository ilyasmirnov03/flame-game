<?php

namespace App\Classes\Factories\Score;

abstract class ScoreFactory {

    public static function getScoreCalculator(string $game): self | null
    {
        $classes = [
            'quiz' => QuizScore::class,
            'running' => RunningScore::class,
        ];

        return new $classes[$game] ?? null;
    }

    public abstract function calculateScore(string $userId, string $gameId, int $elapsedTime): array;

    public abstract function calculateScoreBonus(string $userId, string $gameId, int $elapsedTime): int;
}