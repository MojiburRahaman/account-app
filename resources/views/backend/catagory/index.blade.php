@extends('backend.master')
@section('cat_active')
active
@endsection
@section('cat_view-active')
active
@endsection
@section('cat_dropdown_active')
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
                    <h1 class="m-0">Catagory</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Catagory</li>
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
                <form action="{{route('MarkdeleteCatagory')}}" method="post">
                    @csrf
                    @can('Delete Category')

                    <div>
                        <input type="checkbox" id="select_all"> &nbsp;
                        <label for="select_all">Select All</label> &nbsp; &nbsp;
                        <button class="btn btn-link" type="submit" disabled id="select_btn"><i
                                style="color: white;border-radius:50%;background-color:#bf3232;font-size:smaller;padding:1px 2px"
                                class="fa fa-minus"></i> Delete All </button>
                    </div>
                    @endcan
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Catagory Name</th>
                                    <th>Created At</th>
                                    <th>add to home page</th>
                                    @if (auth()->user()->can('Delete Category') || auth()->user()->can('Edit Category'))

                                    <th>Action</th>s
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($catagoreis as $item)

                                <tr>
                                    <td>
                                        @can('Delete Category')

                                        <input type="checkbox" class="checkbox" name="delete[]" value="{{$item->id}}">
                                        &nbsp;
                                        @endcan
                                        {{$loop->index+1}}
                                    </td>
                </form>

                <td>{{$item->catagory_name}}</td>
                <form action="{{route('catagory.destroy',$item->id)}}" method="post">
                    <td>{{$item->created_at->diffForHumans()}}</td>
                   <td>
                    @if ($item->home_page == 1)
                        
                    <a href="{{route('catagory.show',$item->id)}}" class="btn-sm btn-success">Active</a> &nbsp;
                    @endif
                    @if($item->home_page == 2)
                    <a href="{{route('catagory.show',$item->id)}}" class="btn-sm btn-warning">Inactive</a> &nbsp;
                    @endif
                   </td>
                    @if (auth()->user()->can('Delete Category') || auth()->user()->can('Edit Category'))
                    <td>
                        
                        @can('Edit Category')
                        <a style="padding: 7px 8px" href="{{route('catagory.edit',$item->id)}}"
                            class="btn-sm btn-primary">Edit</a>
                        @endcan
                        @can('Delete Category')
                        @csrf
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
            <!-- /.card -->
            <div class="mt-5">
                {{$catagoreis->links()}}
            </div>
        </div>
</div>
</section>
</div>
@endsection
@section('script_js')
<script>
    $("#select_all").click(function(){
        $("input[class=checkbox]").prop('checked', $(this).prop('checked'));

    });

$('#select_all').click(function () {
        //check if checkbox is checked
        if ($(this).is(':checked')) {

            $('#select_btn').removeAttr('disabled'); //enable input

        } else {
            $('#select_btn').attr('disabled', true); //disable input
        }
    });
$('.checkbox').click(function () {
        //check if checkbox is checked
        if ($(this).is(':checked')) {

            $('#select_btn').removeAttr('disabled'); //enable input

        } 
        // else {
        //     $('#select_btn').attr('disabled', true); //disable input
        // }
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