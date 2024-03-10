<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class EtapesController extends Controller
{
    public function show()
    {
        $response = Http::get('https://maksance.alwaysdata.net/api-jo/etapes');
        $responseActuelle = Http::get('https://maksance.alwaysdata.net/api-jo/etape/actuelle');
        $etapes = $response->json();
        $etapeActuelle = $responseActuelle->json();

        $etapesAVenir = [];
        $etapesPassees = [];

        foreach ($etapes['data'] as $etape) {
            if (strtotime($etape['date']) > time()) {
                $etapesPassees[] = $etape;
            } else {
                $etapesAVenir[] = $etape;
            }
        }

        return view('home', compact('etapesAVenir', 'etapesPassees', 'etapeActuelle'));
    }
}