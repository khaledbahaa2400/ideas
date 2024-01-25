<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function store()
    {
        request()->validate([
            "content" => "required | min:3 | max:240",
        ]);

        Idea::create([
            "content" => request()->get("content", ''),
            "user_id" => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Idea Created Successfully');
    }

    public function show(Idea $idea)
    {
        $status = 'viewing idea';
        return view('ideas.show', compact('idea', 'status'));
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);

        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea Deleted Successfully');
    }

    public function edit(Idea $idea)
    {
        $this->authorize('update', $idea);

        $status = 'editing idea';
        return view('ideas.show', compact('idea', 'status'));
    }

    public function update(Idea $idea)
    {
        $this->authorize('update', $idea);

        request()->validate([
            "content" => "required | min:3 | max:240",
        ]);

        $idea->content = request()->get("content", '');
        $idea->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea Created Successfully');
    }
}
