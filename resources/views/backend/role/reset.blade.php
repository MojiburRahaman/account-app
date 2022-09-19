@extends('backend.master')

@section('role_dropdown_active')
menu-open
@endsection
@section('role_active')
active
@endsection
@section('reset_active')
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
                    <h1 class="m-0">Reset Password</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('ResetPassPost')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="color_name">User list</label>
                      <select id="user" class="form-control @error('user_name') is-invalid  @enderror" name="user_name" id="user">
                          <option value>Select User</option>
                          @foreach ($users as $user)
                          @if (auth()->user()->email != $user->email)
                          <option value="{{$user->id}}">{{$user->name}} ({{$user->email}}) </option>
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
                        <label for="color_name">Password</label>
                        <input required type="password" name="password" class="form-control" placeholder="Password">
                        @error('password')
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

$(document).ready(function() {
    $('#user').select2();
});

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