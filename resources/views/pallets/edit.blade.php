<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pallet') }} #{{ $pallet->pallet_number }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">

                <form action="{{ route('pallets.update', $pallet->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Pallet Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="pallet_number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pallet Number</label>
                            <input type="text" name="pallet_number" id="pallet_number" value="{{ old('pallet_number', $pallet->pallet_number) }}" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white border-gray-300">
                        </div>
                        <div>
                            <label for="score" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Score</label>
                            <input type="number" step="0.1" name="score" id="score" value="{{ old('score', $pallet->score) }}" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white border-gray-300">
                        </div>
                        <div>
                            <label for="QC" class="block text-sm font-medium text-gray-700 dark:text-gray-200">QC</label>
                            <input type="number" step="0.1" name="QC" id="QC" value="{{ old('QC', $pallet->QC) }}" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white border-gray-300">
                        </div>
                        <div>
                            <label for="traceability" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Traceability</label>
                            <input type="text" name="traceability" id="traceability" value="{{ old('traceability', $pallet->traceability) }}" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white border-gray-300">
                        </div>
                        <div class="col-span-2">
                            <label for="observations" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Observations</label>
                            <textarea name="observations" id="observations" rows="3" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white border-gray-300">{{ old('observations', $pallet->observations) }}</textarea>
                        </div>
                    </div>

                    <!-- Quality Analysis -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        @foreach(['reds', 'deshidrated', 'sensitivas', 'soft', 'wounds', 'scars', 'rotten', 'fungus'] as $field)
                            <div>
                                <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ ucfirst($field) }}</label>
                                <input type="number" step="0.01" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $pallet->$field) }}" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white border-gray-300">
                            </div>
                        @endforeach
                    </div>

                    <!-- Varieties -->
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Varieties</h3>

                    <div id="variety-list">
                        @foreach ($pallet->palletInfos as $index => $info)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center mb-4 border p-4 rounded-md bg-gray-100 dark:bg-gray-900">
                                <select name="varieties[{{ $index }}][variety_id]" class="rounded dark:bg-gray-700 dark:text-white">
                                    @foreach ($varieties as $variety)
                                        <option value="{{ $variety->id }}" {{ $info->variety_id == $variety->id ? 'selected' : '' }}>{{ $variety->name }}</option>
                                    @endforeach
                                </select>
                                <select name="varieties[{{ $index }}][field_id]" class="rounded dark:bg-gray-700 dark:text-white">
                                    @foreach ($fields as $field)
                                        <option value="{{ $field->id }}" {{ $info->field_id == $field->id ? 'selected' : '' }}>{{ $field->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="varieties[{{ $index }}][lots]" placeholder="Lots" value="{{ $info->lots }}" class="rounded dark:bg-gray-700 dark:text-white" />
                                <input type="number" name="varieties[{{ $index }}][number_of_boxes]" placeholder="Boxes" value="{{ $info->number_of_boxes }}" class="rounded dark:bg-gray-700 dark:text-white" />
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:underline">Remove</button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" onclick="addVariety()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-6">+ Add Variety</button>

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">{{ __('Update Pallet') }}</button>
                </form>

                <script>
                    let varietyIndex = {{ $pallet->palletInfos->count() }};
                    function addVariety() {
                        const container = document.createElement('div');
                        container.classList.add('grid', 'grid-cols-1', 'md:grid-cols-4', 'gap-4', 'items-center', 'mb-4', 'border', 'p-4', 'rounded-md', 'bg-gray-100', 'dark:bg-gray-900');

                        container.innerHTML = `
                            <select name="varieties[\${varietyIndex}][variety_id]" class="rounded dark:bg-gray-700 dark:text-white">
                                @foreach ($varieties as $variety)
                                    <option value="{{ $variety->id }}">{{ $variety->name }}</option>
                                @endforeach
                            </select>
                            <select name="varieties[\${varietyIndex}][field_id]" class="rounded dark:bg-gray-700 dark:text-white">
                                @foreach ($fields as $field)
                                    <option value="{{ $field->id }}">{{ $field->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="varieties[\${varietyIndex}][lots]" placeholder="Lots" class="rounded dark:bg-gray-700 dark:text-white" />
                            <input type="number" name="varieties[\${varietyIndex}][number_of_boxes]" placeholder="Boxes" class="rounded dark:bg-gray-700 dark:text-white" />
                            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:underline">Remove</button>
                        `;

                        document.getElementById('variety-list').appendChild(container);
                        varietyIndex++;
                    }
                </script>

            </div>
        </div>
    </div>
</x-app-layout>
