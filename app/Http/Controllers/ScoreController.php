<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserScore;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function saveresult(Request $request)
    {
        $startedAt = $request->input('startedAt');
        $finishedAt = $request->input('finishedAt');
        $game = $request->input('game');

        $startedAt = Carbon::parse($startedAt);
        $finishedAt = Carbon::parse($finishedAt);

        $elapsedTime = $finishedAt->diffInSeconds($startedAt);

        $user = Auth::user();
        $userId = $user->id;

        $scoreWithoutBonus = $this->calculateScoreBasedOnTime($elapsedTime);

        $scoreBonus = $this->calculateScoreBonus($userId, $game, $elapsedTime);

        $score = $scoreWithoutBonus + $scoreBonus;

        $score = min($score, 1000);

        UserScore::create([
            'finished_at' => $finishedAt,
            'score' => $score,
            'user_id' => $userId,
            'started_at' => $startedAt,
            'game' => $game,
        ]);

        return response()->json(['message' => 'Score enregistré avec succès', 'scoreWithoutBonus' => $scoreWithoutBonus, 'scoreBonus' => $scoreBonus]);
    }
    public function calculateScoreBasedOnTime($elapsedTime)
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

        return $score;
    }

    public function calculateScoreBonus($userId, $game, $currentElapsedTime)
    {
        // Calculer la moyenne des temps précédents pour le même jeu
        $averageTime = UserScore::where('user_id', $userId)
            ->where('game', $game)
            ->where('finished_at', '<', now())
            ->avg('finished_at');

        // Si la moyenne est disponible et que le joueur a amélioré son temps
        if ($averageTime !== null && $currentElapsedTime < $averageTime) {
            // Bonus basé sur la différence entre le temps actuel et la moyenne
            $timeDifference = $averageTime - $currentElapsedTime;

            // Appliquer un facteur (par exemple, *2) à la différence en secondes
            $bonus = $timeDifference * 2;

            // Limiter le bonus à une certaine valeur (ajuste selon tes préférences)
            $maxBonus = 100; // Par exemple, un bonus maximal de 100 points
            $bonus = min($bonus, $maxBonus);

            return $bonus;
        }

        return 0; // Pas de bonus si le joueur n'a pas amélioré son temps
    }
}