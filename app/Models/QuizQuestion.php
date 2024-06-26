<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class QuizQuestion extends Model {
    use HasFactory;

    protected $table = 'og_quiz_questions';

    /**
     * Not use timestamps for this model.
     * @var bool
     */
    public $timestamps = false;

    public function answers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(QuizTranslation::class);
    }

    protected $fillable = [
        'label'
    ];

    /**
     * Get model with eagerly loaded translations.
     * @param string $lang Language code, i.e. FR, DE, PL...
     * @return Builder
     */
    private function getTranslations(string $lang): Builder
    {
        $language = (new Language)->where('code', '=', strtoupper($lang))->first();

        if (!$language) {
            abort(404, $lang . ' language was not found.');
        }

        return $this->with([
            'translations' => function ($query) use ($language) {
                $query->where('language_id', $language->id);
            },
            'answers.translations' => function ($query) use ($language) {
                $query->where('language_id', $language->id);
            },
        ]);
    }

    /**
     * Transform quizzes collection to readable array with translations.
     * @param Collection $quizzes
     * @return array
     */
    private function transformCollectionToTranslatedArray(Collection $quizzes): array
    {
        return $quizzes->map(function ($quiz) {
            return [
                'id' => $quiz->id,
                'question' => $quiz->translations->first()->question,
                'answers' => $quiz->answers->map(function ($answer) {
                    return [
                        'id' => $answer->id,
                        'answer' => $answer->translations->first()->answer,
                        'is_right' => (boolean)$answer->is_right,
                    ];
                }),
            ];
        })->toArray();
    }

    /**
     * Create a quiz from multiple questions.
     * @param int $limit
     * @param string $lang
     * @return array
     */
    public function getManyRandomisedTranslated(int $limit, string $lang): array
    {
        $questions = $this
            ->inRandomOrder()
            ->limit($limit)
            ->get('id');
        $quizzes = $this->getTranslations($lang)
            ->whereIn('id', $questions)
            ->get();

        return $this->transformCollectionToTranslatedArray($quizzes);
    }

    /**
     * Get questions and answers translations from questions ids array.
     * @param array $ids Question ids
     * @param string $lang Language code, i.e. FR, DE, PL...
     * @return array
     */
    public function getTranslatedFromIds(array $ids, string $lang): array
    {
        $questions = $this
            ->whereIn('id', $ids)
            ->get('id');
        $quizzes = $this->getTranslations($lang)
            ->whereIn('id', $questions)
            ->get();

        return $this->transformCollectionToTranslatedArray($quizzes);
    }

    /**
     * Get a quiz by id and find translations for the question and the answers.
     * @param string $id Quiz id
     * @param string $lang Language code, i.e. FR, DE, PL...
     * @return array
     */
    public function getOneTranslated(string $id, string $lang): array
    {
        $quiz = $this->getTranslations($lang)
            ->findOrFail($id);

        return [
            'question' => $quiz->getRelation('translations')->first()->question,
            'answers' => $quiz->getRelation('answers')->flatMap(function ($answer) {
                return [$answer->translations->first()->answer];
            }),
        ];
    }
}
