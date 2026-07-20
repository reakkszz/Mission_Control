<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    public function index ()
    {
        $missions = Mission::whereHas('operation', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->latest()
        ->get();

        return view('missions.index', compact('missions'));
    }

    public function create()
    {
        $operations = Operation::where('user_id', Auth::id())
        ->orderBy('name')
        ->get();

        return view('missions.create', compact('operations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'operation_id' => 'required|exists:operations,id',
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:todo,in_progress,completed',
            'deadline' => 'nullable|date',
        ]);

        $operation = Operation::findOrFail($request->operation_id);

        abort_if($operation->user_id !== Auth::id(), 403);

        Mission::create([
            'operation_id' => $request->operation_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'deadline' => $request->deadline,
        ]);

        return redirect()
            ->route('missions.index')
            ->with('success', 'Mission created successfully.');
    }

    public function edit(Mission $mission)
    {
        abort_if($mission->operation->user_id !== Auth::id(), 403);

        $operations = Operation::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

            return view('missions.edit', compact('mission', 'operations'));
    }

    public function update(Request $request, Mission $mission)
    {
        abort_if($mission->operation->user_id !== Auth::id(), 403);

        $request->validate([
            'operation_id' => 'required|exists:operations,id',
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:todo,in_progress,completed',
            'deadline' => 'nullable|date',
        ]);

        $operation = Operation::findOrFail($request->operation_id);

        abort_if($operation->user_id !== Auth::id(), 403);

        $mission->update([
            'operation_id' => $request->operation_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'deadline' => $request->deadline,
        ]);

        return redirect()
            ->route('missions.index')
            ->with('success', 'Mission updated successfully.');
    }

    public function destroy(Mission $mission)
    {
        abort_if($mission->operation->user_id !== Auth::id(), 403);

        $mission->delete();

        return redirect()
            ->route('missions.index')
            ->with('success', 'Mission deleted succesfully.');
    }
}
