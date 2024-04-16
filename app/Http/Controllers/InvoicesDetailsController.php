<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Invoices_details;
use App\Models\Invoices_attachments;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices_details $invoices_details, $invoices_id)
    {
        $invoice = Invoice::where('id', $invoices_id)->first();
        $invoices_details = Invoices_details::where('id_invoice', $invoices_id)->get();
        $invoices_attachments = Invoices_attachments::where('invoice_id', $invoices_id)->get();
        return view('invoices.details', compact('invoice', 'invoices_details', 'invoices_attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $invoices_file = Invoices_attachments::findOrFail($request->id_file);
        $invoices_file->delete();
        Storage::disk('public_path_invoice')->delete($request->invoice_number.'/'.$request->file_name);
        return back()->with('success', trans('messages.delete'));
    }

    public function open_file($invoice_num, $file_name)

    {
        $filePath = Storage::disk('public_path_invoice')->path($invoice_num . '/' . $file_name);
        return response()->file($filePath);
    }

    public function download_file($invoice_num, $file_name)

    {
        $filePath = Storage::disk('public_path_invoice')->path($invoice_num . '/' . $file_name);
        return response()->download($filePath);
    }

}
