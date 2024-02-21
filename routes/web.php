<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/login', function () {
    return view('auth', ['baseActive' => 'connexion']);
})->name("login")->middleware(['guest']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/signup', function () {
    return view('auth', ['baseActive' => 'inscription']);
})->name("signup")->middleware(['guest']);

Route::post('/signup', [AuthController::class, 'signup']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profil', function () {
    return view('profil');
})->name("profil")->middleware(['auth']);

/**
 * Flame pages
 */
Route::prefix('/flame')->name('flame.')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        $user = Auth::user()->load('user_groups');
        $score = $user->scores->sum('score');
        return view('flame', [
            'user' => $user,
            'score' => $score,
        ]);
    })->name('index');

    Route::get('/solo', function () {
        $score = Auth::user()->scores->sum('score');
        return view('solo_flame', ['score' => $score]);
    })->name('solo');

    Route::get('/solo/games', function () {
        return view('select_game');
    })->name('select_game');

    Route::get('/solo/games/{game}', function (string $game) {
        $minigame = config('static.minigames.' . $game);

        if ($minigame == null) {
            abort(404, 'Jeu non trouvé');
        }
        return view('play', compact('minigame', 'game'));
    })->name('play');
});

Route::get('/params', function () {
    return view('params');
})->name("params");

Route::get('/score', function () {
    return view('score');
})->name("score")->middleware(['auth']);
