<?php

namespace App\Classes\Factories\Score;

use App\Enums\GameRules;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Exception;

class QuizScore extends ScoreFactory
{

    /**
     * @throws Exception
     */
    public function calculateScore(string $userId, array $game, int $elapsedTime): ScoreViewStore
    {
        $questionsWithAnswersIds = json_decode($game['answers'], true);
        $maxScore = GameRules::MAX_SCORE->value;
        $quizAnswer = new QuizAnswer();
        $quizQuestion = new QuizQuestion();

        // Get all right answers from user input
        $rightAnswers = $quizAnswer
            ->whereIn('id', array_values($questionsWithAnswersIds))
            ->where('is_right', 1)
            ->get();

        // Get all answers and whether the user answer is right
        $allQuestions = $quizQuestion->getTranslatedFromIds(array_keys($questionsWithAnswersIds), app()->getLocale());
        foreach ($allQuestions as &$question) {
            $isRight = $rightAnswers->contains('id', $questionsWithAnswersIds[$question['id']]);
            $question['userAnswerIsRight'] = $isRight;
            $question['userAnswer'] = (int)$questionsWithAnswersIds[$question['id']];
        }

        // Calculate score and return the right view
        $pointsPerRightAnswer = $maxScore / count($questionsWithAnswersIds);
        $score = min($pointsPerRightAnswer * $rightAnswers->count(), $maxScore);
        return new ScoreViewStore(view('games.quiz.score', [
            'message' => __('game.success'),
            'score' => $score,
            'bonus' => 0,
            'allQuestions' => $allQuestions,
            'rightAnswersAmount' => $rightAnswers->count(),
            'pointsPerRightAnswer' => $pointsPerRightAnswer,
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
