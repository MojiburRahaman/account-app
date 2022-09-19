@extends('backend.master')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Change Password</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                {{$error}} <br>
                @endforeach
            </div>
            @endif
            <div class="col-6">
                <form action="{{route('AdminChangePasswordPost')}}" method="POST">
                    @csrf
                    <div class="form-group ">
                        <label for="current_pass">Current Password</label>
                        <input type="password" name="current_pass" id="current_pass" class="form-control"
                            placeholder="Current Password">
                    </div>
                    <div class="form-group ">
                        <label for="new_pass">New Password</label>
                        <input name="new_pass" type="password" id="new_pass" class="form-control"
                            placeholder="New Password">
                    </div>
                    <div class="form-group ">
                        <label for="confirm_pass">Confirm Password</label>
                        <input name="confirm_pass" type="password" id="confirm_pass" class="form-control"
                            placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection