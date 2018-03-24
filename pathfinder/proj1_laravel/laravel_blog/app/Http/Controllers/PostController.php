<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

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
        $posts = Post::all()->sortByDesc("created_at");;
        return view('posts.index', compact('posts'));
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
        
    	return redirect('/posts');
    }
}
