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
  <div class="responsive">
  <div class="box-header with-border">
  <label class = "box-title">Ingrese datos de su reserva para complemento </label>
  </div>


{!!Form::open(array('url'=>'reservas','autocomplete'=>'off'))!!}
<div class="box-header">
      {!!Form::label('Usuario:')!!}
            <!--<div class="input-group-addon">-->
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
            <!--</div>-->
</div>

<div class="box-header">



            <div class="form-group">
              {!!Form::label('Complemento:')!!}
              <select name="ambiente_id" id="ambiente_id" class="form-control select-complemento" required>
                    @foreach ($ambis as $am)
                        <option value="{{$am->id}}">
                          @if($am->tipo_ambiente->tipo_aula=="activo" ||
                               $am->tipo_ambiente->tipo_aula=="inactivo")
                            {{$am->title}}
                          @endif
                        </option>
                    @endforeach
                </select>
            </div>
</div>


<div class="box-header">
      {!!Form::label('Nombre Reserva:')!!}
            <div class="form-group">
                <input type="text" name="nombre_reserva" class="form-control" placeholder="Nombre reserva..." required>
            </div>
</div>



<div class="box-header">
      {!!Form::label('Descripcion:')!!}
            <div class="form-group">
                <input type="text" name="description" class="form-control" placeholder="descripcion..." required>
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
      {!!Form::label('Hora inicio y final:')!!}
      {!! Form::select('periodos[]',$hora,null,['class'=>'form-control input-sm select-tag','multiple','required']) !!}
 </div>

<div class="box-header">
      {!!Form::label('Dias:')!!}
      <div class="input-group col-md-5">

                <input type="checkbox" name="lunes" value="Lunes">Lunes<br>

                <input type="checkbox" name="martes" value="Martes">Martes<br>

                <input type="checkbox" name="miercoles" value="Miercoles">Miercoles<br>

                <input type="checkbox" name="jueves" value="Jueves">Jueves<br>

                <input type="checkbox" name="viernes" value="Viernes">Viernes<br>

                <input type="checkbox" name="sabado" value="Sabado">Sabado<br>

                <input type="checkbox" name="domingo" value="Domingo">Domingo<br>

      </div>
</div>




<div class="box-header">
      <div class="input-group">


            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

      </div>
</div>

{!!Form::close()!!}




</div>
</div>

@endsection

@section('js')
<script>
  $('.select-tag').chosen({
    placeholder_text_multiple:'Seleccione los periodos de reserva',
    width: '100%'
  });

  $('.select-category').chosen({
    placeholder_text_single:'Seleccione el ambiente',
    width: '100%'
  });

   $('.select-complemento').chosen({
    placeholder_text_single:'Seleccione el complemento',
    width: '100%'
  });

  $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
</script>
@endsection
