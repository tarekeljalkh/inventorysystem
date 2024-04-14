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
    public $selectedClient = 1; // Default selection for the client select box
    public $checkoutUser = ''; // Placeholder for the checkout user name
    public $quantities = [];
    public $removalQuantities = [];

    public function mount()
    {
        // Initialize items and clients in mount() without filtering
        $this->initializeItemsAndClients();
    }

    private function initializeItemsAndClients()
    {
        $this->items = Item::where('quantity', '>', 0)->get()->toArray();
        foreach ($this->cart as $item) {
            $this->removalQuantities[$item['id']] = 0;
        }
        $clients = $this->loadClients();
        if ($clients->isNotEmpty()) {
            $this->selectedClient = $clients->last()->id;
        }
    }



    public function addToCart($itemId)
    {
        $item = collect($this->items)->firstWhere('id', $itemId);
        if (!$item) {
            session()->flash('error', 'Item not found.');
            return;
        }

        // Calculate available quantity ensuring integer types
        $availableQuantity = (int) $item['quantity'] - (int) $item['out_quantity'];
        $quantityToAdd = (int) ($this->quantities[$itemId] ?? 1);

        if ($availableQuantity > 0 && $quantityToAdd <= $availableQuantity) {
            if (isset($this->cart[$itemId])) {
                $this->cart[$itemId]['quantity'] += $quantityToAdd;
            } else {
                $this->cart[$itemId] = [
                    'id' => $itemId,
                    'name' => $item['name'],
                    'quantity' => $quantityToAdd,
                ];
            }

            $this->updateItemQuantity($itemId, $quantityToAdd);
        } else {
            session()->flash('error', 'Not enough stock available to add this quantity.');
        }
    }

    private function updateItemQuantity($itemId, $change)
    {
        foreach ($this->items as $key => $item) {
            if ($item['id'] === $itemId) {
                // Ensure integer operation
                $this->items[$key]['out_quantity'] += (int) $change;
                break;
            }
        }
    }


    public function removeFromCart($itemId)
    {
        if (!isset($this->cart[$itemId])) {
            session()->flash('error', 'Item not in cart.');
            return;
        }

        $removeQuantity = (int) ($this->removalQuantities[$itemId] ?? 1);
        $this->cart[$itemId]['quantity'] -= $removeQuantity;

        if ($this->cart[$itemId]['quantity'] <= 0) {
            unset($this->cart[$itemId]);
        }

        $key = array_search($itemId, array_column($this->items, 'id'));
        if ($key !== false) {
            $this->items[$key]['quantity'] += $removeQuantity;
        }

        $this->removalQuantities[$itemId] = 1;
        $this->render();
    }



    public function checkout()
    {
        $this->validate([
            'selectedClient' => 'required|exists:clients,id',
            'cart' => 'required|array',
            'checkoutUser' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            foreach ($this->cart as $item_id => $cartItem) {
                $item = Item::find($item_id);
                $availableQuantity = $item->quantity - $item->out_quantity;

                if ($cartItem['quantity'] > $availableQuantity) {
                    session()->flash('error', 'Checkout failed: Not enough stock available for item ' . $item->name);
                    DB::rollBack();
                    return;
                }
            }

            $checkout = new Checkout();
            $checkout->client_id = $this->selectedClient;
            $checkout->checkout_user = $this->checkoutUser;
            $checkout->save();

            foreach ($this->cart as $item_id => $cartItem) {
                $checkout->items()->attach($item_id, ['quantity' => $cartItem['quantity']]);
                Item::find($item_id)->increment('out_quantity', $cartItem['quantity']);
            }

            DB::commit();
            session()->flash('success', 'Checkout successful.');
            $this->reset(['cart', 'selectedClient', 'checkoutUser']);
        } catch (Exception $e) {
            DB::rollBack();
            toastr()->error('Checkout failed: ' . $e->getMessage());
        }
    }


    public function updateSearch()
    {

        $this->render();
    }

    public function loadClients()
    {
        return Client::all();
    }

    public function render()
    {
        // Always call initializeItemsAndClients to refresh items before filtering
        $this->initializeItemsAndClients();

        // Filter items based on search term
        if (!empty($this->search)) {
            $this->items = collect($this->items)->filter(function ($item) {
                return stripos($item['name'], $this->search) !== false;
            })->toArray();
        }

        return view('livewire.point-of-sale', ['items' => $this->items]);
    }

}
