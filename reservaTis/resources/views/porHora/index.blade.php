@extends('app')

@section('htmlheader_title')
   Busqueda por Hora

@endsection


@section('main-content')

<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">BUSQUEDA HORAS LIBRES</label>
  </div>

@include('porHora.search')

<div class="box-header">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Ambiente</th>
                    <th>Capacidad</th>
                    <th>Calendario</th>
                    <th>periodo</th>
                    <th>Opciones</th>
                </thead>
                @foreach ($libres as $libres)
                
                <tr>
                    <td>{{ $libres->title}}</td>
                    <td>{{ $libres->capacidad}}</td>
                    <td>{{ $libres->fecha}}</td>
                    <td>{{ $libres->hora}}</td>
                    <td>
                        <a href="{{ url('reservas/create') }}" class="btn btn-info">Reservar</a>
                    </td>
                </tr>
                
                @endforeach
                
            </table>
        </div>
    </div>
</div>
</div>

</div>
@endsection
@section('js')
<script>
  $('.select-tag').chosen({
    placeholder_text_multiple:'Seleccione los periodos de busqueda'
  });

  $('.select-comp').chosen({
    placeholder_text_multiple:'Seleccione los complemento',
    width: '100%'
  });

  $('.select-amb').chosen({
    placeholder_text_multiple:'Seleccione los ambientes',
    width: '100%'
  });
</script>
@endsection
