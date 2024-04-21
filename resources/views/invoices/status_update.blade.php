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
                <form class="form-horizontal" action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="card-body">

                        {{-- 1 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName" class="control-label">{{ trans('invoices.Invoice Number') }}</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="{{ trans('Please enter the invoice number.') }}" required>
                                @error('invoice_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- 2 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label>{{ trans('invoices.Invoice Date') }}</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#reservationdate" placeholder="YYYY-MM-DD" name="invoice_Date" value="{{ date('Y-m-d') }}"
                                        required />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <label>{{ trans('invoices.Due Date') }}</label>
                                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#reservationdate2" name="Due_date" placeholder="YYYY-MM-DD" value="{{ date('Y-m-d') }}" required />
                                    <div class="input-group-append" data-target="#reservationdate2"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- 3 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName" class="control-label">{{ trans('invoices.Section') }}</label>
                                <select name="Section" class="form-control" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled>{{ trans('invoices.Section') }}</option>
                                        <option value=""></option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ trans('invoices.Product') }}</label>
                                <select id="product" name="product" class="form-control">
                                </select>
                            </div>
                        </div>

                        {{-- 4 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName" class="control-label">Collection Amount التحصيل</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Commission Amount العمولة</label>
                                <input type="text" class="form-control form-control" id="Amount_Commission"
                                    name="Amount_Commission" title="Please enter the commission amount">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName" class="control-label">Discountالخصم</label>
                                <input type="text" class="form-control" id="Discount" name="Discount"
                                    title="Please enter the discount amount">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Value Added Tax (VAT) Rateنسبة ضريبة القيمة
                                    المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                    <option value="" selected disabled>Select VAT rateحدد نسبة الضريبة</option>
                                </select>
                            </div>
                        </div>

                        {{-- 6 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName" class="control-label">Value Added Tax (VAT) Amountقيمة ضريبة القيمة
                                    المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Total Including Taxالاجمالي شامل
                                    الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly>
                            </div>
                        </div>

                        {{-- 7 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                        </div>

                        {{-- 8 --}}
           


                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">{{ trans('invoices.Save') }}</button>
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

    <!-- bs-custom-file-input -->
    <script src="{{ URL::asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
