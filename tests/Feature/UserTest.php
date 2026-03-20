<?php

use App\Models\User;

it('can render', function () {
    $staff = User::factory()->count(3)->create();

    $contents = $this->view('staff.index', ['staff' => $staff]);

    $contents->assertSee($staff->first()->name);
});

it('Creates a user', function () {
    $this->actingAs($user = User::factory()->create());
    visit('/staff/create')
        ->fill('name', 'John G Smith')
        ->fill('email', 'JSmith@fit.edu')
        ->fill('password', 'Let me in')
        ->click('Create Staff')
        ->assertPathIs('/staff')
        ->assertSee('John G Smith');
});

it('Edit a user', function () {
    $this->actingAs($user = User::factory()->create());
    $user = User::factory()->create();

    visit("/staff/{$user->id}")
        ->click('Edit')
        ->assertPathIs("/staff/{$user->id}/edit")
        ->fill('name', "{$user->name}-Lopez")
        ->click('Save Update')
        ->assertPathIs("/staff/{$user->id}")
        ->assertSee("{$user->name}-Lopez");

});

it('Delete a user', function () {
    $this->actingAs($user = User::factory()->create());
    $user = User::factory()->create();

    visit("/staff/{$user->id}")
        ->click('Delete')
        ->assertPathIs('/staff')
        ->assertDontSee("{$user->name}");
});
