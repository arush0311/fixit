<!DOCTYPE html>
<html>
<head>
	<title>Fixtures - @yield('title') </title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="navbar-containercontainer row">
			<div class="col-md-3">
				<h1>FixIt</h1>
			</div>
			@yield('navbar-content')
		</div>

		<hr>
		<br><br>
		@yield('content')

	</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>