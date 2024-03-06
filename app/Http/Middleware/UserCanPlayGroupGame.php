<?php

namespace App\Http\Middleware;

use App\Classes\CacheKeysManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserCanPlayGroupGame {
    /**
     * Return 403 if user has already played game in group today.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $group = $request->route('group');
        $game = $request->route('game');

        if (Cache::get(CacheKeysManager::groupPlayed($request->user()->id, $group->id, $game->id)) !== null) {
            abort(403, 'Jeu inaccessible');
        }

        return $next($request);
    }
}
