<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trans('titles.InvoiceMaster | Forgot your password?') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/adminlte.min.css') }}">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <div class="image">
                <img src="{{ URL::asset('assets/img/AdminLTELogo.png') }}" class="elevation-2" alt="User Image"
                    style="width: 80px">
            </div>
        </div>
        <!-- /.login-logo -->

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    {{ trans('login.Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>

                @php
                    $status = session('status');
                @endphp

                @if ($status)
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fas fa-check"></i>{{ $status }}</p>
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <input id="email" name="email" type="email" class="form-control"
                            placeholder="{{ trans('login.Email') }}" value="{{ old('email') }}" required
                            autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        @php
                            $messages = $errors->get('email');
                        @endphp

                        @if ($messages)
                            @foreach ($messages as $message)
                                <p class="text-danger">{{ $message }}</p>
                            @endforeach
                        @endif
                    </div>

                    <div class="row">

                        <!-- /.col -->
                        <div class="col">
                            <button type="submit"
                                class="btn btn-primary btn-block">{{ trans('login.Email Password Reset Link') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ URL::asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('assets/js/adminlte.min.js') }}"></script>

</body>

</html>
