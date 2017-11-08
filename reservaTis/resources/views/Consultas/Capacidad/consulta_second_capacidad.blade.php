@extends('app')

@section('htmlheader_title')
    Consultas
@endsection

@section('main-content')

<html>
	<h1>Busqueda por capacidad</h1>

	<table class="table">
			<tr>
				<td>Aula</td>
				<td>Capacidad</td>
				<td>Ubicacion</td>
			</tr>
				@foreach ($datos as $valores)
			<tr>
				<td>{{ $valores -> title }}</td>
				<td>{{ $valores -> capacidad }}</td>
				<td>{{ $valores -> ubicacion }}</td>
				<td>
					<!-- Añadir Funcionalidad para redireccionar a Reserva -->
					<a href="{{ url('reserva_capacidad')}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
				</td>
			</tr>
				@endforeach
			
		</table>
	
</html>

	
@endsection
