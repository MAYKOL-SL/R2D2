@extends('app')
@section('contentheader_title')
    Tipo De Reserva Por Ambiente
@endsection
    
@section('main-content')
 <div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
<div class="box box-primary">
  <div class="col-sm-10">
  <h1>LISTA DE AMBIENTES </h1>
  </div>
<!-- Buscador de ambiente-->
  {!! Form::open(['route'=>'ambiente.index','method'=>'GET', 'class'=>'navbar-form pull-right']) !!}
  <div class="input-group col-md-6 pull-right">
  <span class="input-group-addon"><i class="fa fa-search"></i></span>
          {!! Form::text('name',null,['class'=>'form-control','placelhoder'=>'Buscar ambiente...','aria-describebdy'=>'search']) !!}
 </div>
  {!! Form::close() !!}
<!--Fin de buscador -->
<table class="table table-striped">
  <thead>
    <th>Nombre</th>
    <th>Ubicación</th>
    <th>Reservar</th>
  </thead>
  <tbody>
    @foreach($ambiente as $ambientes)

      <tr>
        <td>{{$ambientes->nombre_aula}}</td>
        <td>{{$ambientes->ubicacion}}</td>
        <td>
          <a href="{{ route('ambiente.edit', $ambientes->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
        </td>
      </tr>

    @endforeach
  </tbody>
</table>
{!! $ambiente->render() !!}
</div>
<div class="col-md-2"></div>
 </div>
 </div>

@endsection
