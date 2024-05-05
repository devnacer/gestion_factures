@extends('layouts.master')

@section('title')
    {{ trans('titles.InvoiceMaster | Home') }}
@endsection

@section('css')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ trans('main-sidebar.Home') }}</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fas fa-info"></i>
                    {{ trans('home.Note: This displays statistics for non-archived invoices') }}
                </div>
                <!-- statistics  boxes invoices -->
                @include('home.statisticsBoxesInvoices')

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">

                        <!-- chartJsPieInvoices -->
                        @include('home.chartJsPieInvoices')

                      
                     
                        <!-- nb PartiallyPaid invoices statistic -->
                        @include('home.invoicesPartiallyPaid')


                        
                        <!-- Calendar -->
                        @include('home.calendar')


                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-5 connectedSortable">


                          <!-- nb add invoices statistic -->
                          @include('home.invoicesAdded')

                           <!-- nb paid invoices statistic -->
                           @include('home.invoicesPaid')

                           
                        <!-- TO DO List -->
                        @include('home.toDoList')

                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
@endsection
