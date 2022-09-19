@extends('backend.master')
@section('product_active')
active
@endsection
@section('product_view-active')
active
@endsection
@section('product_dropdown_active')
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
                    <h1 class="m-0">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('MarkdeleteProduct')}}" method="post">
                    @csrf
                    @can('Delete Product')

                    <div>
                        <input type="checkbox" id="select_all"> &nbsp;
                        <label for="select_all">Select All</label> &nbsp; &nbsp;
                        <button class="btn btn-link" type="submit" disabled id="select_btn"><i
                                style="color: white;border-radius:50%;background-color:#bf3232;font-size:smaller;padding:1px 2px"
                                class="fa fa-minus"></i> Delete All
                        </button>
                    </div>
                    @endcan
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover" id="order_table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Product Name</th>
                                    <th>Stock</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Certified</th>
                                    @if (auth()->user()->can('Edit Product') || auth()->user()->can('Delete Product'))
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr @if ($product->status == 2)
                                    style="background-color:#ccc"
                                    @endif>
                                    <td>
                                        @can('Delete Product')
                                        <input type="checkbox" class="checkbox" name="delete[]"
                                            value="{{$product->id}}">
                                        &nbsp;
                                        @endcan
                                        {{$loop->index+1}}
                                    </td>
                </form>

                <td>
                    <img src="{{asset('thumbnail_img/' . $product->thumbnail_img)}}" width="60" height="60"
                        alt="{{$product->title}}">
                    &nbsp;&nbsp; <a title="view product" style="color: black" href="{{route('SingleProductView',$product->slug)}}">
                        {{$product->title}}</a>

                </td>
                <td>
                    @foreach ($product->Attribute as $item)
                    <li>
                        @if ($item->Color->color_name != 'None')

                        {{ $item->Color->color_name }} -
                        @endif
                        @if ($item->Size->size_name != 'None')

                        {{ $item->Size->size_name }} -
                        @endif
                        {{$item->quantity}}
                    </li>
                    @endforeach
                </td>
                <td class="text-center">
                    @if ($product->status == 1)

                    <a href="{{route('ProductStaus',$product->id)}}" class="btn-sm btn-success">Active</a>
                    @else
                    <a href="{{route('ProductStaus',$product->id)}}" class="btn-sm btn-danger">Inactive</a>

                    @endif
                </td>
                <td class="text-center">
                    @if ($product->certified == 1)
                    <a href="{{route('products.show',$product->id)}}" class="btn-sm btn-success">Active</a>
                @else
                <a href="{{route('products.show',$product->id)}}" class="btn-sm btn-danger">Inactive</a>

                @endif
                </td>
                <form action="{{route('products.destroy',$product->id)}}" method="post">
                    @if (auth()->user()->can('Edit Product') || auth()->user()->can('Delete Product'))

                    <td>
                        @can('Edit Product')
                        <a title="Edit Product" style="padding: 7px 8px" href="{{route('products.edit',$product->id)}}"
                            class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                        <br>
                        @endcan
                        @csrf
                        @can('Delete Product')

                        @method('delete')
                        <button title="delete product" class="btn-sm btn-danger mt-2" type="submit"><i
                                class="fa fa-trash"></i></button>
                        @endcan
                    </td>
                    @endif
                </form>
                </tr>
                @empty
                <td class="text-center" colspan="10">No Data Available</td>
                @endforelse
                </tbody>
                </table>
            </div>
            {{-- <div class="text-right mt-2">
                {{$products->links()}}
            </div> --}}
            <!-- /.card -->
        </div>
</div>
</section>
</div>
@endsection
@section('script_js')
<script>
$(document).ready( function () {
    $('#order_table').DataTable();
} );

    $("#select_all").click(function(){
        $("input[class=checkbox]").prop('checked', $(this).prop('checked'));

    });

$('#select_all').click(function () {
        //check if checkbox is checked
        if ($(this).is(':checked')) {

            $('#select_btn').removeAttr('disabled'); //enable input

        } 
        else {
            $('#select_btn').attr('disabled', true); //disable input
        }
    });
$('.checkbox').click(function () {
        //check if checkbox is checked
        if ($(this).is(':checked')) {
            $('#select_btn').removeAttr('disabled'); //enable input

        } 
        // else {
        //     $('#select_btn').attr('disabled', true); //disable input
        // }
    });


@if (session('delete')) 
Command: toastr["error"]("{{session('delete')}}")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
@endif
@if (session('success')) 
Command: toastr["success"]("{{session('success')}}")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
@endif
@if (session('warning')) 
Command: toastr["warning"]("{{session('warning')}}")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
@endif

</script>
@endsection