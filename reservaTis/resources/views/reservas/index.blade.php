@extends('app')

@section('htmlheader_title')
   Users 
@endsection


@section('main-content')

<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">LISTA DE RESERVAS </label>
  </div>
<div class="box-header">
                <h1 class="box-title">Añadir nueva reserva<a href="{{ url('reservas/create') }}" class="btn btn-primary btn-xs" title="Registrar reseva"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
            </div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Id reserva</th>
                    <th>Usuario</th>
                    <th>Ambiente</th>
                    <th>Dia</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Opciones</th>
                </thead>
                @foreach ($reservas as $res)
                <tr>
                    <td>{{ $res->id_reserva}}</td>
                    <td>{{ $res->usuario}}</td>
                    <td>{{ $res->nombre_aula}}</td>
                    <td>{{ $res->nombre_dia}}</td>
                    <td>{{ $res->fecha_dia}}</td>
                    <td>{{ $res->hora_inicio}}</td>
                    <td>{{ $res->hora_fin}}</td>
                    <td>
                        <a href="{{URL::action('ReservasController@edit',$res->id_reserva)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$res->id_reserva}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                </tr>
               
                @endforeach
            </table>
        </div>
      
    </div>
</div>
</div>
@endsection