@extends('layouts.master')

@section('title')
    {{ trans('titles.Invoice details') }}
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
                        <h1>{{ trans('invoices.Invoices') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ trans('invoices.Invoices') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('invoices.Invoice details') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include('layouts.alert')


            <div class="card card-primary card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                                href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                                aria-selected="true">{{ trans('invoices.Invoice information') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                                aria-selected="false">{{ trans('invoices.Payment statuses') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                                href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                                aria-selected="false">{{ trans('invoices.Attachments') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        {{-- Invoice information --}}
                        <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                            aria-labelledby="custom-tabs-three-home-tab">
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">{{ trans('invoices.Invoice Number') }}</dt>
                                        <dd class="col-sm-8">{{ $invoice->invoice_number }}</dd>
                                        <dt class="col-sm-4">{{ trans('invoices.Invoice Date') }}</dt>
                                        <dd class="col-sm-8">{{ $invoice->invoice_Date }}</dd>
                                        <dt class="col-sm-4">{{ trans('invoices.Due Date') }}</dt>
                                        <dd class="col-sm-8">{{ $invoice->Due_date }}</dd>
                                        <dt class="col-sm-4">{{ trans('invoices.Product') }}</dt>
                                        <dd class="col-sm-8">{{ $invoice->product }}</dd>
                                        <dt class="col-sm-4">{{ trans('invoices.Section') }}</dt>
                                        <dd class="col-sm-8">{{ $invoice->section->name }}</dd>
                                        <dt class="col-sm-4">{{ trans('invoices.Discount') }}</dt>
                                        <dd class="col-sm-8">{{ $invoice->Discount }}</dd>
                                        <dt class="col-sm-4">{{ trans('invoices.Tax Rate') }}</dt>
                                        <dd class="col-sm-8">{{ $invoice->Rate_VAT }}</dd>
                                        <dt class="col-sm-4">{{ trans('invoices.Tax Amount') }}</dt>
                                        <dd class="col-sm-8">{{ $invoice->Value_VAT }}</dd>
                                        <dt class="col-sm-4">{{ trans('invoices.Total') }}</dt>
                                        <dd class="col-sm-8">{{ $invoice->Total }}</dd>
                                        <dt class="col-sm-4">{{ trans('invoices.Status') }}</dt>
                                        <dd class="col-sm-8">
                                            @if ($invoice->Value_Status == 1)
                                                <span class="badge bg-success">{{ trans('invoices.Paid Invoice') }}</span>
                                            @elseif($invoice->Value_Status == 2)
                                                <span class="badge bg-danger">{{ trans('invoices.Unpaid Invoice') }}</span>
                                            @else
                                                <span
                                                    class="badge bg-warning text-dark">{{ trans('invoices.Partially Paid Invoice') }}</span>
                                            @endif
                                        </dd>
                                        <dt class="col-sm-4">{{ trans('invoices.Notes') }}</dt>
                                        <dd class="col-sm-8">{{ $invoice->note }}</dd>

                                    </dl>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                        {{-- Payment statuses --}}
                        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-three-profile-tab">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('invoices.Invoice Number') }}</th>
                                                <th>{{ trans('invoices.Invoice Date') }}</th>
                                                <th>{{ trans('invoices.Due Date') }}</th>
                                                <th>{{ trans('invoices.Status') }}</th>
                                                <th>{{ trans('invoices.Payment Date') }}</th>
                                                <th>{{ trans('invoices.Notes') }}</th>
                                                <th>{{ trans('invoices.Added Date') }}</th>
                                                <th>{{ trans('invoices.Created by') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices_details as $invoice_detail)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $invoice->invoice_number }}</td>
                                                    <td>{{ $invoice->invoice_Date }}</td>
                                                    <td>{{ $invoice_detail->Due_date }}</td>
                                                    <td>
                                                        @if ($invoice_detail->value_status == 1)
                                                            <span
                                                                class="badge bg-success">{{ trans('invoices.Paid Invoice') }}</span>
                                                        @elseif($invoice_detail->value_status == 2)
                                                            <span
                                                                class="badge bg-danger">{{ trans('invoices.Unpaid Invoice') }}</span>
                                                        @else
                                                            <span
                                                                class="badge bg-warning text-dark">{{ trans('invoices.Partially Paid Invoice') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $invoice_detail->payment_date }}</td>
                                                    <td>{{ $invoice_detail->note }}</td>
                                                    <td>{{ $invoice_detail->created_at }}</td>
                                                    <td>{{ $invoice_detail->user }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                        {{-- Attachments --}}
                        <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                            aria-labelledby="custom-tabs-three-messages-tab">

                            {{-- add file --}}
                            <form action="{{ route('another_attachment_store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card p-2">
                                    <label for="exampleInputFile">{{ trans('invoices.Add another attachment') }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                            <input type="hidden" name="invoice_number"
                                                value="{{ $invoice->invoice_number }}">
                                            <input name="invoice_files" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                                type="file" class="custom-file-input" id="exampleInputFile" multiple>
                                            <label class="custom-file-label"
                                                for="exampleInputFile">{{ trans('invoices.Choose file') }}</label>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-secondary">{{ trans('invoices.Save') }}</button>
                                    </div>
                                    <p class="text-danger">
                                        {{ trans('invoices.The attachment format is pdf, jpeg, .jpg, png.') }}</p>
                                </div>
                            </form>
                            <br>

                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('invoices.File name') }}</th>
                                                <th>{{ trans('invoices.Created by') }}</th>
                                                <th>{{ trans('invoices.Added Date') }}</th>
                                                <th>{{ trans('invoices.Payment Date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($invoices_attachments->isEmpty())
                                                <tr>
                                                    <td colspan="4">{{ trans('invoices.No attachments available') }}
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invoices_attachments as $invoice_attach)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $invoice_attach->file_name }}</td>
                                                        <td>{{ $invoice_attach->Created_by }}</td>
                                                        <td>{{ $invoice_attach->created_at }}</td>
                                                        <td></td>
                                                        <td>
                                                            <form
                                                                action="{{ route('open_file', [$invoice_attach->invoice_number, $invoice_attach->file_name]) }}"
                                                                method="GET" target="_blank">
                                                                @csrf
                                                                <button class="modal-effect btn btn-sm btn-primary">
                                                                    <i class="fas fa-folder"></i>
                                                                    {{ trans('invoices.View') }}
                                                                </button>
                                                            </form>

                                                            <form
                                                                action="{{ route('download_file', [$invoice_attach->invoice_number, $invoice_attach->file_name]) }}"
                                                                method="GET">
                                                                @csrf
                                                                <button class="modal-effect btn btn-sm btn-info">
                                                                    <i class="fas fa-download"></i>
                                                                    {{ trans('invoices.Download') }}
                                                                </button>
                                                            </form>

                                                            <a class="modal-effect btn btn-sm btn-danger"
                                                                data-effect="effect-scale"
                                                                data-id_file="{{ $invoice_attach->id }}"
                                                                data-file_name="{{ $invoice_attach->file_name }}"
                                                                data-invoice_number="{{ $invoice_attach->invoice_number }}"
                                                                data-toggle="modal" href="#ModalDelete">
                                                                <i class="fas fa-trash"></i>
                                                                {{ trans('sections.Delete') }}
                                                            </a>
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

                        </div>

                    </div>
                </div>
                <!-- /.card -->

                <!--modal Delete-->
                <div class="modal fade" id="ModalDelete">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{ trans('invoices.Delete File') }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{ route('delete_file') }}" method="post" autocomplete="off">
                                @method('delete')
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id_file" id="id_file" value="">
                                        <input type="hidden" name="invoice_number" id="invoice_number" value="">
                                        <p>{{ trans('invoices.Are you sure you want to delete this File?') }}</p>
                                        <input class="form-control" name="file_name" id="file_name" value=""
                                            readonly>

                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-danger">{{ trans('invoices.Delete') }}</button>
                                    <button type="button" class="btn btn-default"
                                        data-dismiss="modal">{{ trans('invoices.Close') }}</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>

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
        $('#ModalDelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
    <!-- bs-custom-file-input -->
    <script src="{{ URL::asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
