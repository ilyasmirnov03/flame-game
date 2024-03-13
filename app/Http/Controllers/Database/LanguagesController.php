<?php

namespace App\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $languages = Language::all();
        return view('database.models.language.index', [
           'languages' => $languages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View
    {
        $language = Language::create(['code' => $request->post('code')]);
        return view('database.models.language.one', ['language' => $language]);
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
    public function destroy(string $id): void
    {
        Language::destroy($id);
    }
}
