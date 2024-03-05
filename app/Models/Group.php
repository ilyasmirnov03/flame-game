<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin Builder
 */
class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'max_members',
        'private',
    ];

    /**
     * Get users of a group
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_members');
    }

    public function isMember($userId)
    {
        return $this->members()->where('user_id', $userId)->exists();
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'group_members', 'group_id', 'user_id');
    }

    public function calculateTotalScore()
    {
        return $this->members()
            ->join('user_scores', 'users.id', '=', 'user_scores.user_id')
            ->where('user_scores.group_id', $this->id)
            ->sum('user_scores.score');
    }
}