<?php

namespace App\Http\Controllers\Api;

use App\Models\Visit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display all visits
     */
    public function index()
    {
        return Visit::with([
            'member',
            'user'
        ])->get();
    }

    /**
     * Store new visit
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'user_id' => 'required|exists:users,id',
            'visit_date' => 'required|date',
            'notes' => 'nullable'
        ]);

        $visit = Visit::create($validated);

        return response()->json([
            'message' => 'visit created successfully',
            'visit' => $visit
        ]);
    }

    /**
     * Show specific visit
     */
    public function show(string $id)
    {
        return Visit::with([
            'member',
            'user'
        ])->findOrFail($id);
    }

    /**
     * Update visit
     */
    public function update(Request $request, string $id)
    {
        $visit = Visit::findOrFail($id);

        $validated = $request->validate([
            'member_id' => 'sometimes|exists:members,id',
            'user_id' => 'sometimes|exists:users,id',
            'visit_date' => 'sometimes|date',
            'notes' => 'nullable'
        ]);

        $visit->update($validated);

        return response()->json([
            'message' => 'updated successfully',
            'visit' => $visit
        ]);
    }

    /**
     * Delete visit
     */
    public function destroy(string $id)
    {
        Visit::destroy($id);

        return response()->json([
            'message' => 'deleted successfully'
        ]);
    }
}
