<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Client;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch checkouts where not all items have been fully returned and include the user who returned the checkout
        $checkouts = Checkout::with(['items', 'returnedBy'])->whereHas('items', function ($query) {
            $query->havingRaw('SUM(checkout_items.quantity) > SUM(checkout_items.returned_quantity)');
        }, '>', 0)->get();

        return view('checkouts.index', compact('checkouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        $clients = Client::all();
        return view('checkouts.create', compact('items', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'items' => 'required|array',
        ]);

        // Start the transaction
        \DB::beginTransaction();

        try {
            $checkout = new Checkout();
            $checkout->client_id = $request->client_id;
            $checkout->save();

            foreach ($request->items as $item_id => $quantity) {
                if ($quantity > 0) {
                    $item = Item::find($item_id);

                    if (!$item) {
                        throw new \Exception("Item not found.");
                    }

                    if ($item->quantity < $quantity) {
                        // Optionally, handle the case where there isn't enough stock.
                        throw new \Exception("Not enough stock for item {$item->name}.");
                    }

                    // Decrement the item quantity
                    $item->decrement('quantity', $quantity);

                    // Attach the item to the checkout with quantity
                    $checkout->items()->attach($item_id, ['quantity' => $quantity]);
                }
            }

            \DB::commit(); // Commit the transaction
            return back()->with('success', 'Items checked out successfully.');
        } catch (\Exception $e) {
            \DB::rollBack(); // Rollback the transaction on error
            return back()->withErrors('error', $e->getMessage());
        }
    }

    public function returnToStockPage($checkoutId)
    {
        // Fetch the checkout and eager load the items with necessary pivot information.
        $checkout = Checkout::with(['items' => function ($query) {
            // Assuming there's logic to only fetch relevant items.
            $query->addSelect([
                \DB::raw('items.*, checkout_items.quantity - checkout_items.returned_quantity AS remaining_to_return')
            ]);
        }])->findOrFail($checkoutId);

        return view('checkouts.return_to_stock', compact('checkout'));
    }


    public function processReturn(Request $request, $checkoutId)
    {

        $data = $request->validate([
            'returned_by' => 'required|string',
        ]);

        $data = $request->input('returns', []);
        $returnedBy = $request->input('returned_by', '');
        $checkout = Checkout::with('items')->findOrFail($checkoutId);

        DB::beginTransaction();

        try {
            foreach ($data as $itemId => $returnData) {
                $returnQuantity = $returnData['quantity'] ?? 0;
                $notes = $returnData['notes'] ?? '';

                if ($returnQuantity > 0) {
                    $checkoutItem = $checkout->items()->where('item_id', $itemId)->first();
                    if ($checkoutItem) {
                        // Update the returned quantity in the pivot table
                        $currentReturnedQuantity = $checkoutItem->pivot->returned_quantity + $returnQuantity;
                        $checkout->items()->updateExistingPivot($itemId, [
                            'returned_quantity' => $currentReturnedQuantity,
                            'notes' => trim($checkoutItem->pivot->notes . ' ' . $notes)
                        ]);

                        // Decrement the out_quantity from the item's stock
                        $item = Item::find($itemId);
                        if ($item) {
                            $item->decrement('out_quantity', $returnQuantity);
                        }
                    }
                }
            }

            $checkout->return_date = now();
            $checkout->returned_by_user = $returnedBy;  // Assuming you have this column in your database
            $checkout->save();

            DB::commit();
            return redirect()->route('checkouts.index')->with('success', 'Return processed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('error', $e->getMessage());
        }
    }




    // public function returnToStock(Checkout $checkout)
    // {
    //     foreach ($checkout->items as $item) {
    //         $item->increment('quantity', $item->pivot->quantity);
    //     }

    //     // Update the return date
    //     $checkout->return_date = Carbon::now();

    //     // Record the ID of the authenticated user who is returning the items
    //     $checkout->returned_by_user_id = Auth::id(); // Ensure Auth facade is used


    //     $checkout->save();

    //     return to_route('checkouts.index')->with('success', 'Checkout returned to stock successfully.');
    // }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $checkout = Checkout::with('items')->findOrFail($id);
        return view('checkouts.show', compact('checkout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
