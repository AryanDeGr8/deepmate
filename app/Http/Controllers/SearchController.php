<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    //

    public function __invoke()
    {
        $users = User::where('email', 'LIKE', '%' . request('q') . '%', 'and')
            ->where('id', '!=', Auth::user()->id)
            ->get();


        $friendships = [];

        foreach ($users as $user) {

            $friendships[$user->id] = Friendship::getFriendshipBetween(Auth::user(), $user)->first();


        }

        $friendshipsCleaned = [];
        $usersCleaned = [];

        foreach ($friendships as $user_id => $friendship) {

            if ($friendship == null || $friendship->status != 'blocked') {

                $status = null;
                if ($friendship) {
                    if ($friendship->status == 'accepted') {
                        $status = 'friends';
                    } elseif ($friendship->status == 'pending' && $friendship->requester_id == Auth::user()->id) {
                        $status = 'sent';
                    } elseif ($friendship->status == 'pending' && $friendship->addressee_id == Auth::user()->id) {
                        $status = 'received';
                    }
                }

                $friendshipsCleaned[$user_id] = ['friendship' => $friendship, 'status' => $status];

                $usersCleaned[$user_id] = User::where('id', '=', $user_id)->first();

            }
        }



        // dd($usersCleaned);

        return view('friends.add', [
            'users' => $usersCleaned,
            'friendships' => $friendshipsCleaned,
        ]);
    }
}
