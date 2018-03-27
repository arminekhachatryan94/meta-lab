@extends('layouts.app')

@section('content')

@include ('layouts.successmsg')
@include ('layouts.errormsg')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center" style="font-family:cursive; padding:50px 100px 30px 100px;">Posts</div>
                
            @foreach ($posts as $post)
                @include ('posts.post')
            @endforeach
        </div>
    </div>
</div>
@endsection