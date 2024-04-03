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
        // Find the item directly without relying on previously stored keys
        $item = collect($this->items)->firstWhere('id', $itemId);

        if ($item && $item['quantity'] > 0) {
            $quantity = $this->quantities[$itemId] ?? 1;

            // Update the cart
            if (isset($this->cart[$itemId])) {
                $this->cart[$itemId]['quantity'] += $quantity;
            } else {
                $this->cart[$itemId] = [
                    'id' => $itemId,
                    'name' => $item['name'],
                    'quantity' => $quantity,
                ];
            }

            // Update the item's quantity in the original list
            // This requires re-filtering or adjusting the $this->items array accordingly
            $this->updateItemQuantity($itemId, -$quantity);

            // Reset the input for next addition
            $this->quantities[$itemId] = 1;
        } else {
            // Handle the case where the item cannot be found or has insufficient quantity
            session()->flash('error', 'Item cannot be added to the cart.');
        }
    }

    private function updateItemQuantity($itemId, $change)
    {
        // Adjust the quantity in $this->items
        foreach ($this->items as $key => $item) {
            if ($item['id'] === $itemId && isset($item['quantity'])) {
                $this->items[$key]['quantity'] += $change;
                break;
            }
        }
    }


    public function removeFromCart($itemId)
    {
        if (isset($this->cart[$itemId])) {
            // Use the specified quantity to remove, defaulting to 1 if not specified
            $removeQuantity = $this->removalQuantities[$itemId] ?? 1;

            // Decrement the cart item's quantity by the specified removal quantity
            $this->cart[$itemId]['quantity'] -= $removeQuantity;

            // If the quantity drops to 0 or less, remove the item from the cart
            if ($this->cart[$itemId]['quantity'] <= 0) {
                unset($this->cart[$itemId]);
            }

            // Optionally, you might want to increment the available quantity of the item
            // This line assumes you're tracking available quantities in `$this->items`
            $key = array_search($itemId, array_column($this->items, 'id'));
            if ($key !== false) {
                $this->items[$key]['quantity'] += $removeQuantity;
            }

            // Reset the removal quantity to 1 for future operations
            $this->removalQuantities[$itemId] = 1;

            $this->render();
        }
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
            $checkout = new Checkout();
            $checkout->client_id = $this->selectedClient;
            $checkout->checkout_user = $this->checkoutUser; // Set the checkout user
            $checkout->save();

            foreach ($this->cart as $item_id => $cartItem) {
                // Attach item to checkout without modifying item quantity
                $checkout->items()->attach($item_id, ['quantity' => $cartItem['quantity']]);
            }

            DB::commit();
            $this->reset(['cart', 'selectedClient', 'checkoutUser']);
            toastr()->success('Checkout successful.');
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
