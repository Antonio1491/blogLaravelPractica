<?php

namespace Database\Factories;

use App\Models\Post;

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
        return [
            'user_id'=> 1,
            'title'=>$this->faker->sentence,
            'title'=>$this->faker->sentence,
            'body'=> $this->faker->text(800),
        ];
    }
}
