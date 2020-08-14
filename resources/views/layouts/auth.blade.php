<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('inc.auth.head')

<body>

<div class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        @yield('auth')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('inc.auth.scripts')

</body>
</html>
