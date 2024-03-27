<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function updatePassword(Request $request, $userId)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        toastr()->success('Password Updated Successfully');
        return to_route('users.index');

        //return redirect()->back()->with('success', 'User password updated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:60'],
            'email' => ['required', 'email'],
            'role' => ['required'],
            'password' => ['required', 'min:5', 'confirmed']
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($user->password);
        $user->save();

        toastr()->success('Created Successfully');
        // Redirect or return a response
        return to_route('users.index');
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
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id],
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        toastr()->success('Updated Successfully');
        // Redirect or return a response
        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            //return response(['status' => 'error', 'message' => $e->getMessage()]);
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
