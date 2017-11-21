<hr>
<div class="box-header with-border">
  <label class = "box-title">Lista de complementos</label>
  </div>
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
    @foreach($comp as $comps)

      <tr>
        <td>{{$ambientes->title}}</td>
        <td>
                <img src="{{asset('imagenes/'.$comps->imagen)}}" class="pic" alt="{{$comps->title}}">
                <img src="{{asset('imagenes/'.$comps->imagen)}}" class="picbig" >
            </td>
            <td>{{$comps->ubicacion}}</td>
            <td>{{$comps->capacidad}}</td>
        <td>{{$comps->tipo_ambiente->tipo_aula}}</td>
        <td>
          @foreach($comps->complementos as $comples)
          -{{$comples->nombre_complemento}}
          @endforeach
          </td>
        <td>
        @if($ambientes->tipo_ambiente->tipo_aula=="activo" ||
        $ambientes->tipo_ambiente->tipo_aula=="inactivo")
        <a href="{{ route('CrearComplementoAmbiente.edit', $ambientes->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{ route('CrearAmbiente.destroy', $ambientes->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
          @else
         <a href="{{ route('CrearAmbiente.edit', $ambientes->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{ route('CrearAmbiente.destroy', $ambientes->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
        @endif
      </td>
      </tr>

    @endforeach
  </tbody>
</table>

<div class="text-center">
{!! $comp->render() !!}
</div>