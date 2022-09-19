<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Example 1</title>
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                width: 100%;
                height: 100%;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 12px;
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 90px;
            }

            h1 {
                border-top: 1px solid #5D6975;
                border-bottom: 1px solid #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(dimension.png);
            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: right;
                width: 52px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.8em;
            }

            #company {
                float: right;
                text-align: right;
            }

            #project div,
            #company div {
                white-space: nowrap;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: left;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table td.grand {
                border-top: 1px solid #5D6975;
            }

            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }

        </style>
    </head>

    <body>
        <header class="clearfix">
            <h1>{{config('app.name')}}</h1>
            {{-- <div id="company" class="clearfix">
                <div>Company Name</div>
                <div>455 Foggy Heights,<br /> AZ 85004, US</div>
                <div>(602) 519-0450</div>
                <div><a href="mailto:company@example.com">company@example.com</a></div>
            </div> --}}
            <div id="project">
                {{-- <div><span>PROJECT</span> Website development</div>
                <div><span>CLIENT</span>{{Auth::user()->name}}
            </div>
            <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
            <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
            <div><span>DATE</span>{{$billing_details->created_at->format('D,My')}}</div> --}}
            <div class="row mb-5">
                <div class="col-6 col-lg-6">
                    <strong>Order Number</strong>: {{$order->order_number}}
                    <br>
                    <strong>Order Date</strong>: {{$order->created_at->format('d,M,Y')}}
                    <br>
                    <br>
                    <strong> Name </strong> : {{$order->billing_details->billing_user_name}}
                    <br>
                    <strong> Number</strong> : {{$order->billing_details->billing_number}}
                    <br>
                    <strong>Email</strong> : {{$order->billing_details->user_email}}
                    <br>
                    <strong>Address</strong> : <br>
                    Division: {{$order->billing_details->Division->name}},<br>
                    District: {{$order->billing_details->District->name}},<br>
                    Upazila: {{$order->billing_details->Upazila->name}}
                </div>
            </div>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th colspan="1" class="service">Product</th>
                        <th colspan="1" class="service">Quantity</th>
                        <th colspan="1" style="text-align: right"> TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order->order_details as $order_product)
                    <tr>
                        <td colspan="1">
                            {{$order_product->Product->title}}

                            @if ($order_product->Color->color_name != 'None')
                            <br> Color: {{$order_product->Color->color_name}}
                            @endif

                            @if ($order_product->Size->size_name != 'None')
                            <br> Size: {{$order_product->Size->size_name}}
                            @endif

                            @if ($order_product->flavour_id != '')
                            <br> Flavour: {{$order_product->Flavour->flavour_name}}
                            @endif
                        </td>
                        <td>
                            {{$order_product->quantity}}
                        </td>
                        <td style="text-align: right">
                            @php
                            $product =$order_product->Product->WithTrash_Attribute
                            ->where('color_id',$order_product->color_id)
                            ->where('size_id',$order_product->size_id)->first();
                            $sale_price = $product->sell_price;
                            $regular_price = $product->regular_price;
                            if ($sale_price) {
                            echo $sale_price * $order_product->quantity;
                            }
                            if ($sale_price == '') {
                            echo $regular_price * $order_product->quantity;
                            }
                            @endphp
                        </td>
                    </tr>
                    @empty

                    @endforelse
                    <tr>
                        <td colspan="2" style="text-align: right">Total</td>
                        <td colspan="1" style="text-align: right">{{$order->total}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right">Shipping</td>
                        <td colspan="1" style="text-align: right">{{$order->shipping}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right">Discount</td>
                        <td colspan="1" style="text-align: right">{{$order->discount}}</td>
                    </tr>
                    <tr>
                        <td class="grand total" colspan="2" style="text-align: right">SubTotal</td>
                        <td class="grand total" colspan="1" style="text-align: right">{{$order->subtotal}}</td>
                    </tr>
                </tbody>
            </table>



        </main>
        {{-- <footer>
            Invoice was created on a computer and is valid without the signature and seal.
        </footer> --}}
    </body>

</html>