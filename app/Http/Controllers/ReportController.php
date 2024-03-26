<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Client;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $checkouts = Checkout::query();

        if ($request->has('date')) {
            $checkouts->whereDate('created_at', $request->date);
        }

        if ($request->has('client_id')) {
            $checkouts->where('client_id', $request->client_id);
        }

        $filteredCheckouts = $checkouts->get();
        $clients = Client::all();

        return view('reports.index', compact('filteredCheckouts', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
