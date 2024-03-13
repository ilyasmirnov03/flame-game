<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Artisan;

class CreateMiniGames {

    /**
     * Handle the event.
     */
    public function handle(): void
    {
        Artisan::call('db:seed --force', array('--class' => 'GamesSeeder'));
    }
}
