->get('/products')
->assertOk();
});

test('admin can create product', function () {
actingAs($this->admin)
->post('/products', [
'name' => 'Test Product',
'description' => 'Test Description',
'price' => 99.99,
'stock' => 10,
'sku' => 'TEST-SKU-001',
])
->assertRedirect('/products');

$this->assertDatabaseHas('products', [
'sku' => 'TEST-SKU-001',
]);
});

test('admin can update product', function () {
$product = Product::factory()->create();

actingAs($this->admin)
->put("/products/{$product->id}", [
'name' => 'Updated Product',
'description' => $product->description,
'price' => $product->price,
'stock' => $product->stock,
'sku' => $product->sku,
])
->assertRedirect('/products');

$this->assertDatabaseHas('products', [
'id' => $product->id,
'name' => 'Updated Product',
]);
});

test('admin can delete product', function () {
$product = Product::factory()->create();

actingAs($this->admin)
->delete("/products/{$product->id}")
->assertRedirect('/products');

$this->assertSoftDeleted('products', [
'id' => $product->id,
]);
});