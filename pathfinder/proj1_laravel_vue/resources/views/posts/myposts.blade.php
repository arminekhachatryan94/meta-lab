@extends('layouts.app')

@section('content')

@include ('layouts.successmsg')
@include ('layouts.errormsg')

<script>
    var posts = [];
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center title">My Posts</div>

            @foreach ($posts as $post)
                <!--script>
                    posts.push(({{ $post->id }}));
                </script-->
                @include ('posts.post')
            @endforeach
        </div>
    </div>
</div>
@endsection
