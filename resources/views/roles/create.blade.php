@extends('layouts.master')

@section('title')
    {{ trans('titles.Create new Role') }}
@endsection

@section('css')
    <style>
        .custom-list {
            list-style-type: none;
            padding: 0;
        }
    </style>
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

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('roles.Create new Role') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('roles.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">{{ trans('roles.Name Role') }}</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">{{ trans('roles.Permissions') }}</label>
                            <div class="col-sm-10">
                                <ul class="custom-list">
                                    @foreach ($permissions as $permission)
                                        <li>
                                            <input type="checkbox" name="permission[]" id="permi_{{ $permission->id }}"
                                                value="{{ $permission->id }}"> 
                                            <label for="permi_{{ $permission->id }}">{{ $permission->name }}</label> 
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">{{ trans('roles.Validate') }}</button>
                        <button id="btnClose" type="submit"
                            class="btn btn-default float-right">{{ trans('roles.Close') }}</button>
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
