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
        $invoices = Invoice::latest()->get();
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
        //validation
        $validatedData = $request->validate([
            'invoice_number' => 'required',
            'invoice_Date' => 'required|date',
            'Due_date' => 'required|date|after_or_equal:invoice_Date',
            'product' => 'required',
            'Section' => 'required',
            'Amount_collection' => 'required|numeric',
            'Amount_Commission' => 'required|numeric',
            'Discount' => 'required|numeric',
            'Value_VAT' => 'required|numeric',
            'Rate_VAT' => 'required|numeric',
            'Total' => 'required|numeric',
            'note' => 'nullable',
            'invoice_files' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:12048',
        ]);
        // insert into Invoice
        Invoice::create([
            'invoice_number' => $validatedData['invoice_number'],
            'invoice_Date' => $validatedData['invoice_Date'],
            'Due_date' => $validatedData['Due_date'],
            'product' => $validatedData['product'],
            'section_id' => $validatedData['Section'],
            'Amount_collection' => $validatedData['Amount_collection'],
            'Amount_Commission' => $validatedData['Amount_Commission'],
            'Discount' => $validatedData['Discount'],
            'Value_VAT' => $validatedData['Value_VAT'],
            'Rate_VAT' => $validatedData['Rate_VAT'],
            'Total' => $validatedData['Total'],
            'Status' => 'unpaid',
            'Value_Status' => 2,
            'note' => $validatedData['note'],
        ]);

        // insert into Invoices_details
        $invoice = Invoice::latest()->first();
        Invoices_details::create([
            'id_Invoice' => $invoice->id,
            'invoice_number' => $validatedData['invoice_number'],
            'product' => $validatedData['product'],
            'Section' => $invoice->section->name,
            'Status' => 'inpaid',
            'Value_Status' => 2,
            'note' => $validatedData['note'],
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
        //validation
        $validatedData = $request->validate([
            'invoice_number' => 'required',
            'invoice_Date' => 'required|date',
            'Due_date' => 'required|date|after_or_equal:invoice_Date',
            'product' => 'required',
            'Section' => 'required',
            'Amount_collection' => 'required|numeric',
            'Amount_Commission' => 'required|numeric',
            'Discount' => 'required|numeric',
            'Value_VAT' => 'required|numeric',
            'Rate_VAT' => 'required|numeric',
            'Total' => 'required|numeric',
            'note' => 'nullable',
        ]);

        $invoice->update([
            'invoice_number' => $validatedData['invoice_number'],
            'invoice_Date' => $validatedData['invoice_Date'],
            'Due_date' => $validatedData['Due_date'],
            'product' => $validatedData['product'],
            'section_id' => $validatedData['Section'],
            'Amount_collection' => $validatedData['Amount_collection'],
            'Amount_Commission' => $validatedData['Amount_Commission'],
            'Discount' => $validatedData['Discount'],
            'Value_VAT' => $validatedData['Value_VAT'],
            'Rate_VAT' => $validatedData['Rate_VAT'],
            'Total' => $validatedData['Total'],
            'note' => $validatedData['note'],
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
        return back()->with('success', trans('messages.add'));
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
        return view('invoices.invoice_print', compact('invoice'));

        //    $invoice = Invoice::where("Value_Status", 3)->get();
        //    return view('invoices.invoices_partially', compact('invoices'));
    }
}
