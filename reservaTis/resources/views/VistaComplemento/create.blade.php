@extends('app')

@section('contentheader_title')
    Crear ambiente
@endsection

@section('main-content')

{!!Form::open(['route'=>'complemento.store','method'=>'POST'])!!}
<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Ingrese el complemento</label>
  </div>

<div class="box-header">
        {!!Form::label('Nombre del complemento')!!}
           {!!Form::text('nombre_complemento',null,['class' =>'form-control','placeholder' => 'Ingrese nombre del complemento','required'])!!}
</div>

<div class="box-header"> 
{!! Form::label('Estado: ') !!}
{!! Form::select('estado',[
  'Activo'=>'Activo',
  'Inactivo'=>'Inactivo'],null,['class'=>'form-control input-sm'
    ,'placeholder'=>'Seleccione un estado','required'=>'required']) !!}
</div>

      <div class="box-header">
        <td>
          {!!Form::submit('Registrar Complemento',['class'=>'btn btn-primary'])!!}
        </td>
        </div>
      </div>

{!!Form::close()!!}
@endsection