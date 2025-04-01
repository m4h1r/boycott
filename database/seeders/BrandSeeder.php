<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::insert([
            'id' => '1',
            'name' => 'Ülker',
            'alternatives' => '',  // Assuming these are IDs of alternative brands
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Brand::insert([
            'id' => '2',
            'name' => 'Eti',
            'alternatives' => '',  // Assuming these are IDs of alternative brands
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Brand::insert([
            'id' => '3',
            'name' => 'EspressoLab',
            'alternatives' => '',  // Assuming these are IDs of alternative brands
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Brand::insert([
            'id' => '4',
            'name' => 'D&R',
            'alternatives' => '',  // Assuming these are IDs of alternative brands
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Brand::insert([
            'id' => '5',
            'name' => 'İdefix',
            'alternatives' => '',  // Assuming these are IDs of alternative brands
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Brand::insert([
            'id' => '6',
            'name' => 'Turkuaz Yayınevi',
            'alternatives' => '',  // Assuming these are IDs of alternative brands
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Brand::insert([
            'id' => '7',
            'name' => 'TRT',
            'alternatives' => '',  // Assuming these are IDs of alternative brands
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Brand::insert([
            'id' => '8',
            'name' => 'DBL Entertainment',
            'alternatives' => '',  // Assuming these are IDs of alternative brands
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Brand::insert([
            'id' => '9',
            'name' => 'ETS Tur',
            'alternatives' => '',  // Assuming these are IDs of alternative brands
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
