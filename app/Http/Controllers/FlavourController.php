<?php

namespace App\Http\Controllers;

use App\Models\Flavour;
use App\Models\FlavourList;
use Illuminate\Http\Request;

class FlavourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flavours = FlavourList::where('id', '!=', 1)->latest()->paginate(15);
        return view('backend.flavour.index', compact('flavours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.flavour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'flavour_name' => ['required', 'string', 'max:200', 'unique:flavours,flavour_name']
        ]);
        $flavour = new FlavourList;
        $flavour->flavour_name = $request->flavour_name;
        $flavour->save();
        return redirect()->route('flavour.index')->with('success', 'Flavour Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flavour = FlavourList::findorfail($id);
        return view('backend.flavour.edit', compact('flavour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'flavour_name' => ['required', 'string', 'max:200', 'unique:flavours,flavour_name,' . $id]
        ]);
        $flavour =  FlavourList::findorfail($id);
        $flavour->flavour_name = $request->flavour_name;
        $flavour->save();
        return redirect()->route('flavour.index')->with('warning', 'Flavour Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FlavourList::findorfail($id)->delete();
        return back()->with('delete', 'Deleted Successfully');
    }
}
