<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Http\Requests\StoreFriendshipRequest;
use App\Http\Requests\UpdateFriendshipRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        if (request()->getUri() == route('friends.requests')) {

            $sentRequests = Auth::user()->sentFriendRequests;
            $receivedRequests = Auth::user()->receivedFriendRequests;

            // dd([
            //     'sentRequests' => $sentRequests,
            //     'receivedRequests' => $receivedRequests,
            // ]);

            $sentRequestFriendships = [];

            foreach ($sentRequests as $sentRequest) {

                $sentRequestFriendships[$sentRequest->id] = Friendship::getFriendshipBetween(Auth::user(), $sentRequest)->first();

            }

            $receivedRequestFriendships = [];

            foreach ($receivedRequests as $receivedRequest) {

                $receivedRequestFriendships[$receivedRequest->id] = Friendship::getFriendshipBetween(Auth::user(), $receivedRequest)->first();

            }


            return view('friends.requests', [
                'sentRequests' => $sentRequests,
                'receivedRequests' => $receivedRequests,
                'sentRequestFriendships' => $sentRequestFriendships,
                'receivedRequestFriendships' => $receivedRequestFriendships,
            ]);
        } else if(request()->getUri() == route('profile.blocked')){

            $blockedUsers = Auth::user()->sentBlocks;

            $friendships = [];

            foreach ($blockedUsers as $user) {

                $friendships[$user->id] = Friendship::getFriendshipBetween(Auth::user(), $user)->first();

            }

            return view('profile.blocked', [
                'users' => $blockedUsers,
                'friendships' => $friendships,
        ]);

        }


        $friends = Auth::user()->friends();

        $friendships = [];

        foreach ($friends as $friend) {

            $friendships[$friend->id] = Friendship::getFriendshipBetween(Auth::user(), $friend)->first();


        }



        return view('friends.index', [
            'friends' => $friends,
            'friendships' => $friendships,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFriendshipRequest $request)
    {
        //
        $validated = $request->validated();
        $user = User::find($validated['user_id']);

        if ($user) {
            $friendship = Friendship::getFriendshipBetween($user, Auth::user())->first();

            if ($validated['action'] == 'add') {
                if (!$friendship) {
                    $friendship = Friendship::create([
                        'requester_id' => Auth::user()->id,
                        'addressee_id' => $user->id,
                        'status' => 'pending'
                    ]);

                } else {
                    $friendship->requester_id = Auth::user()->id;
                    $friendship->addressee_id = $user->id;
                    $friendship->status = 'pending';

                    $friendship->save();

                }

            } else if ($validated['action'] == 'block') {
                if (!$friendship) {
                    $friendship = Friendship::create([
                        'requester_id' => Auth::user()->id,
                        'addressee_id' => $user->id,
                        'status' => 'blocked'
                    ]);

                } else {
                    $friendship->requester_id = Auth::user()->id;
                    $friendship->addressee_id = $user->id;
                    $friendship->status = 'blocked';

                    $friendship->save();

                }

            }
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Friendship $friendship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Friendship $friendship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFriendshipRequest $request, Friendship $friendship)
    {
        // Since the only action for the update method is accept, we will accept the friend request and redirect back

        $friendship->status = 'accepted';

        $friendship->save();

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Friendship $friendship)
    {
        //

        $friendship->delete();

        return redirect()->back();
    }
}
