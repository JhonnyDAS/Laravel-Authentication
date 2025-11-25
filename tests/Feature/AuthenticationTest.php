<?php

use App\Models\User;
use function Pest\Laravel\{actingAs, get, post};

test('unauthenticated users are redirected to login', function () {
    get('/dashboard')->assertRedirect('/login');
});

test('authenticated users can access dashboard', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get('/dashboard')
        ->assertOk();
});

test('users can login with correct credentials', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);

    post('/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ])->assertRedirect('/dashboard');
});

test('users cannot login with incorrect credentials', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);

    post('/login', [
        'email' => 'test@example.com',
        'password' => 'wrongpassword',
    ])->assertSessionHasErrors();
});
