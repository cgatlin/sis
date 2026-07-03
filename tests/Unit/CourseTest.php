<?php

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;

test('course has enrolled students', function () {
    $course = Course::factory()->create();
    $students = Student::factory()->count(2)->create();

    $course->students()->syncWithoutDetaching($students->pluck('id')->all());

    expect($course->fresh()->students->count())->toBe(2);
    expect($course->fresh()->students->pluck('id')->sort()->values())->toEqualCanonicalizing($students->pluck('id')->sort()->values());
});

test('course has attendances', function () {
    $course = Course::factory()->create();
    $student = Student::factory()->create();

    $attendance = Attendance::create([
        'student_id' => $student->id,
        'course_id' => $course->id,
        'attendance_date' => now()->toDateString(),
        'status' => 'present',
    ]);

    expect($course->fresh()->attendances->contains($attendance))->toBeTrue();
    expect($course->fresh()->attendances->first()->student->id)->toBe($student->id);
});
