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
{!!Form::open(array('url'=>'reserva','autocomplete'=>'off'))!!}
<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Ingrese datos de su reserva </label>
  </div>

      <div class="box-header">
        {!!Form::label('Usuario:')!!}
        <div class="input-group col-md-3"> 
              <select name="user_id" class="form-control" required>
                    @foreach ($user as $us)
                        @if($us->id==Auth::user()->id)
                          <option value="{{$us->id}}">
                              {{$us->name}}
                          </option>
                        @else
                        @endif
                    @endforeach
              </select>
        </div>
      </div>

        <div class="box-header">
            <div class="col-md-3">
              {!!Form::label('Tipo de ambiente')!!}
              {!! Form::select('state',$states,null,['id'=>'state','class'=>'form-control input-sm'
                    ,'placeholder'=>'Seleccione','required'=>'required']) !!}
              {!!Form::label('Ambiente')!!}
              {!! Form::select('ambiente',['placeholder'=>'Selecciona'],null,['id'=>'town','class'=>'form-control select-category input-sm', 'required'=>'required']) !!}
            </div>
        </div>


<div class="box-header">
      {!!Form::label('Fecha inicio y final:')!!}
      <div class="input-group">
          <i class="fa fa-calendar col-md-1"></i>
          <input type="date" name="fecha_ini" min={{$fechaActual}} class="col-md-5" value={{$fechaActual}} required>
         <input type="date" name="fecha_fin" min={{$fechaActual}} class="col-md-5" value={{$fechaActual}} required>
      </div>
</div>


<div class="box-header">
      {!!Form::label('Marque los Días:')!!}
      <div class="input-group col-md-5">
                <label class="form-check-label">
                <input type="checkbox" name="lunes" value="lunes">Lunes<br>
                <input type="checkbox" name="martes" value="martes">Martes<br>
                <input type="checkbox" name="miercoles" value="miercoles">Miercoles<br>
                <input type="checkbox" name="jueves" value="jueves">Jueves<br>
                <input type="checkbox" name="viernes" value="viernes">Viernes<br>
                <input type="checkbox" name="sabado" value="sabado">Sabado
                </label>
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
        <div>        {!!Form::textarea('nombre_reserva',null,['class'=>'textarea', 'placeholder'=>'Ingrese Nombre de Reserva','style'=>'width: 25%; height: 50px; font-size: 14px; line-height: 18px; border: 2px solid #dddddd; padding: 10px;','required'])!!}
      </div>
      </div>

    <div class="box-header">
        {!!Form::label('Descripción de Reserva:')!!}
        <div>        {!!Form::textarea('description',null,['class'=>'textarea', 'placeholder'=>'Ingrese descripcion de reserva','style'=>'width: 25%; height: 100px; font-size: 14px; line-height: 18px; border: 2px solid #dddddd; padding: 10px;','required'])!!}
      </div>
      </div>


      <div class="box-header">
<td>
          {!!Form::submit('Crear Reserva',['class'=>'btn btn-primary'])!!}
        </td>
    </div>

    <div class="box-header">
      <div class="input-group col-md-5">
            
                    
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        
      </div>
</div>
    {!!Form::close()!!}
</div>
@endsection

@section('js')
<script>
  $('.select-tag').chosen({
    placeholder_text_multiple:'Seleccione los periodos de reserva'
  });

</script>
@endsection