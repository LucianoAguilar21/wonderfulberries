<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Varieties List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-2xl font-bold mb-6">Variedades</h1>

                    @if(session('success'))
                        <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @if($varieties)
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No hay variedades disponibles.</td>
                                </tr>
                            @else
                                @foreach($varieties as $variety)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $variety->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $variety->name ?? 'Variedad eliminada' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                            <a href="{{ route('admin.varieties.show', $variety) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                            <a href="{{ route('admin.varieties.edit', $variety) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <a href="{{ route('admin.varieties.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ __('Create New Variety') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
