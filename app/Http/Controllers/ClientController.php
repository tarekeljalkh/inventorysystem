<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'mobile' => ['required', 'numeric'],
            'residency_number' => ['required', 'max:200'],
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->mobile = $request->mobile;
        $client->residency_number = $request->residency_number;
        $client->save();

        toastr()->success('Client Added Successfully');

        return to_route('clients.index');
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
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        // Validation
        $request->validate([
            'name' => ['required', 'max:200'],
            'mobile' => ['required', 'numeric'],
            'residency_number' => ['required', 'max:200'],
        ]);

        // Update item
        $client->name = $request->name;
        $client->mobile = $request->mobile;
        $client->residency_number = $request->residency_number;
        $client->save();

        toastr()->success('Client Updated Successfully');
        // Redirect or return a response
        return to_route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            //return response(['status' => 'error', 'message' => $e->getMessage()]);
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }

    }
}
