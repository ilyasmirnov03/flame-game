<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Artisan;

class GenerateRewards
{

    /**
     * Handle the event.
     */
    public function handle(): void
    {
        Artisan::call('db:seed', array('--class' => 'RewardsSeeder'));
    }
}
