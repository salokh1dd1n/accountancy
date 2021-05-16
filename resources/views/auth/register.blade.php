@extends('layouts.auth')
@section('auth')
    <h5 class="card-title text-center">Accountancy</h5>
    <form class="form-signin" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-label-group">
            <input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror"
                   placeholder="Имя" data-parsley-minlength="3" value="{{ old('name') }}"
                   name="name" required autocomplete="name" autofocus>
            <label for="inputName"><i class="fa fa-user auth-icon"></i> Имя</label>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror"
                   placeholder="Адрес электронной почты" parsley-type="email" value="{{ old('email') }}"
                   name="email" required autocomplete="email">
            <label for="inputEmail"><i class="fa fa-envelope auth-icon pl-1"></i> Адрес электронной почты</label>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Пароль" data-parsley-minlength="8"
                   name="password" required autocomplete="new-password">
            <label for="inputPassword"><i class="fa fa-lock auth-icon pl-1"></i> Пароль</label>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" id="inputConfirmPassword" class="form-control"
                   placeholder="Подтвердить Пароль" data-parsley-equalto="#inputPassword"
                   name="password_confirmation" required autocomplete="new-password">
            <label for="inputConfirmPassword"><i class="fa fa-lock auth-icon pl-1"></i> Подтвердить Пароль</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Регистрация
        </button>
        <div class="mt-4">
            Уже зарегистрировались?
            <a href="{{ route('login') }}" class="auth-a">Авторизуйтесь здесь</a>
        </div>
    </form>
@endsection
