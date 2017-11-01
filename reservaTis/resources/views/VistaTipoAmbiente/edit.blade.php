@extends('app')

@section('contentheader_title')
    Crear Tipo Ambiente
@endsection

@section('main-content')

{!!Form::open(['route'=>['tiposambiente.update',$tipoambiente],'method'=>'PUT'])!!}

<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Editar {{$tipoambiente->tipo_aula}}</label>
  </div>

<div class="box-header">
        {!!Form::label('Nombre del tipo de ambiente: ')!!}
           {!!Form::text('tipo_aula',$tipoambiente->tipo_aula,['class' =>'form-control','placeholder' => 'Ingrese nombre del tipo ambiente','required'])!!}
</div>

      <div class="box-header">
        <td>
          {!!Form::submit('Editar Tipo Ambiente',['class'=>'btn btn-primary'])!!}
        </td>
        </div>
      </div>

{!!Form::close()!!}
@endsection