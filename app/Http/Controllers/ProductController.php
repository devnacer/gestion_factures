<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Product List|Add Product|Edit Product|Delete Product', ['only' => ['index']]);
        $this->middleware('permission:Add Product', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Product', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $sections = Section::all();
        return view('products.index', compact('products', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('products.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {    
        $formFields = $request->validated();
        Product::create($formFields);
        return to_route('products.index')->with('success', trans('messages.add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $sections = Section::all();
        return view('products.edit', compact('product','sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $formFields = $request->validated();
        $product->fill($formFields)->save();

        return to_route('products.index')->with('success', trans('messages.edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Product::find($id)->delete();
        return to_route('products.index')->with('success', trans('messages.delete'));
    }
}
