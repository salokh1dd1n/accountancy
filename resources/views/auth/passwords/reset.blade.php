@extends('layouts.auth')

@section('auth')
    <h5 class="card-title text-center">Reset Password</h5>
    <form class="form-signin" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-label-group">
            <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror"
                   placeholder="{{ __('E-Mail Address') }}" parsley-type="email" value="{{ $email ?? old('email') }}"
                   name="email" required autocomplete="email">
            <label for="inputEmail"><i class="fa fa-envelope auth-icon"></i> {{ __('E-Mail Address') }}</label>

            @error('email')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('New Password') }}" data-parsley-minlength="8"
                   name="password" required autocomplete="new-password" autofocus>
            <label for="inputPassword"><i class="fa fa-lock auth-icon"></i> {{ __('New Password') }}</label>

            @error('password')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-label-group">
            <input type="password" id="inputConfirmPassword" class="form-control"
                   placeholder="{{ __('Confirm New Password') }}" data-parsley-equalto="#inputPassword"
                   name="password_confirmation" required autocomplete="new-password">
            <label for="inputConfirmPassword"><i class="fa fa-lock auth-icon"></i> {{ __('Confirm New Password') }}</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">{{ __('Reset Password') }}
        </button>
    </form>
@endsection
