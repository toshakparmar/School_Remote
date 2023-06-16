@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <img src="{{asset('img/logo.png')}}" width="180px" height="180px" alt="razorpay">
    </div>
    <div class="card shadow-lg br-20">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ trans('global.login') }}</p>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                @if(session()->has('message'))
                <p class="alert alert-info">
                    {{ session()->get('message') }}
                </p>
                @endif
                <div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember" style="font-size: 15px;font-weight: 500;margin-bottom: 10px;">{{ trans('global.remember_me') }}</label>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('global.login') }}
                        </button>
                    </div>
                </div>
            </form>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
             @endif
            <div class="col-12">
                <p class="mb-1 mt-3">
                    <a class="text-center btn-outline btn-block" href="{{ route('register') }}">
                        {{ trans('global.register') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection