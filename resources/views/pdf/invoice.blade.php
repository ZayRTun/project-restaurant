<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head class="h-full">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full">
    @php
        $subtotal = $order->total;
        $tax = round($subtotal / 10);
        $total = $tax + $subtotal;
    @endphp
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h2 class="text-lg font-medium text-gray-900">{{ $order->table->name }} Order summary</h2>
                <p class="mt-2 text-sm text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, reiciendis?</p>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <tbody class="">
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">
                                        {{ $item->name }}</td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{ 'Qty: ' . $item->qty }}</td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 text-right">{{ 'MMK ' . $item->price }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 ">
                                    Subtotal</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"></td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 text-right">{{ 'MMK ' . $subtotal }}</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 ">
                                    Tax</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"></td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 text-right">{{ 'MMK ' . $tax }}</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 ">
                                    Total</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"></td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 text-right">{{ 'MMK ' . $total }}</td>
                            </tr>
                            <!-- More people... -->
                        </tbody>
                    </table>
                    <div>
                        <h1 class="text- font-medium">Payment Status: <span
                                  @class([
                                      'inline-flex px-2 py-1 rounded-full',
                                      'bg-pink-200 text-pink-500' => !$order->completed,
                                      'bg-green-200 text-green-500' => $order->completed,
                                  ])>{{ $order->completed ? 'Paid' : 'Pending' }}</span> </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
