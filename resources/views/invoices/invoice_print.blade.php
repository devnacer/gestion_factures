@extends('layouts.master')

@section('title')
    {{ trans('titles.Print invoice') }}
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
                            <li class="breadcrumb-item"><a href="#">{{ trans('Invoices.Invoices') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('invoices.Invoices list') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('invoices.Print invoice') }}</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> {{ trans('invoices.Note:') }}</h5>
                                {{ trans('invoices.This page has been enhanced for printing.') }} {{ trans('invoices.Click the print button at the bottom of the invoice to test.') }} 
                            </div>


                            <!-- Main content -->
                            <div class="invoice p-3 mb-3"  id="print_invoice">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> InvoiceMaster
                                            <small class="float-right">Date: {{$invoice->invoice_Date}}</small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        From
                                        <address>
                                            <strong>Admin, invoice.</strong><br>
                                            795 Folsom Ave, Suite 600<br>
                                            San Francisco, CA 94107<br>
                                            Phone: (123) 456-7890<br>
                                            Email: info@invoicemaster.com
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        To
                                        <address>
                                            <strong>John Doe</strong><br>
                                            795 Folsom Ave, Suite 600<br>
                                            San Francisco, CA 94107<br>
                                            Phone: (123) 456-7890<br>
                                            Email: john.doe@example.com
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Invoice {{$invoice->invoice_number}}</b><br>
                                        <b>Payment Date:</b> {{$invoice->Payment_Date}}<br>
                                        <b>Status:</b> {{$invoice->Status}}
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Section</th>
                                                    <th>Collection Amount</th>
                                                    <th>Note</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$invoice->product}}</td>
                                                    <td>{{$invoice->section->name}}</td>
                                                    <td>${{$invoice->Amount_Commission}}</td>
                                                    <td>{{$invoice->note}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
                                        <p class="lead">Etsy doostang zoodles:</p>

                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning
                                            heekya handango imeem
                                            plugg
                                            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                        </p>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <p class="lead">Amount Due {{$invoice->Due_date}}</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Tax ({{$invoice->Rate_VAT}})</th>
                                                    <td>${{$invoice->Value_VAT}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Discount:</th>
                                                    <td>${{$invoice->Discount}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>${{$invoice->Total}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                            </div><!-- /.col -->
                        </div><!-- /.row -->


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary" onclick="printDiv()"><i class="fas fa-print"></i>
                            {{ trans('invoices.Print') }}</button>

                        <button id="btnClose" type="submit"
                            class="btn btn-default float-right">{{ trans('invoices.Close') }}</button>
                    </div>
                    <!-- /.card-footer -->

                </div>
                <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script>
        // button close
        $(document).ready(function() {
            // Capture click event on the Close button
            $('#btnClose').click(function(e) {
                e.preventDefault(); // Prevent default button behavior (form submission)
                history.back(); // Redirect the user to the previous page
            });
        });
    </script>

    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print_invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
