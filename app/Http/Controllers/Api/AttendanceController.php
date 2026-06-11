<?php

namespace App\Http\Controllers\Api;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
     /**
     * Display all attendances
     */
    public function index()
    {
        return Attendance::with('member')->get();
    }

    /**
     * Store new attendance
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'member_id' => 'required|exists:members,id',
        'date' => 'required|date',
        'status' => 'required|in:present,absent,late'
    ]);

    $attendance = Attendance::create($validated);

    return response()->json([
        'message' => 'Attendance added successfully',
        'attendance' => $attendance
    ]);
}

    /**
     * Show specific attendance
     */
    public function show(string $id)
    {
        return Attendance::with('member')
            ->findOrFail($id);
    }

    /**
     * Update attendance
     */
    public function update(Request $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);

        $validated = $request->validate([
            'member_id' => 'sometimes|exists:members,id',
            'date' => 'sometimes|date',
            'status' => 'sometimes'
        ]);

        $attendance->update($validated);

        return response()->json([
            'message' => 'updated successfully',
            'attendance' => $attendance
        ]);
    }

    /**
     * Delete attendance
     */
    public function destroy(string $id)
    {
        Attendance::destroy($id);

        return response()->json([
            'message' => 'deleted successfully'
        ]);
    }
}
