<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Section List|Add Section|Edit Section|Delete Section', ['only' => ['index']]);
        $this->middleware('permission:Add Section', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Section', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Section', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {

        $formFields = $request->validated();
        Section::create([
            'name' => $formFields['name'],
            'description' => $request->description,
            'created_by' => (Auth::user()->name),
        ]);
        return to_route('sections.index')->with('success', trans('messages.add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, Section $section)
    {
        $formFields = $request->validated();
        $section->fill($formFields)->save();

        return to_route('sections.index')->with('success', trans('messages.edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::find($id)->delete();
        return to_route('sections.index')->with('success', trans('messages.delete'));
    }
}
