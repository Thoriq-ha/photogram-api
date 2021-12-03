<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        return [
            'title' => $this->faker->word(6),
            'content' => $this->faker->text(),
            'picture' => $this->faker->image('public/storage/images',640,480, null, false),
            'user_id' => $user->id,
        ];
    }
}
