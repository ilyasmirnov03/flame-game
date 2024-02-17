<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizzAnswersTranslation extends Model
{
    use HasFactory;

    protected $table = 'og_quizz_answers_translations';

    public function language(): BelongsTo {
        return $this->belongsTo(Language::class);
    }
}
