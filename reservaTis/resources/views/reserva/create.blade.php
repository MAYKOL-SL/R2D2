@extends('app')
@section('contentheader_title')
    Registrar Ventas
@endsection

@section('main-content')
@if(count($errors)>0)
    <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <ul>
      @foreach($errors->all() as $error)
      <li>{!!$error!!}</li>
      @endforeach 
    </ul>
    </div>
    @endif

<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Ingrese datos de su reserva </label>
  </div>
  <div>

<div class="box-body">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                 {!!Form::label('Tipo de aula')!!}
                    {!!Form::select('tipoAmbiente',$tipoambiente,null,['placeholder'=>'Seleccione','required'=>'required'])!!}
              </div>
              </div>
              </div>
              </div>





@endsection