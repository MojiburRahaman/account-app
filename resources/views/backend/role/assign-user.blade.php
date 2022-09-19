@extends('backend.master')

@section('role_dropdown_active')
menu-open
@endsection
@section('role_active')
active
@endsection
@section('assign_user_active')
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
                    <h1 class="m-0">Assign User</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('AssignUserPost')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="color_name">User list</label>
                      <select class="form-control @error('user_name') is-invalid  @enderror" name="user_name" id="user">
                          <option value>Select User</option>
                          @foreach ($users as $user)
                          @if (auth()->user()->email != $user->email)
                          <option value="{{$user->id}}">{{$user->name}} ({{$user->email}})</option>
                          @endif
                          @endforeach
                      </select>
                        @error('user_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="color_name">Role</label>
                      <select class="form-control @error('role_name') is-invalid  @enderror" name="role_name" id="user">
                          <option value>Select Role</option>
                          @foreach ($roles as $role)
                          @if (auth()->user()->roles->first()->name == 'Super Admin')
                          <option value="{{$role->id}}">{{$role->name}}</option>
                          @else
                          @if ($role->name != 'Super Admin')
                              
                          <option value="{{$role->id}}">{{$role->name}}</option>
                          @endif
                              
                          @endif
                          @endforeach
                      </select>
                        @error('role_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
            @if (auth()->user()->roles->first()->name == 'Super Admin')
            <div class="row">
                <div class="col-12">
                    <div class="card-body table-responsive table-bordered p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>User</th>
                                    <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                @foreach ($user->Roles as $role)
                                @if ($role->name != 'Customer')
                                <tr>
                                    <td>
                                        {{$loop->index+1}}
                                    </td>
                                    <td>
                                        Name: {{$user->name}}
                                        <br>
                                        Email: {{$user->email}}
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($user->Roles as $role)
                                         Role : {{$role->name}}
                                            @foreach ($role->permissions as $item)
                                            <li>
                                                {{$item->name}}
                                            </li>
                                            @endforeach
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @empty
                                <td class="text-center" colspan="10">No Data Available</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection

@section('script_js')
<script>

$(document).ready(function() {
    $('#user').select2();
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