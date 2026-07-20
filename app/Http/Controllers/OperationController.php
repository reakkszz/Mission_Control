<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{
    public function index()
    {
        $operations = Operation::where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('operations.index', compact('operations'));
    }

    public function create()
    {
        return view('operations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        Operation::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('operations.index')
            ->with('success', 'Operation created successfully.');
    }

    public function edit(Operation $operation)
    {
        abort_if($operation->user_id !== Auth::id(), 403);
        return view('operations.edit', compact('operation'));
    }

    public function update(Request $request, Operation $operation)
    {
        abort_if($operation->user_id !== Auth::id(), 403);
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        $operation->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()
            ->route('operations.index')
            ->with('success', 'Operation updated succesfully.');
    }

    public function destroy(Operation $operation)
    {
        abort_if($operation->user_id !== Auth::id(), 403);
        $operation->delete();

        return redirect()
            ->route('operations.index')
            ->with('success', 'Operation deleted successfully.');
    }
}
