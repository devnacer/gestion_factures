@extends('layouts.master')

@section('title')
    {{ trans('titles.Invoices Reports') }}
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
                            <li class="breadcrumb-item active">{{ trans('invoices.Invoices Reports') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title mr-auto">{{ trans('invoices.Invoices Reports') }}</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    @include('layouts.alert')


                    <form action="{{ route('invoices_report_post') }}" method="POST" role="search" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="rdiobox">
                                    <input checked name="rdio" type="radio" value="1"
                                        id="type_div"><span>{{ trans('invoices.Search by invoice type') }}</span>
                                </label>
                            </div>
                            <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                <label class="rdiobox"><input name="rdio" value="2" type="radio"
                                        id="invoice_number_radio"><span>{{ trans('invoices.Search by invoice number') }}</span></label>
                            </div>
                        </div>

                        <div class="col mb-3" id="byType">

                            <div class="row mb-1">
                                <h3 class="text-primary">
                                    {{ trans('invoices.Search by invoice type') }}
                                </h3>
                            </div>

                            {{-- Search by invoice type --}}
                            <div class="row">

                                <div class="form-group">
                                    <label for="type">{{ trans('invoices.Select Invoice Type') }}</label>
                                    <select name="type" class="form-control custom-select" required>
                                        <option value="{{ $type ?? 'Select Invoice Type' }}" selected disabled>
                                            {{ $type ?? 'Select Invoice Type' }}
                                        </option>

                                        <option value="1">{{ trans('invoices.Paid Invoices') }}</option>
                                        <option value="2">{{ trans('invoices.Unpaid Invoices') }}</option>
                                        <option value="3">
                                            {{ trans('invoices.Partially Paid Invoices') }}
                                        </option>

                                    </select>
                                    @error('section_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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

                        </div>

                        <div class="col mb-3" id="byNumber">

                            <div class="row mb-1">
                                <h3 class="text-primary">
                                    {{ trans('invoices.Search by invoice number') }}
                                </h3>
                            </div>

                            {{-- Search by invoice number --}}
                            <div class="row">
                                <div class="form-group">
                                    <label for="inputName"
                                        class="control-label">{{ trans('invoices.Invoice Number') }}</label>
                                    <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                                        placeholder="{{ trans('invoices.Please enter the number.') }}"
                                        value="{{ $invoice_number ?? '' }}">
                                    @error('invoice_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
                                                        @can('View Invoice')
                                                            <form action="{{ route('invoice.details', $invoice->id) }}"
                                                                method="GET" class="dropdown-item">
                                                                @csrf
                                                                <button class="modal-effect btn btn-sm btn-primary">
                                                                    <i class="fas fa-folder"></i>
                                                                    {{ trans('invoices.Show Details') }}
                                                                </button>
                                                            </form>
                                                        @endcan

                                                        {{-- edit --}}
                                                        @can('Edit Invoice')
                                                            <form action="{{ route('invoices.edit', $invoice->id) }}"
                                                                method="GET" class="dropdown-item">
                                                                @csrf
                                                                <button class="modal-effect btn btn-sm btn-info">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                    {{ trans('invoices.Edit') }}
                                                                </button>
                                                            </form>
                                                        @endcan

                                                        {{-- Modify the payment status --}}
                                                        @can('Change Payment Status')
                                                            <form
                                                                action="{{ route('invoicePaymentStatusShow', $invoice->id) }}"
                                                                method="GET" class="dropdown-item">
                                                                @csrf
                                                                <button class="modal-effect btn btn-sm btn-secondary">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                    {{ trans('invoices.Modify the payment status') }}
                                                                </button>
                                                            </form>
                                                        @endcan

                                                        {{-- print --}}
                                                        @can('Print Invoice')
                                                            <form action="{{ route('invoice_print', $invoice->id) }}"
                                                                method="GET" class="dropdown-item">
                                                                @csrf
                                                                <button class="modal-effect btn btn-sm btn-light">
                                                                    <i class="fas fa-print"></i>
                                                                    {{ trans('invoices.Print') }}
                                                                </button>
                                                            </form>
                                                        @endcan

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
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

            $('#byNumber').hide();

            $('input[type="radio"]').click(function() {
                if ($(this).attr('id') == 'type_div') {
                    $('#byNumber').hide();
                    $('#byType').show();
                } else {
                    $('#byNumber').show();
                    $('#byType').hide();
                }
            });
        });
    </script>
@endsection
