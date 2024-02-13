<?php

use App\Enums\RewardPlayerPosition;

return [

    /**
     * Rewards to populate the database with
     */
    'rewards' => [
        [
            'score_needed' => 1000,
            'icon' => 'icon',
            'on_player_image' => 'on_player_image',
            'position' => RewardPlayerPosition::HEAD
        ]
    ],
    'minigames' => [
        'quizz' => [
            'label' => 'Quizz',
            'img' => 'images/quizz_logo.svg',
            'info' => 'Les infos nécessaires pour le quizz',
            'route' => 'quizz',
        ],
        'running' => [
            'label' => 'Course',
            'img' => 'images/run_logo.svg',
            'info' => 'Les infos nécessaires pour la course',
            'route' => 'run',
        ],
    ]
];