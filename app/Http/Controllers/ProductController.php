<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Catagory;
use App\Models\Color;
use App\Models\Flavour;
use App\Models\Product;
use App\Models\Size;
use App\Models\Gallery;
use App\Models\Subcatagory;
use App\Models\Attribute;
use App\Models\FlavourList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('Attribute.Color', 'Attribute.Size')->latest('id')->get();
        // $products = Product::with('Attribute.Color', 'Attribute.Size')->latest('id')->cursorPaginate(10)->fragment('Product');
        return view('backend.product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catagories = Catagory::select('id', 'catagory_name')->latest('id')->get();
        $colors = Color::select('id', 'color_name')->get();
        $sizes = Size::select('id', 'size_name')->get();
        $brands = Brand::select('id', 'brand_name')->latest('id')->get();
        return view('backend.product.create', [
            'catagories' => $catagories,
            'colors' => $colors,
            'sizes' => $sizes,
            'brands' => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->flavour_name;
        // foreach ($request->flavour_name as $key => $value) {
        //     # code...
        //     dd(  explode(' ', $value));
        // }
        // return 'p';
        $request->validate([
            'product_name' => ['required', 'string', 'max:250', 'unique:products,title,'],
            'catagory_name' => ['required'],
            'meta_description' => ['required', 'string', 'max:250'],
            'meta_keyword' => ['required'],
            'subcatagory_name' => ['required'],
            'thumbnail_img' => ['required', 'mimes:png,jpeg,jpg',],
            'product_img.*' => ['required', 'mimes:png,jpeg,jpg'],
            'product_summary' => ['required'],
            'product_description' => ['required'],
            'quantity.*' => ['required'],
            'discount.*' => ['nullable', 'numeric', 'min:1', 'max:99'],
            // 'regular_price[]' => ['required'],
        ], [
            'product_img.*.mimes' => 'Product Image must be png,jpg,jpeg formate',
            'product_img.*.required' => 'Product Image required',
            'discount.*.min' => 'Minimum 1',
            'discount.*.max' => 'Maximum 99',
        ]);
        $product = new Product;
        $product->title = $request->product_name;
        $product->slug = Str::slug($request->product_name);
        $product->catagory_id = $request->catagory_name;
        $product->meta_description = $request->meta_description;
        $product->meta_keyword = $request->meta_keyword;
        $product->subcatagory_id = $request->subcatagory_name;
        $product->brand_id = $request->brand_id;
        $product->product_summary = $request->product_summary;
        $product->product_description = $request->product_description;

        if ($request->hasFile('thumbnail_img')) {
            $product_thumbnail = $request->file('thumbnail_img');
            $extension = Str::slug($request->product_name) . '-' . Str::random(1) . '.' . $product_thumbnail->getClientOriginalExtension();
            Image::make($product_thumbnail)->save(public_path('thumbnail_img/' . $extension), 90);
        }
        $product->thumbnail_img = $extension;
        $product->save();



        if ($request->hasFile('product_img')) {
            // product image validation
            $p_img = $request->file('product_img');
            foreach ($p_img as $value) {
                $product_img = Str::slug($request->product_name) . '-' . Str::random(2) . '.' .
                    $value->getClientOriginalExtension();

                Image::make($value)->save(public_path('product_image/' . $product_img), 90);
                $gallery = new Gallery;
                $gallery->product_img = $product_img;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }
        // foreach ($request->flavour_name as $flavour) {
        //     if ($flavour != '') {
        //         $flavours = new Flavour;
        //         $flavours->product_id = $product->id;
        //         $flavours->flavour_name = $flavour;
        //         $flavours->save();
        //     }
        // }


        foreach ($request->color_id as $key => $color_id) {

            $attribute = new Attribute;
            $attribute->product_id = $product->id;
            $attribute->color_id = $color_id;
            $attribute->size_id = $request->size_id[$key];
            $attribute->quantity = $request->quantity[$key];
            $attribute->regular_price = $request->regular_price[$key];
            if ($request->discount[$key] != '') {
                $regular_price = $request->regular_price[$key];
                $discount_amount = ($request->regular_price[$key] * $request->discount[$key]) / 100;
                $sell_price = round($request->regular_price[$key] - $discount_amount);

                $attribute->sell_price = $sell_price;
                $attribute->discount = $request->discount[$key];
            }
            $attribute->save();
        }
        if ($request->flavour_name != '') {
            foreach ($request->flavour_name as $key => $value) {
                if ($value != '') {
                    # code...
                    $ex =   explode(' ', $value);
                    foreach ($ex as $value) {
                        $flavours = new Flavour;
                        $flavours->product_id = $product->id;
                        $flavours->size_id = $request->size_id[$key];
                        $flavours->flavour_name = $value;
                        $flavours->save();
                    }
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findorfail($id);
        if ($product->certified == 2) {
            $product->certified = 1;
            $product->save();
            return back()->with('success', 'Product Added into Certified');
        } else {
            $product->certified = 2;
            $product->save();
            return back()->with('warning', 'Product remove From Certified');
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
        $product = Product::with('Gallery', 'Attribute')->findorfail($id);
        $catagories = Catagory::select('id', 'catagory_name')->latest('id')->get();
        $subcatagories = Subcatagory::select('id', 'subcatagory_name')->where('catagory_id', $product->catagory_id)->get();
        $colors = Color::select('id', 'color_name')->get();
        $sizes = Size::select('id', 'size_name')->get();
        $brands = Brand::select('id', 'brand_name')->latest('id')->get();
        return view('backend.product.edit', [
            'product' => $product,
            'catagories' => $catagories,
            'colors' => $colors,
            'sizes' => $sizes,
            'brands' => $brands,
            'subcatagories' => $subcatagories,
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
        // return  $request;
        $request->validate([
            'product_name' => ['required', 'string', 'max:250', 'unique:products,title,' . $id],
            'catagory_name' => ['required'],
            'subcatagory_name' => ['required'],
            'meta_description' => ['required', 'string', 'max:250'],
            'meta_keyword' => ['required'],
            'thumbnail_img' => ['mimes:png,',],
            'product_img.*' => ['mimes:png,jpeg,jpg'],
            'product_img_new.*' => ['mimes:png,jpeg,jpg'],
            'product_summary' => ['required'],
            'product_description' => ['required'],
            'discount.*' => ['nullable', 'integer', 'min:1', 'max:99'],
            // 'quantity[]' => ['required'],
            // 'regular_price[]' => ['required'],
        ], [
            'product_img_new.*.mimes' => 'Product Image must be png,jpg,jpeg formate',
            'product_img.*.mimes' => 'Product Image must be png,jpg,jpeg formate',
            'discount.*.min' => 'Minimum 1',
            'discount.*.max' => 'Maximum 99',
            // 'regular_price[].required' => 'Regular Price is required'
        ]);
        $product = Product::findorfail($id);
        $product->title = $request->product_name;
        $product->meta_description = $request->meta_description;
        $product->meta_keyword = $request->meta_keyword;
        $product->slug = Str::slug($request->product_name);
        $product->catagory_id = $request->catagory_name;
        $product->subcatagory_id = $request->subcatagory_name;
        $product->brand_id = $request->brand_id;
        $product->product_summary = $request->product_summary;
        $product->product_description = $request->product_description;

        if ($request->hasFile('thumbnail_img')) {
            $old_thumbnail = public_path('thumbnail_img/' . $product->thumbnail_img);
            if (file_exists($old_thumbnail)) {
                unlink($old_thumbnail);
            }
            $product_thumbnail = $request->file('thumbnail_img');
            $extension = Str::slug($request->product_name) . '-' . Str::random(1) . '.' . $product_thumbnail->getClientOriginalExtension();
            Image::make($product_thumbnail)->save(public_path('thumbnail_img/' . $extension), 90);

            $product->thumbnail_img = $extension;
        }
        $product->save();

        if ($request->hasFile('product_img')) {
            // product image update start
            foreach ($request->file('product_img') as $key => $gallery_image) {
                if ($request->gallery_id[$key] != '') {
                    $gallery = Gallery::findorfail($request->gallery_id[$key]);
                    $old_img = public_path('product_image/' . $gallery->product_img);
                    if (file_exists($old_img)) {
                        unlink($old_img);
                    }
                    $product_img = Str::slug($request->product_name) . '-' . Str::random(3) . '.' .
                        $gallery_image->getClientOriginalExtension();

                    Image::make($gallery_image)->save(public_path('product_image/' . $product_img), 90);
                    $gallery->product_img = $product_img;
                    $gallery->product_id = $product->id;
                    $gallery->save();
                }
            }
        }
        if ($request->hasFile('product_img_new')) {
            // product image new insert
            $p_img = $request->file('product_img_new');
            foreach ($p_img as $value) {
                $product_img = Str::slug($request->product_name) . '-' . Str::random(2) . '.' .
                    $value->getClientOriginalExtension();

                Image::make($value)->save(public_path('product_image/' . $product_img), 90);
                $gallery = new Gallery;
                $gallery->product_img = $product_img;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }
        // if ($request->flavour_id == '') {
        //     foreach ($request->flavour_name as $flavour) {
        //         if ($flavour == '') {
        //             $flavours = new Flavour;
        //             $flavours->product_id = $product->id;
        //             $flavours->flavour_name = $flavour;
        //             $flavours->save();
        //         }
        //     }
        // } else {
        //     foreach ($request->flavour_name as $key => $flavour) {
        //         if ($flavour != '') {
        //             if ($request->flavour_id[$key] == '') {
        //                 $flavours = new Flavour;
        //                 $flavours->product_id = $product->id;
        //                 $flavours->flavour_name = $flavour;
        //                 $flavours->save();
        //             } else {
        //                 $flavours = Flavour::findorfail($request->flavour_id[$key]);
        //                 $flavours->product_id = $product->id;
        //                 $flavours->flavour_name = $flavour;
        //                 $flavours->save();
        //             }
        //         }
        //     }
        // }
        $f_id = Flavour::where('product_id', $id)->get();
        foreach ($f_id as  $f) {
            $f->delete();
        }
        if ($request->flavour_name != '') {
            foreach ($request->flavour_name as $key => $value) {
                if ($value != '') {
                    $ex =   explode(' ', $value);
                    foreach ($ex as $value) {
                        $flavours = new Flavour;
                        $flavours->product_id = $product->id;
                        $flavours->size_id = $request->size_id[$key];
                        $flavours->flavour_name = $value;
                        $flavours->save();
                    }
                }
            }
        }
        foreach ($request->color_id as $key => $color_id) {
            if ($request->attribute_id[$key] != '') {
                $attribute = Attribute::findorfail($request->attribute_id[$key]);
                $attribute->product_id = $product->id;
                $attribute->color_id = $color_id;
                $attribute->size_id = $request->size_id[$key];
                $attribute->quantity = $request->quantity[$key];
                $attribute->regular_price = $request->regular_price[$key];
                if ($request->discount[$key] != '') {
                    $regular_price = $request->regular_price[$key];
                    $discount_amount = ($request->regular_price[$key] * $request->discount[$key]) / 100;
                    $sell_price = round($request->regular_price[$key] - $discount_amount);

                    $attribute->sell_price = $sell_price;
                    $attribute->discount = $request->discount[$key];
                } else {
                    $attribute->sell_price = '';
                    $attribute->discount = $request->discount[$key];
                }
                $attribute->save();
            } else {
                $attribute = new Attribute;
                $attribute->product_id = $product->id;
                $attribute->color_id = $color_id;
                $attribute->size_id = $request->size_id[$key];
                $attribute->quantity = $request->quantity[$key];
                $attribute->regular_price = $request->regular_price[$key];
                if ($request->discount[$key] != '') {
                    $regular_price = $request->regular_price[$key];
                    $discount_amount = ($request->regular_price[$key] * $request->discount[$key]) / 100;
                    $sell_price = round($request->regular_price[$key] - $discount_amount);
                    $attribute->sell_price = $sell_price;
                    $attribute->discount = $request->discount[$key];
                }
                $attribute->save();
            }
        }
        return redirect()->route('products.index')->with('warning', 'Product Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorfail($id);
        // product thumbnail delete 
        $old_img = public_path('thumbnail_img/' . $product->thumbnail_img);
        if (file_exists($old_img)) {
            unlink($old_img);
        }
        // product image delete 
        $gallerys = $product->Gallery;
        foreach ($gallerys as  $gallery) {
            $old_img = public_path('product_image/' . $gallery->product_img);
            if (file_exists($old_img)) {
                unlink($old_img);
            }
            $gallery->delete();
        }
        // product attribute delete 
        $attributes = $product->Attribute;
        foreach ($attributes as  $attribute) {
            $attribute->delete();
        }
        // product flavour delete 
        $flavours = $product->Flavour;
        foreach ($flavours as  $flavour) {
            $flavour->delete();
        }

        $product->delete();
        return back()->with('delete', 'Product Deleted Successfully');
    }
    public function GetSubcatbyAjax($cat_id)
    {
        // dependency dropdown by catagory
     return   $subcatagories  = Subcatagory::select('id', 'subcatagory_name')->where('catagory_id', $cat_id)->latest('id')->get();
        return response()->json($subcatagories);
    }
    public function ProductImagesDelete($id)
    {
        $gallery = Gallery::findorfail($id);
        $old_img = public_path('product_image/' . $gallery->product_img);
        if (file_exists($old_img)) {
            unlink($old_img);
        }
        $gallery->delete();
        return back();
    }
    // public function ProductFlavourDelete($id)
    // {
    //     $Flavour = Flavour::findorfail($id);
    //     $Flavour->delete();
    //     return back();
    // }
    public function ProducvtAtributeDelete($id)
    {
        $Attribute = Attribute::findorfail($id);
        $Attribute->delete();
        return back();
    }
    public function MarkdeleteProduct(Request $request)
    {
        // return $request;
        if ($request->filled('delete')) {
            foreach ($request->delete as $key => $id) {

                $product = Product::findorfail($id);
                // product thumbnail delete 
                $old_img = public_path('thumbnail_img/' . $product->thumbnail_img);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
                // product image delete 
                $gallerys = $product->Gallery;
                foreach ($gallerys as  $gallery) {
                    $old_img = public_path('product_image/' . $gallery->product_img);
                    if (file_exists($old_img)) {
                        unlink($old_img);
                    }
                    $gallery->delete();
                }
                // product attribute delete 
                $attributes = $product->Attribute;
                foreach ($attributes as  $attribute) {
                    $attribute->delete();
                }
                // product flavour delete 
                $flavours = $product->Flavour;
                foreach ($flavours as  $flavour) {
                    $flavour->delete();
                }

                $product->delete();
                return back()->with('delete', 'Product Deleted Successfully');
            }
        } else {
            return back()->with('warning', 'No Item Selected');
        }
    }
    public function ProductStaus($id)
    {
        $product = Product::findorfail($id);
        if ($product->status == 1) {
            $product->status = 2;
            $product->save();
            return back()->with('warning', 'Product Inactive Successfully');
        } else {
            $product->status = 1;
            $product->save();

            return back()->with('success', 'Product Active Successfully');
        }
    }
}
