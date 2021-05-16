@extends('layouts.auth')

@section('auth')
    <h5 class="card-title text-center">Accountancy</h5>
    <form class="form-signin" action="{{ route('login') }}" method="POST" id="form">
        @csrf
        <div class="form-label-group">
            <input type="email" id="inputEmail"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Адрес электронной почты" data-parsley-trigger="change"
                   name="email" value="{{ old('email') }}" required
                   autocomplete="email" autofocus>
            <label for="inputEmail"><i class="fa fa-envelope auth-icon pl-1" style="padding-right: 5px"></i> Адрес электронной почты</label>

            @error('email')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Пароль" data-parsley-minlength="8"
                   name="password" required autocomplete="current-password">
            <label for="inputPassword"><i class="fa fa-lock auth-icon pl-1"></i> Пароль</label>

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-3">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="remember"
                           name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember">Запомни меня</label>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 mb-3">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-a">
                        Забыли пароль?
                    </a>
                @endif
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">
            Войти
        </button>
        <div class="mt-4">
            Нет учетной записи?
            <a href="{{ route('register') }}" class="auth-a">Зарегистрируйтесь здесь</a>
        </div>
        <div class="mt-2">
            <a href="{{ route('index') }}" class="auth-a"><i class="fa fa-arrow-left auth-icon icon-link"></i> Вернуться на главную</a>
        </div>
    </form>
@endsection
