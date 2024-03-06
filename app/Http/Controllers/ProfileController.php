<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {

    public function changeInfos(UserEditRequest $request) {
        $infos = $request->validated();
        $user = User::find(Auth::id());

        $user->name = $infos['name'];
        $user->email = $infos['email'];
        $user->save();
        $request->session()->regenerate();

        return redirect()->route('profile.edit')->with('success', 'Informations updated successfully');
    }
}
