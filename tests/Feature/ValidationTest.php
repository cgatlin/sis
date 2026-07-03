<?php

use App\Models\User;
//Login
it('errors of bad password', function () {
    $user = User::factory()->create();

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'Fake1234')
        ->press('button[name="login"]') 
        ->assertSee('The provided credentials do not match our records.');
});

it('errors of bad email', function () {
    $user = User::factory()->create(['password' => 'Fake1234']);

    visit('/login')
        ->fill('email', 'Fake@email.com')
        ->fill('password', 'Fake1234')
        ->press('button[name="login"]') 
        ->assertSee('The provided credentials do not match our records.');
});

//Courses
it('errors teacher field is required', function () {
    $this->actingAs($user = User::factory()->create(['role' => 'admin']));

    visit('/courses/create')
        ->fill('course_code', 'CS101')
        ->fill('course_name', 'Introduction to Computer Science')
        ->select('semester', 'Winter')
        ->fill('year', '2023')
        ->fill('credits', '3')
        ->fill('description', 'An introductory course on computer science.')
        ->press('button[name="submit"]') 
        ->assertSee('The teacher field is required.');
});

it('errors teacher field is not a valid teacher', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);
    $student = User::factory()->create(['role' => 'student']);

    
    $response = $this->actingAs($admin)
        ->post('/courses', [
            'course_code' => 'CS101',
            'course_name' => 'Introduction to Computer Science',
            'semester'    => 'Winter',
            'year'        => '2023',
            'credits'     => '3',
            'description' => 'An introductory course on computer science.',
            'user'        => $student->id, 
        ]);

    
    $response->assertSessionHasErrors([
        'user' => 'The selected user is not a valid teacher.'
    ]);
});

it('errors semester field is not a valid semester', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);
    $teacher = User::factory()->create(['role' => 'teacher']);

    
    $response = $this->actingAs($admin)
        ->post('/courses', [
            'course_code' => 'CS101',
            'course_name' => 'Introduction to Computer Science',
            'semester'    => 'Fake',
            'year'        => '2023',
            'credits'     => '3',
            'description' => 'An introductory course on computer science.',
            'user'        => $teacher->id, 
        ]);

    
    $response->assertSessionHasErrors([
        'semester' => 'Not a valid Semester.'
    ]);
});

it('errors semester field is required', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);
    $teacher = User::factory()->create(['role' => 'teacher']);

    
    $response = $this->actingAs($admin)
        ->post('/courses', [
            'course_code' => 'CS101',
            'course_name' => 'Introduction to Computer Science',
            'year'        => '2023',
            'credits'     => '3',
            'description' => 'An introductory course on computer science.',
            'user'        => $teacher->id, 
        ]);

    
    $response->assertSessionHasErrors([
        'semester' => 'The semester field is required.'
    ]);
});

it('errors Course Code field is reqired', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);
    $teacher = User::factory()->create(['role' => 'teacher']);

    
    $response = $this->actingAs($admin)
        ->post('/courses', [
            'course_name' => 'Introduction to Computer Science',
            'semester'    => 'Spring',
            'year'        => '2023',
            'credits'     => '3',
            'description' => 'An introductory course on computer science.',
            'user'        => $teacher->id, 
        ]);

    $response->assertSessionHasErrors([
        'course_code' => 'The course code field is required.'
    ]);
});

it('errors Course Name field is required', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);
    $teacher = User::factory()->create(['role' => 'teacher']);

    
    $response = $this->actingAs($admin)
        ->post('/courses', [
            'course_code' => 'CS101',
            'semester'    => 'Spring',
            'year'        => '2023',
            'credits'     => '3',
            'description' => 'An introductory course on computer science.',
            'user'        => $teacher->id, 
        ]);

    
    $response->assertSessionHasErrors([
        'course_name' => 'The course name field is required.'
    ]);
});

it('errors Year field is required', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);
    $teacher = User::factory()->create(['role' => 'teacher']);

    
    $response = $this->actingAs($admin)
        ->post('/courses', [
            'course_code' => 'CS101',
            'course_name' => 'Introduction to Computer Science',
            'semester'    => 'Spring',
            'credits'     => '3',
            'description' => 'An introductory course on computer science.',
            'user'        => $teacher->id, 
        ]);

    
    $response->assertSessionHasErrors([
        'year' => 'The year field is required.'
    ]);
});

it('errors Credits field is required', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);
    $teacher = User::factory()->create(['role' => 'teacher']);

    
    $response = $this->actingAs($admin)
        ->post('/courses', [
            'course_code' => 'CS101',
            'course_name' => 'Introduction to Computer Science',
            'semester'    => 'Spring',
            'year'        => '2023',
            'description' => 'An introductory course on computer science.',
            'user'        => $teacher->id, 
        ]);

    
    $response->assertSessionHasErrors([
        'credits' => 'The credits field is required.'
    ]);
});

it('errors Description field is required', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);
    $teacher = User::factory()->create(['role' => 'teacher']);

    
    $response = $this->actingAs($admin)
        ->post('/courses', [
            'course_code' => 'CS101',
            'course_name' => 'Introduction to Computer Science',
            'semester'    => 'Spring',
            'year'        => '2023',
            'credits'     => '3',
            'user'        => $teacher->id, 
        ]);

    
    $response->assertSessionHasErrors([
        'description' => 'The description field is required.'
    ]);
});

//Students
it('errors First Name field is required', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);

    
    $response = $this->actingAs($admin)
        ->post('/students', [
            'last_name' => 'Doe',
            'date_of_birth' => now(), 
        ]);

    
    $response->assertSessionHasErrors([
        'first_name' => 'The first name is required.'
    ]);
});

it('errors Last Name field is required', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);

    
    $response = $this->actingAs($admin)
        ->post('/students', [
            'first_name' => 'John',
            'date_of_birth' => now(), 
        ]);

    
    $response->assertSessionHasErrors([
        'last_name' => 'The last name is required.'
    ]);
});

it('errors Date field is required', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);

    
    $response = $this->actingAs($admin)
        ->post('/students', [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

    
    $response->assertSessionHasErrors([
        'date_of_birth' => 'The date of birth is required.'
    ]);
});

it('errors Date field is a date', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);

    
    $response = $this->actingAs($admin)
        ->post('/students', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => 'FakeDate', 
        ]);

    
    $response->assertSessionHasErrors([
        'date_of_birth' => 'The date of birth is not a valid date.'
    ]);
});

//Staff
it('errors Date field is a date', function () {
    
    $admin = User::factory()->create(['role' => 'admin']);

    
    $response = $this->actingAs($admin)
        ->post('/students', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => 'FakeDate', 
        ]);

    
    $response->assertSessionHasErrors([
        'date_of_birth' => 'The date of birth is not a valid date.'
    ]);
});