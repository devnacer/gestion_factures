@extends('layouts.master')

@section('title')
    {{ trans('titles.User Rights') }}
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title mr-auto">{{ trans('roles.User Rights') }}</h3>
                    <form action="{{ route('roles.create') }}" method="GET">
                        @csrf
                        <button class="btn btn-default">{{ trans('roles.Create new Role') }}</button>
                    </form>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    @include('layouts.alert')
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('roles.Name') }}</th>
                                <th>{{ trans('roles.Operations') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($roles->isEmpty())
                                <tr>
                                    <td colspan="5">{{ trans('roles.No roles available') }}</td>
                                </tr>
                            @else
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    {{ trans('invoices.Operations') }}
                                                </button>
                                                <div class="dropdown-menu">

                                                    {{-- details --}}
                                                    <form action="{{ route('roles.show', $role->id) }}" method="GET"
                                                        class="dropdown-item">
                                                        @csrf
                                                        <button class="modal-effect btn btn-sm btn-primary">
                                                            <i class="fas fa-folder"></i>
                                                            {{ trans('roles.Show Permissions') }}
                                                        </button>
                                                    </form>

                                                    {{-- edit --}}
                                                    <form action="{{ route('roles.edit', $role->id) }}" method="GET" class="dropdown-item">
                                                        @csrf
                                                        <button class="modal-effect btn btn-sm btn-info">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            {{ trans('roles.Edit') }}
                                                        </button>
                                                    </form> 

                                                    {{-- delete --}}
                                                    <div class="dropdown-item">
                                                        <a class="modal-effect btn btn-sm btn-danger"
                                                            data-effect="effect-scale" data-id="{{ $role->id }}"
                                                            data-name="{{ $role->name }}" data-toggle="modal"
                                                            href="#ModalDelete">
                                                            <i class="fas fa-trash"></i>
                                                            {{ trans('roles.Delete') }}
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!--modal Delete-->
            <div class="modal fade" id="ModalDelete">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ trans('roles.Delete Role') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="{{ route('roles.destroy', 0) }}" method="post" autocomplete="off">
                            @method('delete')
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id" value="">
                                    <p>{{ trans('roles.Are you sure you want to delete this Role?') }}</p>
                                    <input class="form-control" name="name" id="name" type="text" readonly>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-secondary">{{ trans('roles.Validate') }}</button>
                                <button type="button" class="btn btn-default"
                                    data-dismiss="modal">{{ trans('roles.Close') }}</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        </section>
        <!-- /.content -->

    </div>
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $('#ModalDelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        })
    </script>
@endsection
