<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
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
    
        return view('dashboard', compact('totalInvoices', 'totalPaidInvoices', 'totalUnpaidInvoices', 'totalPartiallyPaidInvoices', 'totalPercentage', 'paidPercentage', 'unpaidPercentage', 'partiallyPaidPercentage'));
    }
    

}
