@extends('layouts.auth')
@section('auth')
    <h5 class="card-title text-center">{{ __('Register') }}</h5>
    <form class="form-signin" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-label-group">
            <input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror"
                   placeholder="{{ __('Name') }}" data-parsley-minlength="3" value="{{ old('name') }}"
                   name="name" required autocomplete="name" autofocus>
            <label for="inputName"><i class="fa fa-user auth-icon"></i> {{ __('Name') }}</label>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror"
                   placeholder="{{ __('E-Mail Address') }}" parsley-type="email" value="{{ old('email') }}"
                   name="email" required autocomplete="email">
            <label for="inputEmail"><i class="fa fa-envelope auth-icon pl-1"></i> {{ __('E-Mail Address') }}</label>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('Password') }}" data-parsley-minlength="8"
                   name="password" required autocomplete="new-password">
            <label for="inputPassword"><i class="fa fa-lock auth-icon pl-1"></i> {{ __('Password') }}</label>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" id="inputConfirmPassword" class="form-control"
                   placeholder="{{ __('Confirm Password') }}" data-parsley-equalto="#inputPassword"
                   name="password_confirmation" required autocomplete="new-password">
            <label for="inputConfirmPassword"><i class="fa fa-lock auth-icon pl-1"></i> {{ __('Confirm Password') }}</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">{{ __('Register') }}
        </button>
        <div class="mt-4">
            Already registered?
            <a href="{{ route('login') }}" class="auth-a">Login here</a>
        </div>
    </form>
@endsection
