<?php

namespace App\Livewire;

use App\Models\Checkout;
use App\Models\Client;
use App\Models\Item;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Exception;

class PointOfSale extends Component
{
    public $items = [];
    public $cart = [];
    public $search = '';
    //public $selectedClient; // Make sure this is bound to your client selection input
    public $selectedClient = 1; // i made it 1 because the default for the selectbox

    public function mount()
    {
        // Load items with original quantity from database
        $this->items = Item::where('quantity', '>', 0)->get()->toArray();
    }

    public function addToCart($itemId)
    {
        // Find the item in the local state
        $key = array_search($itemId, array_column($this->items, 'id'));
        $item = &$this->items[$key];

        // Check if the item exists and has more than 0 quantity in the local state
        if ($item && $item['quantity'] > 0) {
            if (isset($this->cart[$itemId])) {
                $this->cart[$itemId]['quantity']++;
            } else {
                $this->cart[$itemId] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'quantity' => 1
                ];
            }

            // Decrement the item quantity in the local state
            $item['quantity']--;
            $this->render();
        }
    }

    public function removeFromCart($itemId)
    {
        if (isset($this->cart[$itemId])) {
            if ($this->cart[$itemId]['quantity'] > 1) {
                $this->cart[$itemId]['quantity']--;
            } else {
                unset($this->cart[$itemId]);
            }

            // Increment the item quantity in the local state
            $key = array_search($itemId, array_column($this->items, 'id'));
            $this->items[$key]['quantity']++;
            $this->render();
        }
    }

    public function checkout()
    {
        $this->validate([
            'selectedClient' => 'required|exists:clients,id',
            'cart' => 'required|array',
        ]);


        DB::beginTransaction();

        try {
            $checkout = new Checkout();
            $checkout->client_id = $this->selectedClient;
            $checkout->user_id = auth()->id(); // Ensure you have `user_id` in your checkouts table
            $checkout->save();

            foreach ($this->cart as $item_id => $cartItem) {
                $quantity = $cartItem['quantity'];

                if ($quantity > 0) {
                    $item = Item::find($item_id);

                    if (!$item) {
                        throw new Exception("Item not found.");
                    }

                    if ($item->quantity < $quantity) {
                        throw new Exception("Not enough stock for item {$item->name}.");
                    }

                    $item->decrement('quantity', $quantity);
                    $checkout->items()->attach($item_id, ['quantity' => $quantity]);
                }
            }

            DB::commit();
            $this->reset(['cart', 'selectedClient']); // Reset cart and selectedClient after successful checkout
            //session()->flash('success', 'Checkout successful.');
            toastr()->success('Checkout Items Successfully');

        } catch (Exception $e) {
            DB::rollBack();
            //session()->flash('error', $e->getMessage());
            toastr()->error($e->getMessage());

        }
    }

    public function updateSearch()
    {
        $this->render(); // Trigger re-rendering of the component
    }

    public function loadClients()
    {
        return Client::all();
    }

    public function render()
    {
        $items = collect($this->items);
        if (!empty($this->search)) {
            $items = $items->filter(function ($item) {
                return false !== stripos($item['name'], $this->search);
            });
        }

        return view('livewire.point-of-sale', ['items' => $items]);
    }
}
