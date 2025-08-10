<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-bold mb-4">Editar Cliente</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.clients.update', $client) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" id="name"
                value="{{ old('name', $client->name) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                required>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.clients.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Actualizar</button>
        </div>
    </form>
</div>

</x-app-layout>
