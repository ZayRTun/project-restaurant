<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Restaurant extends Component
{
    public $orders = [];
    public $bill;
    public $showBill = false;

    protected $listeners = ['orderReceived', 'tableCleared' => '$refresh'];

    public function printToPdf(Order $order)
    {
        return redirect()->route('download', $order);
    }

    public function toggleModal()
    {
        $this->showBill = false;
    }
    public function printOrder(Order $order)
    {
        $order->load('items');
        $this->bill = $order;
        $this->showBill = true;
    }

    public function makePayment($orderId)
    {
        $order = Order::find($orderId);
        $order->update([ 'completed'=> true ]);
        $this->emit('tableCleared', $order->table_id);
    }

    public function mergeTable($currentOrderId, $mergeOrderId)
    {
        $currentOrder = Order::find($currentOrderId);
        $mergeOrder = Order::find($mergeOrderId);
        $mergingTableId = $mergeOrder->table_id;
        $mergeOrderItems = $mergeOrder->items;

        $currentOrder->update([
            'merge_id' => $mergeOrder->id,
            'total' => $currentOrder->total + $mergeOrder->total
        ]);

        $itemsToMerge = [];
        foreach ($mergeOrderItems as  $key => $mergingItem) {
            array_push($itemsToMerge, ['order_id' => $currentOrderId, 'menu_id' => $mergingItem->menu_id, 'name' => $mergingItem->name, 'qty' => $mergingItem->qty, 'price' => $mergingItem->price]);
        }

        $currentOrder->items()->createMany($itemsToMerge);
        $mergeOrder->delete();
        $this->emit('tableCleared', $mergingTableId);
        $this->orderReceived();
    }

    public function orderReceived()
    {
        $this->loadOrders();
    }

    public function mount()
    {
        $this->loadOrders();
    }

    public function render()
    {
        return view('livewire.restaurant', [
            'tables' => Table::all()
        ]);
    }

    public function loadOrders()
    {
        $this->orders = Order::with(['table', 'items'])->where('completed', false)->get();
    }
}
