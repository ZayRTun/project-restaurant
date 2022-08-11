<li
    x-data="{
        cleared: @entangle('cleared'),
        show: false,
        orderConfirmed: @entangle('orderConfirmed'),
        confirmOrder() {
            $wire.confirmOrder().then(result => console.log('Order Confirmed.'));
            this.show = false;
        }
    }" class="col-span-1 flex flex-col text-center bg-white rounded-lg overflow-hidden shadow divide-y divide-gray-200">
    <div class="flex-1 flex flex-col p-8">
        {{-- <div :class="orderConfirmed ? 'bg-green-300' : 'bg-red-400'" class="h-full flex items-center justify-center ">
            <h1 class="text-white font-semibold">{{ $table->name }}</h1>
        </div> --}}
        <dl class="mt-1 flex-grow flex flex-col justify-between">
            <dd class="text-gray-500 text-sm">{{ $table->name }}</dd>
            <dd class="mt-3">
                <span
                      @class([
                          'px-2 py-1 text-xs font-medium  rounded-full',
                          'text-pink-800 bg-pink-100' => $orderConfirmed,
                          'text-gray-800 bg-gray-100' => !$orderConfirmed,
                      ])
                      class="">{{ $orderConfirmed ? 'Occupied' : 'Available' }}</span>
            </dd>
        </dl>
    </div>

    <div>
        {{-- <div class="-mt-px flex divide-x divide-pink-500"> --}}
        <div class="-mt-px flex border-t border-pink-500">
            <div class="w-0 flex-1 flex">
                <button @Click="show = !show" type="button"
                        @class([
                            'relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm  font-medium border border-transparent rounded-bl-lg ',
                            'bg-pink-500 text-white hover:bg-pink-700' => $orderConfirmed,
                            'bg-white text-gray-700 hover:text-gray-500' => !$orderConfirmed,
                        ])
                        class="">
                    <svg @class([
                        'w-5 h-5',
                        'text-white' => $orderConfirmed,
                        ' text-gray-400' => !$orderConfirmed,
                    ]) class="" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd"
                              d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                              clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3">View Menu</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div
         x-cloak
         x-show="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="relative z-10 flex items-center" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div class="fixed z-20 inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed z-30 inset-0 overflow-y-auto">
            <div
                 x-on="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="flex justify-center min-h-full items-center px-4 text-center">
                <div
                     @click.away="show = false"
                     style="height: calc(100vh - 100px)"
                     class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-3xl sm:w-full">
                    <div class="flex flex-col h-full">
                        <h1 class="text-xl font-bold text-center py-5 bg-pink-500 text-white">Menus</h1>

                        <div class="flex-1">
                            <div style="height: calc(100vh - 240px)" class="overflow-hidden overflow-y-scroll">
                                <ul class="py-8 grid grid-cols-1 sm:grid-cols-2 gap-3 px-4 ">
                                    @foreach ($menus as $item)
                                        <li
                                            x-data="{
                                                cleared: @entangle('cleared'),
                                                quantity: 0,
                                                orderQty: 0,
                                                onOrder: false,
                                                total: null,
                                            
                                                incriment(id, name, price) {
                                                    this.quantity++;
                                                    this.total = price * this.quantity;
                                                    this.addToOrder(id, name, price);
                                                },
                                            
                                                decrement(id, name, price) {
                                                    this.quantity--;
                                                    this.total = price * this.quantity;
                                                    this.addToOrder(id, name, price);
                                                },
                                            
                                                addToOrder(id, name, price) {
                                                    $wire.addToOrder(id, name, price, this.quantity, this.total)
                                                        .then(result => {
                                                            if (result.qty == 0) {
                                                                this.orderQty, this.quantity = 0;
                                                                this.onOrder = false;
                                                                this.total = null;
                                                                return;
                                                            }
                                                            this.orderQty = result.qty;
                                                            this.onOrder = true;
                                                        })
                                                },
                                            
                                                tableCleared() {
                                                    console.log('cleared');
                                                }
                                            }"
                                            class="border shadow-sm rounded-md overflow-clip flex ">
                                            <div class="flex-1 flex flex-col py-3 px-3">
                                                <h2 class="text-lg">{{ $item->name }}</h2>
                                                <div class="mt-3 flex-1">
                                                    <p class="text-gray-500 text-sm line-clamp-1">{{ $item->description }}</p>
                                                </div>
                                                <div class="mt-3 flex justify-between items-center">
                                                    <h4>MMK {{ number_format($item->price, 0, '.', ',') }}</h4>
                                                    <span x-show="onOrder"
                                                          class="inline-flex bg-pink-500 text-sm px-2 py-1 rounded-full text-white">Order
                                                        Qty:
                                                        <strong
                                                                x-text="' ' + orderQty"></strong></span>
                                                </div>
                                            </div>
                                            <div class="w-32 flex flex-col justify-between items-center py-3">
                                                <div class="">
                                                    Total: <span x-text="total"></span>
                                                </div>

                                                <div class="flex items-center justify-center space-x-3">
                                                    <button @click="decrement({{ $item->id }}, '{{ $item->name }}', {{ $item->price }})"
                                                            type="button"
                                                            class="inline-flex items-center p-1.5 border border-transparent rounded-full shadow-sm text-white bg-pink-500 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                             viewBox="0 0 20 20"
                                                             fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                                                  clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                    <p x-text="quantity"></p>
                                                    <button @click="incriment({{ $item->id }}, '{{ $item->name }}', {{ $item->price }})"
                                                            type="button"
                                                            class="inline-flex items-center p-1.5 border border-transparent rounded-full shadow-sm text-white bg-pink-500 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                             fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                  clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>

                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="h-full flex items-center space-x-3 px-4">
                            <button @click="show = false" type="button"
                                    class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:mt-0 sm:col-start-1 sm:text-sm">Cancel</button>
                            <button {{ $orderAdded ? '' : 'disabled' }} @click="confirmOrder()" type="button"
                                    @class([
                                        'w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2  text-base font-medium text-white  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:col-start-2 sm:text-sm',
                                        'bg-gray-500' => !$orderAdded,
                                        'hover:bg-pink-700 bg-pink-500' => $orderAdded,
                                    ])
                                    class="">Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Of Modal --}}
</li>
