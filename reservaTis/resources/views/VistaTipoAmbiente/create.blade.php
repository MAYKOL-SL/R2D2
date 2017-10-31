@extends('app')

@section('contentheader_title')
    Crear Tipo Ambiente
@endsection

@section('main-content')

{!!Form::open(['route'=>'tiposambiente.store','method'=>'POST'])!!}
<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Ingrese el tipo de ambiente</label>
  </div>

<div class="box-header">
        {!!Form::label('Nombre del tipo de ambiente: ')!!}
           {!!Form::text('tipo_aula',null,['class' =>'form-control','placeholder' => 'Ingrese nombre del tipo ambiente','required'])!!}
</div>

      <div class="box-header">
        <td>
          {!!Form::submit('Registrar Tipo Ambiente',['class'=>'btn btn-primary'])!!}
        </td>
        </div>
      </div>

{!!Form::close()!!}
@endsection