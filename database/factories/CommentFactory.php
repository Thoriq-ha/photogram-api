<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $post = Post::inRandomOrder()->first();
        $user = User::whereNotIn('id', [$post->user_id])->inRandomOrder()->first();

        return [
            'content' => $this->faker->text(50),
            'post_id' => $post->id,
            'user_id' => $user->id
        ];
    }
}
