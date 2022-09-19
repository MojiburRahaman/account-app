@extends('backend.master')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Coupon</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('coupons.update',$coupon->id)}}" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="color_name">Coupon Name</label>
                        <input id="coupon_name" name="coupon_name" type="text" placeholder="Coupon Name" value="{{$coupon->coupon_name}}"
                            autocomplete="none" class="form-control @error('coupon_name') is-invalid                                
                            @enderror">
                        @error('coupon_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="coupon_amount">Coupon Amount(%)</label>
                        <input id="coupon_amount" name="coupon_amount" type="number" placeholder="Coupon Amount" value="{{$coupon->coupon_amount}}"
                            autocomplete="none" class="form-control @error('coupon_amount') is-invalid                                
                            @enderror">
                        @error('coupon_amount')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="coupon_limit">Coupon Limit User</label>
                        <input id="coupon_limit" name="coupon_limit" type="number" placeholder="Coupon Limit" value="{{$coupon->coupon_limit}}"
                            autocomplete="none" class="form-control @error('coupon_limit') is-invalid                                
                            @enderror">
                        @error('coupon_limit')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="coupon_expire_date">Coupon Expire Date</label>
                        <input id="coupon_expire_date" name="coupon_expire_date" type="date"  value="{{$coupon->coupon_expire_date}}"
                            autocomplete="none" class="form-control @error('coupon_limit') is-invalid                                
                            @enderror">
                        @error('coupon_expire_date')
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

