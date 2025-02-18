<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agences')->insert([
            [

                'nom'=> 'Grace Fashion International',
                'contact'=> '76850274',
                'adresse'=> 'Dassasghom derrière la Pédiatrie',
                'email'=> 'gracefashioninternal@gmail.com',
                'status'=> 'principale',
            ],
        ]);
    }
}
