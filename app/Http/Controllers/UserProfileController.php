<?php

namespace App\Http\Controllers;

use App\Models\billing_details;
use App\Models\Order_Summaries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{

    function FrontendProfile(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $orders = billing_details::where('user_id', auth()->id())
                ->with('order_summaries')->latest('id')->paginate(10);
                $view = view('frontend.Profile.order-list-pagination-data', [
                    'orders' => $orders,
                ])->render();
                return response()->json(['html' => $view,]);
            }
           $orders = billing_details::where('user_id', auth()->id())
                ->with('order_summaries')->latest('id')->paginate(10);
        return view('frontend.Profile.customer-profile', [
            'orders' => $orders,
        ]);
    }
    function ChangeUserPass(Request $request)
    {
        $request->validate([
            'current_pass' => ['required', 'min:8'],
            'new_pass' => ['required', Password::min(8)],
            'confirm_pass' => ['required', 'same:new_pass', 'min:8'],
        ], [
            'current_pass.min' => 'Current Password must be minimum 8 Charecter',
            'current_pass.required' => 'Current Password field required',
            'new_pass.required' => 'New Password field required',
            'new_pass.min' => 'New Password must be minimum 8 Charecter',
            'confirm_pass.min' => 'Confirm Password must be minimum 8 Charecter',
            'confirm_pass.min' => 'Confirm Password must be minimum 8 Charecter',
        ]);
        $current_pass = strip_tags($request->current_pass);
        $new_pass = strip_tags($request->new_pass);
        $confirm_pass = strip_tags($request->confirm_pass);
        $user = auth()->user();

        if (Hash::check($current_pass, $user->password)) {
            $user->update([
                'password' => bcrypt($new_pass),
            ]);
            return back()->with('success', 'Password Updated Successfully');
        } else {

            return back()->with('warning', 'Password not matched');
        }
    }
}
