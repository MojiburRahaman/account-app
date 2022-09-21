{{-- @extends('frontend.master')
@section('title')
{{config('app.name')}} - Login
@endsection
@section('content')
<!-- checkout-area start -->
<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $item)
                    {{$item}}
                    @endforeach
                </div>
                @endif
                @if (session('warning'))
                <div class="alert alert-danger">{{session('warning')}}</div>

                @endif
                <div class="account-form form-style">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-0">

                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus />
                        </div>
                        <div class="form-group">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="current-password" />
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="remember">
                                <span for="remember_me" class=" text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="{{ route('password.request') }}">Forget Your Password?</a>
                            </div>
                        </div>
                        <button type="submit">SIGN IN</button>
                    </form>
                    <div class="text-center">
                        <div class="col-lg-12 col-12">
                            <a class="btn btn-regular mb-4 ptb-2" href="{{route('GoogleLogin')}}"><img width="7%"
                                    src="{{asset('icon/unnamed.png')}}" alt="google">Login with Google</a>
                        </div>
                        <a href="{{route('register')}}">Or Creat an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,100,200,300);

        * {
            margin: 0;
            padding: 0;
        }

        a {
            color: #666;
            text-decoration: none;
        }

        a:hover {
            color: #4FDA8C;
        }

        input {
            font: 14px/26px "Raleway", sans-serif;
        }

        body {
            color: #666;
            background-color: #f1f2f2;
            font: 14px/26px "Raleway", sans-serif;
        }

        .form-wrap {
            background-color: #fff;
            width: 320px;
            margin: 3em auto;
            box-shadow: 0px 1px 8px #BEBEBE;
            -webkit-box-shadow: 0px 1px 8px #BEBEBE;
            -moz-box-shadow: 0px 1px 8px #BEBEBE;
        }

        .form-wrap .tabs {
            overflow: hidden;
        }

        .form-wrap .tabs h3 {
            float: left;
            width: 50%;
        }

        .form-wrap .tabs h3 a {
            padding: 0.5em 0;
            text-align: center;
            font-weight: 400;
            background-color: #e6e7e8;
            display: block;
            color: #666;
            font-size: 20px
        }

        .form-wrap .tabs h3 a.active {
            background-color: #fff;
        }

        .form-wrap .tabs-content {
            padding: 1.5em;
        }

        .form-wrap .tabs-content div[id$="tab-content"] {
            display: none;
        }

        .form-wrap .tabs-content .active {
            display: block !important;
        }

        .form-wrap form .input {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            color: inherit;
            font-family: inherit;
            padding: .8em 0 10px .8em;
            border: 1px solid #CFCFCF;
            outline: 0;
            display: inline-block;
            margin: 0 0 .8em 0;
            padding-right: 2em;
            width: 100%;
        }

        .form-wrap form .button {
            width: 100%;
            padding: .8em 0 10px .8em;
            background-color: #28A55F;
            border: none;
            color: #fff;
            cursor: pointer;
            text-transform: uppercase;
        }

        .form-wrap form .button:hover {
            background-color: #4FDA8C;
        }

        .form-wrap form .checkbox {
            visibility: hidden;
            padding: 20px;
            margin: .5em 0 1.5em;
        }

        .form-wrap form .checkbox:checked+label:after {
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
            filter: alpha(opacity=100);
            opacity: 1;
        }

        .form-wrap form label[for] {
            position: relative;
            padding-left: 20px;
            cursor: pointer;
        }

        .form-wrap form label[for]:before {
            content: '';
            position: absolute;
            border: 1px solid #CFCFCF;
            width: 17px;
            height: 17px;
            top: 0px;
            left: -14px;
        }

        .form-wrap form label[for]:after {
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
            opacity: 0;
            content: '';
            position: absolute;
            width: 9px;
            height: 5px;
            background-color: transparent;
            top: 4px;
            left: -10px;
            border: 3px solid #28A55F;
            border-top: none;
            border-right: none;
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .form-wrap .help-text {
            margin-top: .6em;
        }

        .form-wrap .help-text p {
            text-align: center;
            font-size: 14px;
        }
    </style>


    {{-- <div class="container">
        <div class="row">
            <div class="col-12">

                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $item)
                    {{$item}}
                    @endforeach
                </div>
                @endif
                @if (session('warning'))
                <div class="alert alert-danger">{{session('warning')}}</div>

                @endif
            </div>
        </div>
    </div> --}}
    <h1 style="font-size: 8vw; text-align:center; color:#007CC3;">Asiatic Laboratories Ltd.</h1>
    <div class="form-wrap">
        <div class="tabs">
            <h3 class="signup-tab"><a href="#signup-tab-content">Sign Up</a></h3>
            <h3 class="login-tab"><a class="active" href="#login-tab-content">Login</a></h3>
        </div>
        <!--.tabs-->

        <div class="tabs-content">
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $item)
                {{$item}}
                @endforeach
            </div>
            @endif
            @if (session('warning'))
            <div class="alert alert-danger">{{session('warning')}}</div>
            @endif
            {{-- <div class="alert alert-danger">{{session('warning')}}</div> --}}
            <div id="signup-tab-content">

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="text" autofocus class="input" id="user_name" name="name" autocomplete="off" placeholder="Name">
                    <input type="email" name="email" class="input" id="user_email" autocomplete="off" placeholder="Email">
                    <input type="password" name="password" class="input" id="user_pass" autocomplete="off" placeholder="Password">
                    <input type="password" name="password_confirmation" class="input" id="user_pass" autocomplete="off" placeholder="Confirm Password">
                    <input type="submit" class="button" value="Sign Up">
                </form>
                <!--.login-form-->
                <!--.help-text-->
            </div>
            <!--.signup-tab-content-->

            <div id="login-tab-content" class="active">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="email" name="email" spellcheck="true" class="input" id="user_login" autocomplete="off" placeholder="Email" autofocus>
                    <input type="password" name="password" class="input" id="user_pass" autocomplete="off" placeholder="Password">
                    <input  name="remember" type="checkbox" class="checkbox" id="remember_me">
                    <label for="remember_me">Remember me</label>

                    {{-- <input type="submit" class="button" value="Login"> --}}
                    <button class="button" type="submit">Login</button>
                </form>
      
            </div>
            <!--.login-tab-content-->
        </div>
        <!--.tabs-content-->
    </div>
    <!--.form-wrap-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        jQuery(document).ready(function($) {
	tab = $('.tabs h3 a');

	tab.on('click', function(event) {
		event.preventDefault();
		tab.removeClass('active');
		$(this).addClass('active');

		tab_content = $(this).attr('href');
		$('div[id$="tab-content"]').removeClass('active');
		$(tab_content).addClass('active');
	});
});
    </script>
</body>

</html>