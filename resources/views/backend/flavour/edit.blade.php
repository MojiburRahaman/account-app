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
                    <h1 class="m-0">Add Flavour</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('flavour.update',$flavour->id)}}" method="POST" >
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="flavour_name">Flavour Name</label>
                        <input id="flavour_name" name="flavour_name" type="text" placeholder="Flavour Name" value="{{$flavour->flavour_name}}"
                            autocomplete="none" class="form-control @error('flavour_name') is-invalid                                
                            @enderror">
                        @error('flavour_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                 
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{route('flavour.index')}}" class="btn btn-primary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
