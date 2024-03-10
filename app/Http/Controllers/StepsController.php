<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class StepsController extends Controller
{
    public function show()
    {
        $response = Http::get('https://maksance.alwaysdata.net/api-jo/etapes');
        $responseCurrentStep = Http::get('https://maksance.alwaysdata.net/api-jo/etape/actuelle');

        $steps = $response->json();
        $currentStep = $responseCurrentStep->json();

        $upcomingSteps = [];
        $pastSteps = [];

        foreach ($steps['data'] as $step) {
            if (strtotime($step['date']) > time()) {
                $pastSteps[] = $step;
            } else {
                $upcomingSteps[] = $step;
            }
        }

        return view('home', compact('upcomingSteps', 'pastSteps', 'currentStep'));
    }
}