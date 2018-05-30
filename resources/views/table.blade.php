@extends('row.layout')

<table class="table table-dark table-hover">
	<tr>
		<td>###</td>
		<td>Nombre</td>
		<td>Edad</td>
		<td>OPT</td>
	</tr>
	@foreach ($post as $val)
	<tr>
		<td>{{ $val->id }}</td>
		<td>{{ $val->name }}</td>
		<td>{{ $val->edad }}</td>
		<td>
			<button class="btn btn-info" value="{{ $val->id }}" />Alterar</button>&nbsp; 
			<button class="btn btn-danger laravel" value="{{ $val->id }}" id="test" />ELIMINAR</button>
		</td>
	</tr>
	@endforeach
</table>
