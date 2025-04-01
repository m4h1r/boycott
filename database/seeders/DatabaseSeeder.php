<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BoycottSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::insert([
        //     'email_hash' => Hash::make('test@example.com'),
        //     'password' => Hash::make('password'), // password
        // ]);

        $this->call([
            BrandSeeder::class,
            BoycottSeeder::class,
        ]);
    }
}
