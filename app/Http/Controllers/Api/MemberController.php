<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display all members
     */
    public function index()
    {
        return Member::with([
            'serviceGroups',
            'attendances',
            'visits',
            'users'
        ])->get();
    }

    /**
     * Store new member
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'school' => 'nullable',
            'notes' => 'nullable'
        ]);

        $member = Member::create($validated);

        return response()->json([
            'message' => 'member created successfully',
            'member' => $member
        ]);
    }

    /**
     * Show specific member
     */
    public function show(string $id)
    {
        return Member::with([
            'serviceGroups',
            'attendances',
            'visits',
            'users'
        ])->findOrFail($id);
    }

    /**
     * Update member
     */
    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes',
            'phone' => 'sometimes',
            'birth_date' => 'sometimes',
            'address' => 'sometimes',
            'school' => 'nullable',
            'notes' => 'nullable'
        ]);

        $member->update($validated);

        return response()->json([
            'message' => 'updated successfully',
            'member' => $member
        ]);
    }

    /**
     * Delete member
     */
    public function destroy(string $id)
    {
        Member::destroy($id);

        return response()->json([
            'message' => 'deleted successfully'
        ]);
    }
}
