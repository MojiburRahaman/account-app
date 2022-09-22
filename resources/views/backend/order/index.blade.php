@extends('backend.master')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Payment</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
        
                <form action="{{ route('searchdetails') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-3">
                    
                           
                            <div class="form-group">
                                <input name="fromDate" id="fromDate" type="date"  class="form-control input-sm">
                                    
                            </div>
         
         
                        
                    </div>
                    <div class="col-md-3">
                        
                        <div class="form-group">
                            <input name="toDate" id="toDate" type="date"  class="form-control input-sm">                              
                               
                        </div>
                    </div>
                    <div class="col-md-2">
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
           
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12" style=" padding: 10px; overflow: hidden;">
                <a class="btn-sm btn-primary float-right" href="{{route('indetails')}}">In Details</a>
            </div>
            <div class="col-12">
               
                <div class="card-body table-responsive p-0">
                    <table style="overflow-x:auto;" class="table  text-nowrap" id="order_table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Invoice No</th>
                                <th>Depot Name</th>
                                <th>Payment Time </th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Details</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                @isset($order->invoice_no)
                                <td>{{$order->invoice_no}}</td>
                                @endisset
                                @isset($order->depot_name)
                                 <td>{{$order->depot_name}}</td>
                                @endisset
                                @isset($order->created_at)
                                <td>{{date('Y-m-d',strtotime($order->created_at))}}</td>
                                @endisset
                                @isset($order->method)
                                <td>{{$order->method}}</td>
                                @endisset
                                @isset($order->amount)
                                <td>
                                    {{$order->amount}}
                                     
                                </td>
                                @endisset
                                <td>
                                    @isset($order->id)
                                    <a class="btn-sm btn-primary" href="{{route('orders.show',$order->id)}}">Details</a>
                                   
                                    <a class="btn-sm btn-success" href="{{route('InvoiceDownload',$order->id)}}"><i
                                            class="fa fa-download"></i></a>
                                    
                                            <a class="btn-sm btn-success" href="{{route('coll.edit',$order->id)}}">Edit</a>
                                            @endisset       
                                </td>
                                 {{-- <td> {{$order->sum('amount')}}</td> --}}
                            </tr>
                           
                            @empty
                            <tr>
                                <td colspan="10">No Record</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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


$(document).ready( function () {
    $('#order_table').DataTable();
} );
</script>
@endsection