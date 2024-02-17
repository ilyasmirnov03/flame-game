<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class Quizz extends Model
{
    use HasFactory;

    protected $table = 'og_quizz';

    public function answers(): HasMany {
        return $this->hasMany(QuizzAnswer::class);
    }

    public function translations(): HasMany {
        return $this->hasMany(QuizzTranslation::class);
    }

    /**
     * Get a quizz by id and find translations for the question and the answers.
     *
     * @param string $id Quizz id
     * @param string $lang Language code, i.e. FR, DE, PL...
     * @return array
     */
    public function getFullyTranslated(string $id, string $lang): array {
        $language = Language::where('code', '=', strtoupper($lang))->first();

        if (!$language) {
            abort(404, $lang . ' language wasn\'t found.');
        }

        $quizz = $this->with([
            'translations' => function ($query) use ($language) {
                $query->where('language_id', $language->id);
            },
            'answers.translations' => function ($query) use ($language) {
                $query->where('language_id', $language->id);
            },
        ])
            ->find($id);

        return [
            'question' => $quizz->translations->first()->question,
            'answers' => $quizz->answers->flatMap(function ($answer) use ($language) {
                return [$answer->translations->first()->answer];
            }),
        ];
    }
}
