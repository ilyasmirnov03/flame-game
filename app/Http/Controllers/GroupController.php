<?php

namespace App\Http\Controllers;

use App\Enums\GroupMemberRole;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GroupController extends Controller {

    public function store(Request $request): RedirectResponse
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

        GroupMember::create([
            'user_id' => Auth::id(),
            'group_id' => $group->id,
            'role' => GroupMemberRole::OWNER->value
        ]);

        return redirect()->route('group.flame', ['group' => $group->id]);
    }

    /**
     * Show groups unfiltered groups
     */
    public function showGroups(): View
    {
        $group = new Group();
        $groups = $group->getForSearch(25)->get();
        return view('group.search', compact('groups'));
    }

    /**
     * Search groups by name
     */
    public function searchGroups(Request $request): View
    {
        $search = $request->get('search');

        $group = new Group();
        $groups = $group->getForSearch(25)
            ->where('name', 'LIKE', '%' . $search . '%')
            ->get();

        return view('group.search_content', compact('groups'));
    }

    /**
     * Join a group if not already part of it
     */
    public function joinGroup(Request $request): RedirectResponse
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
}
