@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center" style="font-family:cursive; padding:50px 100px 30px 100px;">Create New Post</div>
            <form method="POST" action="/posts">
                {{ csrf_field() }}
                <div class="card text-center" style="margin:0px 50px 20px 50px; padding:30px;">
                    <div>
                        <div>Title</div>
                        <input name="title" type="text" style="width:50%">
                    </div>
                    <br style="border-bottom:1px dashed black; display:block;">
                    <div>
                        <div>Body</div>
                        <textarea name="body" type="text" style="width:80%; height:100px;"></textarea>
                    </div>
                    <div style="padding-top:30px;">
                        <input type="submit" name="submit" value="Create Post" class="btn-white">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
