<x-app-layout>
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-bold leading-7 text-gray-900">Edit Product</h2>
        </div>
        <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                                class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                        </div>
                        <div class="sm:col-span-4">
                            <label for="sku" class="block text-sm font-medium text-gray-900">SKU</label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" required
                                class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="price" class="block text-sm font-medium text-gray-900">Price</label>
                            <input type="number" step="0.01" name="price" id="price"
                                value="{{ old('price', $product->price) }}" required
                                class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="stock" class="block text-sm font-medium text-gray-900">Stock</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                                required
                                class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                        </div>
                        <div class="sm:col-span-4">
                            <label for="description" class="block text-sm font-medium text-gray-900">Description</label>
                            <textarea name="description" id="description" rows="3"
                                class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <a href="{{ route('products.index') }}" class="text-sm font-semibold text-gray-900">Cancel</a>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">Update</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>