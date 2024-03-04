<?php

namespace App\Classes;

class CacheKeysManager {

    /**
     * Return key for solo played game in cache.
     */
    public static function soloPlayed(string $user, string $game): string
    {
        return sprintf('solo.played.%s.%s', $user, $game);
    }

    /**
     * Return cache key for played game in group by user.
     */
    public static function groupPlayed(string $user, string $group, string $game): string
    {
        return sprintf('group.played.%s.%s.%s', $user, $group, $game);
    }
}