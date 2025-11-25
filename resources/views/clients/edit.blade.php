<x-app-layout>
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-bold leading-7 text-gray-900">Edit Client</h2>
        </div>
        <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $client->name) }}" required
                                class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                        </div>
                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}"
                                required
                                class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                        </div>
                        <div class="sm:col-span-4">
                            <label for="phone" class="block text-sm font-medium text-gray-900">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $client->phone) }}"
                                class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                        </div>
                        <div class="sm:col-span-4">
                            <label for="address" class="block text-sm font-medium text-gray-900">Address</label>
                            <textarea name="address" id="address" rows="3"
                                class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">{{ old('address', $client->address) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <a href="{{ route('clients.index') }}" class="text-sm font-semibold text-gray-900">Cancel</a>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">Update</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>