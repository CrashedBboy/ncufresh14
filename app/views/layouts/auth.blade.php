<div id="auth_box">
@if(Auth::check())
{{-- User has logined. show logout(?) --}}
	<a href="{{ route('logout') }}">Logout</a>
@else
{{-- User not logined. show login form --}}
	{{-- Login form --}}
	{{ Form::open(array('route' => 'login')) }}
	{{ Form::label('email', '帳號') }}
	{{ Form::text('email') }}
	<br>
	{{ Form::label('密碼') }}
	{{ Form::password('password') }}
	<br>
	{{ Form::submit('Login') }}
	<a href="{{ route('loginFB') }}"><button type="button" class="btn btn-default btn-sm">Login with FB</button></a>
	{{ Form::close() }}
	
@endif
</div>