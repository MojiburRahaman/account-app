@extends('backend.master')
@section('coupon_active')
active
@endsection
@section('content')

<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Colors</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Coupons</li>
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
                @csrf
                @can('Create Coupon')

                <div class="text-right">

                    <a href="{{route('coupons.create')}}" class="btn-sm btn-info">Add Coupon</a>
                </div>
                @endcan
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Coupon Name</th>
                                <th>Expire Date </th>
                                <th>User limit </th>
                                @if (auth()->user()->can('Delete Coupon') || auth()->user()->can('Edit Coupon'))

                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($coupons as $coupon)

                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>{{$coupon->coupon_name}}</td>
                                <td>{{$coupon->coupon_expire_date}}</td>
                                <td>{{$coupon->coupon_limit}}</td>
                                @if (auth()->user()->can('Delete Coupon') || auth()->user()->can('Edit Coupon'))
                                <form action="{{route('coupons.destroy',$coupon->id)}}" method="post">
                                    <td>
                                        @can('Edit Color')

                                        <a style="padding: 7px 8px" href="{{route('coupons.edit',$coupon->id)}}"
                                            class="btn-sm btn-primary">Edit</a>
                                        @endcan
                                        @csrf
                                        @can('Delete Coupon')
                                        @method('delete')
                                        <button class="btn-sm btn-danger" type="submit">Delete</button>

                                        @endcan
                                </form>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <td class="text-center" colspan="10">No Data Available</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>
@endsection
@section('script_js')
<script>
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
