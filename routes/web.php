<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Models\Game;
use App\Models\Group;
use App\Models\UserScore;
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

/**
 * Authentication pages
 */
Route::get('/login', function () {
    return view('auth', ['baseActive' => 'connexion']);
})->name("login.view")->middleware(['guest']);

Route::get('/signup', function () {
    return view('auth', ['baseActive' => 'signup']);
})->name("signup.view")->middleware(['guest']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/profile', 'profile')
    ->name('profile')
    ->middleware(['auth']);

/**
 * Flame pages
 */
Route::prefix('/flame')->name('flame.')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        $user = Auth::user()->load('userGroups');
        $score = $user->scores->sum('score');
        return view('flame.flame', [
            'user' => $user,
            'score' => $score,
        ]);
    })->name('index');

    Route::get('/solo', function () {
        $score = Auth::user()->scores->sum('score');
        return view('flame.solo_flame', ['score' => $score]);
    })->name('solo');

    Route::get('/solo/games', function () {
        $games = Game::get();
        return view('games.select_game', ['games' => $games]);
    })->name('select_game');

    Route::get('/solo/games/{game}', function (Game $game) {
        return view('games.' . $game->label, ['minigame' => $game]);
    })->name('game');
});

/**
 * Group pages
 */
Route::prefix('group')->name('group.')->middleware(['auth'])->group(function () {
    // Groups search page
    Route::get('/', [GroupController::class, 'showGroups'])->name('search');

    Route::get('/search-groups', [GroupController::class, 'searchGroups'])->name('type');

    // Join group 
    Route::post('/join', [GroupController::class, 'joinGroup'])->name('join');

    // Create group
    Route::post('/', [GroupController::class, 'store'])->name('store');

    // Create group view
    Route::view('/create', 'group.create')->name("create");

    // Group space
    Route::get('/flame/{group}', function (Group $group) {
        $score = UserScore::where('group_id', $group->id)->sum('score');
        return view('group.index', [
            'group' => $group,
            'score' => $score,
        ]);
    })->name('flame')->middleware('user.in.group');
});

/**
 * Views
 */
Route::view('/', 'home')->name('home');

Route::view('/params', 'params')->name('params');

Route::view('/score', 'score')
    ->name('score')
    ->middleware(['auth']);