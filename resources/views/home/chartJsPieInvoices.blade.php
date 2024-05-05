<!-- chartJsPieInvoices -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="ion ion-ios-analytics mr-1"></i>
            {{ trans('home.Unpaid/Partially Paid/Paid Invoices') }}
        </h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div>
            {!! $chartjs->render() !!}
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
