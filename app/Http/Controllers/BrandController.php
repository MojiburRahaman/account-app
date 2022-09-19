<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
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
            'brand_name' => ['required', 'string', 'max:200', 'unique:brands,brand_name'],
            'brand_img' => ['required', 'mimes:png']
        ]);

        $brand = new Brand;
        $brand->brand_name = strip_tags($request->brand_name);
        $brand->slug = strip_tags(Str::slug($request->brand_name));

        if ($request->hasFile('brand_img')) {

            $brand_img = $request->file('brand_img');
            $extension = Str::slug($request->brand_name) . '-' . Str::random(3) . '.' . $brand_img->getClientOriginalExtension();
            Image::make($brand_img)->save(public_path('brand_img/' . $extension), 70);
        }

        $brand->brand_img = $extension;
        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Brand Added Successfully');
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
        $brand = Brand::findorfail($id);
        return view('backend.brand.edit', [
            'brand' => $brand,
        ]);
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
            'brand_name' => ['required', 'string', 'max:200', 'unique:brands,brand_name,' . $id],
            'brand_img' => ['mimes:png']
        ]);
        $brand = Brand::findorfail($id);
        $brand->brand_name = strip_tags($request->brand_name);
        $brand->slug = strip_tags(Str::slug($request->brand_name));
        if ($request->hasFile('brand_img')) {
            // old image delete
            $old_img = public_path('brand_img/' . $brand->brand_img);
            if (file_exists($old_img)) {
                unlink($old_img);
            }
            $brand_img = $request->file('brand_img');
            $extension = Str::slug($request->brand_name) . '-' . Str::random(3) . '.' . $brand_img->getClientOriginalExtension();
            Image::make($brand_img)->save(public_path('brand_img/' . $extension), 70);

            $brand->brand_img = $extension;
            $brand->save();
            return redirect()->route('brand.index')->with('warning', 'Brand Edited Successfully');
        } else {

            $brand->save();
            return redirect()->route('brand.index')->with('warning', 'Brand Edited Successfully');
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
        $brand = Brand::findorfail($id);
        $old_img = public_path('brand_img/' . $brand->brand_img);
        if (file_exists($old_img)) {
            unlink($old_img);
        }
        $brand->delete();
        return back()->with('delete', 'Brand Deleted Successfully');
    }
    public function Markdeletebrand(Request $request)
    {
        // return $request;
        if ($request->filled('delete')) {
            foreach ($request->delete as $id) {

                $brand = Brand::findorfail($id);
                $old_img = public_path('brand_img/' . $brand->brand_img);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
                $brand->delete();
            }
            return back()->with('delete', 'Brand Deleted Successfully');

        } else {
            return back();
        }
    }
}
