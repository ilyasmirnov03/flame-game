<?php

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

Route::get('/profil', function () {
    return view('profil');
})->name("profil");

Route::get('/flame', function () {
    return view('flame/flame');
})->name("flame");

Route::get('/flame/solo', function () {
    return view('flame/solo_flame');
})->name("solo_flame");

Route::get('/flame/solo/games', function () {
    return view('games/select_game');
})->name("select_game");

Route::get('/params', function () {
    return view('params');
})->name("params");

Route::get('/score', function () {
    return view('score');
})->name("score");

Route::get('/flame/solo/games/run', function () {
    return view('games/running_game');
})->name("game-run");

Route::get('/flame/solo/games/quizz', function () {
    return view('games/quizz');
})->name("game-quizz");