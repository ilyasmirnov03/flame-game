<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    use HasFactory;

    /**
     * Not fill timestamps automatically on this model.
     * @var bool
     */
    public $timestamps = false;
}
