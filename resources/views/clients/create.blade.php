<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="mb-4 flex justify-between items-center  ">
                        <div class="max-w-lg mx-auto mt-10">

                            <h2 class="text-2xl font-bold mb-6">Crear Nuevo Cliente</h2>

                            {{-- Mensaje de éxito --}}
                            @if(session('success'))
                                <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Errores --}}
                            @if ($errors->any())
                                <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-lg">
                                    <ul class="list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Formulario --}}
                            <form action="{{ route('admin.clients.store') }}" method="POST" class="space-y-4">
                                @csrf

                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Cliente</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>

                                <div>
                                    <button type="submit"
                                        class="w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                                        Guardar Cliente
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
