<?php

namespace App\Http\Controllers;

use App\Classes\CacheKeysManager;
use App\Classes\Factories\GameTemplateData\GameTemplateDataFactory;
use App\Models\Game;
use App\Models\GameTranslation;
use App\Models\Group;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class GameController extends Controller
{

    /**
     * Get games for solo flame.
     * @return View
     */
    public function getSoloGames(): View {
        $games = Game::get()->toArray();
        foreach ($games as &$game) {
            $game['timeToNextGame'] = Cache::get(CacheKeysManager::soloPlayed(Auth::id(), $game['id']));
        }
        return view('games.select_game', ['games' => $games, 'route' => 'flame.game']);
    }

    /**
     * Get games for group flame.
     * @param Group $group
     * @return View
     */
    public function getGroupGames(Group $group): View {
        $games = Game::get()->toArray();
        foreach ($games as &$game) {
            $game['timeToNextGame'] = Cache::get(CacheKeysManager::groupPlayed(Auth::id(), $group->id, $game['id']));
        }
        return view('games.select_game', ['games' => $games, 'route' => 'group.game', 'group' => $group]);
    }

    /**
     * Get solo game page.
     * @param Game $game
     * @return View
     */
    public function soloGame(Game $game): View
    {
        $data = ['minigame' => $game];
        GameTemplateDataFactory::getTemplateDataSetter($game->label)?->addToTemplate($data);
        return view('games.' . $game->label . '.game', $data);
    }

    /**
     * Get group game page.
     * @param Group $group
     * @param Game $game
     * @return View
     */
    public function groupGame(Group $group, Game $game): View
    {
        $data = ['minigame' => $game, 'group' => $group];
        GameTemplateDataFactory::getTemplateDataSetter($game->label)?->addToTemplate($data);
        return view('games.' . $game->label . '.game', $data);
    }

    /**
     * Get translated game description.
     * @param string $gameId
     * @return JsonResponse
     */
    public function getGameDescription(string $gameId): JsonResponse
    {
        $lang = Language::where('code', strtoupper(app()->getLocale()))->first();
        $description = GameTranslation::where('game_id', $gameId)
            ->where('language_id', $lang->id)
            ->value('description');
        return response()->json(['description' => $description]);
    }
}
