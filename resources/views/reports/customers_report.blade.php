@extends('layouts.master')

@section('title')
    {{ trans('titles.Customers Reports') }}
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
                            <li class="breadcrumb-item"><a href="#">{{ trans('invoices.Reports') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('invoices.Customers Reports') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title mr-auto">{{ trans('invoices.Customers Reports') }}</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    @include('layouts.alert')

                    <form action="{{ route('customers_report_post') }}" method="POST" role="search" autocomplete="off">
                        @csrf

                        {{-- <div class="row mb-1">
                                <h3 class="text-primary">
                                    {{ trans('invoices.Search by invoice type') }}
                                </h3>
                            </div> --}}

                        {{-- Search by invoice type --}}
                        <div class="row">

                            <div class="form-group">
                                <label for="inputName" class="control-label">{{ trans('invoices.Section') }}</label>
                                <select name="Section" class="form-control" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled>{{ trans('invoices.Section') }}</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group ml-2">
                                <label for="inputName" class="control-label">{{ trans('invoices.Product') }}</label>
                                <select id="product" name="product" class="form-control">
                                </select>
                            </div>

                            <div class="form-group mx-2" id="start_at">
                                <label>{{ trans('invoices.From Date') }}</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" placeholder="YYYY-MM-DD" name="start_at"
                                        value="{{ $start_at ?? '' }}" />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="end_at">
                                <label>{{ trans('invoices.To Date') }}</label>
                                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#reservationdate2" placeholder="YYYY-MM-DD" name="end_at"
                                        value="{{ $end_at ?? '' }}" />
                                    <div class="input-group-append" data-target="#reservationdate2"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col mb-3">
                            <button class="btn btn-primary">{{ trans('invoices.Search') }}</button>
                        </div>
                    </form>

                    @if (isset($details))
                    @if ($invoices->isEmpty())
                        <p class="text-primary">{{ trans('invoices.No invoices available') }}</p>
                    @else
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
                                                @if ($invoice->Value_Status == 1)
                                                    <span
                                                        class="badge bg-success">{{ trans('invoices.Paid Invoice') }}</span>
                                                @elseif($invoice->Value_Status == 2)
                                                    <span
                                                        class="badge bg-danger">{{ trans('invoices.Unpaid Invoice') }}</span>
                                                @else
                                                    <span
                                                        class="badge bg-warning text-dark">{{ trans('invoices.Partially Paid Invoice') }}</span>
                                                @endif
                                            </td>

                                            <td>{{ $invoice->note }}</td>

                                            <td>
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        {{ trans('invoices.Operations') }}
                                                    </button>
                                                    <div class="dropdown-menu">

                                                        {{-- details --}}
                                                        <form action="{{ route('invoice.details', $invoice->id) }}"
                                                            method="GET" class="dropdown-item">
                                                            @csrf
                                                            <button class="modal-effect btn btn-sm btn-primary">
                                                                <i class="fas fa-folder"></i>
                                                                {{ trans('invoices.Show Details') }}
                                                            </button>
                                                        </form>

                                                        {{-- edit --}}
                                                        <form action="{{ route('invoices.edit', $invoice->id) }}"
                                                            method="GET" class="dropdown-item">
                                                            @csrf
                                                            <button class="modal-effect btn btn-sm btn-info">
                                                                <i class="fas fa-pencil-alt"></i>
                                                                {{ trans('invoices.Edit') }}
                                                            </button>
                                                        </form>

                                                        {{-- Modify the payment status --}}
                                                        <form
                                                            action="{{ route('invoicePaymentStatusShow', $invoice->id) }}"
                                                            method="GET" class="dropdown-item">
                                                            @csrf
                                                            <button class="modal-effect btn btn-sm btn-secondary">
                                                                <i class="fas fa-pencil-alt"></i>
                                                                {{ trans('invoices.Modify the payment status') }}
                                                            </button>
                                                        </form>


                                                        {{-- print --}}
                                                        <form action="{{ route('invoice_print', $invoice->id) }}"
                                                            method="GET" class="dropdown-item">
                                                            @csrf
                                                            <button class="modal-effect btn btn-sm btn-light">
                                                                <i class="fas fa-print"></i>
                                                                {{ trans('invoices.Print') }}
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    @endif

                </div>

            </div>
            <!-- /.card-body -->
    </div>
    <!-- /.card -->

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
    <!-- bs-custom-file-input -->
    <script src="{{ URL::asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        //Date picker2
        $('#reservationdate2').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>
@endsection
