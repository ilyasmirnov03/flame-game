<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\FunFactTranslation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FunFactTranslationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View
    {
        $translation = FunFactTranslation::create([
            'fact' => $request->input('fact'),
            'language_id' => $request->input('language_id'),
            'fun_fact_id' => $request->input('fun_fact_id'),
        ]);
        return view('database.models.fun-fact.translation-one', compact('translation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $translation = FunFactTranslation::findOrFail($id);
        return view('database.models.fun-fact.translation', compact('translation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): View
    {
        $translation = FunFactTranslation::findOrFail($id);
        $translation->update([
            'fact' => $request->input('fact'),
            'language_id' => $request->input('language_id')
        ]);
        return view('database.models.fun-fact.translation-one', compact('translation'));
    }
}
