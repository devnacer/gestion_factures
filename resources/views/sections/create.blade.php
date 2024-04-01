@extends('layouts.master')

@section('title')
    {{ trans('titles.Create new Section') }}
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
                        <h1>{{trans('sections.Sections')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{trans('sections.Setting')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('sections.Sections')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">{{trans('sections.Create new Section')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('sections.store') }}" method="post"
                        autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">{{trans('sections.Name')}}</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                 @enderror
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">{{trans('sections.Description')}}</label>                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-secondary">{{trans('sections.Validate')}}</button>
                            <button id="btnClose" type="submit" class="btn btn-default float-right">{{trans('sections.Close')}}</button>
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
    $(document).ready(function(){
        // Capture click event on the Close button
        $('#btnClose').click(function(e){
            e.preventDefault(); // Prevent default button behavior (form submission)
            history.back(); // Redirect the user to the previous page
        });
    });
</script>
@endsection
