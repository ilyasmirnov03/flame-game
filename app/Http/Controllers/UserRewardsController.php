<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Reward;
use Illuminate\View\View;

class UserRewardsController extends Controller {
    public function index(): View
    {
        $user = Auth::user();

        $userRewards = $user->rewards;

        $totalPoints = $user->scores()->sum('score');

        $allRewards = Reward::all();

        $maxScore = $allRewards->max('score_needed');

        return view(
            'user_rewards',
            compact('userRewards', 'totalPoints', 'allRewards', 'maxScore')
        );
    }

    public function obtainReward(string $rewardId): RedirectResponse
    {
        $user = Auth::user();

        if ($user->rewards->contains($rewardId)) {
            return redirect()->route('rewards')->with('message', 'Vous avez déjà obtenu cette récompense.');
        }

        $reward = Reward::findOrFail($rewardId);

        if ($user->scores()->sum('score') >= $reward->score_needed) {
            $user->rewards()->attach($rewardId, ['selected' => 0]);

            return redirect()->route('rewards')->with('message', 'Récompense obtenue avec succès.');
        } else {
            return redirect()->route('rewards')
                ->with('message', 'Vous n\'avez pas assez de points pour obtenir cette récompense.');
        }
    }
}