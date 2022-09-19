<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('View Color')) {
            $colors = Color::where('id', '!=', 1)->select('id', 'color_name', 'created_at')->latest()->simplepaginate(10);
            return view('backend.color.index', compact('colors'));
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
        if (auth()->user()->can('Create Color')) {
            return view('backend.color.create');
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
        if (auth()->user()->can('Create Color')) {
            $request->validate([
                'color_name' => ['required', 'string', 'max:150', 'unique:colors,color_name']
            ]);
            $color = new Color;
            $color->color_name = $request->color_name;
            $color->save();
            return redirect()->route('color.index')->with('success', 'Color Added Successfully');
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
        if (auth()->user()->can('Edit Color')) {
            $color = Color::findorfail($id);
            return view('backend.color.edit', compact('color'));
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
        if (auth()->user()->can('Edit Color')) {
            $request->validate([
                'color_name' => ['required', 'string', 'max:150', 'unique:colors,color_name,' . $id]
            ]);
            $color = Color::findorfail($id);
            $color->color_name = $request->color_name;
            $color->save();
            return redirect()->route('color.index')->with('warning', 'Color Edited Successfully');
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
        if (auth()->user()->can('Delete Color')) {
            Color::findorfail($id)->delete();
            return back()->with('delete', 'Color Deleted Succcessfully');
        } else {
            abort('404');
        }
    }
}
