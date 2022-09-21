@extends('backend.master')

@section('content')

<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Invoice no: {{$order->invoice_no}}</h1> --}}
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

             
                
                        <form action="{{ route('searching') }}" method="POST" enctype="multipart/form-data">
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
                   
             
            {{-- <div class="row mb-5"> --}}
                {{-- <div class="col-6 col-lg-6"> --}}
                    {{-- <h4>
                        Name : {{$order->billing_details->billing_user_name}}
                    </h4>
                    <strong> Number</strong> : {{$order->billing_details->billing_number}}
                    <br>
                    <strong>Email</strong> : {{$order->billing_details->user_email}}
                    <br>
                    <strong>Address</strong> : <br>
                    Division: {{$order->billing_details->Division->name}},<br>
                    District: {{$order->billing_details->District->name}},<br>
                    Upazila: {{$order->billing_details->Upazila->name}}
                    <br>
                    <strong>Order Note</strong>: {{$order->billing_details->billing_order_note}}
                    <br>
                    <strong>Order Date</strong>: {{$order->created_at->format('d,M,Y')}}
                    <br>
                    <strong>Total Payment</strong>: ৳ {{$order->subtotal}} --}}
                    {{--
                </div> --}}

                {{-- <div class="col-6 col-lg-6 text-right">
                    @if ($order->delivery_status == 1)
                    <a href="" class="btn-sm btn-danger">pending</a>
                    @elseif ($order->delivery_status == 2)
                    <a href="" class="btn-sm btn-warning">On The way</a>
                    @else
                    <a class="btn-sm btn-success">Deliverd</a>
                    @endif
                    <a class="btn-sm btn-success" href="{{route('InvoiceDownload',$order->id)}}"><i
                            class="fa fa-download"></i>
                    </a>
                </div> --}}
                {{-- </div> --}}
            {{-- <div class="col-12">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap" id="pdf">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Flavour</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->order_details as $order_product)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    {{$order_product->Product->title}}
                                </td>
                                <td>
                                    {{$order_product->Color->color_name}}
                                </td>
                                <td>
                                    {{$order_product->Size->size_name}}
                                </td>
                                <td>
                                    @if ($order_product->flavour_id != '')

                                    {{$order_product->Flavour->flavour_name}}
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    {{$order_product->quantity}}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">No Record</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> --}}
            {{-- <section class="invoice"> --}}


                {{-- <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> AdminLTE, Inc.
                            <small class="pull-right">Date: 2/10/2014</small>
                        </h2>
                    </div>

                </div> --}}

                <div class="row invoice-info">
                    {{-- <div class="col-sm-6 invoice-col">
                        From
                        <address>
                            <strong>{{ $order->User->name }}</strong><br>
                            Email: {{ $order->User->email }}
                        </address>
                    </div>

                    <div class="col-sm-6 invoice-col text-right">
                        <b>Invoice :{{ $order->invoice_no }}</b><br>
                        <b>Payment Date:</b> {{ $order->created_at->format('d/m/y') }}<br>
                    </div> --}}

                </div>


                <div class="row">
                    <div class="col-xs-12 table-responsive mt-5">
                        <table class="table table-striped">
                            <thead>
                                @forelse ($orders as $order)
                                <tr>
                                    <th>User Name</th>
                                    <th>Invoice :</th>
                                    <th>Depot Name :</th>
                                    <th>Payment Date</th>
                                    <th>Method</th>
                                    @isset(json_decode($order->details, true)['bank_name'])

                                    <th>Bank Name</th>
                                    @endisset
                                    @isset (json_decode($order->details, true)['trasaction_id'])
                                    <th>Transaction Id</th>
                                    @endisset
                                    @isset (json_decode($order->details, true)['slip_no'])
                                    <th>Bank Slip No</th>
                                    @endif
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <td>{{ $order->name }}</td>
                                 
                                   

                                    @isset($order->invoice_no)
                                    <td>{{ $order->invoice_no }}</td>
                                    @endisset
                                    @isset($order->depot_name)
                                    <td>{{ $order->depot_name }}</td>
                                    @endisset
                                    @isset($order->created_at)
                                    <td>{{date('Y-m-d',strtotime($order->created_at))}}</td>
                                    @endisset
                                    @isset($order->method)
                                    <td>{{ $order->method }}</td>
                                    @endisset
                                    @isset(json_decode($order->details, true)['bank_name'])

                                    <td>{{ json_decode($order->details, true)['bank_name'] }} </td>
                                    @endisset
                                    @isset (json_decode($order->details, true)['trasaction_id'])
                                    <td>{{ json_decode($order->details, true)['trasaction_id'] }} </td>
                                    @endisset
                                    @isset (json_decode($order->details, true)['slip_no'])
                                    <td>{{ json_decode($order->details, true)['slip_no'] }} </td>
                                    @endisset
                                    @isset($order->amount)
                                    <td>{{ $order->amount }}</td>
                                    @endisset
                                </tr>
                               
                            @empty
                            <tr>
                               
                            </tr>
                                @endforelse
                                {{-- <tr>
                                    
                                    @isset($orders->sum('amount'))
                                    <td colspan="10"><h6 style="font-weight: 700;">Total ammount: {{ $orders->sum('amount') }}</h6></td>
                                    @endisset
                                </tr> --}}
                                
                            </tbody>
                        </table>
                    </div>

                </div>


        </div>
    </section>

</div>
@endsection