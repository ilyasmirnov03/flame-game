<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    public function signup(SignupRequest $request): RedirectResponse {
        $credentials = $request->validated();

        $user = new User();
        $user->name = $credentials['name'];
        $user->password = Hash::make($credentials['password']);
        $user->email = $credentials['email'];
        $user->save();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => __('auth.signup-generic-error'),
        ])->onlyInput('email');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(LoginRequest $request): RedirectResponse {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => __('auth.login-generic-error'),
        ])->onlyInput('email');
    }

    /**
     * Handle a logout
     */
    public function logout(): RedirectResponse {
        Auth::logout();
        return to_route('home');
    }
}
