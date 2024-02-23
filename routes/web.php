<?php

use App\Http\Controllers\AuthController;
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

Route::get('/home', function () {
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

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/profil', function () {
    return view('profil');
})->name("profil")->middleware(['auth']);

Route::get('/flame', function () {
    return view('flame/flame');
})->name("flame")->middleware(['auth']);

Route::get('/flame/solo', function () {
    return view('flame/solo_flame');
})->name("solo_flame")->middleware(['auth']);

Route::get('/flame/solo/games', function () {
    return view('games/select_game');
})->name("select_game")->middleware(['auth']);

Route::get('/flame/solo/games/{game}', function (string $game) {
    $minigame = config('static.minigames.' . $game);

    if ($minigame == null) {
        abort(404, 'Jeu non trouvé');
    }
    return view('games.' . $game, compact('minigame', 'game'));
})->name('flame.game')->middleware(['auth']);

Route::get('/params', function () {
    return view('params');
})->name("params");

Route::get('/score', function () {
    return view('score');
})->name("score")->middleware(['auth']);
