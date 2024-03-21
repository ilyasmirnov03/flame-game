<?php

namespace App\Http\Controllers;

use App\Classes\Factories\GameTemplateData\GameTemplateDataFactory;
use App\Models\Game;
use App\Models\GameTranslation;
use App\Models\Group;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class GameController extends Controller
{

    public function soloGame(Game $game): View
    {
        $data = ['minigame' => $game];
        GameTemplateDataFactory::getTemplateDataSetter($game->label)?->addToTemplate($data);
        return view('games.' . $game->label, $data);
    }

    public function groupGame(Group $group, Game $game): View
    {
        $data = ['minigame' => $game, 'group' => $group];
        GameTemplateDataFactory::getTemplateDataSetter($game->label)?->addToTemplate($data);
        return view('games.' . $game->label, $data);
    }

    public function getGameDescription(string $gameId): JsonResponse
    {
        $lang = Language::where('code', strtoupper(app()->getLocale()))->first();
        $description = GameTranslation::where('game_id', $gameId)
            ->where('language_id', $lang->id)
            ->value('description');
        return response()->json(['description' => $description]);
    }
}
