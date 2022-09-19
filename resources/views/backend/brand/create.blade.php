@extends('backend.master')

@section('brand_active')
active
@endsection
@section('brand_add-active')
active
@endsection
@section('brand_dropdown_active')
menu-open
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Brand</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input id="brand_name" name="brand_name" type="text" placeholder="Brand Name"
                            autocomplete="none" class="form-control @error('brand_name') is-invalid                                
                            @enderror">
                        @error('brand_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="brand_img">Brand Image</label>
                            <input type="file" name="brand_img" onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])"
                                class="form-control @error('brand_img') is-invalid @enderror">
                            @error('brand_img')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @else
                            <span class="text-danger">*Only png formate will allow</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4 pl-4">
                        &nbsp;<img id="image_id" width="150" height="150" />
                    </div>
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