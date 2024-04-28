<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoices_attachments;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachmentsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Add Attachment', ['only' => ['store']]);
    }
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
        //insert into Invoices_attachements
        if ($request->hasFile('invoice_files')) {

            $my_invoice_files = $request->file('invoice_files');
            $file_name = $my_invoice_files->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            $invoice_id = $request->invoice_id;

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

        return back()->with('success', trans('messages.add'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoices_attachments $invoices_attachments)
    {
        //
    }
}
