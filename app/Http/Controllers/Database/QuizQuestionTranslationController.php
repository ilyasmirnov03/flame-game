<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\QuizTranslation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuizQuestionTranslationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View
    {
        $translation = QuizTranslation::create([
            'question' => $request->input('question'),
            'language_id' => $request->input('language_id'),
            'quiz_question_id' => $request->input('quiz_question_id'),
        ]);
        return view('database.models.quiz.translation-one', compact('translation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $translation = QuizTranslation::findOrFail($id);
        return view('database.models.quiz.translation', compact('translation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): View
    {
        $translation = QuizTranslation::findOrFail($id);
        $translation->update([
            'question' => $request->input('question'),
            'language_id' => $request->input('language_id')
        ]);
        return view('database.models.quiz.translation-one', compact('translation'));
    }
}
