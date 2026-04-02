<?php

use App\Models\Course;
use App\Models\Student;
use App\Models\User;

it('Enroll a Student from Course', function () {
    $this->actingAs($user = User::factory()->create());
    $course = Course::factory()->create();
    Student::factory()->count(3)->create();
    $student = Student::factory()->create();
    Student::factory()->count(2)->create();

    visit("/courses/{$course->id}")
        ->click('Enroll Students')
        ->assertPathIs("/courses/{$course->id}/enroll-student")
        ->type('student', "{$student->first_name} {$student->middle_name} {$student->last_name}")
        ->assertValue('student', "{$student->first_name} {$student->middle_name} {$student->last_name}")
        ->assertValue('selected_student', $student->id)
        ->click('Add Student')
        ->assertPathIs("/courses/{$course->id}/enroll-student")
        ->assertSee("{$student->first_name} {$student->middle_name} {$student->last_name}");
});

it('Enroll a student in a Course', function () {
    $this->actingAs($user = User::factory()->create());
    $course = Course::factory()->create();
    Student::factory()->count(3)->create();
    $student = Student::factory()->create();
    Student::factory()->count(2)->create();

    visit("/students/{$student->id}")
        ->click('Enroll in Courses')
        ->assertPathIs("/students/{$student->id}/enroll-course")
        ->type('course', "{$course->course_code} - {$course->course_name}: {$course->semester} {$course->year}")
        ->assertValue('course', "{$course->course_code} - {$course->course_name}: {$course->semester} {$course->year}")
        ->assertValue('selected_course', $course->id)
        ->click('Add Course')
        ->assertPathIs("/students/{$student->id}/enroll-course")
        ->assertSee("{$course->course_code} - {$course->course_name}: {$course->semester} {$course->year}");
});
