@extends('layouts.master')

@section('title')
    {{ trans('titles.List of sections') }};
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
                        <h1>{{ trans('titles.List of sections') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Setting</a></li>
                            <li class="breadcrumb-item active">sections</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Horizontal Form</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('sections.update', $section->id) }}" method="post"
                        autocomplete="off">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $section->name) }}">
                                </div>
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $section->description) }}</textarea>
                                </div>
                                @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info" name="edit">Validate</button>
                            <button id="btnClose" type="submit" class="btn btn-default float-right">Close</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.container-fluid -->
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
