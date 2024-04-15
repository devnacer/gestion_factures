@extends('layouts.master')

@section('title')
    {{ trans('titles.List of invoices') }}
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
                        <h1>{{ trans('invoices.Invoices') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ trans('invoices.Invoices') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('invoices.Invoices list') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title mr-auto">{{ trans('invoices.Invoices list') }}</h3>
                    <form action="{{ route('invoices.create') }}" method="GET">
                        @csrf
                        <button class="btn btn-default">{{ trans('invoices.Create new Invoice') }}</button>
                    </form>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    @include('layouts.alert')
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans('invoices.#') }}</th>
                                <th>{{ trans('invoices.Invoice Number') }}</th>
                                <th>{{ trans('invoices.Invoice Date') }}</th>
                                <th>{{ trans('invoices.Due Date') }}</th>
                                <th>{{ trans('invoices.Product') }}</th>
                                <th>{{ trans('invoices.Section') }}</th>
                                <th>{{ trans('invoices.Discount') }}</th>
                                <th>{{ trans('invoices.Tax Rate') }}</th>
                                <th>{{ trans('invoices.Tax Amount') }}</th>
                                <th>{{ trans('invoices.Total') }}</th>
                                <th>{{ trans('invoices.Status') }}</th>
                                <th>{{ trans('invoices.Notes') }}</th>
                                <th>{{ trans('invoices.Operations') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($invoices->isEmpty())
                                <tr>
                                    <td colspan="4">{{ trans('No invoices available') }}</td>
                                </tr>
                            @else
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->invoice_Date }}</td>
                                        <td>{{ $invoice->Due_date }}</td>
                                        <td>{{ $invoice->product }}</td>
                                        <td>{{ $invoice->section->name }}</td>
                                        <td>{{ $invoice->Discount }}</td>
                                        <td>{{ $invoice->Rate_VAT }}</td>
                                        <td>{{ $invoice->Value_VAT }}</td>
                                        <td>{{ $invoice->Total }}</td>
                                        <td>
                                            @if($invoice->Value_Status == 1)
                                                <span class="badge bg-success">{{ trans('invoices.Paid Invoice') }}</span>
                                            @elseif($invoice->Value_Status == 2)
                                                <span class="badge bg-danger">{{ trans('invoices.Unpaid Invoice') }}</span>
                                            @else
                                                <span class="badge bg-warning text-dark">{{ trans('invoices.Partially Paid Invoice') }}</span>
                                            @endif
                                        </td>
                                        
                                        <td>{{ $invoice->note }}</td>
                                        <td>
                                            <form action="{{ route('invoices.edit', $invoice->id) }}" method="GET">
                                                @csrf
                                                <button class="modal-effect btn btn-sm btn-info">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    {{ trans('invoices.Edit') }}
                                                </button>
                                            </form>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $invoice->id }}" data-name="{{ $invoice->name }}"
                                                data-toggle="modal" href="#ModalDelete">
                                                <i class="fas fa-trash"></i>
                                                {{ trans('invoices.Delete') }}
                                            </a>

                                            <form action="{{ route('invoice.details', $invoice->id) }}" method="GET">
                                                @csrf
                                                <button class="modal-effect btn btn-sm btn-light">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    {{ trans('invoices.Show Details') }}
                                                </button>
                                            </form>

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
            {{-- <div class="modal fade" id="ModalDelete">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ trans('invoices.Delete Section') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="{{ route('invoices.destroy', 0) }}" method="post" autocomplete="off">
                            @method('delete')
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id" value="">
                                    <p>{{ trans('invoices.Are you sure you want to delete this Section?') }}</p>
                                    <input class="form-control" name="name" id="name" type="text" readonly>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-secondary">{{ trans('invoices.Validate') }}</button>
                                <button type="button" class="btn btn-default"
                                    data-dismiss="modal">{{ trans('invoices.Close') }}</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div> --}}
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
        // $('#ModalDelete').on('show.bs.modal', function(event) {
        //     var button = $(event.relatedTarget)
        //     var id = button.data('id')
        //     var name = button.data('name')
        //     var modal = $(this)
        //     modal.find('.modal-body #id').val(id);
        //     modal.find('.modal-body #name').val(name);
        // })
    </script>
@endsection
