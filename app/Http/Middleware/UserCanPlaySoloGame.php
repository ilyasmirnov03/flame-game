<?php

namespace App\Http\Middleware;

use App\Classes\CacheKeysManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserCanPlaySoloGame {
    /**
     * Return 403 if user played game solo today.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Cache::get(CacheKeysManager::soloPlayed($request->user()->id, $request->route('game')->id)) !== null) {
            abort(403, 'Jeu inaccessible');
        }

        return $next($request);
    }
}
