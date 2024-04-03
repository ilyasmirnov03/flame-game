<?php

namespace App\Classes\Factories\Score;

use App\Enums\GameRules;
use App\Models\QuizAnswer;
use Exception;

class QuizScore extends ScoreFactory
{

    /**
     * @throws Exception
     */
    public function calculateScore(string $userId, array $game, int $elapsedTime): ScoreViewStore
    {
        $answers = json_decode($game['answers'], true);
        $maxScore = GameRules::MAX_SCORE->value;
        $quizAnswer = new QuizAnswer();
        $rightAnswersAmount = $quizAnswer
            ->whereIn('id', array_values($answers))
            ->where('is_right', 1)
            ->count();
        $score = min(($maxScore / count($answers)) * $rightAnswersAmount, $maxScore);
        return new ScoreViewStore(view('games.quiz.score', [
            'message' => __('game.success'),
            'score' => $score,
            'bonus' => 0,
        ]), $score, 0);
    }

    /**
     * Quiz game doesn't have a bonus for anything yet.
     */
    public function calculateScoreBonus(string $userId, array $game, int $elapsedTime): int
    {
        return 0;
    }
}
