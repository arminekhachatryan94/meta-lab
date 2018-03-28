<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $posts = Post::all()->sortByDesc("created_at");
        return view('posts.index', compact('posts'));
    }

    public function myposts(){
        $posts = Post::all()->where('user_id', auth()->id())->sortByDesc("created_at");
        return view('posts.myposts', compact('posts'));
    }

    public function show( Post $post ){
        return view('posts.show', compact('post'));
    }
    
    public function create(){
        return view('posts.create');
    }

    public function store(){
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id(),
            'created_at' => now()
        ]);
        
        session()->flash('message', 'New post has been published.');
    	return redirect('/posts');
    }

    public function delete( $id ){
        $post = Post::find($id);
        if ( !$post ){
            return back()->withErrors([
    			'error' => "Couldn't delete post."
    		]);
        } else {
            $post->delete();
            session()->flash('message', 'Post was successfully deleted');
            return back();
        }
    }
}
