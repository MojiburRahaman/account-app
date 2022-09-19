@extends('backend.master')
@section('site-setting_active')
active
@endsection
@section('banner-active')
active
@endsection
@section('color-Site_setting_active')
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
                    <h1 class="m-0">Banner</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Banner</li>
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
                {{-- <form action="{{route('Markdeletebrand')}}" method="post"> --}}
                {{-- @csrf --}}
                {{-- @can('Create Color') --}}

                <div class="text-right">

                    <a data-toggle="modal" data-target="#exampleModal" class="btn-sm btn-info">Add Banner</a>
                </div>
                {{-- @endcan --}}
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>
                                    Product Image
                                </th>
                                <th>Banner Preview</th>
                                <th>Created At</th>
                                {{-- @if (auth()->user()->can('Delete Color') || auth()->user()->can('Edit Color')) --}}

                                <th>Action</th>
                                {{-- @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($banners as $banner)
                            @if ($banner->product_id != '' || $banner->banner_image != '')

                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    @if ($banner->product_id != '')
                                    <img src="{{asset('thumbnail_img/'.$banner->Product->thumbnail_img)}}" width="30%"
                                        alt="">
                                    @endif
                                </td>
                                <td>
                                    <img src="{{asset('banner_image/'.$banner->banner_image)}}" width="30%" alt="">
                                </td>
                                <td>{{$banner->created_at->diffForHumans()}}</td>
                                <td>
                                    @if ($banner->status == 1)
                                    <a href="{{route('SiteBannerStatus',$banner->id)}}"
                                        class="btn-sm btn-primary">Active</a>
                                    @else
                                    <a href="{{route('SiteBannerStatus',$banner->id)}}"
                                        class="btn-sm btn-warning">Inactive</a>
                                    @endif
                                    <a href="{{route('SiteBannerDelete',$banner->id)}}"
                                        class="ml-2 btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endif
                            @empty
                            <td class="text-center" colspan="10">No Data Available</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-body table-responsive p-0 mt-5">
                    <table class="table table-hover text-nowrap">
                        @if ($center_banner_count != 1)
                        <div class="text-right">
                            <a data-toggle="modal" data-target="#exampleModal2" href="" class="btn-sm btn-primary">Add
                                Center Banner</a>
                        </div>
                        @endif
                        <thead>
                            <th>Center Banner</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($banners as $center_banner)
                            @if ($center_banner->center_banner != '')
                            <tr>
                                <td>
                                    <img src="{{asset('banner_image/'.$center_banner->center_banner)}}" width="30%"
                                        alt="">
                                </td>
                                <td>{{$center_banner->created_at->diffForHumans()}}</td>
                                <td>
                                    @if ($center_banner->status == 1)
                                    <a href="{{route('SiteBannerStatus',$center_banner->id)}}"
                                        class="btn-sm btn-primary">Active</a>
                                    @else
                                    <a href="{{route('SiteBannerStatus',$center_banner->id)}}"
                                        class="btn-sm btn-warning">Inactive</a>
                                    @endif
                                    <a href="{{route('SiteBannerDelete',$center_banner->id)}}"
                                        class="ml-2 btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="10">No items</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('SiteBannerPost')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="product_id">Select Product</label>
                                            <select class="form-control " name="product_id" id="">
                                                <option value="">Select One</option>
                                                @forelse ($products as $product)

                                                <option value="{{$product->id}}">{{$product->title}}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="from-group">
                                            <label for="">Banner Image</label>
                                            <input name="banner_image" class="form-control" type="file">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Center Banner</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('SiteBannerPost')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="from-group">
                                            <label for="center_banner">Banner Image</label>
                                            <input name="center_banner" class="form-control" type="file">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>
@endsection
@section('script_js')
<script>
    $(document).ready(function() {
    $('.product_id').select2();
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