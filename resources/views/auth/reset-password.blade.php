<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trans('titles.InvoiceMaster | Reset Password') }}</title>

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

                <form action="{{ route('password.store') }}" method="post">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="input-group mb-3">
                        <input id="email" name="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="{{ trans('login.Email') }}" value="{{ old('email', $request->email) }}"
                            required autofocus autocomplete="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </span>
                            </div>
                        </div>

                        @php
                            $messages = $errors->get('email');
                        @endphp

                        @if ($messages)
                            @foreach ($messages as $message)
                                <p class="text-danger">{{ $message }}</p>
                            @endforeach
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <input name="password" id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="{{ trans('login.Password') }}" name="password" required
                            autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @php
                            $messages = $errors->get('password');
                        @endphp

                        @if ($messages)
                            @foreach ($messages as $message)
                                <p class="text-danger">{{ $message }}</p>
                            @endforeach
                        @endif
                    </div>
                       <!-- Password -->

                    <!-- Confirm Password -->
                    <div class="input-group mb-3">
                        <input name="password_confirmation" id="password_confirmation" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="{{ trans('login.Confirm Password') }}" name="password_confirmation" required
                            autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @php
                            $messages = $errors->get('password_confirmation');
                        @endphp

                        @if ($messages)
                            @foreach ($messages as $message)
                                <p class="text-danger">{{ $message }}</p>
                            @endforeach
                        @endif
                    </div>

                    <div class="row">
                        {{-- <div class="col"> --}}
                        <!-- /.col -->
                        <button type="submit" class="btn btn-primary btn-block">{{ trans('login.Reset Password') }}</button>
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
