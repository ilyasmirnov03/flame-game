<?php

use App\Classes\CacheKeysManager;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StepsController;
use App\Models\Game;
use App\Models\Group;
use App\Models\User;
use App\Models\UserScore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

/**
 * Profile pages
 */
Route::prefix('/profile')->name('profile.')->group(function () {

    Route::get('/', function () {
        return view('profile.index', ['user' => Auth::user()]);
    })->name("profile")->middleware(['auth']);

    // Access edit page
    Route::get('/edit', function () {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user]);
    })->name("edit")->middleware(['auth']);

    // Request an edit
    Route::post('/edit', [ProfileController::class, 'changeInfos'])->name("edit")->middleware(['auth']);

    Route::get('/{user}', function (User $user) {
        return view('profile.index', ['user' => $user]);
    })->name("consult");
});

/**
 * Flame pages
 */
Route::prefix('/flame')->name('flame.')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        $user = Auth::user()->load('userGroups');
        $score = $user->scores->sum('score');
        return view('flame.index', [
            'user' => $user,
            'score' => $score,
        ]);
    })->name('index');

    // Solo flame page
    Route::get('/solo', function () {
        $score = Auth::user()->scores->sum('score');
        return view('flame.solo_flame', ['score' => $score]);
    })->name('solo');

    // Solo game selection
    Route::get('/solo/games', function () {
        $games = Game::get()->toArray();
        foreach ($games as &$game) {
            $game['timeToNextGame'] = Cache::get(CacheKeysManager::soloPlayed(Auth::id(), $game['id']));
        }
        return view('games.select_game', ['games' => $games, 'route' => 'flame.game']);
    })->name('select_game');

    // Solo games page
    Route::get('/solo/games/{game}', function (Game $game) {
        return view('games.' . $game->label, ['minigame' => $game]);
    })
        ->middleware('user.can.play.solo')
        ->name('game');
});

/**
 * Leaderboard routes
 */
Route::prefix('/leaderboard')->name('leaderboard.')->group(function () {
    Route::prefix('/solo')->name('solo.')->group(function () {
        Route::get('/', [LeaderboardController::class, 'leaderboardUser'])->name('index');

        Route::get('/{page}', [LeaderboardController::class, 'leaderboardUser'])->name('page');
    });

    Route::prefix('/group')->name('group.')->group(function () {
        Route::get('/', [LeaderboardController::class, 'leaderboardGroup'])->name('index');

        Route::get('/{page}', [LeaderboardController::class, 'leaderboardGroup'])->name('page');
    });
});

/**
 * Group pages
 */
Route::prefix('group')->name('group.')->middleware(['auth'])->group(function () {
    // Groups search page
    Route::get('/', [GroupController::class, 'showGroups'])->name('search');

    // Search group
    Route::get('/search', [GroupController::class, 'searchGroups'])->name('content');

    // Join group 
    Route::post('/join', [GroupController::class, 'joinGroup'])->name('join');

    // Create group
    Route::post('/', [GroupController::class, 'store'])->name('store');

    // Create group view
    Route::get('/create', [GroupController::class, 'create'])->name("create");

    // Group space
    Route::get('/flame/{group}', function (Group $group) {
        $score = UserScore::where('group_id', $group->id)->sum('score');
        return view('group.space', [
            'group' => $group,
            'score' => $score,
        ]);
    })->name('flame')->middleware('user.in.group');

    // Leave group
    Route::post('/leave/{group}', [GroupController::class, 'leaveGroup'])->name('leave');

    // Group games selection
    Route::get('/flame/{group}/games', function (Group $group) {
        $games = Game::get()->toArray();
        foreach ($games as &$game) {
            $game['timeToNextGame'] = Cache::get(CacheKeysManager::groupPlayed(Auth::id(), $group->id, $game['id']));
        }
        return view('games.select_game', ['games' => $games, 'route' => 'group.game', 'group' => $group]);
    })->name('select_game');

    // Group games page
    Route::get('/flame/{group}/games/{game}', function (Group $group, Game $game) {
        return view('games.' . $game->label, ['minigame' => $game, 'group' => $group]);
    })
        ->middleware('user.can.play.group')
        ->name('game');
});

/**
 * User score
 */

Route::post('/user_score', [ScoreController::class, 'saveResult'])
    ->middleware('auth');

/**
 * Views
 */

Route::get('/', [StepsController::class, 'show'])->name('home');

Route::view('/params', 'params')->name('params');
