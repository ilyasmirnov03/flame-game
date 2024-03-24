<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\QuizAnswersTranslation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuizAnswerTranslationController extends Controller {
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View
    {
        $translation = QuizAnswersTranslation::create([
            'answer' => $request->input('answer'),
            'language_id' => $request->input('language_id'),
            'quiz_answer_id' => $request->input('quiz_answer_id'),
        ]);
        return view('database.models.quiz-answer.translation-one', compact('translation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $translation = QuizAnswersTranslation::findOrFail($id);
        return view('database.models.quiz-answer.translation', compact('translation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): View
    {
        $translation = QuizAnswersTranslation::findOrFail($id);
        $translation->update([
            'answer' => $request->input('answer'),
            'language_id' => $request->input('language_id')
        ]);
        return view('database.models.quiz-answer.translation-one', compact('translation'));
    }
}
