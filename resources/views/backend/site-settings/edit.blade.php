@extends('backend.master')
@section('site-setting_active')
active
@endsection
@section('setting-active')
active
@endsection
@section('Site_setting_active')
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
                    <h1 class="m-0">Setting</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Setting</li>
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <span>{{$error}} </span><br>
                    @endforeach
                </div>
                @endif
                <div class="card-body  p-0">
                    <form action="{{route('settings.update',$setting->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="meta_title">Meta title</label>
                                    <input value="{{$setting->meta_title}}" type="text" name="meta_title" id="meta_title" placeholder="Meta Title"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="met_description">Meta Description</label>
                                    <input value="{{$setting->meta_description}}" type="text" name="meta_description" id="met_description"
                                        placeholder="Meta Description" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input value="{{$setting->meta_keyword}}" type="text" name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="site_logo">Site Logo</label>
                                    <input
                                        onchange="document.getElementById('test').src = window.URL.createObjectURL(this.files[0])"
                                        class="form-control" type="file" name="site_logo" id="site_logo">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="site_logo"> Logo Preview</label>
                                    <img src="{{asset('logo/'.$setting->site_logo)}}" id="test" width="30%" height="100%" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="site_logo">Email</label>
                                    <input value="{{$setting->email}}" type="email" name="email" id="email" placeholder="Email"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="number">Number</label>
                                    <input value="{{$setting->number}}" type="number" name="number" id="number" placeholder="Number"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input value="{{$setting->address}}" type="text" name="address" id="address" placeholder="Address"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="facebook_link">Facebook Link</label>
                                    <input value="{{$setting->facebook_link}}" type="text" name="facebook_link" id="facebook_link"
                                        placeholder="Facebook Link" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="twitter_link">Twitter Link</label>
                                    <input value="{{$setting->twitter_link}}" type="text" name="twitter_link" id="twitter_link"
                                        placeholder="Twitter Link" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="youtube_link">Youtube Link</label>
                                    <input value="{{$setting->youtube_link}}" type="text" name="youtube_link" id="twitter_link"
                                        placeholder="Youtube Link" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="instagram_link">Instagram Link</label>
                                    <input value="{{$setting->instagram_link}}" type="text" name="instagram_link" id="instagram_link"
                                        placeholder="Instagram Link" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label  for="footer_text">Footer Text</label>
                                    <textarea class="form-control" name="footer_text" id="footer_text">{{$setting->footer_text}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label  for="google_map">Google Maps Link</label>
                                    <textarea class="form-control" name="google_map" id="google_map">{{$setting->google_map}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
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