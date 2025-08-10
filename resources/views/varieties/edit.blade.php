<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit variety') }}
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Editar Variedad</h1>

        <form action="{{ route('admin.varieties.update', $variety) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Nombre:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $variety->name) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Actualizar
                </button>

                <a href="{{ route('admin.varieties.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Volver
                </a>
            </div>
        </form>
</x-app-layout>
