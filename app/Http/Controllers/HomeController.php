<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:home Page show', ['only' => ['index']]);
    }

    public function index()
    {
        //_______________statistics  boxes invoices__________________________________ 
        // Total invoices (not deleted)
        $totalInvoices = Invoice::whereNull('deleted_at')->count();

        // Total paid invoices (not deleted)
        $totalPaidInvoices = Invoice::where('Value_Status', '=', 1)->whereNull('deleted_at')->count();

        // Total unpaid invoices (not deleted)
        $totalUnpaidInvoices = Invoice::where('Value_Status', '=', 2)->whereNull('deleted_at')->count();

        // Total partially paid invoices (not deleted)
        $totalPartiallyPaidInvoices = Invoice::where('Value_Status', '=', 3)->whereNull('deleted_at')->count();

        // Calculate percentages
        $totalPercentage = 100;
        $paidPercentage = $totalInvoices != 0 ? ($totalPaidInvoices / $totalInvoices) * 100 : 0;
        $unpaidPercentage = $totalInvoices != 0 ? ($totalUnpaidInvoices / $totalInvoices) * 100 : 0;
        $partiallyPaidPercentage = $totalInvoices != 0 ? ($totalPartiallyPaidInvoices / $totalInvoices) * 100 : 0;
        //_______________end_statistics  boxes invoices___________________________ 


        //________________Chart_____________________________________
        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('doughnut')
            ->size(['width' => 400, 'height' => 200])
            ->labels([
                trans('home.Unpaid Invoices'),
                trans('home.Partially Paid'),
                trans('home.Paid Invoices')
            ])
            ->datasets([
                [
                    "label" => "Invoices",
                    'backgroundColor' => ["rgba(255, 99, 132, 0.2)", "rgba(255, 206, 86, 0.2)", "rgba(75, 192, 192, 0.2)"], 
                    'borderColor' => ["rgba(255,99,132,1)", "rgba(255, 206, 86, 1)", "rgba(75, 192, 192, 1)"],
                    'hoverBackgroundColor' => ["rgba(255,99,132,0.4)", "rgba(255, 206, 86, 0.4)", "rgba(75, 192, 192, 0.4)"],
                    'data' => [$totalUnpaidInvoices, $totalPartiallyPaidInvoices, $totalPaidInvoices],
                ],
            ])
            ->options([]);
            //_______________end_Chart_____________________________________


            //_______________nb add invoices statistic________________________________________ 
            // Number of invoices added today
            $nbInvoicesAddedToday = Invoice::whereDate('created_at', Carbon::today())->count();
            
            // Number of invoices added in the last 7 days
            $nbInvoicesAddedLast7Days = Invoice::where('created_at', '>=', Carbon::now()->subDays(7))->count();
            
            // Number of invoices added this month
            $nbInvoicesAddedThisMonth = Invoice::whereYear('created_at', Carbon::now()->year)
                                               ->whereMonth('created_at', Carbon::now()->month)
                                               ->count();
            
            //_______________end_____nb add invoices statistic_________________________________


            //_______________nb paid invoices statistic________________________________________ 
            // Number of invoices paid today
            $nbInvoicesPaidToday = Invoice::whereDate('created_at', Carbon::today())->where('Value_Status', '=', 1)->count();
            
            // Number of invoices paid in the last 7 days
            $nbInvoicesPaidLast7Days = Invoice::where('created_at', '>=', Carbon::now()->subDays(7))->where('Value_Status', '=', 1)->count();
            
            // Number of invoices paid this month
            $nbInvoicesPaidThisMonth = Invoice::whereYear('created_at', Carbon::now()->year)
                                                ->whereMonth('created_at', Carbon::now()->month)
                                                ->where('Value_Status', '=', 1)
                                                ->count();
            //_____________end__nb paid invoices statistic_______________________________________ 
            
            
            //_______________nb partially invoices statistic_______________________________________ 
            // Number of invoices partially paid today
            $nbInvoicesPartiallyPaidToday = Invoice::whereDate('created_at', Carbon::today())->where('Value_Status', '=', 3)->count();

            // Number of invoices partially paid in the last 7 days
            $nbInvoicesPartiallyPaidLast7Days = Invoice::where('created_at', '>=', Carbon::now()->subDays(7))->where('Value_Status', '=', 3)->count();

            // Number of invoices partially paid this month
            $nbInvoicesPartiallyPaidThisMonth = Invoice::whereYear('created_at', Carbon::now()->year)
                                                    ->whereMonth('created_at', Carbon::now()->month)
                                                    ->where('Value_Status', '=', 3)
                                                    ->count();
            //_____________end__nb partially invoices statistic_______________________________________ 




        return view('dashboard', compact('totalInvoices', 'totalPaidInvoices', 'totalUnpaidInvoices', 'totalPartiallyPaidInvoices', 'totalPercentage', 'paidPercentage', 'unpaidPercentage', 'chartjs', 'partiallyPaidPercentage','nbInvoicesAddedToday', 'nbInvoicesAddedLast7Days', 'nbInvoicesAddedThisMonth','nbInvoicesPaidToday', 'nbInvoicesPaidLast7Days', 'nbInvoicesPaidThisMonth', 'nbInvoicesPartiallyPaidToday', 'nbInvoicesPartiallyPaidLast7Days', 'nbInvoicesPartiallyPaidThisMonth'));
    }
}
