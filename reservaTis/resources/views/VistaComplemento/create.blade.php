@extends('app')

@section('contentheader_title')
    RESERVACIÓN
@endsection

@section('main-content')

{!!Form::open(['route'=>'complemento.store','method'=>'POST'])!!}
<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Ingrese el complemento</label>
  </div>

<div class="box-header">
        {!!Form::label('Nombre del complemento')!!}
        <div class="input-group">
           {!!Form::text('complemento',null,['required'=>'required'])!!}
      </div>
      </div>
      <div class="box-header">
        <td>
          {!!Form::submit('Registrar Complemento',['class'=>'btn btn-primary'])!!}
        </td>
        </div>
      </div>

{!!Form::close()!!}
@endsection