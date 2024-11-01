<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'game_slug' => $this->faker->slug,
            'content' => $this->faker->paragraph,
            'user_id' => null, // Verrà impostato dal seeder
        ];
    }
}
