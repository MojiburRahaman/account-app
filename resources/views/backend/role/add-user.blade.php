@extends('backend.master')

@section('role_dropdown_active')
menu-open
@endsection
@section('role_active')
active
@endsection
@section('add_user_active')
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
                <form action="{{route('CreateUserPost')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="color_name">User Name</label>
                        <input type="text" name="user_name" class="form-control" placeholder="User Name">
                        @error('user_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="color_name">User Email</label>
                        <input type="text" name="user_email" class="form-control" placeholder="User Email">
                        @error('user_email')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="color_name">Password</label>
                        <input required type="password" name="password" class="form-control" placeholder="Password">
                        @error('password')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="color_name">Role</label>
                        <select class="form-control @error('role_name') is-invalid  @enderror" name="role_name"
                            id="user">
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
        </div>
    </section>
</div>
@endsection

@section('script_js')
<script>
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

</script>
@endsection