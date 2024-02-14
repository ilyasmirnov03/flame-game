<?php

namespace App\Listeners;

use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Support\Facades\Artisan;

class GenerateRewards
{

    /**
     * Handle the event.
     */
    public function handle(MigrationsEnded $event): void
    {
        Artisan::call('db:seed', array('--class' => 'RewardsSeeder'));
    }
}
