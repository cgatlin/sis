<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 300; $i++) {
            DB::table('students')->insert([
                'first_name' => fake()->firstName(),
                'middle_name' => fake()->optional()->firstName(),
                'last_name' => fake()->lastName(),
                'date_of_birth' => fake()->date(),
            ]);
        }
    }
}
