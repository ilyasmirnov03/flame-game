<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class FlameController extends Controller
{
    public function index()
    {
        $score = Auth::user()->scores->sum('score');

        $images = [
            [
                'image' => 'carte_1.svg',
                'total_score' => 4999,
                'min_score' => 0,
            ],
            [
                'image' => 'carte_2.svg',
                'total_score' => 9999,
                'min_score' => 5000,
            ],
            [
                'image' => 'carte_3.svg',
                'total_score' => 14999,
                'min_score' => 10000,
            ],
        ];

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
}