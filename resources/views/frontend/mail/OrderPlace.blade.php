<h1 style="text-align: center"><a style="text-decoration: none;color:#ef4836;"
        href="{{route('Frontendhome')}}">{{config('app.name')}}</a>
</h1>
<div>

    <h3>Hi {{$user_name}},</h3>
    <p>Thank you for ordering from {{ config('app.name') }}!</p>
    <p>We're excited for you to receive your order <b>#{{$order_number}}</b> and will notify you once it's on its way.</p>
    
    Thanks,<br>
    {{ config('app.name') }}
</div>