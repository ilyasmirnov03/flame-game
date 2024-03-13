<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\QuizAnswer;
use App\Models\QuizAnswersTranslation;
use App\Models\QuizQuestion;
use App\Models\QuizTranslation;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuizController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $quizzes = QuizQuestion::with(['translations', 'answers' => function (HasMany $query) {
            $query->with('translations');
        },])->get();
        $languages = Language::all();
        return view('database.models.quiz.index', [
            'quizzes' => $quizzes,
            'languages' => $languages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View
    {
        $languages = Language::all();

        $quiz = QuizQuestion::create([
            'label' => $request->post('label'),
        ]);
        $languages->each(function ($language) use ($quiz) {
            QuizTranslation::create([
                'language_id' => $language->id,
                'quiz_question_id' => $quiz->id
            ]);
        });
        return view('database.models.quiz.one', compact('quiz', 'languages'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        QuizQuestion::destroy($id);
    }
}
