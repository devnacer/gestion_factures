<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesReportController extends Controller
{
    public function index()
    {
        return view('reports.report_invoices');
    }

    public function search_invoices(Request $request)
    {

        $rdio = $request->rdio;
        $type = $request->type;
        if ($type == 1) {
            $type = "Paid Invoices";
        } else if ($type == 2) {
            $type = "Unpaid Invoices";
        } else {
            $type = "Partially Paid Invoices";
        }

        //Search by invoice type

        if ($rdio == 1) {

            // In case of not specifying a date

            if ($request->type && $request->start_at == '' && $request->end_at == '') {

                $invoices = Invoice::select('*')->where('Value_Status', '=', $request->type)->get();

                return view('reports.report_invoices', compact('type', 'invoices'))->with('details', $invoices);
            }

            // if inputs date are not NULL
            else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);;

                $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])
                    ->where('Value_Status', '=', $request->type)
                    ->get();

                return view('reports.report_invoices', compact('type', 'start_at', 'end_at', 'invoices'))
                    ->with('details', $invoices);
            }
        }

        //Search by invoice number
        else {
            $invoice_number = $request->invoice_number;
            $invoices = Invoice::select('*')->where('invoice_number', '=', $request->invoice_number)->get();
            return view('reports.report_invoices', compact('invoice_number', 'invoices'))->with('details', $invoices);
        }
    }
}
