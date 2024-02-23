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

Route::get('/flamme', function () {
    return view('flame');
})->name("flame");

Route::get('/flamme/solo', function () {
    return view('solo_flame');
})->name("solo_flame");

Route::get('/flamme/solo/games', function () {
    return view('select_game');
})->name("select_game");

Route::get('/params', function () {
    return view('params');
})->name("params");

Route::get('/score', function () {
    return view('score');
})->name("score")->middleware(['auth']);

Route::get('/flamme/solo/games/{game}', function ($game) {
    $minigames = config('static.minigames');

    if (array_key_exists($game, $minigames)) {
        $minigame = $minigames[$game];
        return view('play', compact('minigame'));
    } else {
        abort(404, 'Jeu non trouvé');
    }
})->name('play');