@extends('app')
@section('contentheader_title')
    Lista de Complementos
@endsection
    
@section('main-content')
 <div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Lista de complementos</label>
  </div>
<div class="box-header">
             <a href="{{ url('complemento/create') }}" class="btn btn-info">Crear nuevo complemento</a>
            </div><hr>
<table class="table table-striped">
  <thead>
    <th>Nombre Componente</th>
    <th>Estado</th>
    <th>Acciones</th>
  </thead>
  <tbody>
    @foreach($complemento as $complementos)

      <tr>
        <td>{{$complementos->nombre_complemento}}</td>
        <td>
          @if($complementos->estado == "Inactivo")
          <span class="label label-danger">{{$complementos->estado}}</span>
            @else
            <span class="label label-primary">{{$complementos->estado}}</span>
          @endif
        </td>
        <td>
          <a href="{{ route('complemento.edit', $complementos->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{ route('complemento.destroy', $complementos->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
        </td>
      </tr>

    @endforeach
  </tbody>
</table>

<div class="text-center">
{!! $complemento->render() !!}
</div>
</div>
 @endsection