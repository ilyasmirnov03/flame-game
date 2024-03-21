<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class GameTranslation extends Model
{
    use HasFactory;

    /**
     * Not use timestamps for this model.
     * @var bool
     */
    public $timestamps = false;
}
