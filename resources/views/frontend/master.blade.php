<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title',$setting->meta_title) </title>
        <meta name="title" content="@yield('title',$setting->meta_title) ">
        <meta name="description" content="@yield('meta_description',$setting->meta_description)">
        <meta name="keyword" content="@yield('meta_keyword',$setting->meta_keyword)">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta property="og:title" content="@yield('title',$setting->meta_title)" />
        <meta property="og:description" content="@yield('meta_description',$setting->meta_description)" />
        <meta property="og:url" content="{{url()->current()}}" />
        <meta property="og:site_name" content="@yield('title',$setting->meta_title)" />
        <meta property="og:type" content="website" />
        @yield('social_thumbnail')
        <link rel="canonical" href="{{url()->current()}}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('logo/'.$setting->site_logo) }}">
        <!-- Place favicon.ico in the root directory -->
        <!-- all css here -->
        <!-- bootstrap v4.0.0-beta.2 css -->
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
        <!-- owl.carousel.2.0.0-beta.2.4 css -->
        <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
        <!-- font-awesome v4.6.3 css -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
        <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
        <link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- flaticon.css -->
        <link rel="stylesheet" href="{{ asset('front/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('front/css/corner-popup.min.css') }}">
        <!-- jquery-ui.css -->
        <link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
        <!-- metisMenu.min.css -->
        <link rel="stylesheet" href="{{ asset('front/css/metisMenu.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/css/selectsearch.css') }}">
        <!-- swiper.min.css -->
        <link rel="stylesheet" href="{{ asset('front/css/swiper.min.css') }}">
        <!-- style css -->
        <link rel="stylesheet" href="{{ asset('front/css/styles.css') }}">
        <!-- responsive css -->
        <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
        <!-- modernizr css -->
        <script src="{{ asset('front/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    </head>

    <body>
        <style>
            .dropdown_style li a:hover {
                padding-left: 0;
            }
            .logo a img{
                width: 55%;
            }

        </style>
        <!-- search-form here -->
        <div class="search-area flex-style">
            <span class="closebar">Close</span>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 col-12">
                        <div class="search-form">
                            <form action="{{route('Frontendhome')}}">
                                <input name="search" type="text" placeholder="Search Here...">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- search-form here -->
        <!-- header-area start -->
        <header class="header-area" id="sticky-header">
            {{-- <div class="header-top bg-2">
                <div class="fluid-container">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <ul class="d-flex header-contact">
                                <li><i class="fa fa-phone"></i> {{$setting->number}}</li>
            <li><i class="fa fa-envelope"></i> {{$setting->email}} </li>
            </ul>
            </div>
            <div class="col-md-6 col-12">
                <ul class="d-flex account_login-area">
                    @auth
                    <li>
                        <a href="{{route('FrontendProfile')}}">
                            <i class="fa fa-user "><span class="pl-2">Profile</span></i>
                        </a>
                    </li>
                    @else
                    <li><a href="{{ route('login') }}"> Login/Register </a></li>
                    @endauth
                </ul>
            </div>
            </div>
            </div>
            </div> --}}
            <div class="container">

                <div class="row mt-2">
                    <div class="col-lg-3 mb-2 col-12 col-sm-12">
                        <i style="font-size: medium" class="fa fa-mobile"> : {{$setting->number}}</i>
                    </div>
                    <div class="col-lg-3 col-6 col-sm-6">
                        <ul class="d-flex">
                            @if ($setting->facebook_link != '')
                            <li><a class="pr-2 ml-2" target="_blank" href="{{$setting->facebook_link}}"><i
                                        style="font-size: small" class="fa fa-facebook"></i></a></li>
                            @endif
                            @if ($setting->instagram_link != '')
                            <li><a class="pr-2" target="_blank" href="{{$setting->instagram_link}}"><i
                                        style="font-size: small" class="fa fa-instagram"></i></a></li>
                            @endif
                            @if ($setting->twitter_link != '')
                            <li><a class="pr-2" target="_blank" href="{{$setting->twitter_link}}"><i
                                        style="font-size: small" class="fa fa-twitter"></i></a></li>
                            @endif
                            @if ($setting->youtube_link != '')
                            <li><a class="pr-2" target="_blank" href="{{$setting->youtube_link}}"><i
                                        style="font-size: small" class="fa fa-youtube"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    <div class=" text-right col-lg-6 col-6 col-sm-6">
                        <a class="ml-2" href="{{route('login')}}">Login/Register</a>
                    </div>
                </div>
            </div>
            <div class="header-bottom sticky sticky--top">
                <div class="fluid-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                            <div class="logo">
                                <a href="{{route('Frontendhome')}}">
                                    <img src="{{ asset('logo/'.$setting->site_logo) }}" alt="{{config('app.name')}}">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7 d-none d-lg-block">
                            <nav class="mainmenu">
                                <ul class="d-flex">
                                    <li class="{{ route('Frontendhome') == url()->current() ? 'active' : '' }}"><a
                                            href="{{ route('Frontendhome') }}">Home</a></li>
                                    <li>
                                        <a href="{{ route('Frontendshop') }}">Shop <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown_style">
                                            @forelse ($catagory_menu->take(5) as $cat )
                                            <li>
                                                <a
                                                    href="{{route('CategorySearch',$cat->slug)}}">{{$cat->catagory_name}}</a>
                                            </li>
                                            @empty

                                            @endforelse
                                        </ul>
                                    </li>
                                    <li><a class="{{route('FrontendCertified') == url()->current() ? 'active' : ''}}"
                                            href="{{route('FrontendCertified')}}">Sports Certified</a>
                                    </li>
                                    <li class="{{route('Frontendblog') == url()->current() ? 'active' : ''}}">
                                        <a href="{{route('Frontendblog')}}">Blog </a>
                                    </li>
                                    <li class="{{route('CartView') == url()->current() ? 'active' : ''}}">
                                        <a href="{{route('CartView')}}">
                                            <i class="fa fa-shopping-cart"></i>
                                            Cart</a>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                        <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                            <ul class="search-cart-wrapper d-flex">

                                <li class="search-tigger"><a href="javascript:void(0);"><i
                                            class="flaticon-search"></i></a>
                                </li>
                                @auth
                                {{-- wishlist start --}}
                                <li>
                                    <a href="javascript:void(0);"><i class="flaticon-like"></i>
                                        <span>{{wish_list_count()}}</span></a>
                                    <ul class="cart-wrap dropdown_style">
                                        @forelse (wish_list_products() as $wish_list)
                                        @php
                                        $Attribute =$wish_list->Product->Attribute
                                        ->where('color_id',$wish_list->color_id)
                                        ->where('size_id',$wish_list->size_id)->first();
                                        @endphp
                                        @if ($Attribute != '')
                                        <li class="cart-items">
                                            <div>
                                                <img style="width:40%;margin-right:10px;float: left;"
                                                    src="{{ asset('thumbnail_img/' . $wish_list->Product->thumbnail_img) }}"
                                                    alt="{{ $wish_list->Product->title }}">
                                            </div>
                                            <div class="cart-content">
                                                <a
                                                    href="{{ route('SingleProductView', $wish_list->Product->slug) }}">{{ $wish_list->Product->title }}</a>
                                                <span>QTY : {{ $wish_list->quantity }}</span>
                                                <p>৳

                                                    @php
                                                    $regular_price =$Attribute->regular_price;
                                                    $sell_price = $Attribute->sell_price;
                                                    @endphp
                                                    {{($sell_price == '')? $regular_price : $sell_price}}
                                                </p>
                                                <a href="{{route('WishlistRemove',$wish_list->id)}}" title="Remove"
                                                    class="remove">
                                                    <i class="fa fa-times"></i>
                                                </a>

                                            </div>
                                        </li>
                                        @endif
                                        @empty
                                        <li>
                                            No Product In Your Wishlist
                                        </li>
                                        @endforelse
                                        <li>
                                            <a class="btn btn-regular"
                                                onMouseOver="this.style.color='white',this.style.backgroundColor='#ef4836'"
                                                onMouseOut="this.style.backgroundColor='#FFFFFF',this.style.color='#ef4836'"
                                                style="background-color:white;color:#ef4836"
                                                href="{{route('WishlistView')}}">
                                                View Wishlist
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- wishlist end --}}
                                @endauth
                                <li>
                                    {{-- ###########cart list############# --}}
                                    <a href="javascript:void(0);"><i class="flaticon-shop"></i>
                                        <span>{{ cart_total_product() }}</span></a>

                                    <ul class="cart-wrap dropdown_style">
                                        @forelse (cart_product_view() as $cart_product)
                                        @php
                                        $Attribute =$cart_product->Product->Attribute
                                        ->where('color_id',$cart_product->color_id)
                                        ->where('size_id',$cart_product->size_id)->first();
                                        @endphp
                                        @if ($Attribute != '')
                                        <li class="cart-items">
                                            <div>
                                                <img style="width:40%;margin-right:10px;float: left;"
                                                    src="{{ asset('thumbnail_img/' . $cart_product->Product->thumbnail_img) }}"
                                                    alt="{{ $cart_product->Product->title }}">
                                            </div>
                                            <div class="cart-content">
                                                <a
                                                    href="{{ route('SingleProductView', $cart_product->Product->slug) }}">{{ $cart_product->Product->title }}</a>
                                                <span>QTY : {{ $cart_product->quantity }}</span>
                                                <p>৳
                                                    @php
                                                    $regular_price =$Attribute->regular_price;
                                                    $sell_price = $Attribute->sell_price;
                                                    @endphp
                                                    {{($sell_price == '')? $regular_price : $sell_price}}
                                                </p>
                                                <a href="{{route('CartDelete',$cart_product->id)}}" title="Remove"
                                                    class="remove">
                                                    <i class="fa fa-times"></i>
                                                </a>

                                            </div>
                                        </li>
                                        @endif
                                        @empty
                                        <li>
                                            No Product In Your Cart
                                        </li>
                                        @endforelse

                                        <li>
                                            <a class="btn btn-regular"
                                                onMouseOver="this.style.color='white',this.style.backgroundColor='#ef4836'"
                                                onMouseOut="this.style.backgroundColor='#FFFFFF',this.style.color='#ef4836'"
                                                style="background-color:white;color:#ef4836"
                                                href="{{route('CartView')}}">View
                                                Cart</a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- ###########cart list############# --}}
                            </ul>
                        </div>
                        <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                            <div class="responsive-menu-tigger">
                                <a href="javascript:void(0);">
                                    <span class="first"></span>
                                    <span class="second"></span>
                                    <span class="third"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- responsive-menu area start -->
                <div class="responsive-menu-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-block d-lg-none">
                                <ul class="metismenu">

                                    <li><a href="{{route('Frontendhome')}}">Home</a></li>
                                    <li class="sidemenu-items">
                                        <a class="has-arrow" aria-expanded="false" href="{{route('Frontendshop')}}">Shop
                                        </a>
                                        <ul aria-expanded="false" class="collapse">
                                            @forelse ($catagory_menu as $cat)
                                            <li><a
                                                    href="{{route('CategorySearch',$cat->slug)}}">{{$cat->catagory_name}}</a>
                                            </li>
                                            @empty
                                            <li>No Catagory</li>
                                            @endforelse
                                        </ul>
                                    </li>
                                    <li><a href="{{route('FrontendCertified')}}">Sports Certiified</a></li>
                                    <li><a href="{{route('Frontendblog')}}">Blog</a></li>
                                    <li><a href="{{route('CartView')}}">Cart</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- responsive-menu area start -->
            </div>
        </header>
        <!-- header-area end -->
        @yield('content')
        <!-- start social-newsletter-section -->
        <section class="social-newsletter-section" style="background-color: #ffdd2e;padding: 50px 0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <div class="newsletter text-left">
                            <h3 style="color: black;margin-bottom:0">Subscribe Newsletter</h3>
                            <p style="color: black">
                                Receive the latest news, offers and deals going on at {{config('app.name')}}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="newsletter-form">
                            <form action="{{route('FrontendNewsLetter')}}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input type="email" required style="padding: 10px 20px" name="email"
                                        class="form-control" placeholder="Enter Your Email Address...">
                                    <button style="padding: 5px 15px;background-color:black;color:white"
                                        type="submit">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end container -->
        </section>
        <!-- end social-newsletter-section -->
        <!-- .footer-area start -->
        <div class="footer-area">
            <div class="footer-top">
                <div class="container">
                    <div class="footer-top-item">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="footer-top-text text-center">
                                    <ul>
                                        <li><a href="{{route('Frontendhome')}}">home</a></li>
                                        <li><a href="{{route('FrontendAbout')}}">about us</a></li>
                                        <li><a href="{{route('Frontendshop')}}">shop</a></li>
                                        <li><a href="{{route('Frontendblog')}}">blog</a></li>
                                        <li><a href="{{route('FrontndContact')}}">contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-12">
                            <div class="footer-icon">
                                <ul class="d-flex">
                                    @if ($setting->facebook_link != '')
                                    <li><a target="_blank" href="{{$setting->facebook_link}}"><i
                                                style="font-size: large" class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if ($setting->instagram_link != '')
                                    <li><a target="_blank" href="{{$setting->instagram_link}}"><i
                                                style="font-size: large" class="fa fa-instagram"></i></a></li>
                                    @endif
                                    @if ($setting->twitter_link != '')
                                    <li><a target="_blank" href="{{$setting->twitter_link}}"><i style="font-size: large"
                                                class="fa fa-twitter"></i></a></li>
                                    @endif
                                    @if ($setting->youtube_link != '')
                                    <li><a target="_blank" href="{{$setting->youtube_link}}"><i style="font-size: large"
                                                class="fa fa-youtube"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-8 col-sm-12">
                            <div class="footer-content">
                                <p>{{$setting->footer_text}}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-12">
                            <div class="footer-adress">
                                <ul>
                                    <li><a><span>Email:</span> {{$setting->email}}</a></li>
                                    <li><a><span>Tel: </span>{{$setting->number}}</a></li>
                                    <li><a><span>Adress: </span> {{$setting->address}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="footer-reserved">
                                <ul>
                                    <li>Copyright © {{now()->format('Y')}} {{config('app.name')}} All rights reserved.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Messenger Chat plugin Code -->

        <div class="newsletter-overlay">
            <div id="newsletter-popup">
                <a href="#" class="popup-close">X</a>
                <div class="newsletter-in">
                    <h3>Join our Newsletter!</h3>
                    <form class="validate" method="post" action="{{route('FrontendNewsLetter')}}">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="email" placeholder="Enter Your Email Address..." autofocus
                                id="nsw_email" name="email" required="">
                        </div>
                        <div class="frm-submit">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Your Chat plugin code -->
        <!-- Messenger Chat plugin Code -->
        <div id="fb-root"></div>

        <!-- Your Chat plugin code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <script>
            var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "661548170721498");
  chatbox.setAttribute("attribution", "biz_inbox");
        </script>

        <!-- Your SDK code -->
        <script>
            window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v12.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
        </script>
        <!-- .footer-area end -->

        <!-- jquery latest version -->
        <script src="{{ asset('front/js/vendor/jquery-2.2.4.min.js') }}"></script>
        <!-- bootstrap js -->
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
        <!-- owl.carousel.2.0.0-beta.2.4 css -->
        <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
        <!-- scrollup.js -->
        <script src="{{ asset('front/js/scrollup.js') }}"></script>
        <!-- isotope.pkgd.min.js -->
        <script src="{{ asset('front/js/isotope.pkgd.min.js') }}"></script>
        <!-- imagesloaded.pkgd.min.js -->
        <script src="{{ asset('front/js/imagesloaded.pkgd.min.js') }}"></script>
        <!-- jquery.zoom.min.js -->
        <script src="{{ asset('front/js/jquery.zoom.min.js') }}"></script>
        <!-- countdown.js -->
        <script src="{{ asset('front/js/countdown.js') }}"></script>
        <!-- swiper.min.js -->
        <script src="{{ asset('front/js/swiper.min.js') }}"></script>
        {{-- <script src="{{ asset('front/js/price_range_script.js') }}"></script> --}}
        <!-- metisMenu.min.js -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('front/js/metisMenu.min.js') }}"></script>
        <!-- mailchimp.js -->
        <script src="{{ asset('front/js/mailchimp.js') }}"></script>
        <!-- jquery-ui.min.js -->
        <script src="{{ asset('front/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('front/js/corner-popup.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- main js -->

        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <script src="{{ asset('front/js/selectsearch.js') }}"></script>
        <script src="{{ asset('front/js/scripts.js') }}"></script>

        @yield('script_js')
        <script>
            @guest
        
        var delay = 1000; //in milleseconds
        jQuery(document).ready(function($){
          setTimeout(function(){ showNewsletterPopup(); }, delay);
          
          $('.popup-close').click(function(){
              $('.newsletter-overlay').hide();
              
              //when closed create a cookie to prevent popup to show again on refresh
              setCookie('newsletter-popup', 'popped', 30);
          });
        });
        
        function showNewsletterPopup(){
          if( getCookie('newsletter-popup') == ""){
             $('.newsletter-overlay').show();
             setCookie('newsletter-popup', 'popped', 30);
          }
          else{
            console.log("Newsletter popup blocked.");
          }
        }
        
        
        function setCookie(cname,cvalue,exdays)
        {
            var d = new Date();
            d.setTime(d.getTime()+(exdays*24*60*60*100));
            var expires = "expires="+d.toGMTString();
            document.cookie = cname+"="+cvalue+"; "+expires+"; path=/";
        }
        
        function getCookie(cname)
        {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i<ca.length; i++) 
            {
                var c = jQuery.trim(ca[i]);
                if (c.indexOf(name)==0) return c.substring(name.length,c.length);
            }
            return "";
        }
                $.fn.cornerpopup({
                    variant: 1,
                    slide: 1,
                    popupImg: '{{asset('icon/unnamed.png')}}',
                    position : 'left',
                    header : '<h6>Continue With Google</h6>',
                    link1: '{{route('GoogleRegister')}}',
                    colors : '#ef4836',
                    delay:70000,    
                    slide:true,
                    button1 :'Continue',
             });

             @if (session('subscribe'))
            Swal.fire(
                'Thanks',
                '{{session("subscribe")}}',
                'success'
            )
             @endif
        @endguest
        </script>

    </body>

</html>