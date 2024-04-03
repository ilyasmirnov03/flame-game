<?php

namespace App\Classes\Factories\Score;

use App\Models\UserScore;
use Exception;

class RunningScore extends ScoreFactory {

    /**
     * @throws Exception
     */
    public function calculateScore(string $userId, array $game, int $elapsedTime): ScoreViewStore
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

        $bonusPoints = $this->calculateScoreBonus($userId, $game, $elapsedTime);
        $finalScore = min($score + $bonusPoints, $maxScore);
        return new ScoreViewStore(view('games.running.score', [
            'message' => __('game.success'),
            'score' => $finalScore,
            'bonus' => 0,
        ]), $finalScore, $bonusPoints);
    }

    public function calculateScoreBonus(string $userId, array $game, int $elapsedTime): int
    {
        $averageTime = UserScore::where('user_id', $userId)
            ->where('game_id', $game['game_id'])
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
