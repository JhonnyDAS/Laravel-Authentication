->assertOk();
});

test('non-admin cannot view users list', function () {
actingAs($this->regularUser)
->get('/users')
->assertForbidden();
});

test('admin can create user', function () {
actingAs($this->admin)
->post('/users', [
'name' => 'New User',
'email' => 'newuser@example.com',
'password' => 'Password123!',
'password_confirmation' => 'Password123!',
'role' => 'ADMIN',
])
->assertRedirect('/users');

$this->assertDatabaseHas('users', [
'email' => 'newuser@example.com',
]);
});

test('admin can update user', function () {
$user = User::factory()->create();

actingAs($this->admin)
->put("/users/{$user->id}", [
'name' => 'Updated Name',
'email' => $user->email,
])
->assertRedirect('/users');

$this->assertDatabaseHas('users', [
'id' => $user->id,
'name' => 'Updated Name',
]);
});

test('admin can delete user', function () {
$user = User::factory()->create();

actingAs($this->admin)
->delete("/users/{$user->id}")
->assertRedirect('/users');

$this->assertSoftDeleted('users', [
'id' => $user->id,
]);
});

test('non-admin cannot create user', function () {
actingAs($this->regularUser)
->post('/users', [
'name' => 'New User',
'email' => 'newuser@example.com',
'password' => 'Password123!',
'password_confirmation' => 'Password123!',
])
->assertForbidden();
});