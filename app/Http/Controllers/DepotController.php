<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
 
class DepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('View Depot')) {
            $depots = Depot::select('id','code', 'depot_name', 'created_at')->latest('id')->paginate(25);
            return view('backend.depot.index', [
                'depots' => $depots,
            ]);
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
        if (auth()->user()->can('Create Depot')) {

            return view("backend.depot.create");
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
        if (auth()->user()->can('Create Depot')) {
            $request->validate([
                'depot_name' => ['required', 'string', 'unique:depots,depot_name'],
                'code' => ['required']
            ]);
            $depot = new Depot;
            $depot->depot_name = strip_tags($request->depot_name);
            $depot->code = strip_tags($request->code);
 
            $depot->save();
            return redirect()->route('depot.index')->with('success', 'Depot Added Succesfully');
        } else {
            abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Http\Response
     */
    public function show(Depot $depot)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('Edit Depot')) {
            $depot = Depot::findorfail($id);
            return view('backend.depot.edit', [
                "depot" => $depot,
            ]);
        } else {
            abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can('Edit Depot')) {
            $request->validate([
                'depot_name' => ['required', 'string', 'unique:depots,depot_name,'. $id],
             
            ]);
            $depot =  Depot::findorfail($id);
            $depot->depot_name = $request->depot_name;
            $depot->code = $request->code;
 

            $depot->save();
            return redirect()->route('depot.index')->with('warning', 'Depot Updated Succesfully');
        } else {
            abort('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('Delete Depot')) {

           
                $depot =  Depot::findorfail($id);
           
                $depot->delete();
                return back()->with('delete', 'Depot Deleted Succesfully');
           
        } else {
            abort('404');
        }
    }

    public function MarkdeleteDepot(Request $request)
    {
        if (auth()->user()->can('Delete Depot')) {

            if ($request->filled('delete')) {
                foreach ($request->delete as  $value) {
    
                        // if theres no subcatagory under this catafory id

                        $depot =  Depot::findorfail($value);
                     
                        $depot->delete();
                    
                }
                return back()->with('delete', 'Depot Deleted Succesfully');
            } else {
                return back();
            }
        } else {
            abort('404');
        }
    }
}
