<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\BestDeal;
use App\Models\BestDealProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BestDealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('View Deals')) {
            $best_deals = BestDeal::latest('id')->get();
            return view('backend.deals.index', compact('best_deals'));
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
        if (auth()->user()->can('View Deals')) {
            $products = Product::where('status', 1)->select('id', 'title')->latest('id')->get();
            return view('backend.deals.create', compact('products'));
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
        if (auth()->user()->can('View Deals')) {
            $request->validate([
                'date' => ['date', 'required',],
                'time' => ['required',],
                'discount' => ['required', 'numeric', 'min:2', 'max:99'],
                'title' => ['required',],
                'product_id.*' => ['required'],
            ]);
            if ($request->product_id != '') {
                $deal = new BestDeal;
                $deal->title = $request->title;
                $deal->discount = $request->discount;
                $deal->expire_date = $request->date;
                $deal->expire_time = $request->time;
                if ($request->deal_banner != '') {
                    if ($request->hasFile('deal_banner')) {
                        $deal_banner = $request->file('deal_banner');
                        $extension = config('app.name') . '-' . Str::random(2) . '.' . $deal_banner->getClientOriginalExtension();
                        Image::make($deal_banner)->save(public_path('deal_banner/' . $extension), 90);
                        $deal->deal_banner = $extension;
                    }
                } else {
                    $request->validate(['deal_backgraound_color' => ['required']]);
                    $deal->deal_backgraound_color = $request->deal_backgraound_color;
                }
                $deal->save();

                foreach ($request->product_id as $key => $product_id) {

                    $attributes = Attribute::where('product_id', $product_id)->get();
                    foreach ($attributes as $key => $attribute) {
                        $attribute->discount = $request->discount;
                        $discount_amount = ($attribute->regular_price * $request->discount) / 100;
                        $sell_price = round($attribute->regular_price - $discount_amount);
                        $attribute->sell_price = $sell_price;
                        $attribute->save();
                    }
                    $deal_product = new BestDealProduct;
                    $deal_product->best_deal_id = $deal->id;
                    $deal_product->product_id = $product_id;
                    $deal_product->save();
                }
                return redirect()->route('deals.index')->with('success', 'Added Successfully');
            };
            return back();
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
        if (auth()->user()->can('View Deals')) {
            $BestDeal =  BestDeal::findorfail($id);
            if ($BestDeal->status == 1) {
                $best_deal_product = BestDealProduct::where('best_deal_id', $BestDeal->id)->get();
                foreach ($best_deal_product as $key => $deal_product) {
                    $attributes = Attribute::where('product_id', $deal_product->product_id)->get();
                    foreach ($attributes as $key => $attribute) {
                        $attribute->discount = '';
                        $attribute->sell_price = '';
                        $attribute->save();
                    }
                }
                $BestDeal->status = 2;
                $BestDeal->save();
                return back()->with('warning', 'Inactive Successfully');
            } else {

                if (Carbon::today()->format('Y-m-d') > $BestDeal->expire_date) {
                    return back()->with('warning', 'Out of Date');;
                }
                $best_deal_product = BestDealProduct::where('best_deal_id', $BestDeal->id)->get();
                foreach ($best_deal_product as $key => $deal_product) {
                    $attributes = Attribute::where('product_id', $deal_product->product_id)->get();
                    foreach ($attributes as $key => $attribute) {
                        $attribute->discount = $BestDeal->discount;
                        $discount_amount = ($attribute->regular_price * $BestDeal->discount) / 100;
                        $sell_price = round($attribute->regular_price - $discount_amount);
                        $attribute->sell_price = $sell_price;
                        $attribute->save();
                    }
                }
                $BestDeal->status = 1;
                $BestDeal->save();
                return back()->with('success', 'Active Successfully');
            }
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('View Deals')) {
            $BestDeal =  BestDeal::findorfail($id);
            if ($BestDeal->deal_banner) {
                $old_banner = public_path('deal_banner/' . $BestDeal->deal_banner);
                if (file_exists($old_banner)) {
                    unlink($old_banner);
                }
            }
            $best_deal_product = BestDealProduct::where('best_deal_id', $BestDeal->id)->get();
            foreach ($best_deal_product as $key => $deal_product) {
                $attributes = Attribute::where('product_id', $deal_product->product_id)->get();
                foreach ($attributes as $key => $attribute) {
                    $attribute->discount = '';
                    $attribute->sell_price = '';
                    $attribute->save();
                }
                $deal_product->delete();
            }
            $BestDeal->delete();
            return back()->with('delete', 'Deleted Successfully');
        } else {
            abort('404');
        }
    }
}
