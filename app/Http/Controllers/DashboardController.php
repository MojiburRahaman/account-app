<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Newsletter;
use App\Models\Order_Summaries;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Payment::whereDate('created_at', Carbon::today())->sum('amount');
        $order = Payment::get();
        $user = User::role('Customer')->get()->count();
        // $user = Role::where('name', 'Customer')->count();
        return view('backend.main', [
            'order' => $order,
            'today' => $today,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function AdminChangePassword()
    {
        return view('backend.change-password');
    }
    public function AdminChangePasswordPost(Request $request)
    {
        $request->validate([
            'current_pass' => ['required', 'min:8'],
            'new_pass' => ['required', 'min:8', Password::min(8)],
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
    public function AdminLogin()
    {
        return view('backend.login');
    }
    public function AdminLoginPost(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8),],
        ]);
        $email = strip_tags($request->email);
        $password = strip_tags($request->password);
        $user =  User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                abort_if($user->roles->first()->name == 'Customer', 404);
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    return redirect()->route('dashboard.index');
                }
            }
            return 'ok';
        }
        return back();
    }
}
