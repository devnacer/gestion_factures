<!-- statistics  boxes invoices -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <p>{{ trans('home.Total Invoices') }} <span
                        class="badge badge-light">{{ $totalPercentage }}%</span></p>
                <h3 class="text-center">{{ $totalInvoices }}</h3>
            </div>
            <a href="{{ route('invoices.index') }}" class="small-box-footer">{{ trans('home.More info') }}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <p>{{ trans('home.Paid Invoices') }} <span
                        class="badge badge-light">{{ number_format($paidPercentage, 2) }}%</span></p>
                <h3 class="text-center">{{ $totalPaidInvoices }}</h3>
            </div>
            <a href="{{ route('invoices.paid') }}"
                class="small-box-footer">{{ trans('home.More info') }}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <p>{{ trans('home.Partially Paid') }} <span
                        class="badge badge-light">{{ number_format($partiallyPaidPercentage, 2) }}%</span>
                </p>
                <h3 class="text-center">{{ $totalPartiallyPaidInvoices }}</h3>
            </div>
            <a href="{{ route('invoices.partially_paid') }}"
                class="small-box-footer">{{ trans('home.More info') }}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <p>{{ trans('home.Unpaid Invoices') }} <span
                        class="badge badge-light">{{ number_format($unpaidPercentage, 2) }}%</span></p>
                <h3 class="text-center">{{ $totalUnpaidInvoices }}</h3>
            </div>
            <a href="{{ route('invoices.unpaid') }}"
                class="small-box-footer">{{ trans('home.More info') }}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
