<?php

namespace App\Http\Middleware;

use App\Classes\CacheKeysManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserCanPlaySoloGame {
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Cache::get(CacheKeysManager::soloPlayed($request->user()->id, $request->route('game')->id))) {
            abort(403, 'Jeu inaccessible');
        }

        return $next($request);
    }
}
