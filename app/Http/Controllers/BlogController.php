<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CkeditorFileUpload;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('View Blog')) {
            $blogs = Blog::latest('id')->simplepaginate(10);
            return view('backend.blogs.index', [
                'blogs' => $blogs,
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
        if (auth()->user()->can('Create Blog')) {
            return view('backend.blogs.create');
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
        if (auth()->user()->can('Create Blog')) {

            $request->validate([
                'title' => ['required', 'string', 'unique:blogs,title'],
                'meta_description' => ['required'],
                'thumbnail' => ['required', 'image'],
                'blog_image' => ['required', 'image'],
                'blog_description' => ['required'],
            ]);

            $Blog = new Blog;
            $Blog->title = $request->title;
            $Blog->slug = Str::slug($request->title);
            $Blog->meta_description = $request->meta_description;
            $Blog->blog_description = $request->blog_description;

            if ($request->hasFile('thumbnail')) {
                $blog_thumbnail = $request->file('thumbnail');
                $Blog_thumb_extension = Str::slug($request->title) . '-' . 'thumbnail' . '.' . $blog_thumbnail->getClientOriginalExtension();
                Image::make($blog_thumbnail)->save(public_path('blogs/thumbnail/' . $Blog_thumb_extension));
            }
            if ($request->hasFile('blog_image')) {
                $blog_image = $request->file('blog_image');
                $Blog_image_extension = Str::slug($request->title) . '-' . Str::random(3) . '.' . $blog_image->getClientOriginalExtension();
                Image::make($blog_image)->save(public_path('blogs/blog_image/' . $Blog_image_extension));
            }
            $Blog->blog_thumbnail = $Blog_thumb_extension;
            $Blog->blog_image = $Blog_image_extension;
            $Blog->save();


            return redirect()->route('blogs.index')->with('success', 'Blog Added Successfully');
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
        $blog = Blog::findorfail($id);
        if ($blog->add_to_goal == '') {
            $blog->add_to_goal = 1;
            $blog->save();
            return back();
        } else {
            $blog->add_to_goal = '';
            $blog->save();
            return back();
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
        if (auth()->user()->can('Edit Blog')) {
            return view('backend.blogs.edit', [
                'Blog' => Blog::findorfail($id),
            ]);
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
        if (auth()->user()->can('Edit Blog')) {
            $request->validate([
                'title' => ['required', 'string', 'unique:blogs,title,' . $id],
                'meta_description' => ['required'],
                'thumbnail' => ['nullable', 'image'],
                'blog_image' => ['nullable', 'image'],
                'blog_description' => ['required'],
            ]);
            $Blog = Blog::findorfail($id);
            $Blog->title = $request->title;
            $Blog->slug = Str::slug($request->title);
            $Blog->meta_description = $request->meta_description;
            $Blog->blog_description = $request->blog_description;

            if ($request->hasFile('thumbnail')) {
                $blog_thumbnail = $request->file('thumbnail');
                $Blog_thumb_extension = Str::slug($request->title) . '-' . 'thumbnail' . '.' . $blog_thumbnail->getClientOriginalExtension();
                Image::make($blog_thumbnail)->save(public_path('blogs/thumbnail/' . $Blog_thumb_extension), 100);
                $Blog->blog_thumbnail = $Blog_thumb_extension;
            }
            if ($request->hasFile('blog_image')) {
                $blog_image = $request->file('blog_image');
                $Blog_image_extension = Str::slug($request->title) . '-' . Str::random(3) . '.' . $blog_image->getClientOriginalExtension();
                Image::make($blog_image)->save(public_path('blogs/blog_image/' . $Blog_image_extension), 100);
                $Blog->blog_image = $Blog_image_extension;
            }

            $Blog->save();
            return redirect()->route('blogs.index')->with('warning', 'Blog Edited Successfully');
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
        if (auth()->user()->can('Edit Blog')) {
            $blog = Blog::findorfail($id);
            $thumb = public_path('blog/thumbnail' . $blog->blog_thumbnail);
            $image = public_path('blog/blog_image' . $blog->blog_image);
            if (file_exists($thumb)) {
                unlink($thumb);
            }
            if (file_exists($image)) {
                unlink($image);
            }
            $blog->delete();
            return back()->with('delete', 'Blog Deleted Successfully');
        } else {
            abort('404');
        }
    }
    function CkfileUpload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $blog_image = $request->file('upload');
            $Blog_image_extension = Str::random(5) . '.' . $blog_image->getClientOriginalExtension();
            $url = public_path('blogs/ckeditor/' . $Blog_image_extension);
            Image::make($blog_image)->save($url, 100);
            $ckeditor = new CkeditorFileUpload;
            $ckeditor->ckeditor_image = $Blog_image_extension;
            $ckeditor->save();
            $image_url = asset('blogs/ckeditor/' . $Blog_image_extension);
            return response()->json(['url' => $image_url]);
        }
    }
}
