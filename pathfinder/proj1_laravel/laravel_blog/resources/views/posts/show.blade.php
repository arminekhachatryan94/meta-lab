@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center" style="font-family:cursive; padding:50px 100px 30px 100px;">Posts</div>
                <div class="card" style="margin:0px 50px 20px 50px; padding:30px;">
                    <div class="text-center">
                        <a href="/posts/{{$post->id}}">
                            {{ $post->title }}
                        </a>
                    </div>
                    <br style="border-bottom:1px dashed black; display:block;">
                    <div>
                        <div class="text-right">{{ $post->user->username }}</div>
                        <div>
                            {{ $post->body }}
                        </div>
                        <div style="padding-top:20px;">
                            <b>Comments</b>
                            @foreach ($post->comments as $comment)
                                <div>{{ $comment->body}}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
