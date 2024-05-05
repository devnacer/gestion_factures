<!-- nb add invoices statistic -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="ion ion-ios-analytics mr-1"></i>
            {{trans('home.Invoice Add Statistics')}}
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>{{ trans('home.Today') }}</td>
                    <td><span class="badge bg-primary">{{ $nbInvoicesAddedToday }}</span></td>
                </tr>
                <tr>
                    <td>{{ trans('home.Last 7 days') }}</td>
                    <td><span class="badge bg-primary">{{ $nbInvoicesAddedLast7Days }}</span></td>
                </tr>
                <tr>
                    <td>{{ trans('home.This month') }}</td>
                    <td><span class="badge bg-primary">{{ $nbInvoicesAddedThisMonth }}</span></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
