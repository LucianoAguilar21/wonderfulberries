<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <a href="{{ route('orders.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Back to Orders') }}
                        </a>
                    </div>

                    <form action="{{ route('orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="client" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client</label>
                                <select id="client" name="client_id" class="...">
                                    <option>Choose a client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ $order->client_id == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="destination" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination</label>
                                <select id="destination" name="destination_id" class="...">
                                    <option>Choose a destination</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}" {{ $order->destination_id == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="exporter" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Exporter</label>
                                <select id="exporter" name="exporter_id" class="...">
                                    <option>Choose an exporter</option>
                                    @foreach($exporters as $exporter)
                                        <option value="{{ $exporter->id }}" {{ $order->exporter_id == $exporter->id ? 'selected' : '' }}>
                                            {{ $exporter->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="transport" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transport</label>
                                <select id="transport" name="transport" class="...">
                                    <option value="air" {{ $order->transport === 'air' ? 'selected' : '' }}>Aéreo</option>
                                    <option value="sea" {{ $order->transport === 'sea' ? 'selected' : '' }}>Marítimo</option>
                                    <option value="land" {{ $order->transport === 'land' ? 'selected' : '' }}>Tierra</option>
                                </select>
                            </div>

                            <div>
                                <label for="observations" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observations</label>
                                <textarea id="observations" name="observations" rows="4" class="...">{{ old('observations', $order->observations) }}</textarea>
                            </div>

                            <div>
                                <label for="pot_size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pot size</label>
                                <input type="text" id="pot_size" name="pot_size" value="{{ old('pot_size', $order->pot_size) }}" class="..." required />
                            </div>

                            <div>
                                <input id="organic" type="checkbox" name="organic" value="1" {{ $order->organic ? 'checked' : '' }} class="..." />
                                <label for="organic" class="...">Is organic</label>
                            </div>

                            <div>
                                <input id="is_labeled" name="is_labeled" type="checkbox" value="1" {{ $order->is_labeled ? 'checked' : '' }} class="..." />
                                <label for="is_labeled" class="...">Is Labeled</label>
                                <input type="text" id="label" name="label" value="{{ old('label', $order->label) }}" class="label ... {{ $order->is_labeled ? '' : 'hidden' }}" placeholder="Label description" />
                                <script>
                                    document.getElementById('is_labeled').addEventListener('change', function () {
                                        document.getElementById('label').classList.toggle('hidden', !this.checked);
                                    });
                                </script>
                            </div>

                            <div>
                                <label for="box_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Box type</label>
                                <input type="text" id="box_type" name="box_type" value="{{ old('box_type', $order->box_type) }}" class="..." required />
                            </div>

                            <div>
                                <label for="treatment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Treatment</label>
                                <select id="treatment" name="treatment" class="...">
                                    <option value="Frio" {{ $order->treatment === 'Frio' ? 'selected' : '' }}>Frío</option>
                                    <option value="Brom" {{ $order->treatment === 'Brom' ? 'selected' : '' }}>Brom</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="status" value="{{ $order->status }}" />

                        <button type="submit" class="...">
                            {{ __('Update Order') }}
                        </button>
                    </form>

                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
