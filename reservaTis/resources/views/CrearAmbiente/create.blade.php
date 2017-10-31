@extends('app')

@section('htmlheader_title')
    User
@endsection


@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Ingrese los datos del ambiente: </label>
  </div>

{!!Form::open(['route'=>'CrearAmbiente.store','method'=>'POST'])!!}

<div class="box-header">
    {!! Form::label('Nombre: ') !!}       
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="box-header">  
{!! Form::label('Capacidad: ') !!}
{!! Form::number('capacidad', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="box-header"> 
{!! Form::label('Ubicación: ')!!}
{!! Form::text('ubicacion',null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="box-header">         
{!! Form::label('Complementos: ') !!} 
{!! Form::select('complementos[]',$complementos,null,['class'=>'form-control input-sm select-tag','multiple','required']) !!}
</div>

<div class="box-header"> 
{!! Form::label('Tipo ambiente: ') !!}
{!! Form::select('tipo_ambiente_id',$tipos,null,['id'=>'state','class'=>'form-control input-sm'
    ,'placeholder'=>'Seleccione','required'=>'required']) !!}
</div>


<div class="box-header">
    <td>
{!! Form::submit('Crear Ambiente ', ['class' => 'btn btn-primary']) !!}
    </td>
</div>

    {!! Form::close() !!}

</div>

@endsection
@section('js')
<script>
  $('.select-tag').chosen({
    placeholder_text_multiple:'Seleccione los complementos del ambiente'
  });

</script>
@endsection