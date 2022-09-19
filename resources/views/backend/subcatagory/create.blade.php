@extends('backend.master')
@section('subcat_active')
active
@endsection
@section('subcat_add-active')
active
@endsection
@section('sub-cat_dropdown_active')
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
                    <h1 class="m-0">Sub-Catagory</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('subcatagory.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label  for="subcatagory_name">Sub Catagory</label>
                        <input id="subcatagory_name" value="{{old('subcatagory_name')}}" name="subcatagory_name" type="text" placeholder="SubCatagory Name" autocomplete="none"
                            class="form-control @error('subcatagory_name') is-invalid                                
                            @enderror">
                        @error('subcatagory_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label  for="catagory_id">Catagory</label>
                        <select title="Select Catagory" class="form-control  @error('catagory_id') is-invalid                                
                        @enderror" name="catagory_id" id="catagory_id">
                            <option value=>Select One</option>
                            @foreach ($catagories as $catagory)
                            <option value="{{$catagory->id}}">{{$catagory->catagory_name}}</option>
                            @endforeach
                            
                        </select>
                        @error('catagory_id')
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