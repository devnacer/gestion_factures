@extends('layouts.master')

@section('title')
    {{ trans('titles.Change the payment status of the invoice') }}
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
                    <h3 class="card-title">{{ trans('invoices.Change the payment status of the invoice') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('InvoicePaymentStatusUpdate', $invoice->id) }}" method="post" autocomplete="off">
                    @csrf
                    <div class="card-body">

                        {{-- 1 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName" class="control-label">{{ trans('invoices.Invoice Number') }}</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    value="{{ $invoice->invoice_number }}" readonly>
                            </div>
                        </div>

                        {{-- 2 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label>{{ trans('invoices.Invoice Date') }}</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="invoice_Date"
                                        value="{{ $invoice->invoice_Date }}" readonly />
                                </div>
                            </div>

                            <div class="col">
                                <label>{{ trans('invoices.Due Date') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="Due_date"
                                        value="{{ $invoice->Due_date }}" readonly />
                                </div>
                            </div>

                        </div>

                        {{-- 3 --}}
                        <div class="row mb-3">

                            <div class="col">
                                <label>{{ trans('invoices.Section') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="section"
                                        value="{{ $invoice->section->name }}" readonly />
                                </div>
                            </div>

                            <div class="col">
                                <label>{{ trans('invoices.Product') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="product"
                                        value="{{ $invoice->product }}" readonly />
                                </div>
                            </div>

                        </div>

                        {{-- 4 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName" class="control-label">Collection Amount التحصيل</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    value="{{ $invoice->Amount_collection }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Commission Amount العمولة</label>
                                <input type="text" class="form-control form-control" id="Amount_Commission"
                                    name="Amount_Commission" value="{{ $invoice->Amount_Commission }}" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName" class="control-label">Discountالخصم</label>
                                <input type="text" class="form-control" id="Discount" name="Discount"
                                    value="{{ $invoice->Discount }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Value Added Tax (VAT) Rateنسبة ضريبة القيمة
                                    المضافة</label>
                                <input type="text" name="Rate_VAT" id="Rate_VAT" class="form-control"
                                    value="{{ $invoice->Rate_VAT }}" readonly>
                            </div>
                        </div>

                        {{-- 6 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName" class="control-label">Value Added Tax (VAT) Amountقيمة ضريبة القيمة
                                    المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                    value="{{ $invoice->Value_VAT }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Total Including Taxالاجمالي شامل
                                    الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total"
                                    value="{{ $invoice->Total }}" readonly>
                            </div>
                        </div>

                        {{-- 7 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>{{ $invoice->note }}</textarea>
                            </div>
                        </div>

                        {{-- 8 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="exampleTextarea">{{ trans('invoices.Payment Status') }}</label>
                                <select class="form-control" id="Status" name="value_status" required>
                                    <option selected="true" disabled="disabled">
                                        {{ trans('invoices.Select Payment Status') }}</option>
                                    <option value="1">{{ trans('invoices.Paid') }}</option>
                                    <option value="3">{{ trans('invoices.Partially Paid') }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>{{ trans('invoices.Payment Date') }}</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" placeholder="YYYY-MM-DD" name="payment_date"
                                        value="{{ date('Y-m-d') }}" required />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit"
                            class="btn btn-secondary">{{ trans('invoices.Update the payment status') }}</button>
                        <button id="btnClose" type="submit"
                            class="btn btn-default float-right">{{ trans('invoices.Close') }}</button>
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
        // button close
        $(document).ready(function() {
            // Capture click event on the Close button
            $('#btnClose').click(function(e) {
                e.preventDefault(); // Prevent default button behavior (form submission)
                history.back(); // Redirect the user to the previous page
            });
        });
    </script>

    <script>
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    </script>
@endsection
