<?php

use App\Models\Course;
use App\Models\Student;
use App\Models\User;

it('can render', function () {
    $courses = Course::factory()->count(3)->create();

    $contents = $this->view('courses.index', ['courses' => $courses]);

    $contents->assertSee($courses->first()->course_name);
});

it('Creates a course', function () {
    $this->actingAs($user = User::factory()->create());
    $teacher = User::factory()->create();

    visit('/courses/create')
        ->fill('course_code', 'CIS 101')
        ->fill('course_name', 'Intro to Computers')
        ->select('semester', 'Winter')
        ->fill('year', '2026')
        ->fill('credits', '25')
        ->type('teacher', $teacher->name)
        ->assertValue('teacher', $teacher->name)
        ->assertValue('user', $teacher->id)
        ->fill('description', 'Wonderful World of Computers')
        ->click('Create Course')
        ->assertPathIs('/courses')
        ->assertSee('CIS 101, Intro to Computers');
});

it('Edit a course', function () {
    $this->actingAs($user = User::factory()->create());
    $teacher = User::factory()->create();
    $course = Course::factory()->create();

    visit("/courses/{$course->id}")
        ->click('Edit')
        ->assertPathIs("/courses/{$course->id}/edit")
        ->fill('course_code', 'CIS 101')
        ->fill('course_name', 'Intro to Computers')
        ->select('semester', 'Winter')
        ->fill('year', '2026')
        ->fill('credits', '25')
        ->type('teacher', $teacher->name)
        ->assertValue('teacher', $teacher->name)
        ->assertValue('user', $teacher->id)
        ->fill('description', 'Wonderful World of Computers')
        ->click('Save Edit')
        ->assertPathIs("/courses/{$course->id}")
        ->assertSee('CIS 101 - Intro to Computers')
        ->assertSee('Winter - 2026: 25 Credits')
        ->assertSee($teacher->name)
        ->assertSee('Wonderful World of Computers');

});

it('Delete a course', function () {
    $this->actingAs($user = User::factory()->create());
    $course = Course::factory()->create();

    visit("/courses/{$course->id}")
        ->click('Delete')
        ->assertPathIs('/courses')
        ->assertDontSee("{$course->course_name}");
});

it('Enroll a student', function () {
    $this->actingAs($user = User::factory()->create());
    $course = Course::factory()->create();
    Student::factory()->count(3)->create();
    $student = Student::factory()->create();
    Student::factory()->count(2)->create();

    visit("/courses/{$course->id}")
        ->type('student', "{$student->first_name} {$student->middle_name} {$student->last_name}")
        ->assertValue('student', "{$student->first_name} {$student->middle_name} {$student->last_name}")
        ->assertValue('selected_student', $student->id)
        ->click('Add Student')
        ->assertPathIs("/courses/{$course->id}")
        ->assertSee("{$student->first_name} {$student->middle_name} {$student->last_name}");
});
