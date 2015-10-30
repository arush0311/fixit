@extends('master')

@section('title')
	LOGIN
@stop


@section('content')
	<h3>Login</h3><br>
	@if($errors)
		@foreach($errors->all() as $error)
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ $error }}
			</div>
		@endforeach
	@endif
	<form method="post" action="/login">
		
	{!! csrf_field() !!}

	<label for="username">Username:</label><br>
	<input type="text" placehoder = "Username" id = "username" name="username" class="form-control" value= {{ old('username') }}></input><br>
	<label for="password">Password:</label><br>
	<input type="password" placehoder = "Password" id = "password" name="password" class="form-control"></input><br>
	<button type="submit" class="btn btn-default">Log In</button>



	</form>






@stop