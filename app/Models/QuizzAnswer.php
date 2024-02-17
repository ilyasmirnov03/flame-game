<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizzAnswer extends Model
{
    use HasFactory;

    protected $table = 'og_quizz_answers';

    protected $hidden = [
        'is_right'
    ];

    public function translations(): HasMany {
        return $this->hasMany(QuizzAnswersTranslation::class);
    }
}
