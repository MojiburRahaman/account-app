<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('View Coupon')) {
            # code...
            return view('backend.coupon.index', [
                'coupons' => Coupon::all()
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
        if (auth()->user()->can('Create Coupon')) {
            return view('backend.coupon.create');
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
        if (auth()->user()->can('Create Coupon')) {
            $request->validate([
                'coupon_name' => ['required', 'unique:coupons,coupon_name'],
                'coupon_amount' => ['required','min:2', 'max:98', 'numeric'],
                'coupon_limit' => ['min:2', 'numeric', 'nullable'],
                'coupon_expire_date' => ['date','required', 'after:tomorrow', 'nullable']
            ]);
            
            $coupon = new Coupon;
            $coupon->coupon_name = $request->coupon_name;
            $coupon->coupon_amount = $request->coupon_amount;
            $coupon->coupon_expire_date = $request->coupon_expire_date;
            $coupon->coupon_limit = $request->coupon_limit;
            $coupon->save();
            return redirect('/coupons')->with('success', 'Coupon Added Successfully');
        } else {
            abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        if (auth()->user()->can('View Coupon')) {
            return view('backend.coupon.show', compact('coupon'));
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        if (auth()->user()->can('Edit Coupon')) {
            return view('backend.coupon.edit', compact('coupon'));
        } else {
            abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        if (auth()->user()->can('Edit Coupon')) {
            $request->validate([
                'coupon_name' => ['required', 'unique:coupons,coupon_name,' . $coupon->id],
                'coupon_amount' => ['required', 'min:2', 'max:98', 'numeric'],
                'coupon_limit' => ['min:2', 'numeric', 'nullable'],
                'coupon_expire_date' => ['date:', 'after:tomorrow', 'nullable']
            ]);
            $coupon->coupon_name = $request->coupon_name;
            $coupon->coupon_amount = $request->coupon_amount;
            $coupon->coupon_expire_date = $request->coupon_expire_date;
            $coupon->coupon_limit = $request->coupon_limit;
            $coupon->save();
            return redirect('/coupon')->with('success', 'Coupon Edited Successfully');
        } else {
            abort('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        if (auth()->user()->can('Delete Coupon')) {
            // return $coupon;
            $coupon->delete();
            return back()->with('warning', 'Coupon Deleted Successfully');
        } else {
            abort('404');
        }
    }
    function markdeletecoupon(Request $request)
    {
        if (auth()->user()->can('Delete Coupon')) {
            if (isset($request->test)) {
                if ($request->filled('delete')) {
                    foreach ($request->delete as $value) {
                        $cat = Coupon::findorfail($value)->delete();
                    }
                    return back()->with('warning', "Coupon Deleted Successfully");
                } else {
                    return back()->with('warning', 'Please Select at least one item');
                }
            }
        } else {
            abort('404');
        }
    }
}
