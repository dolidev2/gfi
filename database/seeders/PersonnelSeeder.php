<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        \App\Models\personnel::factory(10)->create();
    }
}
