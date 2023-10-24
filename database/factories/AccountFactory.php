<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'profile_image' => fake()->name(),
            'skills' => fake()->realText($maxNbChars = 10, $indexSize = 2),
            'about' => fake()->realText($maxNbChars = 20, $indexSize = 2),
            'views' => fake()->randomDigit(),
        ];
    }
}
