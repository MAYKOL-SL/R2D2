@extends('app')
@section('contentheader_title')
    Lista de Ambientes
@endsection
    
@section('main-content')
 <div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Lista de ambientes</label>
  </div>

  <div class="box-header">
                <a href="{{ url('CrearAmbiente/create') }}" class="btn btn-info">Crear nuevo ambiente</a>
            
</div>
             <!-- Buscador de ambiente-->
  {!! Form::open(['route'=>'CrearAmbiente.index','method'=>'GET', 'class'=>'navbar-form pull-right']) !!}
  <div class="input-group col-md-6 pull-right">
  <span class="input-group-addon"><i class="fa fa-search"></i></span>
          {!! Form::text('name',null,['class'=>'form-control','placelhoder'=>'Buscar ambiente...','aria-describebdy'=>'search']) !!}
 </div>
  {!! Form::close() !!}
<!--Fin de buscador -->


<table class="table table-striped">
  <thead>
    <th>Nombre Ambiente</th>
    <th>Capacidad</th>
    <th>Ubicación</th>
    <th>Tipo Ambiente</th>
    <th>Acciones</th>
  </thead>
  <tbody>
    @foreach($ambiente as $ambientes)

      <tr>
        <td>{{$ambientes->title}}</td>
        <td>{{$ambientes->capacidad}}</td>
        <td>{{$ambientes->ubicacion}}</td>
        <td>{{$ambientes->tipo_ambiente->tipo_aula}}</td>
        <td>
          <a href="{{ route('CrearAmbiente.edit', $ambientes->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{ route('CrearAmbiente.destroy', $ambientes->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
        </td>
      </tr>

    @endforeach
  </tbody>
</table>
<div class="text-center">
{!! $ambiente->render() !!}
</div>
</div>
<div class="col-md-2"></div>
 @endsection