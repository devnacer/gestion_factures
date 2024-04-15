<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->delete();

        $sectionId = DB::table('sections')->select('id')->first()->id;

        DB::table('products')->insert([
            'name' => 'Product A',
            'description' => 'Description du produit A',
            'section_id' => $sectionId,
        ]);

        DB::table('products')->insert([
            'name' => 'Product B',
            'description' => 'Description du produit B',
            'section_id' => $sectionId,
        ]);


    }
}
