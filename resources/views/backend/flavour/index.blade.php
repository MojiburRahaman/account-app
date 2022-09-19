@extends('backend.master')
@section('color-size_active')
active
@endsection
@section('flavour_view-active')
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
                    <h1 class="m-0">Flavours</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Flavour</li>
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
                <div class="text-right">

                    <a href="{{route('flavour.create')}}" class="btn-sm btn-info">Add Flavour</a>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Flavour Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($flavours as $flavour)

                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>{{$flavour->flavour_name}}</td>
                                <td>{{$flavour->created_at->diffForHumans()}}</td>
                                <form action="{{route('flavour.destroy',$flavour->id)}}" method="post">
                                    <td>
                                        <a style="padding: 7px 8px" href="{{route('flavour.edit',$flavour->id)}}"
                                            class="btn-sm btn-primary">Edit</a>
                                        @csrf
                                        @method('delete')
                                        <button class="btn-sm btn-danger" type="submit">Delete</button>
                                </form>
                                </td>
                            </tr>
                            @empty
                            <td class="text-center" colspan="10">No Data Available</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{$flavours->links()}}
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