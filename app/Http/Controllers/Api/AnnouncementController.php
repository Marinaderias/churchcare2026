<?php

namespace App\Http\Controllers\Api;

use App\Models\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display all announcements
     */
    public function index()
    {
        return Announcement::with('user')->get();
    }

    /**
     * Store new announcement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        $announcement = Announcement::create($validated);

        return response()->json([
            'message' => 'announcement created successfully',
            'announcement' => $announcement
        ]);
    }

    /**
     * Show specific announcement
     */
    public function show(string $id)
    {
        return Announcement::with('user')
            ->findOrFail($id);
    }

    /**
     * Update announcement
     */
    public function update(Request $request, string $id)
    {
        $announcement = Announcement::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes',
            'content' => 'sometimes',
            'user_id' => 'sometimes|exists:users,id'
        ]);

        $announcement->update($validated);

        return response()->json([
            'message' => 'updated successfully',
            'announcement' => $announcement
        ]);
    }

    /**
     * Delete announcement
     */
    public function destroy(string $id)
    {
        Announcement::destroy($id);

        return response()->json([
            'message' => 'deleted successfully'
        ]);
    }
}

