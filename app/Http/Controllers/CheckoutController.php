<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Client;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$checkouts = Checkout::all();
        $checkouts = Checkout::notReturnedToStock()->get();
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

    public function returnToStock(Checkout $checkout)
    {
        foreach ($checkout->items as $item) {
            $item->increment('quantity', $item->pivot->quantity);
        }

        // Update the return date
        $checkout->return_date = Carbon::now();

        // Record the ID of the authenticated user who is returning the items
        $checkout->returned_by_user_id = Auth::id(); // Ensure Auth facade is used


        $checkout->save();

        return to_route('checkouts.index')->with('success', 'Checkout returned to stock successfully.');
    }


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
