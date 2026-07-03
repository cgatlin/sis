<?php

use App\Models\User;

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