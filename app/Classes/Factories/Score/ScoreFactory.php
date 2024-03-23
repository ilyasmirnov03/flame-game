<?php

namespace App\Classes\Factories\Score;

abstract class ScoreFactory {

    public static function getScoreCalculator(string $game): self|null
    {
        $classes = [
            'quiz' => QuizScore::class,
            'running' => RunningScore::class,
        ];

        return new $classes[$game] ?? null;
    }

    abstract public function calculateScore(string $userId, array $game, int $elapsedTime): array;

    abstract public function calculateScoreBonus(string $userId, array $game, int $elapsedTime): int;
}
