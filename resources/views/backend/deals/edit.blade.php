@extends('backend.master')

@section('content')
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {

        padding-left: 20px;
    }

</style>
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Best Deal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Best Deal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{route('deals.store')}}" method="POST">
                <div class="col-lg-12">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input value="{{$best_deal->title}}" type="text" name="title" id="title" placeholder="title" autofocus class="form-control @error('title') is-invvalid  @enderror">
                        @error('title')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product_id">Select Product</label>
                        <select required name="product_id[]" class="form-control test" id="product_id" multiple="multiple">
                            @forelse ($products as $product)
                            <option value="{{$product->id}}">{{$product->title}}</option>
                            @empty
                            <option value=>No Product</option>
                            @endforelse
                        </select>
                        @error('product_id.*')
                        <div class="alert alert-danger"> {{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input value="{{$best_deal->discount}}" required type="number" name="discount" id="discount" class="form-control @error('discount') is-invalid @enderror">
                        @error('discount')
                        <div class="alert alert-danger"> {{$message}}</div>
                            
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Select Date</label>
                        <input type="date" id="date" name="date" value="{{$best_deal->expire_date}}" class="form-control @error('date') is-invalid @enderror">
                        @error('date')
                        <div class="alert alert-danger"> {{$message}}</div>
                            
                        @enderror
                    </div>
                   
                    <button class="btn btn-success" type="submit">Submit</button>

                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@section('script_js')

<script>
    $(document).ready(function() {
    $('.test').select2();
});
</script>
@endsection