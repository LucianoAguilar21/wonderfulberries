<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Destinations') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-2xl font-bold mb-6">Destinos</h1>

                    <a href="{{ route('admin.destinations.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">
                        {{ __('Create New Destination') }}
                    </a>
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if($destinations->isEmpty())
                        <p>No destinations found.</p>
                    @else
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">ID</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Name</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($destinations as $destination)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">{{ $destination->id }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">{{ $destination->name }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-600">
                                            <a href="{{ route('admin.destinations.show', $destination) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-200 mr-2">View</a>
                                            <a href="{{ route('admin.destinations.edit', $destination) }}" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-200 mr-2">Edit</a>
                                            <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this destination?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
