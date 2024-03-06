<?php

namespace App\Http\Controllers;

use App\Enums\GroupMemberRole;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
            'role' => GroupMemberRole::OWNER->value
        ]);

        return redirect()->route('group.flame', ['group' => $group->id]);
    }

    public function showGroups()
    {
        $userId = Auth::id();

        $groups = Group::where('private', 0)->take(25)->get();

        $groups->each(function ($group) use ($userId) {
            $group->is_member = $group->isMember($userId);
            $group->total_score = $group->calculateTotalScore();
        });

        return view('group.search', compact('groups'));
    }

    public function joinGroup(Request $request)
    {
        $groupId = $request->input('group_id');
        $userId = Auth::id();

        $group = Group::findOrFail($groupId);
        if (!$group->isMember($userId)) {
            $group->members()->attach($userId, ['role' => 'member']);

            return redirect()->route('group.flame', ['group' => $group->id]);
        }

        return Redirect::back()->with('error', 'Vous êtes déjà membre de ce groupe');
    }

    public function searchGroups(Request $request)
    {
        $searchTerm = $request->input('search');

        $results = Group::where('name', 'LIKE', '%' . $searchTerm . '%')
            ->where('private', 0)
            ->take(25)
            ->get();

        $userId = Auth::id();

        $groups = $results->map(function ($group) use ($userId) {
            $group->is_member = $group->isMember($userId);
            $group->total_score = $group->calculateTotalScore();

            return $group;
        });

        return view('group.search', compact('groups', 'searchTerm'));
    }
}