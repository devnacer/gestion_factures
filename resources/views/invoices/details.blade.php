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





                        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-three-profile-tab">

                            <div class="card">
                   
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                  <table class="table table-hover text-nowrap">
                                    <thead>
                                      <tr>
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
                                      <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->invoice_Date }}</td>
                                        <td>{{ $invoice->Due_date }}</td>
                                        <td> @if ($invoice->Value_Status == 1)
                                            <span class="badge bg-success">{{ trans('invoices.Paid Invoice') }}</span>
                                        @elseif($invoice->Value_Status == 2)
                                            <span class="badge bg-danger">{{ trans('invoices.Unpaid Invoice') }}</span>
                                        @else
                                            <span
                                                class="badge bg-warning text-dark">{{ trans('invoices.Partially Paid Invoice') }}</span>
                                        @endif</td>
                                        <td>{{ $invoice->payment_date }}</td>
                                        <td>{{ $invoice->note }}</td>
                                        {{-- <td>{{ $invoice_details->created_at }}</td>
                                        <td>{{ $invoice_details->user }}</td> --}}
                                      </tr>

                                    </tbody>
                                  </table>
                                </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->


                        </div>






                        <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                            aria-labelledby="custom-tabs-three-messages-tab">
                            Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue
                            id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac
                            tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit
                            condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus
                            tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet
                            sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum
                            gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend
                            ac ornare magna.
                        </div>
                    </div>
                </div>
                <!-- /.card -->
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
@endsection
