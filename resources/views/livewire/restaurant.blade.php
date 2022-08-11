<x-layout>
    <div>
        <header>
            <h1 class="text-xl">Restaurant Tables</h1>
            <p class="text-sm text-gray-500 mt-3 max-w-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, dolorum.</p>
        </header>
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 ">
            @foreach ($tables as $table)
                <livewire:table :table="$table" :wire:key="$table->id" />
            @endforeach
        </div>
    </div>

    <x-slot name="rightSection">
        <div x-data="{ showBill: @entangle('showBill') }">
            <header class="border-b border-b-pink-600 pb-3 ">
                <h1 class="text-xl">Restaurant Orders</h1>
                <p class="text-sm text-gray-500 mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum quaerat incidunt beatae
                    quas
                    dolorem molestias</p>
            </header>
            @if (isset($orders))
                <ul x-data="{ openedIndex: -1 }" class="mt-8">
                    @foreach ($orders as $key => $order)
                        {{-- Tables --}}
                        <li
                            x-data="{
                                mergeBox: false,
                            
                                mergeTable(currentOrderId, mergeOrderId) {
                                    $wire.mergeTable(currentOrderId, mergeOrderId)
                                        .then(result => console.log(result))
                                }
                            }"
                            class="mb-3 relative">
                            @php
                                $currentTableId = $order->table->id;
                                $currentOrderId = $order->id;
                            @endphp
                            <div class="rounded-md overflow-hidden shadow-md">

                                <header
                                        x-cloak
                                        :class="openedIndex == {{ $key }} ? 'rounded-t-md' : 'rounded-md'"
                                        class="bg-pink-600 flex items-center justify-between cursor-pointer">
                                    <button
                                            @click="openedIndex == {{ $key }} ? openedIndex = -1 : openedIndex = {{ $key }}"
                                            class="w-full h-full flex justify-between items-center py-2 px-3 bg-pink-500">
                                        <h1 class="text-white font-semibold ">{{ $order->table->name }}</h1>
                                        <svg :class="openedIndex == {{ $key }} ? 'rotate-180' : ''"
                                             class="w-5 h-5 text-white transform" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                             viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </header>
                                <div
                                     x-cloak
                                     x-show="openedIndex == {{ $key }}"
                                     class="overflow-hidden">
                                    @foreach ($order->items as $item)
                                        <div class="flex justify-between space-x-2 mt-3 p-3 rounded-md">
                                            <h2 class="flex-1">{{ $item->name }}</h2>
                                            <div class="px-6">
                                                <span>Qty: {{ $item->qty }}</span>
                                            </div>
                                            <div>
                                                <span>MMK {{ $item->price }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="p-3 mb-3 flex items-center justify-between">
                                        <div>
                                            <span class="text-gray-500 text-xs">Payment:</span>
                                            <span @class([
                                                'inline-flex px-3 py rounded-full text-white font-semibold',
                                                'bg-green-300' => $order->completed,
                                                'bg-red-400' => !$order->completed,
                                            ])>{{ $order->completed ? 'Payed' : 'Pending' }}
                                            </span>
                                        </div>
                                        <div class="flex justify-end">
                                            <span>Total: {{ $order->total }}</span>
                                        </div>
                                    </div>

                                    <div class="p-3">
                                        <header>
                                            <h3 class="text-sm">Manage table</h3>
                                        </header>
                                        <div class="mt-3 flex-1 flex justify-start space-x-3">
                                            <button
                                                    @Click="mergeBox = !mergeBox"
                                                    type="button"
                                                    class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-pink-500 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                                Merge
                                            </button>

                                            <button
                                                    @Click="$wire.makePayment({{ $order->id }})"
                                                    type="button"
                                                    class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-pink-500 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                                Pay
                                            </button>

                                            <button
                                                    wire:click="printOrder({{ $order->id }})"
                                                    type="button"
                                                    class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-pink-500 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                                Print
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Merge Box --}}
                            <div x-cloak x-show="mergeBox" @Click.outside="mergeBox = false"
                                 class="absolute z-10 w-full top-0 bg-white rounded-md overflow-hidden">
                                <header class="bg-pink-600 flex items-center justify-between px-3 py-2">
                                    <h1 class="text-white font-semibold ">Select a table below to merge.</h1>
                                </header>

                                <div class="py-6">
                                    <ul>
                                        @foreach ($orders as $order)
                                            @if ($order->table->id != $currentTableId)
                                                <li class="px-3 py-2">
                                                    <button
                                                            @Click="mergeTable({{ $currentOrderId }}, {{ $order->id }})"
                                                            class="bg-pink-500 inline-flex justify-between w-full py-2 px-3 text-white rounded-md hover:bg-pink-700">
                                                        <span>{{ $order->table->name }}</span>
                                                        <span>Order ID: {{ $order->table->name }}</span>
                                                        <span>Total: {{ $order->total }}</span>
                                                    </button>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                            {{-- End Of Merge Box --}}
                        </li>
                        {{-- End Of Tables --}}
                    @endforeach
                </ul>
            @endif

            @isset($bill)
                <x-modal :bill="$bill"></x-modal>
            @endisset
        </div>
    </x-slot>
</x-layout>
{{-- </div> --}}
