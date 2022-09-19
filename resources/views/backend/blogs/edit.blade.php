@extends('backend.master')

@section('blog_dropdown_active')
menu-open
@endsection
@section('blog_active')
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
                    <h1 class="m-0">Edit Blogs</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('blogs.update',$Blog->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input value="{{$Blog->title}}" id="title" name="title" type="text" placeholder="Title" autocomplete="none" class="form-control @error('title') is-invalid                                
                            @enderror">
                        @error('title')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <input value="{{$Blog->meta_description}}" id="meta_description" name="meta_description" type="text" placeholder="Meta Description"
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
                        <textarea name="blog_description" id="editor" class="form-control">{{$Blog->blog_description}}</textarea>
                        @error('blog_description')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{route('blogs.index')}}" class="btn btn-primary">Cancel</a>
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