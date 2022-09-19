@extends('backend.master')

@section('blog_dropdown_active')
menu-open
@endsection
@section('blog_active')
active
@endsection
@section('add_blog-active')
active
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Blogs</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('blogs.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" name="title" type="text" placeholder="Title" autocomplete="none" class="form-control @error('title') is-invalid                                
                            @enderror">
                        @error('title')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <input id="meta_description" name="meta_description" type="text" placeholder="Meta Description"
                            autocomplete="none" class="form-control @error('meta_description') is-invalid                                
                            @enderror">
                        @error('meta_description')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input id="thumbnail" name="thumbnail" type="file" autocomplete="none" class="form-control @error('thumbnail') is-invalid                                
                            @enderror">
                        @error('thumbnail')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="blog_image">Blog Image</label>
                        <input id="blog_image" name="blog_image" type="file" autocomplete="none" class="form-control @error('blog_image') is-invalid                                
                            @enderror">
                        @error('blog_image')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="blog_description"> Description</label>
                        <textarea name="blog_description" id="editor" class="form-control"></textarea>
                        @error('blog_description')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script_js')
@include('backend.ckeditor')
@endsection