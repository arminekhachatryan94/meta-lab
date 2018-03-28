@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center" class="title">Posts</div>
                <div class="card" class="margin-0-50-20-50 padding-30">
                    <div class="text-center">
                        <a href="/posts/{{$post->id}}">
                            {{ $post->title }}
                        </a>
                    </div>
                    <br class="border-bottom-dashed display-block">
                    <div>
                        <div class="text-right">{{ $post->user->username }}</div>
                        <div>
                            {{ $post->body }}
                        </div>
                        <div class="padding-top-20">
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
