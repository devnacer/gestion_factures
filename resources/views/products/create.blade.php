@extends('layouts.master')

@section('title')
    {{ trans('titles.Create new Product') }}
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
                        <h1>{{ trans('products.Products') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ trans('products.Setting') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('products.Products') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('products.Create new Product') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('products.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">{{ trans('products.Name') }}</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="section_id"
                                class="col-sm-2 col-form-label">{{ trans('products.Section name') }}</label>
                            <div class="col-sm-10">
                                <select id="section_id" name="section_id" class="form-control custom-select">
                                    <option value="" selected disabled>{{ trans('products.Choose a section') }}
                                    </option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('section_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                class="col-sm-2 col-form-label">{{ trans('products.Description') }}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">{{ trans('products.Validate') }}</button>
                        <button id="btnClose" type="submit"
                            class="btn btn-default float-right">{{ trans('products.Close') }}</button>
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
