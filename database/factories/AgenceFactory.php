<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agence>
 */
class AgenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'contact' => fake()->phoneNumber(),
            'adresse' => fake()->address(),
            'email' => fake()->email(),
            'image' => fake()->imageUrl(60, 60),
            'status' =>'annexe',
        ];
    }
}
