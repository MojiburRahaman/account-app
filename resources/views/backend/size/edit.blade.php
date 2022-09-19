@extends('backend.master')
@section('color-size_active')
active
@endsection
@section('color-size_dropdown_active')
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
                    <h1 class="m-0">Edit Size</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('size.update',$size->id)}}" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="size_name">Size Name</label>
                        <input id="size_name" name="size_name" type="text" placeholder="Size Name"
                          value="{{$size->size_name}}"  autocomplete="none" class="form-control @error('size_name') is-invalid                                
                            @enderror">
                        @error('size_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                 
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{route('size.index')}}" class="btn btn-primary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

