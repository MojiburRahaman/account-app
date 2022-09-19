@extends('backend.master')
@section('cat_active')
active
@endsection
@section('cat_add-active')
active
@endsection
@section('cat_dropdown_active')
menu-open
@endsection
@section('content')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Catagory</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('catagory.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input name="catagory_name" type="text" placeholder="Catagory Name" autocomplete="none" class="form-control @error('catagory_name') is-invalid                                
                            @enderror">
                            @error('catagory_name')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <input name="catagory_image" type="file" autocomplete="none" class="form-control @error('catagory_image') is-invalid                                
                            @enderror">
                            @error('catagory_image')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection