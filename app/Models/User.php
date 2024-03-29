<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @mixin Builder
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get groups of user
     * @return BelongsToMany
     */
    public function userGroups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_members');
    }

    /**
     * Get scores of user
     * @return HasMany
     */
    public function scores(): HasMany
    {
        return $this->hasMany(UserScore::class);
    }

    /**
     * Get rewards of user
     * @return BelongsToMany
     */
    public function rewards(): BelongsToMany
    {
        return $this->belongsToMany(Reward::class, 'user_rewards');
    }
}
