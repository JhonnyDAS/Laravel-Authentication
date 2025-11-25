->get('/clients')
->assertOk();
});

test('admin can create client', function () {
actingAs($this->admin)
->post('/clients', [
'name' => 'Test Client',
'email' => 'client@example.com',
'phone' => '1234567890',
'address' => '123 Test St',
])
->assertRedirect('/clients');

$this->assertDatabaseHas('clients', [
'email' => 'client@example.com',
]);
});

test('admin can update client', function () {
$client = Client::factory()->create();

actingAs($this->admin)
->put("/clients/{$client->id}", [
'name' => 'Updated Client',
'email' => $client->email,
'phone' => $client->phone,
'address' => $client->address,
])
->assertRedirect('/clients');

$this->assertDatabaseHas('clients', [
'id' => $client->id,
'name' => 'Updated Client',
]);
});

test('admin can delete client', function () {
$client = Client::factory()->create();

actingAs($this->admin)
->delete("/clients/{$client->id}")
->assertRedirect('/clients');

$this->assertSoftDeleted('clients', [
'id' => $client->id,
]);
});