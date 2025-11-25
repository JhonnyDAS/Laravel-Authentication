<x-app-layout>
    <div class="space-y-6">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl">Clients</h2>
                <p class="mt-1 text-sm text-gray-500">Manage system clients and their email</p>
            </div>
            @can('create-clients')
                <div class="mt-4 sm:ml-16 sm:mt-0">
                    <a href="{{ route('clients.create') }}"
                        class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                        <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                        </svg>
                        Add Client
                    </a>
                </div>
            @endcan
        </div>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created</th>
                        <th class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($clients as $client)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                {{ $client->name }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $client->email }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                @foreach($client->email as $role)
                                    <span
                                        class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $client->created_at->format('M d, Y') }}
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <div class="flex justify-end gap-x-2">
                                    @can('edit-clients')
                                        <a href="{{ route('clients.edit', $client) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    @endcan
                                    @can('delete-clients')
                                        <form action="{{ route('clients.destroy', $client) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-8 text-center text-sm text-gray-500">
                                No clients found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $clients->links() }}
        </div>
    </div>
</x-app-layout>