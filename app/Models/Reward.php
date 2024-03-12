<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class Reward extends Model
{
    use HasFactory;

    /**
     * Reward translations
     * @return HasMany
     */
    public function translations(): HasMany
    {
        return $this->hasMany(RewardTranslation::class);
    }
    protected $fillable = ['user_id', 'reward_id'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_rewards');
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}