<!DOCTYPE html>
<html>
<head>
	<title>LARAVEL</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap-select.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="{{ url('js/bootstrap-select.js') }}"></script>
</head>
<body>
<div class="container">
	
	<hr>
	<form action="{{ route('opt') }}" method="POST">
		{{csrf_field()}}
		<div class="form-group">
			<select class="selectpicker" multiple name="opt">
			  @foreach ($post as $val)	
			  <option value="{{ $val->name }}">{{ $val->name }}</option>	
			  @endforeach
			</select>
		</div>
		<div class="form-group">
			<select class="selectpicker" data-live-search="true" data-style="btn-info" name="opt2">
				<option value="0" data-icon="glyphicon glyphicon-plus">0</option>
				<option value="1" data-icon="glyphicon glyphicon-music">1</option>
				<option value="2" data-icon="glyphicon glyphicon-signal">2</option>
				<option value="3" data-icon="glyphicon glyphicon-envelope">3</option>
				<option value="4" data-icon="glyphicon glyphicon-star">laravel</option>
				<option value="5" data-icon="glyphicon glyphicon-heart">Cake PHP</option>
			</select>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">ENVIAR</button>
		</div>
	</form>
	<hr>
</div>
</body>
</html>