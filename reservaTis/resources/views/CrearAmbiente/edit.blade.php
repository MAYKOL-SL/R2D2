@extends('app')

@section('htmlheader_title')
    User
@endsection


@section('main-content')
<div class="box box-primary">
  <div class="table-responsive">
  <div class="box-header with-border">
  <label class = "box-title">Editar {{$ambiente->title}} </label>
  </div>

  {!!Form::open(['route'=>['CrearAmbiente.update',$ambiente],'method'=>'PUT', 'files' => true])!!}


<div class="box-header">
    {!! Form::label('Nombre: ') !!}
    {!! Form::text('title', $ambiente->title, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="box-header">
{!! Form::label('Capacidad: ') !!}
{!! Form::number('capacidad', $ambiente->capacidad, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="box-header">
{!! Form::label('Ubicación: ')!!}
{!! Form::text('ubicacion',$ambiente->ubicacion, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="box-header">
{!! Form::label('Complementos: ') !!}
{!! Form::select('complementos[]',$complementos,$my_complementos,['class'=>'form-control input-sm select-tag','multiple','required']) !!}
</div>

<div class="box-header">
{!! Form::label('Facultad :') !!}
    {!! Form::select('facultad_id',$facultades,null,['id'=>'state','class'=>'form-control input-sm'
    ,'placeholder'=>'Seleccione','required'=>'required']) !!}

</div>


<div class="box-header">
{!! Form::label('Tipo ambiente: ') !!}
{!! Form::select('tipo_ambiente_id',$tipos,$ambiente->tipo_ambiente->id,['id'=>'state','class'=>'form-control input-sm'
    ,'placeholder'=>'Seleccione','required'=>'required']) !!}
</div>

<div class="box-header">
  {!! Form::label('imagen','Imagen de Ubicación: ') !!}
  {!! Form::file('imagen', ['class'=>'form-control input-sm']) !!}
</div>

<div class="box-header">
    <td>
{!! Form::submit('Editar Ambiente ', ['class' => 'btn btn-primary']) !!}
    </td>
</div>

    {!! Form::close() !!}

</div>
</div>


@endsection
@section('js')
<script>
  $('.select-tag').chosen({
    placeholder_text_multiple:'Seleccione los complementos del ambiente'
  });

</script>
@endsection
