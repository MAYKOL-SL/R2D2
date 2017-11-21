@extends('app')
@section('contentheader_title')
    Tipo De Reserva Por Ambiente
@endsection
    
@section('main-content')
 <div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Lista de ambientes</label>
  </div>
<div class="box-header">
<div class="input-group"> <span class="input-group-addon">Buscar</span>
        <input id="filtrar" type="text" class="form-control" placeholder="Ingresa datos del aula que desa buscar....">
      </div>
</div>
<table class="table table-striped">
  <thead>
   <th>Nombre Ambiente</th>
    <th>Capacidad</th>
    <th>Ubicación</th>
    <th>Tipo Ambiente</th>
    <th>Complemento</th>
    <th>Acciones</th>
  </thead>
  <tbody class="buscar">
    @foreach($ambiente as $ambientes)

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

    @endforeach
  </tbody>
</table>
{!! $ambiente->render() !!}
</div>

@endsection

 @section('js')
<script>
$(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>
@endsection