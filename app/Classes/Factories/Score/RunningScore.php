<?php

namespace App\Classes\Factories\Score;

use App\Models\UserScore;

class RunningScore extends ScoreFactory {
    public function calculateScore(string $userId, string $gameId, int $elapsedTime): int
    {
        $maxScore = 1000;
        $maxTime = 2 * 60 + 30;

        if ($elapsedTime <= $maxTime) {
            $score = $maxScore;
        } else {
            $additionalTime = $elapsedTime - $maxTime;
            $decayFactor = 3;
            $score = max($maxScore - ($additionalTime * $decayFactor), 0);
        }

        $bonusPoints = $this->calculateScoreBonus($userId, $gameId, $elapsedTime);

        return min($score + $bonusPoints, $maxScore);
    }

    public function calculateScoreBonus(string $userId, string $gameId, int $elapsedTime): int
    {
        $averageTime = UserScore::where('user_id', $userId)
            ->where('game_id', $gameId)
            ->selectRaw('AVG(TIMESTAMPDIFF(SECOND, started_at, finished_at)) as average_time')
            ->value('average_time');

        if ($averageTime !== null && $elapsedTime < (int)$averageTime) {
            $timeDifference = $averageTime - $elapsedTime;

            $bonus = $timeDifference * 2;

            $maxBonus = 100;
            return min($bonus, $maxBonus);
        }

        return 0;
    }
}