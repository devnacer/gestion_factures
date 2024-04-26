@extends('layouts.master')

@section('title')
    {{ trans('titles.Create new User') }}
@endsection

@section('css')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ trans('users.Users') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ trans('users.Users') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('users.List of Users') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('users.Create new User') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('users.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">{{ trans('users.Name') }}</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">{{ trans('users.Email') }}</label>
                            <div class="col-sm-10">
                                <input name="email" type="email" class="form-control" id="email"
                                    value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">{{ trans('users.Password') }}</label>
                            <div class="col-sm-10">
                                <input name="password" type="password" class="form-control" id="password"
                                    value="{{ old('password') }}" required>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-sm-2 col-form-label">{{ trans('users.Confirm Password') }}</label>
                            <div class="col-sm-10">
                                <input name="password_confirmation" type="password" class="form-control" id="password"
                                    value="{{ old('password') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">{{ trans('users.User Status') }}</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ trans('users.User Permissions') }}</label>
                            <div class="col-sm-10">
                                {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                @error('roles_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>





                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">{{ trans('users.Validate') }}</button>
                        <button id="btnClose" type="submit"
                            class="btn btn-default float-right">{{ trans('users.Close') }}</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Capture click event on the Close button
            $('#btnClose').click(function(e) {
                e.preventDefault(); // Prevent default button behavior (form submission)
                history.back(); // Redirect the user to the previous page
            });
        });
    </script>
@endsection
