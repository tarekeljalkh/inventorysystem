<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Item;
use Livewire\Component;

class PointOfSale extends Component
{
    public $items = [];
    public $cart = [];
    public $search = ''; // New property for search query

    public function mount()
    {
        $this->items = Item::where('quantity', '>', 0)->get(); // Load initial items
    }

    public function addToCart($itemId)
    {
        $item = $this->items->find($itemId);

        // Check if the item exists and has more than 0 quantity
        if ($item && $item->quantity > 0) {
            if (isset($this->cart[$itemId])) {
                $this->cart[$itemId]['quantity']++;
            } else {
                $this->cart[$itemId] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'quantity' => 1
                ];
            }

            // Decrement the item quantity
            $item->decrement('quantity');
            // You can optionally save the changes to the database if needed

            $this->render(); // Re-render the component
        }
    }

    public function loadClients()
    {
        return Client::all(); // Assuming Client is your model for clients
    }

    public function removeFromCart($itemId)
    {
        if (isset($this->cart[$itemId])) {
            if ($this->cart[$itemId]['quantity'] > 1) {
                $this->cart[$itemId]['quantity']--;
            } else {
                unset($this->cart[$itemId]);
            }
            // Increment the item quantity in the list of items
            $this->items->find($itemId)->increment('quantity');
            $this->render(); // Re-render the component
        }
    }

    public function checkout()
    {
        // Your checkout logic

        // Clear the cart
        $this->cart = [];
    }

    public function updateSearch()
    {
        $this->render(); // Trigger re-rendering of the component
    }

    public function render()
    {
        $query = Item::where('quantity', '>', 0);

        if (!empty($this->search)) {
            $query = $query->where('name', 'like', '%' . $this->search . '%');
        }

        $items = $query->get();

        return view('livewire.point-of-sale', compact('items'));
    }
}
