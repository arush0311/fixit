@extends('master')

@section('title')
	HOME
@stop


@section('navbar-content')

	
		<div class="logout-form col-md-2 col-md-offset-7 text-center">
			<br><p class="text-muted">Welcome {{ ucfirst($username) }}</p>
			<form method="post" action="/logout">
				{!! csrf_field() !!}
				<button type="submit" class="btn btn-primary">Logout</button>
			</form>
		</div>

@stop
@section('content')
	<div class="row">
	
		<div class="add-form col-md-8">
			<form method="post" action="/add">
				@if($errors)
					@foreach($errors->all() as $error)
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ $error }}
						</div>
					@endforeach
				@endif
				@if(Session::has('message'))
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('message') }}
					</div>
				@endif
				{!! csrf_field() !!}
				<label for="p_name">Name:</label><br>
				<input type="text" placeholder="Participent Name" name="name" id="p_name" class="form-control"><br>
				<button type="submit" class="btn btn-warning">Add Participent</button>
			</form>
		</div>
		<div class="col-md-3 col-md-offset-1">
		<div class="reset-form">
			<br>
			<form method="post" action="/reset">
				{!! csrf_field() !!}
				<button type="submit" class="btn btn-danger">Delete all previous participents</button>
			</form>
			<br>
		</div>
		<div class="generatefixtures-form">

			<a class="btn btn-success" href="/home">Update Fixtures</a>
		</div>
		</div>
	</div>
	<br><br><hr>

	<div class="row print">
		
		<h2 class="text-center">Fixtures</h2>
		<br>
		@if($fixtures)
			<?php $i = 0;?>
			<div class="col-md-3 col-md-offset-9"><button class="btn btn-success" onclick="window.print();" href="#">Print</button></div><br><br><br>
			@foreach($fixtures as $fixture)
			
				  		<ul class="list-group" style="max-width:200px;">
				  			<li class="list-group-item">Fixture {{ $i + 1 }}</li>
				  			<li class="list-group-item">{{$fixture[0]['name']}}</li>

				  			@if($fixture[1] != $fixture[0])
				  				<li class="list-group-item">{{$fixture[1]['name']}}</li>
				  			@endif

				  		</ul>
			<?php $i = $i +1 ?>
			@endforeach






		@else
			<p class="text-muted text-center">There are no participents in the record. Please add some participents</p>
		@endif

	</div>



@stop