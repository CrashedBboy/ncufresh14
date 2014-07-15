<div id="auth_box">
@if(Auth::check())
{{-- User has logined. show logout(?) --}}
	<a href="{{ route('logout') }}">Logout</a>
@else


{{-- User not logined. show login form --}}
	{{-- Login form --}}
	{{ Form::open(array('route' => 'login', 'id' => 'login-form')) }}
	{{-- Form::label('email', '帳號') --}}
	{{ Form::text('email', null, array('id' => 'account', 'placeholder' => '帳號')) }}
	<br>
	{{-- Form::label('密碼') --}}
	{{ Form::password('password', array('id' => 'password', 'placeholder' => '密碼')) }}
	<br>
	<a href="{{ route('register') }}"><div id="register"></div></a>
	{{ Form::submit('', array('id' => 'submit')) }}
	<a href="{{ route('login.FB') }}"><div id="fblogin"></div></a>
	{{ Form::close() }}
	
@endif
</div>