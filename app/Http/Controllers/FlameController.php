<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\UserScore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class FlameController extends Controller
{
    public function index()
    {
        $score = Auth::user()->scores->sum('score');

        $images = Config::get('static.images');

        $imageName = '';
        $minScore = '';
        $totalScore = '';

        foreach ($images as $img) {
            if ($score >= $img['min_score'] && $score <= $img['total_score']) {
                $imageName = $img['image'];
                $minScore = $img['min_score'];
                $totalScore = $img['total_score'];
                break;
            }
        }

        return view('flame.solo_flame', compact('score', 'imageName', 'minScore', 'totalScore'));
    }

    public function show(Group $group)
    {
        $score = UserScore::where('group_id', $group->id)->sum('score');

        $imagesData = Config::get('static.images');

        $imageName = '';
        $minScore = '';
        $totalScore = '';

        foreach ($imagesData as $img) {
            if ($score >= $img['min_score'] && $score <= $img['total_score']) {
                $imageName = $img['image'];
                $minScore = $img['min_score'];
                $totalScore = $img['total_score'];
                break;
            }
        }

        return view('group.space', compact('group', 'score', 'imageName', 'minScore', 'totalScore'));
    }
}
