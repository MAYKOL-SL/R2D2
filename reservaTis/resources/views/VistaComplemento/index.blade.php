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
  <h1>LISTA DE COMPLEMENTOS </h1>
  </div>
<div class="box-header">
                <h1 class="box-title">Añadir nuevo complemento<a href="{{ url('complemento/create') }}" class="btn btn-primary btn-xs" title="Registrar reseva"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
            </div>
<table class="table table-striped">
  <thead>
    <th>ID</th>
    <th>Nombre Componente</th>
    <th>Acciones</th>
  </thead>
  <tbody>
    @foreach($complemento as $complementos)

      <tr>
        <td>{{$complementos->id}}</td>
        <td>{{$complementos->nombre_complemento}}</td>
        <td>
          <a href="" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
        </td>
      </tr>

    @endforeach
  </tbody>
</table>
</div>
<div class="col-md-2"></div>
 </div>
 </div>
 @endsection