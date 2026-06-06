<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        return User::with([
            'serviceGroups',
            'members'
        ])->get();
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'password' => 'required|min:6',
            'role' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'job' => 'nullable',
            'confession_father' => 'required',
            'image' => 'nullable'
        ]);

        $validated['password'] = Hash::make(
            $validated['password']
        );

        $user = User::create($validated);

        return response()->json([
            'message' => 'WELCOME TO CHURCHCARE',
            'user' => $user
        ]);
    }

    /**
     * Display specific user
     */
    public function show(string $id)
    {
        return User::with([
            'serviceGroups',
            'members',
            'visits'
        ])->findOrFail($id);
    }

    /**
     * Update user
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes',
            'phone' => 'sometimes',
            'email' => 'sometimes|email',
            'role' => 'sometimes',
            'address' => 'sometimes',
            'birth_date' => 'sometimes',
            'job' => 'nullable',
            'confession_father' => 'sometimes'
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'updated successfully',
            'user' => $user
        ]);
    }

    /**
     * Delete user
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return response()->json([
            'message' => 'deleted successfully'
        ]);
    }
}
