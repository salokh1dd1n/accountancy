@extends('layouts.auth')

@section('auth')
    <h5 class="card-title text-center">Сброс пароля</h5>
    @if (session('status'))
        <div class="notice notice-success mb-4">
            <strong>{{ session('status') }}</strong>
        </div>
    @endif
    <form class="form-signin" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-label-group">
            <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror"
                   placeholder="Адрес электронной почты" value="{{ old('email') }}" parsley-type="email"
                   name="email" required autocomplete="email" autofocus>
            <label for="inputEmail"><i class="fa fa-envelope auth-icon pl-1"></i> Адрес электронной почты</label>

            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase"
                type="submit">Отправить ссылку для сброса пароля
        </button>
        <div class="mt-4">
            <a href="{{ route('login') }}" class="auth-a"><i class="fa fa-arrow-left auth-icon pl-1 icon-link"></i> Вернуться на главную</a>
        </div>
    </form>
@endsection
