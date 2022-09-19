<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Subcatagory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('View Category')) {
            $catagoreis = Catagory::select('id', 'home_page', 'catagory_name', 'created_at')->latest('id')->paginate(15);
            return view('backend.catagory.index', [
                'catagoreis' => $catagoreis,
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
        if (auth()->user()->can('Create Category')) {

            return view("backend.catagory.create");
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
        if (auth()->user()->can('Create Category')) {
            $request->validate([
                'catagory_name' => ['required', 'string', 'unique:catagories,catagory_name'],
                'catagory_image' => ['required', 'mimes:png,jpg']
            ]);
            $catagory = new Catagory;
            $catagory->catagory_name = strip_tags($request->catagory_name);
            $catagory->slug = strip_tags(Str::slug($request->catagory_name));

            if ($request->hasFile('catagory_image')) {
                $product_thumbnail = $request->file('catagory_image');
                $extension = Str::slug($request->catagory_name) . '-' . Str::random(1) . '.' . 'webP';
                // $extension = Str::slug($request->catagory_name) . '-' . Str::random(1) . '.' . $product_thumbnail->getClientOriginalExtension();
                Image::make($product_thumbnail)->save(public_path('category_images/' . $extension), 90);
            }
            $catagory->catagory_image = $extension;
            $catagory->save();
            return redirect()->route('catagory.index')->with('success', 'Catagory Added Succesfully');
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
        if (auth()->user()->can('View Category')) {
            $catagory = Catagory::findorfail($id);
            if ($catagory->home_page == 1) {
                $catagory->home_page = 2;
                $catagory->save();
                return back()->with('warning', 'Inactive Successfully');
            }
            $catagory->home_page = 1;
            $catagory->save();
            return back()->with('success', 'Active Successfully');
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('Edit Category')) {
            $catagory = Catagory::findorfail($id);
            return view('backend.catagory.show', [
                "catagory" => $catagory,
            ]);
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
        if (auth()->user()->can('Edit Category')) {
            $request->validate([
                'catagory_name' => ['required', 'string', 'unique:catagories,catagory_name,' . $id],
            ]);
            $catagory =  Catagory::findorfail($id);
            $catagory->catagory_name = $request->catagory_name;
            $catagory->slug = Str::slug($request->catagory_name);

            if ($request->hasFile('catagory_image')) {
                if ($catagory->catagory_image != '') {
                    $old_thumbnail = public_path('category_images/' . $catagory->catagory_image);
                    if (file_exists($old_thumbnail)) {
                        unlink($old_thumbnail);
                    }
                }
                $product_thumbnail = $request->file('catagory_image');
                $extension = Str::slug($request->catagory_name) . '-' . Str::random(1) . '.' . 'webP';
                // $extension = Str::slug($request->catagory_name) . '-' . Str::random(1) . '.' . $product_thumbnail->getClientOriginalExtension();
                Image::make($product_thumbnail)->save(public_path('category_images/' . $extension), 90);
                $catagory->catagory_image = $extension;
            }

            $catagory->save();
            return redirect()->route('catagory.index')->with('warning', 'Catagory Updated Succesfully');
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
        if (auth()->user()->can('Delete Category')) {

            $subcatagory = Subcatagory::where('catagory_id', $id)->get()->count();
            if ($subcatagory > 0) {
                return back()->with('warning', "There's a Subcatagory Under This Catagory");
            } else {
                $catagory =  Catagory::findorfail($id);
                if ($catagory->catagory_image != '') {
                    $old_thumbnail = public_path('category_images/' . $catagory->catagory_image);
                    if (file_exists($old_thumbnail)) {
                        unlink($old_thumbnail);
                    }
                }
                $catagory->delete();
                return back()->with('delete', 'Catagory Deleted Succesfully');
            }
        } else {
            abort('404');
        }
    }
    public function MarkdeleteCatagory(Request $request)
    {
        if (auth()->user()->can('Delete Category')) {

            if ($request->filled('delete')) {
                foreach ($request->delete as  $value) {

                    // if theres subcatagory under this catafory id
                    $subcatagory = Subcatagory::where('catagory_id', $value)->get()->count();
                    if ($subcatagory > 0) {
                        // it will return back
                        return back()->with('warning', "There's a Subcatagory Under A Catagory");
                    } else {
                        // if theres no subcatagory under this catafory id

                        $catagory =  Catagory::findorfail($value);
                        if ($catagory->catagory_image != '') {
                            $old_thumbnail = public_path('category_images/' . $catagory->catagory_image);
                            if (file_exists($old_thumbnail)) {
                                unlink($old_thumbnail);
                            }
                        }
                        $catagory->delete();
                    }
                }
                return back()->with('delete', 'Catagory Deleted Succesfully');
            } else {
                return back();
            }
        } else {
            abort('404');
        }
    }
}
