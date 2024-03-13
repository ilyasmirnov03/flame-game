<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin Builder
 */
class Group extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'max_members',
        'private',
        'image',
    ];

    /**
     * Get users of a group
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_members');
    }

    public function isMember($userId): bool
    {
        return $this->members()->where('user_id', $userId)->exists();
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_members', 'group_id', 'user_id');
    }

    public function scores(): HasMany
    {
        return $this->hasMany(UserScore::class);
    }

    /**
     * Get groups for search page
     */
    public function getForSearch(int $limit): Builder|Group
    {
        return $this->where('private', 0)
            ->withSum('scores', 'score')
            ->withCount('members')
            ->withExists(['members as is_member' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }])
            ->limit($limit);
    }
}