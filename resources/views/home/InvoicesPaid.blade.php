<!-- Invoices Paid -->
<div class="card bg-gradient-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="ion ion-ios-analytics mr-1"></i>
            {{ trans('home.Invoices Paid Statistics (non-archived)') }}
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>{{ trans('home.Today') }}</td>
                    <td><span class="badge bg-primary">{{ $nbInvoicesPaidToday }}</span></td>
                </tr>
                <tr>
                    <td>{{ trans('home.Last 7 days') }}</td>
                    <td><span class="badge bg-primary">{{ $nbInvoicesPaidLast7Days }}</span></td>
                </tr>
                <tr>
                    <td>{{ trans('home.This month') }}</td>
                    <td><span class="badge bg-primary">{{ $nbInvoicesPaidThisMonth }}</span></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
