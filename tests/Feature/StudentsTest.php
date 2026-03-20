<?php

use App\Models\Student;
use App\Models\User;

it('can render', function () {
    $students = Student::factory()->count(3)->create();

    $contents = $this->view('students.index', ['students' => $students]);

    $contents->assertSee($students->first()->first_name);
});

it('Creates a student', function () {
    $this->actingAs($user = User::factory()->create());

    visit('/students/create')
        ->fill('first_name', 'John')
        ->fill('last_name', 'Doe')
        ->fill('date_of_birth', '2000-01-01')
        ->click('Create Student')
        ->assertPathIs('/students');

    visit('/students')
        ->assertSee('Doe, John');
});

it('Edit a student', function () {
    $this->actingAs($user = User::factory()->create());
    $student = Student::factory()->create();

    visit("/students/{$student->id}")
        ->click('Edit')
        ->assertPathIs("/students/{$student->id}/edit")
        ->fill('last_name', "{$student->last_name}-Lopez")
        ->click('Save Update')
        ->assertPathIs("/students/{$student->id}")
        ->assertSee("{$student->last_name}-Lopez");

});

it('Delete a student', function () {
    $this->actingAs($user = User::factory()->create());
    $student = Student::factory()->create();

    visit("/students/{$student->id}")
        ->click('Delete')
        ->assertPathIs('/students')
        ->assertDontSee("{$student->last_name}, {$student->first_name} {$student->middle_name}");
});
