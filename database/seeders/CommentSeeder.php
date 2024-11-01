<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        if (User::count() < 10) {
            User::factory(10)->create();
        }

        $users = User::all();

        foreach ($users as $user) {
            Comment::factory()->count(5)->create([
                'user_id' => $user->id,
                'game_slug' => 'star-trucker',
            ]);
        }
    }
}
