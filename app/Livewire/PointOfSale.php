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

    public function mount()
    {
        $this->items = Item::where('quantity', '>', 0)->get()->toArray();
    }

    public function addToCart($itemId)
    {
        $key = array_search($itemId, array_column($this->items, 'id'));
        if ($key !== false) {
            $item = &$this->items[$key];

            if ($item['quantity'] > 0) {
                if (isset($this->cart[$itemId])) {
                    $this->cart[$itemId]['quantity']++;
                } else {
                    $this->cart[$itemId] = [
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'quantity' => 1
                    ];
                }

                // No actual decrement here, just visually for the user interface
                $item['quantity']--;
            }
        }

        $this->render();
    }

    public function removeFromCart($itemId)
    {
        if (isset($this->cart[$itemId])) {
            $this->cart[$itemId]['quantity']--;

            if ($this->cart[$itemId]['quantity'] <= 0) {
                unset($this->cart[$itemId]);
            }

            // No actual increment here, just visually for the user interface
            $key = array_search($itemId, array_column($this->items, 'id'));
            if ($key !== false) {
                $this->items[$key]['quantity']++;
            }

            $this->render();
        }
    }

    public function checkout()
    {
        $this->validate([
            'selectedClient' => 'required|exists:clients,id',
            'cart' => 'required|array',
            'checkoutUser' => 'required|string', // Validate checkoutUser
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
        $items = collect($this->items);
        if (!empty($this->search)) {
            $items = $items->filter(function ($item) {
                return stripos($item['name'], $this->search) !== false;
            });
        }

        return view('livewire.point-of-sale', ['items' => $items]);
    }
}
