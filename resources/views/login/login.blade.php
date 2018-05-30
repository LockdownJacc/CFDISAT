@extends('row.layout')

@section('content')
	<form action="{{ route('form') }}" method="POST">
	{{csrf_field()}}
		<label>Usuario</label>
		<input type="text" name="usuario"><br>
		<label>Password</label>
		<input type="Password" name="pass"><br>
		<input type="submit" value="Loguear">
	</form>
	@if (Session::has('error'))
		<div> <p class='alert alert-danger alert-dismissable'>{{Session::get('error')}}</p> </div>
	@endif
@stop