<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAnswersTranslation extends Model
{
    use HasFactory;

    protected $table = 'og_quiz_answers_translations';

    /**
     * Not use timestamps for this model.
     * @var bool
     */
    public $timestamps = false;

    public function language(): BelongsTo {
        return $this->belongsTo(Language::class);
    }
}