<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Friendship extends Pivot
{
    /** @use HasFactory<\Database\Factories\FriendshipFactory> */
    use HasFactory;


    protected $table = 'friendships';
    public $timestamps = false;

    public static function getFriendshipBetween(User $user1, User $user2)
    {

        $friendship = self::where('requester_id', '=', $user1->id, 'and')
            ->where('addressee_id', '=', $user2->id);

        $friendship = $friendship->first() ? $friendship : self::where('addressee_id', '=', $user1->id, 'and')
            ->where('requester_id', '=', $user2->id);

        return $friendship;

    }


}
