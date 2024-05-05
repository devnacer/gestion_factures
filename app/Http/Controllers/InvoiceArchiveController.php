<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceArchiveController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Invoices Archive', ['only' => ['index']]);
        $this->middleware('permission:Restore Invoice', ['only' => ['update']]);
        $this->middleware('permission:Delete Invoice', ['only' => ['destroy']]);
        $this->middleware('permission:Archive Invoice', ['only' => ['archive']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::onlyTrashed()->latest()->get();
        return view('invoices.invoices_archived', compact('invoices'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id_unarchive;
        Invoice::withTrashed()->where('id', $id)->restore();
        return to_route('archive.index')->with('success', trans('messages.add'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $invoice = Invoice::withTrashed()->where('id',$id)->first();
        $invoices_attachments = Invoices_attachments::where('invoice_id', $id)->first();

        if (!empty($invoices_attachments->invoice_number)) {

            Storage::disk('public_path_invoice')->deleteDirectory($invoices_attachments->invoice_number);
        }

        $invoice->forceDelete();
        return back()->with('success', trans('messages.delete'));
    }

    
    public function archive(Request $request)
    {
        $id = $request->id_archive;
        $invoice = Invoice::where('id', $id)->first();
        $invoice->delete();
        return back()->with('success', trans('messages.add'));
    }

}
