<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Preparation;
use Illuminate\Http\Request;

class PreparationController extends Controller
{
    public function index()
    {
        return Preparation::with('user')
            ->latest()
            ->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'user_id' => 'required',

            'title' => 'required',

            'content' => 'required',

            'type' => 'required',

            'media' => 'nullable'
        ]);

        $preparation =
            Preparation::create($validated);

        return response()->json([
            'message' => 'Preparation Created',
            'preparation' => $preparation
        ]);
    }

    public function show(string $id)
    {
        return Preparation::with('user')
            ->findOrFail($id);
    }

    public function update(
        Request $request,
        string $id
    )
    {
        $preparation =
            Preparation::findOrFail($id);

        $preparation->update(
            $request->all()
        );

        return response()->json([
            'message' => 'Updated',
            'preparation' => $preparation
        ]);
    }

    public function destroy(string $id)
    {
        Preparation::destroy($id);

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}