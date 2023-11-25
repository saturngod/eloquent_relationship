<?php

namespace Database\Factories;

use App\Models\TextPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "title" => fake()->realText(),
            "postable_id" => TextPost::factory()->create()->id,
            "postable_type" => TextPost::class,
            "body" => fake()->paragraph(),
        ];
    }
}
