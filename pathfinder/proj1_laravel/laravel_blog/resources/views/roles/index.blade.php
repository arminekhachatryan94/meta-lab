@extends('layouts.app')

@section('content')

@include ('layouts.successmsg')
@include ('layouts.errormsg')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center title">User Roles</div>
                
            @foreach ($users as $user)
                @include ('roles.user')
            @endforeach
        </div>
    </div>
</div>
@endsection
