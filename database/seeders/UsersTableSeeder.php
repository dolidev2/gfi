<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            //Super_admin
            [
                'nom_complet'=>'Admin',
                'username'=>'admin',
                'password'=> Hash::make ('admin'),
                'role'=>'super_admin',
                'status'=>'active',
                'agence_id'=>1,
            ],
            //Admin
            [
                'nom_complet'=>'edo claude',
                'username'=>'edo',
                'password'=> Hash::make ('edo'),
                'role'=>'admin',
                'status'=>'active',
                'agence_id'=>1,
            ],
        ]);
    }
}
