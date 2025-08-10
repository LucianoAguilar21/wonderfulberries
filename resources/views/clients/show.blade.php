<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Client Details') }}
        </h2>
    </x-slot>

<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">Detalles del Cliente</h1>

    <div class="mb-4">
        <p class="text-gray-700"><strong>ID:</strong> {{ $client->id }}</p>
        <p class="text-gray-700"><strong>Nombre:</strong> {{ $client->name }}</p>
        <p class="text-gray-500 text-sm">Creado: {{ $client->created_at->format('d/m/Y H:i') }}</p>
        <p class="text-gray-500 text-sm">Actualizado: {{ $client->updated_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="flex gap-4">
        <a href="{{ route('admin.clients.edit', $client) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Editar
        </a>

        <form action="{{ route('admin.clients.destroy', $client) }}" method="POST"
              onsubmit="return confirm('¿Seguro que quieres eliminar este cliente?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Eliminar
            </button>
        </form>

        <a href="{{ route('admin.clients.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Volver
        </a>
    </div>
</div>
</x-app-layout>
