@extends('app')
@section('contentheader_title')
    Registrar Reserva
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



<div class="box-header">
            <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                 {!!Form::label('Marque los días:')!!}
                 <div class="form-check form-check-inline">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="lunes" value="option1"> Lunes
  </label>
</div>
<div class="form-check form-check-inline">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="martes" value="option2"> Martes
  </label>
</div>
<div class="form-check form-check-inline disabled">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="miercoles" value="option3">Miercoles
  </label>
</div>
<div class="form-check form-check-inline">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="jueves" value="option1">Jueves
  </label>
</div>
<div class="form-check form-check-inline">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="viernes" value="option2">Viernes
  </label>
</div>
<div class="form-check form-check-inline disabled">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="sabado" value="option3"> Sábado
  </label>
</div>
<div class="form-check form-check-inline disabled">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="domingo" value="option3">Domingo
  </label>
</div>
  
</div>
</div>

<div class="box-header">
      {!!Form::label('Hora inicio y final:')!!}
      <div class="input-group">
      <div class="input-group-addon">
                    <i class="fa fa-safari"></i>
                  </div>
      {!!Form::time('fechaInicio')!!}  
      {!!Form::time('fechaFin')!!}
      </div>
      </div>

<div class="box-header">
      {!!Form::label('Fecha inicio y final:')!!}
      <div class="input-group">
      <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
      {!!Form::date('fechaInicio', \Carbon\Carbon::now())!!}  
      {!!Form::date('fechaFin', \Carbon\Carbon::now())!!}
      </div>
      </div>

        
<div class="box-header">
<td>
          {!!Form::submit('Crear Reserva',['class'=>'btn btn-primary'])!!}
        </td>
    </div>

@endsection