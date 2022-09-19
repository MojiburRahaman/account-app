@extends('backend.master')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Catagory</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('catagory.update' ,$catagory->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <input name="catagory_name" value="{{$catagory->catagory_name}}" type="text"
                            placeholder="Catagory Name" autocomplete="none" class="form-control @error('catagory_name') is-invalid                                
                            @enderror">
                        @error('catagory_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input
                                    onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])"
                                    name="catagory_image" value="{{$catagory->catagory_image}}" type="file" class="form-control @error('catagory_image') is-invalid                                
                                    @enderror">
                                @error('catagory_image')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label for="">Preview Category Image</label>
                                <img src="{{asset('category_images/'.$catagory->catagory_image)}}" id="image_id"
                                    width="30%" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection