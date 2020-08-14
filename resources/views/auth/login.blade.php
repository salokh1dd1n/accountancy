@extends('layouts.auth')

@section('auth')
    <h5 class="card-title text-center">{{ __('Login') }}</h5>
    <form class="form-signin" action="{{ route('login') }}" method="POST" id="form">
        @csrf
        <div class="form-label-group">
            <input type="email" id="inputEmail"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="{{ __('E-Mail Address') }}" data-parsley-trigger="change"
                   name="email" value="{{ old('email') }}" required
                   autocomplete="email" autofocus>
            <label for="inputEmail"><i class="fa fa-envelope auth-icon" style="padding-right: 5px"></i> {{ __('E-Mail Address') }}</label>

            @error('email')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('Password') }}" data-parsley-minlength="8"
                   name="password" required autocomplete="current-password">
            <label for="inputPassword"><i class="fa fa-lock auth-icon"></i> {{ __('Password') }}</label>

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="remember"
                           name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember">{{ __('Remember Me')}}</label>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 mb-3">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-a">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">
            {{ __('Login')}}
        </button>
        <div class="mt-4">
            Don't have an account?
            <a href="{{ route('register') }}" class="auth-a">Register here</a>
        </div>
    </form>
@endsection
