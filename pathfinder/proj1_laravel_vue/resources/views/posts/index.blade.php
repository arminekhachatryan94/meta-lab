@extends('layouts.app')

@section('content')

@include ('layouts.successmsg')
@include ('layouts.errormsg')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center title">All Posts</div>
            <post v-for="post in posts"
                :id="post.id"
                :user_id="post.user_id"
                :title="post.title"
                :body="post.body"
                :created_at="post.created_at"
                :updated_at="post.updated_at"
                :user="post.user"
                :comments="post.comments"
                ></post>
        </div>
    </div>
</div>
@endsection
