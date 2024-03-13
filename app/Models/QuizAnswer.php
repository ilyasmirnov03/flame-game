<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class QuizAnswer extends Model
{
    use HasFactory;

    protected $table = 'og_quiz_answers';

    protected $hidden = [
        'is_right'
    ];

    protected $fillable = [
        'is_right',
        'quiz_question_id',
    ];

    /**
     * Not use timestamps for this model.
     * @var bool
     */
    public $timestamps = false;

    public function translations(): HasMany {
        return $this->hasMany(QuizAnswersTranslation::class);
    }
}
