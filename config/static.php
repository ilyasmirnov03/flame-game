<?php

use App\Enums\RewardPlayerPosition;

return [

    /**
     * Rewards to populate the database with.
     */
    'rewards' => [
        [
            'score_needed' => 1000,
            'name' => 'test_hat',
            'description' => 'This is a hat.',
            'icon' => 'icon',
            'on_player_image' => 'on_player_image',
            'position' => RewardPlayerPosition::HEAD
        ]
    ],

    /**
     * Application's minigames.
     */
    'minigames' => [
        'quiz' => [
            'label' => 'Quizz',
            'img' => 'images/quizz_logo.svg',
            'header' => 'Question',
            'title' => 'Votre quizz quotidien',
        ],
        'running' => [
            'label' => 'Course',
            'img' => 'images/run_logo.svg',
            'header' => 'Course',
            'title' => 'Votre course quotidienne',
        ],
    ]
];
