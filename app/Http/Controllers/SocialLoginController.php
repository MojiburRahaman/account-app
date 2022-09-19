<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
    function GoogleRegister()
    {
        return Socialite::driver('google')->redirect();
    }
    function GoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    function GoogleCallbackUrlRegister()
    {
        $user_detail = Socialite::driver('google')->user();
        $users =   User::where('email', $user_detail->getEmail())->first();
        if ($users == '') {
            $user = new User;
            $user->name = $user_detail->getName();
            $user->email = $user_detail->getEmail();
            $user->email_verified_at = now();
            $user->password = bcrypt($user_detail->getEmail() . now());
            $user->save();

            $user->assignrole('Customer');
            Auth::login($user);
            
            return redirect('/');
        } else {
            Auth::login($users);
            return redirect('/');
        }
    }
}
