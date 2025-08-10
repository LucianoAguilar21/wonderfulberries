<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ORDER DETAILS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-4">
                        <a href="{{ route('orders.index') }}" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('Back') }}
                        </a>
                        @can('create')
                            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" type="button">
                                {{ __('Add pallet') }}
                            </button>
                        @endcan
                    </div>

                    @if($varieties)
                        <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-gray-100 rounded-lg shadow-sm dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            {{__('Add Pallet to Order') }}
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="p-6 space-y-4">
                                        <p class="text-gray-500 dark:text-gray-400">{{ __('Please create a variety and a field before adding pallets to this order.') }}</p>
                                        <div class="flex justify-center">
                                            <a href="{{ route('admin.varieties.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                {{ __('Create Variety') }}
                                            </a>
                                            <a href="{{ route('admin.fields.create') }}" class="ml-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                                {{ __('Create Field') }}
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @else

                    <!-- Main modal -->
                        <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-gray-100 rounded-lg shadow-sm dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            {{__('Add Pallet to Order') }}
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>

                                    <form class="max-w-sm mx-auto" action="{{ route('pallets.store') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="text" name="order_id" value="{{ $order->id }}" hidden>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <div class="mb-5">
                                                <label for="pallet_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("Pallet number")}}</label>
                                                <input type="text" id="pallet_number" name="pallet_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="100" required />
                                            </div>



                                            <div>
                                                <h4 class="p-4"><strong>{{__("Palllet information")}}</strong></h4>
                                                <div class="mb-5">
                                                    <label for="field_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Field</label>
                                                    <select id="field_id" name="field_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <option selected>Choose a Field</option>
                                                        @foreach($fields as $field)
                                                            <option value="{{ $field->id }}">{{ $field->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-5">
                                                    <label for="lots" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("Lots")}}</label>
                                                    <input type="text" id="lots"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="14,1,5" />
                                                </div>
                                                <div class="mb-5">
                                                    <label for="variety_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Variety</label>
                                                    <select id="variety_id" name="variety_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        @foreach($varieties as $variety)
                                                        <option value="{{ $variety->id }}">{{ $variety->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-5">
                                                    <label for="numberOfBoxes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("Number of Boxes")}}</label>
                                                    <input type="number"  id="numberOfBoxes"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="75" />
                                                </div>
                                                <button type="button" onclick="addVariety()">
                                                    <span  class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                        {{ __('Add Variety') }}
                                                    </span>
                                                </button>
                                            </div>
                                            <div id="varieties-container" class="space-y-2 mb-4"></div>
                                    <script>
                                                let varietyIndex = 0;

                                                function addVariety() {
                                                    const field = document.getElementById('field_id').value;
                                                    const fieldText = document.getElementById('field_id').selectedOptions[0].text;
                                                    const lots = document.getElementById('lots').value;
                                                    const variety = document.getElementById('variety_id').value;
                                                    const varietyText = document.getElementById('variety_id').selectedOptions[0].text;
                                                    const numberOfBoxes = document.getElementById('numberOfBoxes').value;

                                                    if (!field || !lots || !variety || !numberOfBoxes) {
                                                        alert('Todos los campos de variedad son obligatorios.');
                                                        return;
                                                    }

                                                    const container = document.getElementById('varieties-container');

                                                    const varietyHTML = `
                                                        <div class="flex  items-center bg-gray-200 dark:bg-gray-800 p-2 rounded">
                                                            <input type="hidden" name="varieties[${varietyIndex}][field_id]" value="${field}">
                                                            <input type="hidden" name="varieties[${varietyIndex}][lots]" value="${lots}">
                                                            <input type="hidden" name="varieties[${varietyIndex}][variety_id]" value="${variety}">
                                                            <input type="hidden" name="varieties[${varietyIndex}][numberOfBoxes]" value="${numberOfBoxes}">

                                                            <div><strong>Field:</strong> ${fieldText}</div>
                                                            <div><strong>Lots:</strong> ${lots}</div>
                                                            <div><strong>Variety:</strong> ${varietyText}</div>
                                                            <div><strong>Boxes:</strong> ${numberOfBoxes}</div>
                                                            <button type="button" onclick="this.parentElement.remove()" class="text-red-600 font-bold ml-2">✕</button>
                                                        </div>
                                                    `;

                                                    container.insertAdjacentHTML('beforeend', varietyHTML);
                                                    varietyIndex++;

                                                    document.getElementById('field_id').value = '';
                                                    document.getElementById('lots').value = '';
                                                    document.getElementById('variety_id').value = '';
                                                    document.getElementById('numberOfBoxes').value = '';
                                                }
                                            </script>
                                            <div class="text-gray-500 text-sm flex flex-col">
                                                <h4 class="p-4"><strong>{{__("Quality analisys")}}</strong></h4>
                                                <label class="">Rojos (%): <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" step="0.01" id="reds" name="reds" min="0" max="100"></label>
                                                <label class="">Deshidratadas (%): <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" step="0.01"  id="deshidrated" name="deshidrated" min="0" max="100"></label>
                                                <label class="">Sensitivas (%): <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" step="0.01"  id="sensitivas" name="sensitivas" min="0" max="100"></label>
                                                <label class="">Blandas (%): <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" step="0.01"  id="soft" name="soft" min="0" max="100"></label>
                                                <label class="">Heridas Frescas (%): <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" step="0.01"  id="wounds" name="wounds" min="0" max="100"></label>
                                                <label class="">Cicatrices (%): <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" step="0.01"  id="scars" name="scars" min="0" max="100"></label>
                                                <label class="">Podridos (%): <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" step="0.01"  id="rotten" name="rotten" min="0" max="100"></label>
                                                <label class="">Hongos (%): <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" step="0.01"  id="fungus" name="fungus" min="0" max="100"></label>
                                            </div>

                                            <div>
                                                <label for="qc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("QC")}}</label>
                                                <input type="number" step="0.01" id="qc" name="qc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="QC" required>
                                            </div>

                                            <div>
                                                <label for="score" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("Score")}}</label>
                                                <select name="score" id="score" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="A" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">A</option>
                                                    <option value="B"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">B</option>
                                                    <option value="C" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">C</option>
                                                    <option value="D" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">D</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label for="traceability" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("Traceability")}}</label>
                                                <input type="text" id="traceability" name="traceability" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter traceablity..." required></input>
                                            </div>

                                            <div>
                                                <label for="observations" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("Observations")}}</label>
                                                <textarea id="observations" name="observations" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter observations..."></textarea>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                                            <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="lg:flex ">
                        <div class="mb-4 ">
                            <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Date') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->created_at }}</strong>
                        </div>
                        <div class="mx-1 grid grid-cols-2 gap-1 ">
                            <div class="mb-4">
                                <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Order ID') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->id }}</strong>
                            </div>
                            <div class="mb-4">
                                <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Pallets') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->pallets->count() }}</strong>
                            </div>
                        </div>

                    </div>

                        <div class="mb-4">
                            <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Client Name') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->client->name }} </strong>
                        </div>
                        <div class="mb-4">
                            <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Status') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ ucfirst($order->status) }}</strong>
                        </div>
                    <div class="lg:flex grid grid-cols-2 gap-1">
                        <div class="mb-4">
                            <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Destination') }}</strong> <strong class="dark:bg-gray-700 p-1 mx-0 rounded"> {{ $order->destination->name }}</strong>
                        </div>
                        <div class="mb-4">
                            <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Transport') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->transport }}</strong>
                        </div>
                    </div>
                    <div class="mb-4">
                        <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Exporter') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->exporter->name }}</strong>
                    </div>
                        <div class="mb-4">
                            <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Pot size') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->pot_size }}</strong>
                        </div>
                        <div class="mb-4">
                            <strong class="bg-gray-200  dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Organic') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->organic ? "Si" : "No" }}</strong>
                        </div>
                        <div class="mb-4">
                            <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Labeled') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->is_labeled ? "Si" : "No" }}</strong>
                        </div>
                        @if ($order->is_labeled)
                            <div class="mb-4">
                                <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Label') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->label }}</strong>
                            </div>
                        @endif
                        <div class="mb-4">
                            <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Treatment') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->treatment }}</strong>
                        </div>
                        <div class="mb-4">
                            <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0  rounded">{{ __('Bot type') }}</strong> <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->box_type }}</strong>
                        </div>

                    <div class="mb-4">
                        <strong class="bg-gray-200 dark:bg-gray-900 p-2 mx-0 rounded">{{ __('Observations') }}</strong>
                        <strong class="dark:bg-gray-700 p-2 mx-0 rounded"> {{ $order->observations ?? 'No notes provided' }}</strong>
                    </div>

                    <!-- Pallets Section -->

                    <div class="mb-4 w-full">
                        <h3 class="bg-gray-400 dark:bg-gray-900 p-2 mx-0 rounded text-center text-white">{{ __('Pallets') }}</h3>
                        @if($order->pallets->isEmpty())
                            <p class="text-gray-600">{{ __('No pallets found for this order.') }}</p>
                        @else
                            <div class="relative overflow-x-auto">
                                <table class="w-full bg-white dark:bg-gray-800 text-left">
                                    <thead class="text-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="py-2 px-4 border-b"></th>
                                            <th class="py-2 px-4 border-b">{{ __('Pallet Number') }}</th>
                                            <th class="py-2 px-4 border-b">{{ __('Score') }}</th>
                                            <th class="py-2 px-4 border-b">{{ __('QC') }}</th>
                                            <th class="py-2 px-4 border-b">{{ __('Traceability') }}</th>
                                            <th class="py-2 px-4 border-b">{{ __('Observations') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->pallets as $pallet)
                                            <tr class="bg-white dark:bg-gray-800">
                                                <td><button data-modal-target="pallet-modal-{{$pallet->id}}" data-modal-toggle="pallet-modal-{{$pallet->id}}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                    Ver
                                                    </button>
                                                </td>

                                                <!-- Main modal -->
                                                <div id="pallet-modal-{{$pallet->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative rounded-lg shadow-sm bg-gray-200 dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Terms of Service
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="pallet-modal-{{$pallet->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="p-4 md:p-5 space-y-4">
                                                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                                    Pallet Number: {{ $pallet->pallet_number }}<br>
                                                                    Score: {{ $pallet->score }}<br>
                                                                    QC: {{ $pallet->QC }}<br>
                                                                    Traceability: {{ $pallet->traceability }}<br>
                                                                    Observations: {{ $pallet->observations ?? 'No observations' }}<br>
                                                                </p>

                                                                <h4 class="my-2 p-2">{{__("Varieties")}}</h4>
                                                                @foreach ($pallet->palletInfos as $palletInfo)
                                                                    Variety: {{ $palletInfo->variety->name }}<br>
                                                                    Field: {{ $palletInfo->field->name }}<br>
                                                                    Lots: {{ $palletInfo->lots }}<br>
                                                                    Number of Boxes: {{ $palletInfo->number_of_boxes }}<br><br>
                                                                @endforeach

                                                                <p class="py-2 px-4 border-b">Reds: {{ $pallet->reds }}</p>
                                                                <p class="py-2 px-4 border-b">Deshidrated: {{ $pallet->deshidrated }}</p>
                                                                <p class="py-2 px-4 border-b">Sensitivas: {{ $pallet->sensitivas }}</p>
                                                                <p class="py-2 px-4 border-b">Soft: {{ $pallet->soft }}</p>
                                                                <p class="py-2 px-4 border-b">Wounds: {{ $pallet->wounds }}</p>
                                                                <p class="py-2 px-4 border-b">Scars: {{ $pallet->scars }}</p>
                                                                <p class="py-2 px-4 border-b">Rotten: {{ $pallet->rotten }}</p>
                                                                <p class="py-2 px-4 border-b">Fungus: {{ $pallet->fungus }}</p>


                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button data-modal-hide="pallet-modal-{{$pallet->id}}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                                                                @can('delete')
                                                                    <div class="m-2">
                                                                        <button data-modal-target="delete-modal-{{$pallet->id}}" data-modal-toggle="delete-modal-{{$pallet->id}}" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" type="button">
                                                                            {{__('Delete')}}
                                                                        </button>
                                                                    </div>
                                                                @endcan
                                                                @can('edit')
                                                                    <a href="{{ route('pallets.edit', $pallet) }}" class="text-yellow-500 font-bold hover:underline">{{ __('Edit') }}</a>
                                                                @endcan
                                                            </div>

                                                            <!-- Main modal -->
                                                            <div id="delete-modal-{{$pallet->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                                    <!-- Modal content -->
                                                                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                                                        <!-- Modal header -->
                                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                                ¿{{ __('Are you sure you want to delete this pallet?') }}?
                                                                            </h3>
                                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{$pallet->id}}">
                                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                                </svg>
                                                                                <span class="sr-only">Close modal</span>
                                                                            </button>
                                                                        </div>
                                                                        <!-- Modal body -->
                                                                        <div class="p-4 md:p-5 space-y-4">

                                                                        </div>

                                                                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                            <button data-modal-hide="delete-modal-{{$pallet->id}}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__('Back')}}</button>
                                                                            <form action="{{route('pallets.delete',$pallet)}}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button data-modal-hide="delete-modal-{{$pallet->id}}" type="submit" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                                                    {{ __('Delete') }}
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <td class="py-2 px-4 border-b">{{ $pallet->pallet_number }}</td>
                                                <td class="py-2 px-4 border-b">{{ $pallet->score }}</td>
                                                <td class="py-2 px-4 border-b">{{ $pallet->QC }}</td>
                                                <td class="py-2 px-4 border-b">{{ $pallet->traceability }}</td>
                                                <td class="py-2 px-4 border-b">{{ $pallet->observations ?? 'No observations' }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>


                    <a href="{{ route('orders.edit', $order->id) }}" class="text-yellow-500 font-bold hover:underline">{{ __('Edit') }}</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
