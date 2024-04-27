@extends('layouts.master')

@section('title')
    {{ trans('titles.Role details') }}
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
                        <h1>{{ trans('roles.Users') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ trans('roles.Users') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('roles.User Rights') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include('layouts.alert')

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ trans('roles.Permissions of the role') }} "{{$role->name}}" 
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul>
                        @foreach ($rolePermissions as $rolePermission)
                            <li>{{ $rolePermission->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button id="btnClose" type="submit"
                        class="btn btn-default float-right">{{ trans('users.Close') }}</button>
                </div>
                <!-- /.card-footer -->
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
