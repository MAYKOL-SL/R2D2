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

{!!Form::open(array('url'=>'reservas','autocomplete'=>'off'))!!}
<div class="box-header">
      {!!Form::label('Usuario:')!!}
      <div class="input-group col-md-4"> 
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
</div>


<div class="box-header">
      {!!Form::label('Nombre Reserva:')!!}
      <div class="input-group col-md-4" > 
            <div class="form-group">
                <input type="text" name="nombre_reserva" class="form-control" placeholder="Nombre reserva..." required>
            </div>
      </div>
</div>



<div class="box-header">
      {!!Form::label('Descripcion:')!!}
      <div class="input-group col-md-4"> 
            <div class="form-group">
                <input type="text" name="description" class="form-control" placeholder="descripcion..." required>
            </div>
      </div>
</div>



<div class="box-header">
      {!!Form::label('Ambiente:')!!}
      <div class="input-group col-md-4" > 
            <!--<div class="input-group-addon">-->
                <select name="ambiente_id" class="form-control" required>
                    @foreach ($ambiente as $amb)
                        <option value="{{$amb->id}}">
                            {{$amb->title}}
                        </option>
                    @endforeach
                </select>
            <!--</div>-->
      </div>
</div>

<div class="box-header">
      {!!Form::label('Fecha inicio y final:')!!}
      <div class="input-group col-md-5">
            
                    <i class="fa fa-calendar col-md-1"></i>
                    <input type="date" name="fecha_ini" min={{$fechaActual}} class="col-md-5" value={{$fechaIni}} required>
                    
                    <input type="date" name="fecha_fin" min={{$fechaActual}} class="col-md-5" value={{$fechaFin}} required>
                    
            
        
      </div>
</div>
<!--
<div class="box-header">
      {!!Form::label('Dias:')!!}
      <div class="input-group col-md-5">
                
                <input type="checkbox" name="lunes" value="lunes" checked>Lunes<br>
                <input type="checkbox" name="martes" value="martes">Martes<br>
                <input type="checkbox" name="miercoles" value="miercoles">Miercoles<br>
                <input type="checkbox" name="jueves" value="jueves">Jueves<br>
                <input type="checkbox" name="viernes" value="viernes">Viernes<br>
                <input type="checkbox" name="sabado" value="sabado">Sabado
                
      </div>
</div>
-->
<div class="box-header">
      {!!Form::label('Dias:')!!}
      <div class="input-group col-md-5">
              @if ($lunes == "lunes")
                <input type="checkbox" name="lunes" value="lunes" checked>Lunes<br>
              @endif
              @if ($martes == "martes")
                <input type="checkbox" name="martes" value="martes" checked>Martes<br>
              @endif
              @if ($miercoles == "miercoles")
                <input type="checkbox" name="miercoles" value="miercoles" checked>Miercoles<br>
              @endif
              @if ($jueves == "jueves")
                <input type="checkbox" name="jueves" value="jueves" checked>Jueves<br>
              @endif
              @if ($viernes == "viernes")
                <input type="checkbox" name="viernes" value="viernes" checked>Viernes<br>
              @endif
              @if ($sabado == "sabado")
                <input type="checkbox" name="sabado" value="sabado" checked>Sabado<br>
              @endif
      </div>
</div>



<div class="box-header">
      {!!Form::label('Hora inicio y final:')!!}
      <div class="input-group col-md-5">
        <!--<div class="input-group-addon">-->
                    <i class="fa fa-safari col-md-1"></i>
                    <select type="text" name="periodo_id" class="col-md-4"  required>
                    @foreach ($periodo as $per)
                        <option value="{{$per->id}}">
                            {{$per->hora}}
                        </option>
                    @endforeach
                    </select>

        <!--</div>-->
                  
      </div>
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