<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;

class FunFact
{
    public function handle($request, Closure $next)
    {
        $funfactKey = 'daily_fun_fact';
        $now = Carbon::now("UTC");
        $midnight = $now->copy()->endOfDay();
        $expirationTime = $now->diffInSeconds($midnight);

        if (!Cache::get($funfactKey)) {

            $randomFunFact = \App\Models\FunFact::with('translations')->inRandomOrder()->first();

            Cache::set($funfactKey, json_encode($randomFunFact), $expirationTime);

            view()->share('dailyFunFact', $randomFunFact);
        } else {
            $dailyFunFact = json_decode(Cache::get($funfactKey));
            view()->share('dailyFunFact', $dailyFunFact);
        }

        return $next($request);
    }
}