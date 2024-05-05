<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Invoices Report', ['only' => ['index_invoices_report', 'search_invoices']]);
        $this->middleware('permission:Customers Report', ['only' => ['index_customers_report', 'Search_customers']]);
   
    }

    public function index_invoices_report()
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

    public function index_customers_report()
    {
        $sections = Section::all();
        return view('reports.customers_report', compact('sections'));
    }

    public function Search_customers(Request $request)
    {
        $sections = Section::all();
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);

        if ($request->Section && $request->product && $request->start_at == '' && $request->end_at == '') {

            $invoices = Invoice::select('*')->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
        } else if ($request->Section == NULL && $request->product == NULL && $request->start_at && $request->end_at) {
            $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->get();
        } else {

            $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
        }
        return view('reports.customers_report', compact('sections', 'invoices'))->with('details', $invoices);
    }
}
