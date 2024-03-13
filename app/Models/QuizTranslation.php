<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 */
class QuizTranslation extends Model {
    use HasFactory;

    protected $table = 'og_quiz_translations';

    /**
     * Not use timestamps for this model.
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'question',
        'language_id',
        'quiz_question_id'
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
