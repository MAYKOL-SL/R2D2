@extends('app')
@section('contentheader_title')
    Lista de Tipos de Ambiente
@endsection
    
@section('main-content')
 <div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Lista de tipos de ambientes</label>
  </div>
<div class="box-header">
             <a href="{{ url('tiposambiente/create') }}" class="btn btn-info">Crear nuevo tipo ambiente</a>
            </div><hr>
<table class="table table-striped">
  <thead>
    <th>Tipo ambiente</th>
    <th>Acciones</th>
  </thead>
  <tbody>
    @foreach($tipoambiente as $tipoambientes)

      <tr>
        <td>{{$tipoambientes->tipo_aula}}</td>
        <td>
          <a href="{{ route('tiposambiente.edit', $tipoambientes->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{ route('tiposambiente.destroy', $tipoambientes->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
        </td>
      </tr>

    @endforeach
  </tbody>
</table>

<div class="text-center">
{!! $tipoambiente->render() !!}
</div>
</div>
 @endsection