@extends('layouts.app')

@section('content')

@if(Session::has('message'))
    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('message') !!}</em></div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center" style="font-family:cursive; padding:50px 100px 30px 100px;">My Posts</div>

            @foreach ($posts as $post)
                @include ('posts.post')
            @endforeach
        </div>
    </div>
</div>
@endsection
