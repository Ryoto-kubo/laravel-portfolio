<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function show(User $user)
    {
        $posts = $user->posts->sortByDesc('created_at');
        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function edit()
    {
        return view('users.edit');
    }

    public function checkedYourself($request, $user)
    {
        if ($user->id === $request->user()->id)
        {
          return abort('404', 'Cannot follow yourself.');
        }
    }

    public function detachData(Request $request, User $user)
    {
        $request->user()->followings()->detach($user);
    }

    public function followings(User $user)
    {
        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    public function followers(User $user)
    {
        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, User $user)
    {
        $this->checkedYourself($request, $user);
        $this->detachData($request, $user);
        $request->user()->followings()->attach($user);
        return ['user' => $user];
    }

    public function unfollow(Request $request, User $user)
    {
        $this->checkedYourself($request, $user);
        $this->detachData($request, $user);
        return ['user' => $user];
    }
}
