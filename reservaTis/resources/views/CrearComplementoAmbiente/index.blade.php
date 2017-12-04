@extends('app')
@section('contentheader_title')
    Lista de Ambientes
@endsection
    
@section('main-content')
 <div class="box box-primary">
  <div class="table-responsive">
  <div class="box-header with-border">
  <label class = "box-title">Lista de ambientes</label>
  </div>

  <div class="box-header">
                <a href="{{ route('CrearAmbiente.create') }}" class="btn btn-info">Crear nuevo ambiente</a>
            <a href="{{ route('CrearComplementoAmbiente.create') }}" class="btn btn-info">Crear Complemento Para llevar</a>
            <a href="{{ route('CrearAmbiente.index') }}" class="btn btn-info">Lista De Ambientes</a>

</div>

             <!-- Buscador de ambiente-->
  {!! Form::open(['route'=>'CrearComplementoAmbiente.index','method'=>'GET', 'class'=>'navbar-form pull-right']) !!}
  <div class="input-group col-md-6 pull-right">
  <span class="input-group-addon"><i class="fa fa-search"></i></span>
          {!! Form::text('name',null,['class'=>'form-control','placelhoder'=>'Buscar ambiente...','aria-describebdy'=>'search']) !!}
 </div>
  {!! Form::close() !!}
<!--Fin de buscador -->
 
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped table-bordered table-condensed table-hover">
  <thead>
    <th>Nombre Ambiente</th>
    <th>Imagen Ubicación</th>
    <th>Ubicación</th>
    <th>Capacidad</th>
    <th>Típo</th>
    <th>Complementos</th>
    <th>Acciones</th>
  </thead>
  <tbody>
    @foreach($ambiente as $ambientes)
      @if($ambientes->tipo_ambiente->tipo_aula=="activo" ||
      $ambientes->tipo_ambiente->tipo_aula=="inactivo")
      <tr>
        <td>{{$ambientes->title}}</td>
        <td>
                <img src="{{asset('imagenes/'.$ambientes->imagen)}}" class="pic" alt="{{$ambientes->title}}">
                <img src="{{asset('imagenes/'.$ambientes->imagen)}}" class="picbig" >
            </td>
            <td>{{$ambientes->ubicacion}}</td>
            <td>{{$ambientes->capacidad}}</td>
        <td>{{$ambientes->tipo_ambiente->tipo_aula}}</td>
        <td>
          @foreach($ambientes->complementos as $comple)
          -{{$comple->nombre_complemento}}
          @endforeach
          </td>
        <td>
        <a href="{{ route('CrearComplementoAmbiente.edit', $ambientes->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{ route('CrearAmbiente.destroy', $ambientes->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
      </td>
      </tr>
      @endif
    @endforeach
  </tbody>
  </table>
<div class="text-center">
{!! $ambiente->render() !!}
</div>
</div>
</div>
</div>
</div>
<div class="col-md-2"></div>
 @endsection
