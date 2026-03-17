<?php

use App\Models\Student;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;

test('has enrolled in course', function () {
    $student = Student::factory()->create();

    $course = Course::factory()->create();

    expect($student->courses)->toBeEmpty();


    $enrollment = Enrollment::factory()->create([
        'student_id' => $student->id,
        'course_id' => $course->id,
    ]);
   
    expect($student->fresh()->courses->contains($course))->toBeTrue();
});
