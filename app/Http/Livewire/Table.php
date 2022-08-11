<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table as ModelsTable;
use Livewire\Component;

class Table extends Component
{
    public $table;
    public $menus;
    public $total = 0;
    public $cleared = true;
    public $orderConfirmed = false;
    public $orderAdded = false;
    public $orderItems = [];
    public $orderId = 0;

    protected $listeners = ['tableCleared'];

    public function tableCleared($tableId)
    {
        if ($this->table->id == $tableId) {
            $this->cleared = true;
            $this->orderConfirmed = false;
        }
    }

    public function confirmOrder()
    {
        if ($this->orderConfirmed) {
            $order = $this->table->orders()->where('completed', false)->first();
            $prevTotal = $order->total;
            $newTotal = $prevTotal + $this->total;
            $order->update(['total' => $newTotal]);
            $order->items()->createMany($this->orderItems);
        } else {
            $order = $this->table->orders()->create(['total' => $this->total]);
            $order->items()->createMany($this->orderItems);
            $this->orderId = $order->id;
        }

        $this->total = 0;
        $this->orderItems = [];
        $this->orderAdded = false;
        $this->emit('orderReceived');
        $this->cleared = false;
        $this->orderConfirmed = true;
        return ['confirmed' => true];
    }

    public function addToOrder($id, $name, $price, $qty, $total)
    {
        $this->total += $price;

        if ($qty > 0) {
            $this->orderItems[$id] = new OrderItem(['menu_id' => $id, 'name' => $name, 'price' => $price, 'qty' => $qty]);
            $this->orderAdded = true;
        } else {
            if (isset($this->orderItems[$id])) {
                unset($this->orderItems[$id]);
            }
            if (empty($this->orderItems)) {
                $this->orderAdded = false;
            }
        }
        return [ 'qty' => $qty ];
    }

    public function mount(ModelsTable $table)
    {
        $this->table = $table;
        $orders = $this->table->orders()->where('completed', false)->first();
        $this->orderConfirmed = isset($orders);
        $this->menus = Menu::all();
    }

    public function render()
    {
        return view('livewire.table');
    }
}
