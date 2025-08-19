<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Field') . ' ' . $field->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-2xl font-bold mb-6">Detalles del campo</h1>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $field->id }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $field->name }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Numero del campo</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $field->field_number }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.fields.edit', $field) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            {{ __('Edit Field') }}
                        </a>
                        <form action="{{ route('admin.fields.destroy', $field) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this field?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                {{ __('Delete Field') }}
                            </button>
                        </form>
                    </div>
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
