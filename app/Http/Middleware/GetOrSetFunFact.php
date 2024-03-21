<?php

namespace App\Http\Middleware;

use App\Models\FunFact;
use App\Models\Language;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;

class GetOrSetFunFact
{
    public function handle($request, Closure $next)
    {
        $funFactKey = 'daily_fun_fact';
        $now = Carbon::now("UTC");
        $midnight = $now->copy()->endOfDay();
        $expirationTime = $now->diffInSeconds($midnight);

        if (!Cache::get($funFactKey)) {
            $funFactWithTranslations = FunFact::with('translations')->inRandomOrder()->first();
            Cache::set($funFactKey, json_encode($funFactWithTranslations), $expirationTime);
        } else {
            $funFactWithTranslations = json_decode(Cache::get($funFactKey));
        }

        $lang = Language::where('code', strtoupper(app()->getLocale()))->first();
        $translatedFunFactIndex = array_search(
            $lang->id,
            array_column($funFactWithTranslations->translations, 'language_id')
        );

        if ($translatedFunFactIndex !== false) {
            $translatedFact = $funFactWithTranslations->translations[$translatedFunFactIndex]->fact;
        } else {
            $translatedFact = '';
        }

        view()->share('dailyFunFact', $translatedFact);

        return $next($request);
    }
}
