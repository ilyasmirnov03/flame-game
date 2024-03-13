<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\FunFact;
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
        return view('database.models.fun_fact.index', [
            'funFacts' => $funFacts,
            'languages' => $languages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
