<?php

namespace App\Http\Controllers;

use App\Classes\Factories\GameTemplateData\GameTemplateDataFactory;
use App\Models\Game;
use App\Models\Group;
use Illuminate\View\View;

class GameController extends Controller {

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
}
