<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\AboutSite;
use App\Models\Banner;
use App\Models\BestDeal;
use App\Models\BestDealProduct;
use App\Models\Blog;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\BlogComment;
use App\Models\BlogReply;
use App\Models\Brand;
use App\Models\Newsletter;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    function Frontendhome(Request $request)
    {
     return view('frontend.main');
    }
   
}
