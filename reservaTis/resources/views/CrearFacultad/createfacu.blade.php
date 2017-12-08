@extends('app')

@section('htmlheader_title')
    User
@endsection


@section('main-content')
<div class="box box-primary">
  <div class="responsive">
  <div class="box-header with-border">
  <label class = "box-title">Ingrese los datos de la Facultad </label>
  </div>

{!!Form::open(['route'=>'facultad.store','method'=>'POST', 'files' => true])!!}

    <div class="box-header">
        {!! Form::label('Nombre: ') !!}
        {!! Form::text('nombref', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>

    <div class="box-header">
        <td>
    {!! Form::submit('Crear Facultad ', ['class' => 'btn btn-primary']) !!}
        </td>
    </div>

    {!! Form::close() !!}

</div>
</div>


@endsection
