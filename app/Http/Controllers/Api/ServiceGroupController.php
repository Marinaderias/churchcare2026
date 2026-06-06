<?php

namespace App\Http\Controllers\Api;

use App\Models\ServiceGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceGroupController extends Controller
{
 /**
     * Display all service groups
     */
    public function index()
    {
        return ServiceGroup::with([
            'users',
            'members'
        ])->get();
    }

    /**
     * Store new service group
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);

        $serviceGroup = ServiceGroup::create($validated);

        return response()->json([
            'message' => 'service group created successfully',
            'service_group' => $serviceGroup
        ]);
    }

    /**
     * Show specific service group
     */
    public function show(string $id)
    {
        return ServiceGroup::with([
            'users',
            'members'
        ])->findOrFail($id);
    }

    /**
     * Update service group
     */
    public function update(Request $request, string $id)
    {
        $serviceGroup = ServiceGroup::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes',
            'description' => 'nullable'
        ]);

        $serviceGroup->update($validated);

        return response()->json([
            'message' => 'updated successfully',
            'service_group' => $serviceGroup
        ]);
    }

    /**
     * Delete service group
     */
    public function destroy(string $id)
    {
        ServiceGroup::destroy($id);

        return response()->json([
            'message' => 'deleted successfully'
        ]);
    }
}
