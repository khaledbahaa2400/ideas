<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Idea $idea)
    {
        Comment::create([
            "idea_id" => $idea->id,
            "user_id" => auth()->id(),
            "content" => request('content'),
        ]);

        return back()->with('success', 'Comment Posted Successfully');
    }
}
