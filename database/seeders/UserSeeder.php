<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'WebMaster',
            'email' => 'webmaster@fit.edu',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Valerie Felicity Frizzle',
            'email' => 'vfrizzle@fit.edu',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role' => 'teacher',
        ]);

        for ($i = 1; $i <= 25; $i++) {
            DB::table('users')->insert([
                'name' => fake()->Name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]);
        }
    }
}
