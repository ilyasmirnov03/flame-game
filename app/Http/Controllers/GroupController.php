<?php

namespace App\Http\Controllers;

use App\Enums\GroupMemberRole;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:16',
            'max_members' => 'required|integer|min:1|max:50',
            'private' => 'in:on,off'
        ]);

        if ($validator->fails()) {
            return redirect()->route('group.create')
                ->withErrors($validator)
                ->withInput();
        }


        $group = Group::create([
            'name' => $request->input('name'),
            'max_members' => $request->input('max_members'),
            'private' => $request->has('private'),
            'image' => $request->input('icon'),
        ]);

        $user = Auth::user();

        GroupMember::create([
            'user_id' => $user->id,
            'group_id' => $group->id,
            'role' => GroupMemberRole::OWNER->value,
        ]);

        return redirect()->route('group.flame', ['group' => $group->id]);
    }


    public function create()
    {
        $groupIcons = [];
        $iconDirectory = public_path('images/group_icons');

        if (file_exists($iconDirectory) && is_dir($iconDirectory)) {
            $files = scandir($iconDirectory);

            $groupIcons = array_filter($files, function ($file) {
                return is_file(public_path("images/group_icons/$file"));
            });

            $groupIcons = array_values($groupIcons);
        }

        return view('group.create', ['groupIcons' => $groupIcons]);
    }
}