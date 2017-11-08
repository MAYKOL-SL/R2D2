@extends('app')

@section('htmlheader_title')
    Consultas
@endsection


@section('contentheader_title')
    Consultas
@endsection

@section('contentheader_description')
    por capacidad de ambiente
@endsection


@section('enlaces')
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
@endsection



@section('main-content')

<html>
	<h1>Consulta Capacidad</h1>

	<div class="row">
		<div class="form-group col-md-4">

		      {!!Form::label('capacidad_name', 'Capacidad')!!}
		      {!! Form::text('capacidad', null, array('type' => 'Capacidad', 'class' => 'number_format(number)')) !!}

		</div>
	</div>
	
</html>

	
@endsection
