<?php

namespace App\Http\Controllers;

use App\Models\MissLog;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissLogController extends Controller
{
    public function index()
    {
        $missLogs = MissLog::whereHas('mission.operation', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->latest()
        ->get();

        return view('misslogs.index', compact('missLogs'));
    }

    public function create()
    {
        $missions = Mission::whereHas('operation', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->orderBy('title')
        ->get();

        return view('misslogs.create', compact('missions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $mission = Mission::findOrFail($request->mission_id);

        abort_if($mission->operation->user_id !== Auth::id(), 403);

        $imagePath = null;

        if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('misslogs', 'public');
    }

    MissLog::create([
        'mission_id' => $request->mission_id,
        'title' => $request->title,
        'content' => $request->content,
        'image' => $imagePath,
    ]);

    return redirect()
        ->route('misslogs.index')
        ->with('success', 'Mission Log created successfully.');

    }

    public function edit(MissLog $missLog)
    {
        abort_if($missLog->mission->operation->user_id !== Auth::id(), 403);

        $missions = Mission::whereHas('operation', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->orderBy('title')
        ->get();

        return view('misslogs.edit', compact('missLog', 'missions'));
    }

    public function update(Request $request, MissLog $missLog)
    {
        abort_if($missLog->mission->operation->user_id !== Auth::id(), 403);

        $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $mission = Mission::findOrFail($request->mission_id);

        abort_if($mission->operation->user_id !== Auth::id(), 403);

        $imagePath = $missLog->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('misslogs', 'public');
        }

        $missLog->update([
            'mission_id' => $request->mission_id,
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('misslogs.index')
            ->with('success', 'Mission Log updated successfully.');
    }

    public function destroy(MissLog $missLog)
    {
        abort_if($missLog->mission->operation->user_id !== Auth::id(), 403);

        $missLog->delete();

        return redirect()
            ->route('misslogs.index')
            ->with('success', 'Mission Log deleted successfully.');
    }
}
