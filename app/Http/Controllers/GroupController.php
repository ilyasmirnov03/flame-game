<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:16',
            'max_members' => 'required|integer|min:1|max:50',
            'private' => 'boolean',
        ]);

        $group = Group::create([
            'name' => $request->input('name'),
            'max_members' => $request->input('max_members'),
            'private' => $request->has('private'),
        ]);

        $user = Auth::user();
        GroupMember::create([
            'user_id' => $user->id,
            'group_id' => $group->id,
        ]);

        return redirect()->route('group.flame', ['group' => $group->id]);
    }
}