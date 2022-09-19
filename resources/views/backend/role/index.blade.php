@extends('backend.master')
@section('role_active')
active
@endsection
@section('role_view-active')
active
@endsection
@section('role_dropdown_active')
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
                    <h1 class="m-0">Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Role</li>
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
                @can('Create Role')
                <div class="text-right">
                    <a href="{{route('roles.create')}}" class="btn-sm btn-info">Add Role</a>
                </div>
                @endcan
                <div class="card-body table-responsive table-bordered p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Role Name</th>
                                <th>Permission</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <ul>
                                        @foreach ($role->Permissions as $permission)
                                        <li>
                                            {{$permission->name}}
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{$role->created_at->format('D-M-Y')}}</td>
                                <td>
                                    {{-- <form action="{{route('roles.destroy',$role->id)}}" method="post"> --}}
                                        @if ($role->name != 'Customer')
                                        @can('Edit Role')
                                        <a style="padding: 7px 8px" href="{{route('roles.edit',$role->id)}}"
                                            class="btn-sm btn-primary">Edit</a>
                                        @endcan
                                        @endif
                                        {{-- @csrf
                                        @can('Delete Role')
                                        @if ($role->id != 1)
                                        @method('delete')
                                        <button class="btn-sm btn-danger" type="submit">Delete</button>
                                        @endif
                                        @endcan --}}
                                    {{-- </form> --}}
                                </td>
                            </tr>
                            @empty
                            <td class="text-center" colspan="10">No Data Available</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{$roles->links()}}
                </div>
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