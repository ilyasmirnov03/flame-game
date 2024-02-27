<?php

use App\Http\Controllers\AuthController;
use App\Models\Group;
use App\Models\UserScore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
        return view('profile.profile', ['user' => Auth::user()]);
    })->name("profile")->middleware(['auth']);

    Route::get('/edit', function () {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user]);
    })->name("edit")->middleware(['auth']);

    Route::get('/{userId}', function (string $userId) {
        $user = DB::table('users')->find($userId);
        return view('profile.profile', ['user' => $user]);
    })->name("consult");
});

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
        return view('games.select_game');
    })->name('select_game');

    Route::get('/solo/games/{game}', function (string $game) {
        $minigame = config('static.minigames.' . $game);

        if ($minigame == null) {
            abort(404, 'Jeu non trouvé');
        }
        return view('games.' . $game, compact('minigame', 'game'));
    })->name('game');
});

Route::prefix('group')->name('group.')->middleware(['auth'])->group(function () {
    Route::get('/{group}', function (Group $group) {
        $score = UserScore::where('group_id', $group->id)->sum('score');
        return view('group.index', [
            'group' => $group,
            'score' => $score,
        ]);
    })->name('index')->middleware('user.in.group');
});

Route::get('/params', function () {
    return view('params');
})->name("params");

Route::get('/score', function () {
    return view('score');
})->name("score")->middleware(['auth']);
