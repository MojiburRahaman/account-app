<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Coupon;
use App\Models\Wishlist;

class CartController extends Controller
{
    function CartView($coupon_name = '')
    {
        $Carts = Cart::with(['Product.Attribute', 'Color:id,color_name', 'Size:id,size_name', 'Flavour:flavour_name,id'])
            ->Where('cookie_id', Cookie::get('cookie_id'))->withcount('Flavour')->latest('id')->get();
        $coupon = Coupon::where('coupon_name', $coupon_name)->first();
        $current_date = Carbon::today()->format('Y-m-d');
        if ($coupon_name == '') {
            $discount = 0;
        } else {
            if ($Carts->count() == '') {
                // if theres no product in cart
                return redirect('/cart/#coupon_section')->with('coupon_invalid', "There's No Product In Your Cart");
            } elseif (!Coupon::where('coupon_name', $coupon_name)->exists()) {
                // if theres no coupon name exist 
                return redirect('/cart/#coupon_section')->with('coupon_invalid', "There's No Coupon In This Name");
            } elseif ($current_date > $coupon->coupon_expire_date) {
                // coupon expire date checking
                return redirect('/cart/#coupon_section')->with('coupon_invalid', "Coupon Date Expired");
            } elseif ($coupon != '') {
                // if theres coupon name exist 
                $discount = $coupon->coupon_amount;
            }
        }
        return view('frontend.pages.cart', compact('Carts', 'discount', 'coupon_name'));
    }

    function CartPost(Request $request)
    {
        session()->forget('cart_total');
        $request->validate([
            'color_id' => ['required',],
            'size_id' => ['required',],

            'cart_quantity' => ['required',],
        ], [
            'color_id.required' => 'Please Choose a Color',
            'size_id.required' => 'Please Choose a Size'
        ]);
        if ($request->has('flavour_id')) {
            $request->validate([
                'flavour_id' => ['required'],
            ],[
                'flavour_id.required' => 'Please Choose a Flavour',
            ]);
        }

        if ($request->has('wish_list_id')) {
            $request->validate([
                'wish_list_id' => ['required'],
            ]);
            if ($request->wish_list_id != '') {
                Wishlist::findorfail($request->wish_list_id)->delete();
            }
        }

        if ($request->hasCookie('cookie_id')) {
            // if user has cookie
            $cookie_id_generate = $request->cookie('cookie_id');
        } else {
            // if user dont have cookie
            $cookie_id_generate = time() . Str::random(10);
            Cookie::queue('cookie_id', $cookie_id_generate, 129600);
        }
        $product_already_add = Cart::Where('cookie_id', Cookie::get('cookie_id'))
            ->Where('color_id', $request->color_id)
            ->Where('product_id', $request->product_id)
            ->Where('flavour_id', $request->flavour_id)
            ->Where('size_id', $request->size_id);
        if ($product_already_add->exists()) {
            // checking the product already added if added then update the quantitiy
            Cart::Where('cookie_id', Cookie::get('cookie_id'))
                ->Where('color_id', $request->color_id)
                ->Where('product_id', $request->product_id)
                ->Where('size_id', $request->size_id)
                ->Where('flavour_id', $request->flavour_id)
                ->increment('quantity', $request->cart_quantity);
            return back()->with('cart_added', 'Prodcut add to cart succcessfully');
        }
        // new data add
        $cart = new Cart;
        $cart->cookie_id = $cookie_id_generate;
        $cart->product_id = $request->product_id;
        $cart->flavour_id = $request->flavour_id;
        $cart->quantity = $request->cart_quantity;
        $cart->color_id = $request->color_id;
        $cart->size_id = $request->size_id;
        $cart->save();
        return back()->with('cart_added', 'Prodcut add to cart succcessfully');
    }
    function CartUpdate(Request $request)
    {
        $html ='';
        $request->validate([
            'cart_quantity' => ['required', 'numeric', 'min:1'],
            'cart_id' => ['required', 'numeric',]
        ]);
        $cart = Cart::findorfail($request->cart_id);
        $Attr = Attribute::where('product_id', $cart->product_id)
            ->where('color_id', $cart->color_id)
            ->where('size_id', $cart->size_id)
            ->select('regular_price', 'sell_price', 'quantity')->first();
        if ($Attr->quantity < $request->cart_quantity) {
            return response()->json($html);
        }
        $cart->quantity = $request->cart_quantity;
        $cart->save();

        if ($Attr->sell_price != '') {
            $price = $Attr->sell_price;
        } else {
            $price = $Attr->regular_price;
        }
        $html = '<span class="singlesub_price" >' . $price * $request->cart_quantity . '</span>';
        return response()->json($html);
    }
    function CartDelete($id)
    {
        Cart::findorfail($id)->delete();
        return back();
    }
    function CartClear(Request $request)
    {
        $carts = Cart::Where('cookie_id', Cookie::get('cookie_id'))->delete();
        return back()->with('warning', 'Shopping cart clear successfully');
    }
}
