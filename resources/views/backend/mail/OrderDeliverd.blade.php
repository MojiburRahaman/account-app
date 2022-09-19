<h1 style="text-align: center"><a style="text-decoration: none;color:#ef4836;"
        href="{{route('Frontendhome')}}">{{config('app.name')}}</a>
</h1>
<h3>Hi {{$user_name}},</h3>
<p>We are pleased to inform that your order <b>#{{$order_details->order_number}}</b> has been delivered.</p>
<p>We hope you are enjoying your recent purchase! Once you have a chance, we would love to hear your shopping experience
    to keep us constantly improving.</p>

Thanks,<br>
{{ config('app.name') }}