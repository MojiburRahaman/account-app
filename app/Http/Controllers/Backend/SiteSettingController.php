<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Mail\Newsletter;
use App\Models\AboutSite;
use App\Models\Banner;
use App\Models\Newsletter as ModelsNewsletter;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.site-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('Subscriber')) {
            return view('backend.site-settings.create');
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
        // if (auth()->user()->can('Setting')) {
        $request->validate([
            'meta_title' => ['required', 'string', 'max:250'],
            'meta_description' => ['required', 'string', 'max:250'],
            'meta_keyword' => ['required', 'string', 'max:250'],
            'email' => ['required', 'string', 'max:250'],
            'number' => ['required',],
            'address' => ['required', 'string', 'max:250'],
            'facebook_link' => ['max:250'],
            'instagram_link' => ['max:250'],
            'footer_text' => ['required', 'string'],
            'site_logo' => ['required', 'mimes:png'],
        ]);

        $setting = new SiteSetting;
        $setting->meta_title = $request->meta_title;
        $setting->meta_description = $request->meta_description;
        $setting->meta_keyword = $request->meta_keyword;
        $setting->email = $request->email;
        $setting->number = $request->number;
        $setting->address = $request->address;
        $setting->facebook_link = $request->facebook_link;
        $setting->instagram_link = $request->instagram_link;
        $setting->footer_text = $request->footer_text;

        if ($request->hasFile('site_logo')) {
            $site_logo = $request->file('site_logo');
            $extension = config('app.name') . '-' . Str::random(2) . '.' . $site_logo->getClientOriginalExtension();
            Image::make($site_logo)->save(public_path('logo/' . $extension), 100);
            $setting->site_logo = $extension;
        }
        $setting->save();

        return back()->with('success', 'Addedd Successfully');
        // } else {
        //     abort('404');
        // }
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
    public function edit($id, Request $request)
    {
        if (auth()->user()->can('Setting')) {
            abort_if(!$request->hasValidSignature(), 404);
            $setting = SiteSetting::findorfail($id);
            return view('backend.site-settings.edit', compact('setting'));
        } else {
            abort('404');
        }
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
        if (auth()->user()->can('Subscriber')) {
            $request->validate([
                'meta_title' => ['required', 'string', 'max:250'],
                'meta_description' => ['required', 'string', 'max:250'],
                'meta_keyword' => ['required', 'string', 'max:250'],
                'email' => ['required', 'string', 'max:250'],
                'number' => ['required',],
                'address' => ['required', 'string', 'max:250'],
                'facebook_link' => ['max:250'],
                'instagram_link' => ['max:250'],
                'twitter_link' => ['max:250'],
                'footer_text' => ['required', 'string'],
                // 'site_logo' => ['mimes:png'],
            ]);

            $setting = SiteSetting::findorfail($id);
            $setting->meta_title = $request->meta_title;
            $setting->meta_description = $request->meta_description;
            $setting->meta_keyword = $request->meta_keyword;
            $setting->email = $request->email;
            $setting->number = $request->number;
            $setting->address = $request->address;
            $setting->facebook_link = $request->facebook_link;
            $setting->instagram_link = $request->instagram_link;
            $setting->twitter_link = $request->twitter_link;
            $setting->youtube_link = $request->youtube_link;
            $setting->footer_text = $request->footer_text;
            $setting->google_map = $request->google_map;

            if ($request->hasFile('site_logo')) {
                $old_thumbnail = public_path('logo/' . $setting->site_logo);
                if (file_exists($old_thumbnail)) {
                    unlink($old_thumbnail);
                }
                $site_logo = $request->file('site_logo');
                $extension = config('app.name') . '-' . Str::random(2) . '.' . $site_logo->getClientOriginalExtension();
                Image::make($site_logo)->save(public_path('logo/' . $extension), 100);
                $setting->site_logo = $extension;
            }
            $setting->save();

            return back()->with('success', 'Edited Successfully');
        } else {
            abort('404');
        }
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
    public function SiteBanner()
    {
        if (auth()->user()->can('Banner')) {
            $banners = Banner::latest('id')->get();
            $center_banner_count = Banner::latest('id')->where('center_banner', '!=', '')->count();
            $products = Product::latest('id')->where('status', 1)->get();
            return view('backend.site-settings.banner', [
                'banners' => $banners,
                'center_banner_count' => $center_banner_count,
                'products' => $products,
            ]);
        } else {
            abort('404');
        }
    }
    public function SiteBannerPost(Request $request)
    {

        if (auth()->user()->can('Banner')) {
            if ($request->product_id != '') {
                $banner = new Banner;
                $banner->product_id = $request->product_id;
                $banner->save();
                return back()->with('success', 'Addedd Successfully');
            }
            if ($request->hasFile('banner_image')) {
                $banner_image = $request->file('banner_image');
                $extension = config('app.name') . '-' . Str::random(6) . '.' . $banner_image->getClientOriginalExtension();
                Image::make($banner_image)->save(public_path('banner_image/' . $extension), 95);
                $banner = new Banner;
                $banner->banner_image = $extension;
                $banner->save();
                return back()->with('success', 'Addedd Successfully');
            }
            if ($request->hasFile('center_banner')) {
                $banner_image = $request->file('center_banner');
                $extension = config('app.name') . '-' . Str::random(6) . '.' . $banner_image->getClientOriginalExtension();
                Image::make($banner_image)->save(public_path('banner_image/' . $extension), 95);
                $banner = new Banner;
                $banner->center_banner = $extension;
                $banner->save();
                return back()->with('success', 'Addedd Successfully');
            }
        } else {
            abort('404');
        }
    }
    public function SiteBannerDelete($id)
    {
        if (auth()->user()->can('Banner')) {
            $banner = Banner::findorfail($id);
            $banner_image = $banner->banner_image;
            $center_banner = $banner->center_banner;
            if ($center_banner != '') {
                $old_banner = public_path('banner_image/' . $center_banner);
                if (file_exists($old_banner)) {
                    unlink($old_banner);
                }
                $banner->delete();
                return back()->with('warning', 'Deleted Successfully');
            }
            if ($banner_image != '') {
                $old_banner = public_path('banner_image/' . $banner_image);
                if (file_exists($old_banner)) {
                    unlink($old_banner);
                }
                $banner->delete();
                return back()->with('warning', 'Deleted Successfully');
            }
            $banner->delete();
            return back()->with('warning', 'Deleted Successfully');
        } else {
            abort('404');
        }
    }
    public function SiteBannerStatus($id)
    {
        if (auth()->user()->can('Banner')) {
            $banner = Banner::findorfail($id);
            $status = $banner->status;
            if ($status == 1) {
                $banner->status = 2;
                $banner->save();
                return back()->with('warning', 'Inactive Successfully');
            }
            $banner->status = 1;
            $banner->save();
            return back()->with('success', 'Active Successfully');
        } else {
            abort('404');
        }
    }
    public function SiteAbout($id, Request $request)
    {
        if (auth()->user()->can('About')) {
            abort_if(!$request->hasValidSignature(), 404);
            $about = AboutSite::findorfail($id);
            return view('backend.site-settings.about', compact('about'));
        } else {
            abort('404');
        }
    }
    public function SiteAboutUpdate(Request $request)
    {
        if (auth()->user()->can('About')) {
            $request->validate([
                'heading' => ['required', 'max:250', 'string'],
                'about' => ['required'],
                'about_id' => ['required'],
            ]);
            $about = AboutSite::findorfail($request->about_id);
            $about->heading = $request->heading;
            $about->about = $request->about;
            $about->save();
            return back()->with('success', 'Edited Successfully');
        } else {
            abort('404');
        }
    }
    public function SiteSubscriber(Request $request)
    {
        if (auth()->user()->can('Subscriber')) {
            $newsletter = ModelsNewsletter::where('status', 1)->get();
            $request->validate([
                'subject' => ['required'],
                'message' => ['required'],
            ]);
            $subject = $request->subject;
            $message = $request->message;
            foreach ($newsletter as $newsletter) {
                Mail::to($newsletter->email)->send(new Newsletter($subject, $message));
            }
            return back()->with('success', 'Email Send');
        } else {
            abort('404');
        }
    }
}
