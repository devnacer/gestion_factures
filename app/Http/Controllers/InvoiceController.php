<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Invoices_details;
use Illuminate\Support\Facades\DB;
use App\Models\Invoices_attachments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Invoices List|Add Invoice|Edit Invoice|Delete Invoice|View Invoice', ['only' => ['index']]);
        $this->middleware('permission:Add Invoice', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Invoice', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Invoice', ['only' => ['destroy']]);
        $this->middleware('permission:View Invoice', ['only' => ['show']]);
        $this->middleware('permission:Change Payment Status', ['only' => ['statusUpdate']]);
        $this->middleware('permission:Paid Invoices', ['only' => ['showPaidInvoices']]);
        $this->middleware('permission:Unpaid Invoices', ['only' => ['showUnpaidInvoices']]);
        $this->middleware('permission:Partially Paid Invoices', ['only' => ['showPartiallyPaidInvoices']]);
        $this->middleware('permission:Print Invoice', ['only' => ['print_invoice']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('invoices.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // insert into Invoice
        Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'unpaid',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        // insert into Invoices_details
        $invoice = Invoice::latest()->first();
        Invoices_details::create([
            'id_Invoice' => $invoice->id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $invoice->section->name,
            'Status' => 'inpaid',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => Auth::user()->name,
        ]);

        //insert into Invoices_attachements
        if ($request->hasFile('invoice_files')) {

            $invoice_id = Invoice::latest()->first()->id;
            $my_invoice_files = $request->file('invoice_files');
            $file_name = $my_invoice_files->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new Invoices_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->invoice_id = $invoice_id;
            $attachments->Created_by = Auth::user()->name;
            $attachments->save();

            // move invoice_files
            $invoice_files_name = $request->invoice_files->getClientOriginalName();
            $request->invoice_files->move(public_path('Attachments/' . $invoice_number), $invoice_files_name);
        }

        return to_route('invoices.index')->with('success', trans('messages.add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice, $id)
    {
        $invoice = Invoice::where('id', $id)->first();
        return view('invoices.status_update', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $sections = Section::all();
        return view('invoices.edit', compact('sections', 'invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);

        return to_route('invoices.index')->with('success', trans('messages.edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $invoice = Invoice::where('id', $id)->first();
        $invoices_attachments = Invoices_attachments::where('invoice_id', $id)->first();

        if (!empty($invoices_attachments->invoice_number)) {

            Storage::disk('public_path_invoice')->deleteDirectory($invoices_attachments->invoice_number);
        }

        $invoice->forceDelete();

        return back()->with('success', trans('messages.delete'));
    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("name", "id");
        return json_encode($products);
    }

    public function statusUpdate(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        if ($request->value_status === '1') {

            $invoice->update([
                'Value_Status' => 1,
                'Status' => 'paid',
                'Payment_Date' => $request->payment_date,
            ]);

            Invoices_details::create([
                'id_Invoice' => $invoice->id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $invoice->section->name,
                'Status' => "paid",
                'Value_Status' => 1,
                'Payment_Date' => $request->payment_date,
                'note' => $request->note,
                'user' => Auth::user()->name,
            ]);
        } else {
            $invoice->update([
                'Value_Status' => 3,
                'Status' => 'partially paid',
                'Payment_Date' => $request->payment_date,
            ]);
    
            Invoices_details::create([
                'id_Invoice' => $invoice->id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $invoice->section->name,
                'Status' => "partially paid",
                'Value_Status' => 3,
                'Payment_Date' => date('Y-m-d', strtotime($request->payment_date)),
                'note' => $request->note,
                'user' => Auth::user()->name,
            ]);

        }
        return to_route('invoices.index')->with('success', trans('messages.add'));
    }

    
    public function showPaidInvoices()
    {
       $invoices = Invoice::where("Value_Status", 1)->get();
       return view('invoices.invoices_paid', compact('invoices'));
    }
    
    public function showUnpaidInvoices()
    {
       $invoices = Invoice::where("Value_Status", 2)->get();
       return view('invoices.invoices_unpaid', compact('invoices'));
    }
    
    public function showPartiallyPaidInvoices()
    {
       $invoices = Invoice::where("Value_Status", 3)->get();
       return view('invoices.invoices_partially', compact('invoices'));
    }
    
    public function print_invoice($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        return view('invoices.invoice_print',compact('invoice'));

    //    $invoice = Invoice::where("Value_Status", 3)->get();
    //    return view('invoices.invoices_partially', compact('invoices'));
    }


}
