<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_code' => fake()->unique()->word(),
            'course_name' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'credits' => fake()->numberBetween(1, 5),
            'User' => User::factory(),
            'semester' => fake()->randomElement(['Fall', 'Spring', 'Summer','Winter']),
            'year' => fake()->year(),
        ];
    }
}
