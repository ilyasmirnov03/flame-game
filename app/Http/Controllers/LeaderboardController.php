<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller {
    function leaderboardUser(int $page = 1) {
        $ranking = User::withSum('scores', 'score')
            ->orderBy('scores_sum_score', 'desc')
            ->limit(10)
            ->offset(($page * 10) - 10)
            ->get();

        // Adds their total rank as data (witchcraft)
        $ranking->each(function ($user, $key) use ($page) {
            $user->rank = $key + 1 + (($page * 10) - 10);
            $user->image = 'images/avatar.png';
        });

        // If trying to access OOB page, redirect to last page
        $max_pages = ceil((User::all()->count() / 10));
        if ($page > $max_pages) {
            return redirect()->intended(route('leaderboard.solo.page', ['page' => $max_pages]));
        }

        return view('leaderboard', ['ranking' => $ranking, 'page' => $page]);
    }

    function leaderboardGroup(int $page = 1) {
        $ranking = Group::withSum('scores', 'score')
            ->orderBy('scores_sum_score', 'desc')
            ->offset((10 * $page) - 10)
            ->limit(10)
            ->get();
        $ranking->each(function ($group, $key) use ($page) {
            $group->rank = ($key + 1) + ($page * 10 - 10);
            $group->image = 'images/group_icons/' . $group->image;
        });

        // If trying to access OOB page, redirect to last page
        $max_pages = ceil((Group::all()->count() / 10));
        if ($page > $max_pages) {
            return redirect()->intended(route('leaderboard.group.page', ['page' => $max_pages]));
        }

        return view('leaderboard', ['ranking' => $ranking,  'page' => $page]);
    }
}
