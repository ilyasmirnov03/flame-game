<?php

namespace App\Http\Controllers;

use App\Classes\CacheKeysManager;
use App\Classes\Factories\Score\ScoreFactory;
use App\Models\Game;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\UserScore;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ScoreController extends Controller {

    /**
     * Save game result
     * @throws Exception
     */
    public function saveResult(Request $request): JsonResponse
    {
        $startedAt = Carbon::parse($request->post('startedAt'));
        $finishedAt = Carbon::parse($request->post('finishedAt'));
        $game = Game::where('label', $request->post('game'))->first();
        $groupId = $request->post('group');

        $elapsedTime = $finishedAt->diffInSeconds($startedAt);

        $scoreCalculator = ScoreFactory::getScoreCalculator($game->label);
        $score = $scoreCalculator->calculateScore(Auth::id(), $game->id, $elapsedTime);

        $userScoreArray = [
            'game_id' => $game->id,
            'finished_at' => $finishedAt,
            'started_at' => $startedAt,
            'score' => $score['total'],
            'user_id' => Auth::id(),
        ];

        if ($groupId !== null) {
            $userScore['group_id'] = $groupId;
        }

        $userScore = UserScore::create($userScoreArray);

        $this->saveToCache($userScore->toArray());

        return response()->json([
            'message' => 'Score enregistré avec succès',
            'score' => $score['score'],
            'bonus' => $score['bonus'],
            'total' => $score['total']
        ]);
    }

    /**
     * Save played game to the cache
     * @throws Exception
     */
    private function saveToCache(array $userScore): void
    {
        // Create interval to the next 12pm utc time
        $utcDateTimeZone = new DateTimeZone('UTC');
        $currentDateTime = new DateTime('now', $utcDateTimeZone);
        $targetTime = new DateTime(
            (int)$currentDateTime->format('H') < 12 ? '12:00:00' : 'tomorrow 12:00:00',
            $utcDateTimeZone
        );
        $interval = $currentDateTime->diff($targetTime);

        $cacheKey = array_key_exists('group_id', $userScore) ?
            CacheKeysManager::groupPlayed($userScore['user_id'], $userScore['group_id'], $userScore['game_id']) :
            CacheKeysManager::soloPlayed($userScore['user_id'], $userScore['game_id']);
        Cache::set($cacheKey, $targetTime->getTimestamp(), $interval);
    }
}