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

Route::get('/flamme', function () {
    return view('flamme');
})->name("flamme");

Route::get('/flamme/solo', function () {
    return view('flamme_indiv');
})->name("flamme_indiv");

Route::get('/flamme/solo/games', function () {
    return view('select_game');
})->name("select_game");

Route::get('/flamme/solo/games/run', function () {
    return view('course');
})->name("course");

Route::get('/params', function () {
    return view('params');
})->name("params");

Route::get('/score', function () {
    return view('score');
})->name("score");