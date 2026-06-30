<?php

use App\Models\Course;
use App\Models\Student;
use App\Models\User;

it('redirects guests from protected routes', function () {
    $course = Course::factory()->create();
    $student = Student::factory()->create();

    $this->get('/courses')->assertRedirect('/login');
    $this->get('/students')->assertRedirect('/login');
    $this->get('/staff')->assertRedirect('/login');
    $this->get("/courses/{$course->id}/attendance")->assertRedirect('/login');
    $this->get("/students/{$student->id}/enroll-course")->assertRedirect('/login');
});

it('prevents non-admin users from accessing admin-only routes', function () {
    $this->actingAs(User::factory()->create(['role' => 'teacher']));
    $course = Course::factory()->create();
    $student = Student::factory()->create();

    $this->get('/courses/create')->assertStatus(403);
    $this->get('/students/create')->assertStatus(403);
    $this->get('/staff/create')->assertStatus(403);
    $this->delete("/courses/{$course->id}")->assertStatus(403);
    $this->delete("/students/{$student->id}")->assertStatus(403);
});
