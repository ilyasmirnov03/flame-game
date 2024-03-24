<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\FunFact;
use App\Models\FunFactTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FunFactController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $funFacts = FunFact::with('translations')->get();
        $languages = Language::all();
        return view('database.models.fun-fact.index', [
            'funFacts' => $funFacts,
            'languages' => $languages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View
    {
        $languages = Language::all();

        $funFact = FunFact::create([
            'label' => $request->post('label'),
        ]);
        $languages->each(function ($language) use ($funFact) {
            FunFactTranslation::create([
                'language_id' => $language->id,
                'fun_fact_id' => $funFact->id
            ]);
        });
        return view('database.models.fun-fact.one', compact('funFact', 'languages'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        FunFact::destroy($id);
    }
}
