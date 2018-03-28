@extends('layouts.app')

@section('content')

@include ('layouts.successmsg')
@include ('layouts.errormsg')

<script>
    var count = {{ count($posts) }};
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center title">Posts</div>
                
            @foreach ($posts as $post)
                @include ('posts.post')
            @endforeach
        </div>
    </div>
</div>
@endsection
