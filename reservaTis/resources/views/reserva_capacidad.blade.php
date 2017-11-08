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

{!!Form::open(['route'=>['ReservaController'],'method'=>'PUT'])!!}




<div class="box-header">
    {!! Form::label('Nombre: ') !!}       
    {!! Form::text('title', $valor->title, ['class' => 'form-control', 'required' => 'required']) !!}
</div>


<div class="box-header">  
{!! Form::label('Capacidad: ') !!}
{!! Form::number('capacidad', $valor->capacidad, ['class' => 'form-control', 'required' => 'required']) !!}
</div>


<div class="box-header">
            <div class="col-md-3">
              {!!Form::label('Tipo de ambiente')!!}
            {!! Form::select('state',$states,null,['id'=>'state','class'=>'form-control input-sm'
                    ,'placeholder'=>'Seleccione','required'=>'required']) !!}
          {!!Form::label('Ambiente')!!}
  {!! Form::select('town',['placeholder'=>'Selecciona'],null,['id'=>'town','class'=>'form-control select-category input-sm'
                    ,'required'=>'required']) !!}
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
      <div class="input-group col-md-3"> 
      {!! Form::select('periodos',$hora,null,['class'=>'form-control input-sm select-tag','multiple','required']) !!}
      </div>
 </div>

<div class="box-header">
        {!!Form::label('Nombre de Reserva:')!!}
        <div>        {!!Form::textarea('NombreReserva',null,['class'=>'textarea', 'placeholder'=>'Ingrese Nombre de Reserva','style'=>'width: 25%; height: 50px; font-size: 14px; line-height: 18px; border: 2px solid #dddddd; padding: 10px;'])!!}
      </div>
      </div>

    <div class="box-header">
        {!!Form::label('Descripción de Reserva:')!!}
        <div>        {!!Form::textarea('DescripcionReserva',null,['class'=>'textarea', 'placeholder'=>'Ingrese descripcion de reserva','style'=>'width: 25%; height: 100px; font-size: 14px; line-height: 18px; border: 2px solid #dddddd; padding: 10px;'])!!}
      </div>
      </div>


      <div class="box-header">
<td>
          {!!Form::submit('Crear Reserva',['class'=>'btn btn-primary'])!!}
        </td>
    
    {!! Form::close() !!}

    </div>

@endsection

@section('js')
<script>
  $('.select-tag').chosen({
    placeholder_text_multiple:'Seleccione los periodos de reserva'
  });

</script>
@endsection