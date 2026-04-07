<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        $courses = Course::all();

        foreach ($students as $student) {

            // Pick random number of courses (e.g. 3–6 per student)
            $randomCourses = $courses->random(rand(3, 6));

            // Attach WITHOUT duplicates
            $student->courses()->syncWithoutDetaching(
                $randomCourses->pluck('id')->toArray()
            );
        }
    }
}
