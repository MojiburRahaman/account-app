@extends('backend.master')
@section('Paymentmethod_active')
active
@endsection
@section('Paymentmethod_add-active')
active
@endsection
@section('Paymentmethod_dropdown_active')
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
                    <h1 class="m-0">Payment Method</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('payment-method.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input name="method_name" type="text" placeholder="Method Name" autocomplete="none" class="form-control @error('method_name') is-invalid                                
                            @enderror">
                            @error('method_name')
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