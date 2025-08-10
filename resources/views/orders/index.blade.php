<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ __('Order List') }}</h3>
                        @can('create')
                            <a href="{{ route('orders.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Create Order') }}
                            </a>
                        @endcan
                    </div>

                    @if($orders->isEmpty())
                        <p class="text-gray-600">{{ __('No orders found.') }}</p>
                    @else
                    <div class="relative overflow-x-auto">
                        <table class="w-full bg-white dark:bg-gray-800 text-left">
                            <thead class="text-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="py-2 px-4 border-b">{{ __('Order ID') }}</th>
                                    <th class="py-2 px-4 border-b">{{ __('Client') }}</th>
                                    <th class="py-2 px-4 border-b">{{ __('Status') }}</th>
                                    <th class="py-2 px-4 border-b">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="bg-white border-b dark:bg-gray-800">
                                        <td class="py-2 px-4 border-b">{{ $order->id }}</td>
                                        <td class="py-2 px-4 border-b">{{ $order->client->name ?? 'Cliente eliminado'}}</td>
                                        <td class="py-2 px-4 border-b">{{ ucfirst($order->status) }}</td>
                                        <td class="py-2 px-4 border-b flex">
                                            <a href="{{ route('orders.show', $order) }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">{{ __('View') }}</a>
                                            <a href="{{ route('orders.copyInfo', $order->id) }}"  class="text-gray-900 bg-lime-200 hover:bg-lime-300 focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                Copiar
                                            </a>
                                        </td>

                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        {{-- {{ $orders->links() }} --}}
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
