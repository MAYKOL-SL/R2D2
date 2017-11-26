@extends('app')

@section('htmlheader_title')
   Busqueda por Hora

@endsection


@section('main-content')

<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">BUSQUEDA POR HORA Y FECHA</label>
  </div>

@include('porCapacidad.search')

<div class="box-header">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <!--th>Id</th-->
                    <th>Ambiente</th>
                    <th>capacidad</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <!--th>Periodo</th-->
                    <!--th>Complemento</th-->
                    <th>Opciones</th>

                </thead>
                @foreach ($ambientes as $amb)
                 @if($amb->tipo_aula<>"activo" && $amb->tipo_aula<>"inactivo")
                <tr>
                    <!--td>{{ $amb->id}}</td-->
                    <td>{{ $amb->title}}</td>
                    <td>{{ $amb->capacidad}}</td>
                    <td>{{ $fechaIni}}</td>
                    <td>{{ $fechaFin}}</td>
                    <!--td>{{ $periodoBuscado}}</td-->
                    <!--td>{{ $amb->nombre_complemento}}</td-->
                    <td>
                        <a href="{{ url('reservas/create') }}" class="btn btn-info">Reservar</a>
                    </td>
                </tr>
                  @endif
                @endforeach
            </table>
        </div>
    </div>
</div>
</div>

</div>
@endsection
