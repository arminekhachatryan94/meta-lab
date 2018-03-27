<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function create() {
        $this->validate(request(), [
            'body' => 'required'
        ]);

        Comment::create([
            'body' => request('body'),
            'post_id' => request('post_id'),
            'user_id' => auth()->id(),
            'created_at' => now()
        ]);

        session()->flash('message', 'New comment has been published.');
    	return back();
    }
}
