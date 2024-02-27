<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\UserScore;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function saveResult(Request $request): JsonResponse
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
    public function calculateScoreBasedOnTime(int $elapsedTime)
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

    public function calculateScoreBonus(string $userId, string $game, int $currentElapsedTime): int
    {
        $averageTime = UserScore::where('user_id', $userId)
            ->where('game', $game)
            ->selectRaw('AVG(TIMESTAMPDIFF(SECOND, started_at, finished_at)) as average_time')
            ->value('average_time');

        if ($averageTime !== null && $currentElapsedTime < (int)$averageTime) {
            $timeDifference = $averageTime - $currentElapsedTime;

            $bonus = $timeDifference * 2;

            $maxBonus = 100;
            return min($bonus, $maxBonus);
        }

        return 0;
    }
}