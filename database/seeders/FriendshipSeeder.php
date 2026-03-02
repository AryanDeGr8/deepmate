<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FriendshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        foreach (User::all() as $user) {
            $users = User::inRandomOrder()->take(rand(1, 3))->pluck('id');

            $user->friendships()->attach($users);
        }
    }
}
