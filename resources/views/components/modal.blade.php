<!-- This example requires Tailwind CSS v2.0+ -->
<div
     x-cloak
     x-show="showBill"
     x-transition:enter="ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed z-10 inset-0 overflow-y-auto">
        <div
             x-cloak
             x-show="showBill"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">

            <div
                 @Click.outside="$wire.toggleModal"
                 class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full sm:p-6">
                <div class="mt-10 lg:mt-0">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">{{ $bill->table->name }} Order summary</h2>


                        <button wire:click="printToPdf({{ $bill->id }})" class="bg-gray-100 p-1 rounded-md">
                            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                        </button>

                    </div>

                    <div class="mt-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="divide-y divide-gray-200">
                            <ul role="list">
                                @foreach ($bill->items as $item)
                                    <li>
                                        <dl class="border-t border-gray-200 py-6 px-4 space-y-6 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <dt class="text-sm flex-1">{{ $item->name }}</dt>
                                                <dd class="text-sm font-medium text-gray-900">{{ 'Qty: ' . $item->qty }}</dd>
                                                <dd class="text-sm font-medium text-gray-900 w-32 flex justify-end items-baseline">
                                                    {{ 'MMK ' . $item->price }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @php
                            $subtotal = $bill->total;
                            $tax = round($subtotal / 10);
                            $total = $tax + $subtotal;
                        @endphp
                        <dl class="border-t border-gray-200 py-6 px-4 space-y-6 sm:px-6">
                            <div class="flex items-center justify-between">
                                <dt class="text-sm">Subtotal</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ 'MMK ' . $subtotal }}</dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt class="text-sm">Taxes</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ 'MMK ' . $tax }}</dd>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                                <dt class="text-base font-medium">Total</dt>
                                <dd class="text-base font-medium text-gray-900">{{ 'MMK ' . $total }}</dd>
                            </div>
                            <div>
                                <h1 class="text- font-medium">Status: <span
                                          @class([
                                              'inline-flex px-2 py-1 rounded-full',
                                              'bg-pink-200 text-pink-500' => !$bill->completed,
                                              'bg-green-200 text-green-500' => $bill->completed,
                                          ])>{{ $bill->completed ? 'Paid' : 'Pending' }}</span> </h1>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
