@extends('layouts.auth')

@section('auth')
    <h5 class="card-title text-center">{{ __('Reset Password') }}</h5>
    @if (session('status'))
        <div class="notice notice-success mb-4">
            <strong>{{ session('status') }}</strong>
        </div>
    @endif
    <form class="form-signin" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-label-group">
            <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror"
                   placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" parsley-type="email"
                   name="email" required autocomplete="email" autofocus>
            <label for="inputEmail">{{ __('E-Mail Address') }}</label>

            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase"
                type="submit">{{ __('Send Password Reset Link') }}
        </button>
    </form>
@endsection
