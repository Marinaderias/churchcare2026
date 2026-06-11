<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpiritualTask;
use Illuminate\Http\Request;

class SpiritualTaskController extends Controller
{
    public function index()
    {
        return SpiritualTask::latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => 'required',

            'week_number' => 'required',

            'month' => 'required',

            'year' => 'required',

            'created_by' => 'required'
        ]);

        return SpiritualTask::create(
            $validated
        );
    }

    public function show(string $id)
    {
        return SpiritualTask::findOrFail($id);
    }

    public function update(
        Request $request,
        string $id
    )
    {
        $task =
            SpiritualTask::findOrFail($id);

        $task->update(
            $request->all()
        );

        return $task;
    }

    public function destroy(string $id)
    {
        SpiritualTask::destroy($id);

        return response()->json([
            'message' => 'deleted'
        ]);
    }
}