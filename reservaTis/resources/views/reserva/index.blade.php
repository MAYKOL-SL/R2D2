@extends('app')
@section('contentheader_title')
    BIENVENIDO
@endsection

@section('main-content')
<?php $message=Session::get('message')?>
@if ($message=='store') 
  <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    Reserva realizada correctamente
</div>
@endif
<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">LISTA DE RESERVAS </label>
  </div>
  <div>
      <div class="box-header">
                <h1 class="box-title">Añadir nueva reserva<a href="{{ url('reserva/create') }}" class="btn btn-primary btn-xs" title="Registrar reseva"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
            </div>
  <table class="table table-striped">
  	<thead>
  		<th>Fecha</th>
  		<th>Dias</th>
  		<th>Ambiente</th>
  		<th>Reservante</th>
    </thead>
  	<tbody>
  	</tbody>
  </table>
  </div>
  </div>
  </div>
  <td>
          {!!Form::submit('Buscar aula',['class'=>'btn btn-primary'])!!}
        </td>
@endsection