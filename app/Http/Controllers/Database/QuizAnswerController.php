<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\QuizAnswer;
use App\Models\QuizAnswersTranslation;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuizAnswerController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $quizIds = QuizQuestion::all('id');
        $answers = QuizAnswer::with(['translations'])
            ->get();
        $languages = Language::all();
        return view('database.models.quiz-answer.index', [
            'answers' => $answers,
            'languages' => $languages,
            'quizIds' => $quizIds->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View
    {
        $languages = Language::all();

        $request->validate([
            'is_right' => 'in:on,off'
        ]);

        $answer = QuizAnswer::create([
            'is_right' => $request->has('is_right'),
            'quiz_question_id' => $request->post('quiz_question_id'),
        ]);
        $languages->each(function ($language) use ($answer) {
            QuizAnswersTranslation::create([
                'language_id' => $language->id,
                'quiz_answer_id' => $answer->id
            ]);
        });
        return view('database.models.quiz-answer.one', compact('answer', 'languages'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        QuizAnswer::destroy($id);
    }
}
