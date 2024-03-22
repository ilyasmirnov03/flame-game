<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class FunFact extends Model
{
    use HasFactory;

    /**
     * Table name corresponding to this model.
     * @var string
     */
    protected $table = 'og_fun_facts';

    /**
     * Not use timestamps for this model.
     * @var bool
     */
    public $timestamps = false;

    public function translations(): HasMany {
        return $this->hasMany(FunFactTranslation::class);
    }
}
