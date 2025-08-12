<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Exporter' . ' ' . $exporter->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-2xl font-bold mb-6">Detalles del Exportador</h1>

                    <div class="mb-4">
                        <strong>ID:</strong> {{ $exporter->id }}
                    </div>
                    <div class="mb-4">
                        <strong>Nombre:</strong> {{ $exporter->name }}
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.exporters.edit', $exporter) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            {{ __('Edit Exporter') }}
                        </a>
                        <form action="{{ route('admin.exporters.destroy', $exporter) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                {{ __('Delete Exporter') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
