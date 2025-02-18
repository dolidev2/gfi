<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_complet' => fake()->name(),
            'contact' => fake()->phoneNumber(),
            'username' => fake()->userName(),
            'password' => Hash::make('password'),
            'role' => fake()->randomElement(['admin','user']),
            'status' => fake()->randomElement(['active', 'inactive']),
            'cnib_recto' => fake()->imageUrl(60, 60),
            'cnib_verso' => fake()->imageUrl(60, 60),
            'image' => fake()->imageUrl(60, 60),
            'agence_id' => 1,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
