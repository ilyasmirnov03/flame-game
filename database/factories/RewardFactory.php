<?php

namespace Database\Factories;

use App\Enums\RewardPlayerPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reward>
 */
class RewardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'score_needed' => fake()->numberBetween(250, 1000),
            'position' => fake()->numberBetween(RewardPlayerPosition::HEAD->value, RewardPlayerPosition::FLAME->value),
            'label' => fake()->unique()->word(),
            'icon' => fake()->imageUrl(32, 32),
            'on_player_image' => fake()->imageUrl(128, 128)
        ];
    }
}
