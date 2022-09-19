@extends('backend.master')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Depot Edit</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('depot.update',$depot->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="depot_name">Depot Name</label>
                        <input value="{{$depot->depot_name}}" name="depot_name" type="text"
                            placeholder="Depot Name" autocomplete="none" class="form-control @error('depot_name') is-invalid                                
                            @enderror">
                        @error('depot_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                

                    <div class="form-group">
                        <label for="code">Depot Code</label>
                        <input value="{{$depot->code}}" name="code" type="text"
                            placeholder="Depot Code" autocomplete="none" class="form-control @error('code') is-invalid                                
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

