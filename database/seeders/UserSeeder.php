<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            DB::table('users')->delete();
            DB::table('users')->insert([
                // 'name' => Str::random(10),
                'name' => 'nacer',
                // 'email' => Str::random(10).'@example.com',
                'email' => 'nacer@gmail.com',
                // 'password' => Hash::make('password'),
                'password' => Hash::make('nacer@gmail.com'),
            ]);
        }
    }
}
