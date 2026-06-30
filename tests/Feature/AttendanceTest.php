<?php

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;

it('can take attendance', function () {
    $this->actingAs($user = User::factory()->create(['role' => 'admin']));
    $course = Course::factory()->create();
    $student = Student::factory()->create();

    $course->students()->syncWithoutDetaching([$student]);

    visit('/courses/'.$course->id)
        ->click('Take Attendance')
        ->assertSee("{$student->last_name}, {$student->first_name} {$student->middle_name}")
        ->select('select[name="attendance['.$student->id.']"]', 'absent')
        ->click('Save Attendance')
        ->click('View Attendance by Date')
        ->click(now()->toDateString())
        ->assertSee("{$student->last_name}, {$student->first_name} {$student->middle_name}")
        ->assertSee('absent');
});

it('can edit attendance', function () {
    $this->actingAs($user = User::factory()->create(['role' => 'admin']));
    $course = Course::factory()->create();
    $student = Student::factory()->create();

    $course->students()->syncWithoutDetaching([$student]);
    Attendance::create([
        'student_id' => $student->id,
        'course_id' => $course->id,
        'attendance_date' => now()->toDateString(),
        'status' => 'present',
    ]);

    visit('/courses/'.$course->id)
        ->click('View Attendance by Date')
        ->click(now()->toDateString())
        ->assertSee("{$student->last_name}, {$student->first_name} {$student->middle_name}")
        ->click('Edit')
        ->select('select[name="attendance['.$student->id.']"]', 'absent')
        ->click('Save Attendance')
        ->click('View Attendance by Date')
        ->click(now()->toDateString())
        ->assertSee("{$student->last_name}, {$student->first_name} {$student->middle_name}")
        ->assertSee('absent');
});
