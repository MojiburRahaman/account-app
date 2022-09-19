<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('View Size')) {
            $sizes = Size::where('id', '!=', 1)->latest()->paginate(15);
            return view('backend.size.index', compact('sizes'));
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('Create Size')) {
            return view('backend.size.create');
        } else {
            abort('404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('Create Size')) {
            $request->validate([
                'size_name' => ['required', 'string', 'max:200', 'unique:sizes,size_name']
            ]);
            $size = new Size;
            $size->size_name = $request->size_name;
            $size->save();
            return redirect()->route('size.index')->with('success', 'Size Added Successfully');
        } else {
            abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('Edit Size')) {
            $size = Size::findorfail($id);
            return view('backend.size.edit', compact('size'));
        } else {
            abort('404');
        }
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
        if (auth()->user()->can('Edit Size')) {
            $request->validate([
                'size_name' => ['required', 'string', 'max:200', 'unique:sizes,size_name,' . $id]
            ]);
            $size = Size::findorfail($id);
            $size->size_name = $request->size_name;
            $size->save();
            return redirect()->route('size.index')->with('warning', 'Size Edited Successfully');
        } else {
            abort('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('Delete Size')) {
            Size::findorfail($id)->delete();
            return back()->with('delete', 'Size Deleted Successfully');
        } else {
            abort('404');
        }
    }
}
