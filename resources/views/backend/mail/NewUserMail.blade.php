<h1>Hello {{$user_name}}</h1>
<p>New Admin Account Craeted On <a href="{{route('Frontendhome')}}">{{config('app.name')}}</a></p>
<p>Your Login Password is : {{$password_send_to_user}}</p>
<p>You Can login admin panel by <a href="{{route('AdminLogin')}}">Click here</a></p>
<h6>Thanks</h6>