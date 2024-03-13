<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardTranslation extends Model
{
    use HasFactory;

    /**
     * Not use timestamps for this model.
     * @var bool
     */
    public $timestamps = false;
}
