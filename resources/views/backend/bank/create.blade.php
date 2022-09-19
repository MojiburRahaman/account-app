@extends('backend.master')
@section('bank_active')
active
@endsection
@section('bank_add-active')
active
@endsection
@section('bank_dropdown_active')
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
                    <h1 class="m-0">Add Banks</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('bank.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label  for="bank_name">Name</label>
                        <input id="bank_name" value="{{old('bank_name')}}" name="bank_name" type="text" placeholder="Bank Name" autocomplete="none"
                            class="form-control @error('bank_name') is-invalid                                
                            @enderror">
                        @error('bank_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label  for="method_id">Method</label>
                        <select title="Select Method" class="form-control  @error('method_id') is-invalid                                
                        @enderror" name="method_id" id="method_id">
                            <option value=>Select One</option>
                            @foreach ($methods as $method)
                            <option value="{{$method->id}}">{{$method->method_name}}</option>
                            @endforeach
                            
                        </select>
                        @error('method_id')
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