@extends('app')

@section('htmlheader_title')
    User
@endsection


@section('main-content')
<div class="box box-primary">
  <div class="table-responsive">
  <div class="box-header with-border">
  <label class = "box-title">Ingrese los datos del complemento: </label>
  </div>

{!!Form::open(['route'=>'CrearComplementoAmbiente.store','method'=>'POST', 'files' => true])!!}

<div class="box-header">
    {!! Form::label('Nombre: ') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="box-header">
{!! Form::label('Numero de serie: ') !!}
{!! Form::number('capacidad', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="box-header">
{!! Form::label('Ubicación: ')!!}
{!! Form::text('ubicacion',null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="box-header">
{!! Form::label('Tipo de complemento: ') !!}
{!! Form::select('complementos[]',$complementos,null,['class'=>'form-control input-sm','placeholder'=>'Seleccione','required']) !!}
</div>

<div class="box-header">
{!! Form::label('Estado: ') !!}
{!! Form::select('tipo_ambiente_id',$tipos,null,['id'=>'state','class'=>'form-control input-sm'
    ,'placeholder'=>'Seleccione','required'=>'required']) !!}
</div>

<div class="box-header">
  {!! Form::label('imagen','Imagen de Ubicación: ') !!}
  {!! Form::file('imagen',['class'=>'form-control input-sm']) !!}
</div>


<div class="box-header">
    <td>
{!! Form::submit('Crear Complemento de Ambiente ', ['class' => 'btn btn-primary']) !!}
    </td>
</div>

    {!! Form::close() !!}

</div>
</div>


@endsection
