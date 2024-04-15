<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sections')->delete();

        DB::table('sections')->insert([
            'name' => 'Section A',
            'description' => 'Description de la section A',
            'created_by' => 'Admin',
        ]);

        DB::table('sections')->insert([
            'name' => 'Section B',
            'description' => 'Description de la section B',
            'created_by' => 'Admin',
        ]);
    }
}
