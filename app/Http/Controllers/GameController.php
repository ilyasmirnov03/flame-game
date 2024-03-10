<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Group;
use Illuminate\View\View;

class GameController extends Controller {

    public function soloGame(Game $game): View
    {
        return view('games.' . $game->label, ['minigame' => $game]);
    }

    public function groupGame(Group $group, Game $game): View
    {
        return view('games.' . $game->label, ['minigame' => $game, 'group' => $group]);
    }
}
