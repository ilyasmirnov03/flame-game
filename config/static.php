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
    ]
];
