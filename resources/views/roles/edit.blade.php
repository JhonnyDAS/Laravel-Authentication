<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <div class="md:flex md:items-center md:justify-between mb-6">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Edit
                    Role</h2>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <a href="{{ route('roles.index') }}"
                    class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Back</a>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <form action="{{ route('roles.update', $role) }}" method="POST" class="px-4 py-6 sm:p-8">
                @csrf
                @method('PUT')
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Role Name</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                {{ $role->name === 'ADMIN' ? 'readonly' : '' }}>
                        </div>
                        @if($role->name === 'ADMIN')
                            <p class="mt-1 text-xs text-gray-500">ADMIN role name cannot be changed.</p>
                        @endif
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-full">
                        <label class="block text-sm font-medium leading-6 text-gray-900 mb-3">Permissions</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($permissions as $group => $perms)
                                <div class="border rounded-md p-4 bg-gray-50">
                                    <h3 class="font-semibold text-gray-900 capitalize mb-3 border-b pb-2">{{ $group }}</h3>
                                    <div class="space-y-2">
                                        @foreach($perms as $permission)
                                            <div class="relative flex items-start">
                                                <div class="flex h-6 items-center">
                                                    <input id="permission_{{ $permission->id }}" name="permissions[]"
                                                        type="checkbox" value="{{ $permission->name }}"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                </div>
                                                <div class="ml-3 text-sm leading-6">
                                                    <label for="permission_{{ $permission->id }}"
                                                        class="font-medium text-gray-700">{{ $permission->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 mt-8 pt-8">
                    <button type="button" onclick="window.history.back()"
                        class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update
                        Role</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>