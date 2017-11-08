@extends('app')

@section('htmlheader_title')
    Consultas
@endsection

@section('main-content')

<html>
	<h1>Busqueda por capacidad Nuevo</h1>

	<div class="row">

		<div class="form-group">

			{!! Form::open(['action' => 'Consultas\\Capacidad@consultaPorCapacidad']) !!}
			
			{!! Form::label('capacidad', 'Capacidad') !!}

			{!! Form::number('numero', null, ['id' => 'capacidad_id']) !!}

			{!! Form::button('Buscar', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}

			{!! Form::close() !!}

		</div>

	</div>
	
</html>

	
@endsection
