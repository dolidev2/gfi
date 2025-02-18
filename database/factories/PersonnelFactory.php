<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personnel>
 */
class PersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_complet' => $this->faker->name(),
            'contact' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->address(),
            'matricule' => $this->faker->randomNumber(9),
            'image' => $this->faker->imageUrl(400, 400),
            'cnib_recto' => $this->faker->imageUrl(400, 400),
            'cnib_verso' => $this->faker->imageUrl(400, 400),
            'agence_id' => \App\Models\Agence::inRandomOrder()->first()->id,
        ];
    }
}
