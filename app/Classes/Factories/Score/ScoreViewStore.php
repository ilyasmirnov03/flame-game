<?php

namespace App\Classes\Factories\Score;

use App\Enums\GameRules;
use Exception;
use Illuminate\View\View;

class ScoreViewStore
{

    private View $view;
    private int $totalScore;
    private int $bonusScore;

    /**
     * @throws Exception
     */
    public function __construct(
        View $view,
        int  $totalScore,
        int  $bonusScore,
    )
    {
        $this->setTotalScore($totalScore);
        $this->setBonusScore($bonusScore);
        $this->setView($view);
    }

    public function getView(): View
    {
        return $this->view;
    }

    public function setView(View $view): ScoreViewStore
    {
        $this->view = $view;
        return $this;
    }

    public function getTotalScore(): int
    {
        return $this->totalScore;
    }

    /**
     * @throws Exception
     */
    public function setTotalScore(int $totalScore): ScoreViewStore
    {
        if ($totalScore > GameRules::MAX_SCORE->value) {
            throw new Exception(
                sprintf("Exception: total score is superior to %d", GameRules::MAX_SCORE->value)
            );
        }
        $this->totalScore = $totalScore;
        return $this;
    }

    public function getBonusScore(): int
    {
        return $this->bonusScore;
    }

    public function setBonusScore(int $bonusScore): ScoreViewStore
    {
        $this->bonusScore = $bonusScore;
        return $this;
    }
}
