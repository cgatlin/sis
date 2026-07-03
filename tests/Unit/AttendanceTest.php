<?php

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;

test('attendance belongs to a student', function () {
    $student = Student::factory()->create();
    $course = Course::factory()->create();

    $attendance = Attendance::create([
        'student_id' => $student->id,
        'course_id' => $course->id,
        'attendance_date' => now()->toDateString(),
        'status' => 'present',
    ]);

    expect($attendance->fresh()->student)->not->toBeNull();
    expect($attendance->fresh()->student->id)->toBe($student->id);
});

test('attendance belongs to a course', function () {
    $student = Student::factory()->create();
    $course = Course::factory()->create();

    $attendance = Attendance::create([
        'student_id' => $student->id,
        'course_id' => $course->id,
        'attendance_date' => now()->toDateString(),
        'status' => 'present',
    ]);

    expect($attendance->fresh()->course)->not->toBeNull();
    expect($attendance->fresh()->course->id)->toBe($course->id);
});
