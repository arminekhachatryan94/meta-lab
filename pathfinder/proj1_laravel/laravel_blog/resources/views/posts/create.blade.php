@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center" class="title">Create New Post</div>
            <form method="POST" action="/posts">
                {{ csrf_field() }}
                <div class="card text-center margin-0-50-20-50 padding-30">
                    <div>
                        <div>Title</div>
                        <input name="title" type="text" class="w-50">
                    </div>
                    <br class="display-block border-bottom-dashed">
                    <div>
                        <div>Body</div>
                        <textarea name="body" type="text" class="w80-h100px;"></textarea>
                    </div>
                    <div class="padding-top-30">
                        <input type="submit" name="submit" value="Create Post" class="btn-white">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
