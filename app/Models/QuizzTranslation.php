<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizzTranslation extends Model
{
    use HasFactory;

    protected $table = 'og_quizz_translations';

    public function language(): BelongsTo {
        return $this->belongsTo(Language::class);
    }
}
