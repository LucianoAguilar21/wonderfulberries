<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Order') }}
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
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="client" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client</label>
                                <select id="client" name="client_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="destination" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination</label>
                                <select id="destination" name="destination_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a destination</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="exporter" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Exporter</label>
                                <select id="exporter" name="exporter_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose an exporter</option>
                                    @foreach($exporters as $exporter)
                                        <option value="{{ $exporter->id }}">{{ $exporter->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="transport" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transport</label>
                                <select id="transport" name="transport" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a transport</option>                                    
                                    <option value="air">{{ "Aéreo" }}</option>
                                    <option value="sea">{{ "Marítimo" }}</option>    
                                    <option value="land">{{ "Tierra" }}</option>                                                                      
                                </select>
                            </div>
                            <div>
                                <label for="observations" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observations</label>
                                <textarea id="observations" name="observations" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write observations here..."></textarea>
                            </div>
                             <div>
                                <label for="pot_size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pot size</label>
                                <input type="text" id="pot_size" name="pot_size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Example: 4.4" required />
                            </div>
                            <div>
                                <input id="organic" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="organic" name="organic" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is organic</label>                                
                            </div>
                            
                            <div>
                                <input id="is_labeled" name="is_labeled" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="is_labeled" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is Labeled</label>                                  
                                <input type="text" id="label" name="label" class=" label bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 hidden" placeholder="Label description" />
                                <script>
                                    document.getElementById('is_labeled').addEventListener('change', function() {
                                        if (this.checked) {
                                            document.querySelector('#label').style.display = 'block';
                                           
                                        } else {
                                            document.querySelector('#label').style.display = 'none';
                                           
                                        }
                                    });
                                </script>
                            </div>

                            <div>
                                <label for="box_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Box type</label>
                                <input type="text" id="box_type" name="box_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Wonderful" required />
                            </div>

                             <div>
                                <label for="treatment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Treatment</label>
                                <select id="treatment" name="treatment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a treatment</option>                                    
                                    <option value="Frio">{{ "Frío" }}</option>
                                    <option value="Brom">{{ "Brom" }}</option>  
                                                                                                          
                                </select>
                            </div>

                        </div>

                        <input type="text" hidden name="status" value="open" />

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('Create Order') }}</button>
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
