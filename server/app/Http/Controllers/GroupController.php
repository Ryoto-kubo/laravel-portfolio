<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $groups = $user->groups->sortByDesc('created_at');
        return view('groups.index', [
            'groups' => $groups,
        ]);
    }

    public function show(Group $group)
    {
        $user = Auth::user();
        if($user instanceof User) {
            $groups = $user->groups->sortByDesc('created_at');
            $messages = $group->messages;
            return view('groups.show', [
                'group' => $group,
                'groups' => $groups,
                'messages' => $messages,
            ]);
        }
    }

    public function create()
    {
        $user = Auth::user();
        if($user instanceof User) {
            $followings = $user->followings;
            return view('groups.create', [
                'followings' => $followings
            ]);
        }
    }

    public function store(GroupRequest $request, Group $group)
    {
        $group->fill($request->all());
        $users = $request->users;
        if(!is_null($request['image'])){
            $file_path = $request->file('image')->store('public/images');
            $group->image = basename($file_path);
        }
        $group->save();
        $group->users()->attach(Auth::user());
        foreach ($users as $key => $user) {
            $group->users()->attach($user);
        }
        return redirect()->route('group.index');
    }

    public function edit(Group $group)
    {
        $user = Auth::user();
        if($user instanceof User){
            $group_users = $group->users;
            $followings = $user->followings;
            $diff_users = $followings->diff($group_users);
            return view('groups.edit', [
                'group' => $group,
                'group_users' => $group_users,
                'followings' => $followings,
                'diff_users' => $diff_users,
            ]);
        }
    }

    public function update(GroupRequest $request, Group $group)
    {
        $user = Auth::user();
        if($user instanceof User) {
            $group->fill($request->all());
            $group->save();
            $group->users()->sync($request->users);
            $group->users()->attach($user);

            if(!is_null($request['image'])){
                $file_path = $request->file('image')->store('public/images');
                $group->image = basename($file_path);
                $group->save();
            }
            return redirect()->route('group.show', [
                'group' => $group,
            ]);
        }
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('group.index');
    }
}
