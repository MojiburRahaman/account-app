@extends('backend.master')
@section('color-size_active')
active
@endsection
@section('color_view-active')
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
                    <h1 class="m-0">Colors</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Color</li>
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
                @csrf
                @can('Create Color')

                <div class="text-right">

                    <a href="{{route('color.create')}}" class="btn-sm btn-info">Add Color</a>
                </div>
                @endcan
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Color Name</th>
                                <th>Created At</th>
                                @if (auth()->user()->can('Delete Color') || auth()->user()->can('Edit Color'))

                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($colors as $color)

                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>{{$color->color_name}}</td>
                                <td>{{$color->created_at->diffForHumans()}}</td>
                                @if (auth()->user()->can('Delete Color') || auth()->user()->can('Edit Color'))
                                <form action="{{route('color.destroy',$color->id)}}" method="post">
                                    <td>
                                        @can('Edit Color')

                                        <a style="padding: 7px 8px" href="{{route('color.edit',$color->id)}}"
                                            class="btn-sm btn-primary">Edit</a>
                                        @endcan
                                        @csrf
                                        @can('Delete Color')
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
                    {{$colors->links()}}
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