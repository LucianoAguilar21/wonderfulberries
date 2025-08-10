<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Variety') . ' ' . $variety->name }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">{{ $variety->name }}</h1>

        <div class="mb-4">
            <p class="text-gray-700"><strong>ID:</strong> {{ $variety->id }}</p>
            <p class="text-gray-700"><strong>Nombre:</strong> {{ $variety->name }}</p>
            <p class="text-gray-500 text-sm">Creado: {{ $variety->created_at->format('d/m/Y H:i') }}</p>
            <p class="text-gray-500 text-sm">Actualizado: {{ $variety->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('admin.varieties.edit', $variety) }}"
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Editar
            </a>

            <form action="{{ route('admin.varieties.destroy', $variety) }}" method="POST"
                  onsubmit="return confirm('¿Seguro que quieres eliminar esta variedad?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Eliminar
                </button>
            </form>

            <a href="{{ route('admin.varieties.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        </div>
</x-app-layout>
