@extends('backend.master')
@section('depot_active')
active
@endsection
@section('depot_add-active')
active
@endsection
@section('depot_dropdown_active')
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
                    <h1 class="m-0">Depot</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('depot.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input name="depot_name" type="text" placeholder="Depot Name" autocomplete="none" class="form-control @error('depot_name') is-invalid                                
                            @enderror">
                            @error('depot_name')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
 
                    <div class="form-group">
                        <input name="code" type="text" placeholder="code" autocomplete="none" class="form-control @error('code') is-invalid                                
                            @enderror">
                            @error('code')
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