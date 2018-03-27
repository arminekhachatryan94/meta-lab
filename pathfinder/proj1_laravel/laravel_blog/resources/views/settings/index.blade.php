@extends('layouts.app')

@section('content')

@include ('layouts.successmsg')
@include ('layouts.errormsg')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="display-4 text-center" style="font-family:cursive; padding:50px 100px 30px 100px;">Settings</div>
            <div class="card" style="padding:50px;">
                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                    <div class="col-md-6">
                        {{ $user->first_name }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                    <div class="col-md-6">
                        {{ $user->last_name }}
                    </div>
                </div>
                
                <form method="POST" action="/settings/username">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                        
                        <div class="col-md-6">
                            <input id="username" type="text" value="{{$user->username}}" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                            @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0 text-center" style="display:inline; padding-top:20px;">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-white">
                                Save Username
                            </button>
                        </div>
                    </div>
                </form>

                <form method="POST" action="/settings/email">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" value="{{$user->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0 text-center" style="display:inline; padding-top:20px;">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" name="put_email" class="btn btn-white">
                                Save Email
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{ request('username') }}
@endsection
