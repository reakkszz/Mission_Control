<?php

namespace App\Http\Controllers;

use App\Models\Intel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntelController extends Controller
{
    public function index()
    {
        $intels = Intel::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('intels.index', compact('intels'));
    }

    public function create()
    {
        return view('intels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'source' => 'nullable|max:255',
        ]);

        Intel::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'source' => $request->source,
        ]);

        return redirect()
            ->route('intels.index')
            ->with('success', 'Intel created successfully.');
    }

    public function edit(Intel $intel)
    {
        abort_if($intel->user_id !== Auth::id(), 403);

        return view('intels.edit', compact('intel'));
    }

    public function update(Request $request, Intel $intel)
    {
        abort_if($intel->user_id !== Auth::id(), 403);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'source' => 'nullable|max:255',
        ]);

        $intel->update([
            'title' => $request->title,
            'content' => $request->content,
            'source' => $request->source,
        ]);

        return redirect()
            ->route('intels.index')
            ->with('success', 'Intel updated successfully.');
    }

    public function destroy(Intel $intel)
    {
        abort_if($intel->user_id !== Auth::id(), 403);

        $intel->delete();

        return redirect()
            ->route('intels.index')
            ->with('success', 'Intel deleted successfully.');
    }
}
