@extends('app')
@section('contentheader_title')
    Tipo De Reserva Por Ambiente
@endsection
    
@section('main-content')
 <div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Lista de ambientes</label>
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
   <th>Nombre Ambiente</th>
    <th>Capacidad</th>
    <th>Ubicación</th>
    <th>Tipo Ambiente</th>
    <th>Complemento</th>
    <th>Acciones</th>
  </thead>
  <tbody>
    @foreach($ambiente as $ambientes)
      @if($ambientes->tipo_ambiente->tipo_aula<>"activo" &&
      $ambientes->tipo_ambiente->tipo_aula<>"inactivo")
     <tr>
        <td>{{$ambientes->title}}</td>
        <td>{{$ambientes->capacidad}}</td>
        <td>{{$ambientes->ubicacion}}</td>
        <td>{{$ambientes->tipo_ambiente->tipo_aula}}</td>
        <td>
          @foreach($ambientes->complementos as $comp)
          -{{$comp->nombre_complemento}}
          @endforeach
          </td>
        <td>
          <a href="{{ route('ambiente.edit', $ambientes->id)}}" class="btn btn-success"><span aria-hidden="true"></span>Reservar</a>
        </td>
      </tr>


    @endif
     

    @endforeach
  </tbody>
</table>

{!! $ambiente->render() !!}
</div>

@endsection
