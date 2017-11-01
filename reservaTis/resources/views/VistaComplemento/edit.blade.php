@extends('app')

@section('main-content')

{!!Form::open(['route'=>['complemento.update',$complemento],'method'=>'PUT'])!!}
<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title"> Editar {{$complemento->nombre_complemento}}</label>
  </div>

<div class="box-header">
        {!!Form::label('Nombre del complemento')!!}
           {!!Form::text('nombre_complemento',$complemento->nombre_complemento,['class' =>'form-control','placeholder' => 'Ingrese nombre del complemento','required'])!!}
      </div>

      <div class="box-header"> 
{!! Form::label('Estado: ') !!}
{!! Form::select('estado',[
  'Activo'=>'Activo',
  'Inactivo'=>'Inactivo'],$complemento->estado,['class'=>'form-control input-sm'
    ,'placeholder'=>'Seleccione un estado','required'=>'required']) !!}
</div>

      <div class="box-header">
        <td>
          {!!Form::submit('Editar Complemento',['class'=>'btn btn-primary'])!!}
        </td>
        </div>
      </div>

{!!Form::close()!!}
@endsection