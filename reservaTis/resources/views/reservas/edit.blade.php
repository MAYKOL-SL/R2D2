@extends('app')
@section('contentheader_title')
    Registrar Reserva
@endsection

@section('main-content')

    <div class="box box-primary">

        <div class="box-header with-border">
            <label class="box-title">Editar Reserva</label>

        </div>
        {!!Form::open(['route'=>['reservas.update',$reserva],'method'=>'PUT'])!!}

        <div class="box-header">


              {!!Form::label('Usuario')!!}
                <select name="user_id" class="form-control" disabled>

                    @foreach ($user as $us)
                        @if($us->id==Auth::user()->id)
                        <option value="{{$us->id}}">
                            {{$us->name}}
                        </option>
                        @endif
                    @endforeach
                </select>


        </div>

              <div class="box-header">
            {!!Form::label('Ambiente:')!!}
            <div class="input-group">
                <select name="ambiente_id" class="form-control select-category" required>
                    @foreach($ambiente as $amb)

                            @if($amb->id==$dreserva->ambiente_id)
                                <option value="{{$amb->id}}" selected="selected">
                                    {{$amb->title}}
                                </option>
                            @else
                            <option value="{{$amb->id}} ">
                                {{$amb->title}}
                            </option>
                            @endif
                    @endforeach

                </select>


            </div>

        </div>

        <div class="box-header">

            {!!Form::label('Nombre Reserva')!!}
            {!!Form::text('nombre_reserva',$reserva->nombre_reseva,['class'=>'form-control','required'=>'required'])!!}

        </div>

        <div class="box-header">
            {!!Form::label('Descripcion Reserva')!!}
            {!!Form::text('description',$reserva->description,['class'=>'form-control','required'=>'required',])!!}


        </div>

        <div class="box-header">
            {!!Form::label('Fecha inicio y final:')!!}
            <div class="input-group col-md-5">

                 <i class="fa fa-calendar col-md-1"></i>
                 <input type="date" name="fecha_ini" min={{$fechaActual}} class="col-md-5" value={{$reserva->start}} required>

                 <input type="date" name="fecha_fin" min={{$fechaActual}} class="col-md-5" value={{$reserva->end}} required>


            </div>
        </div>


        <div class="box-header">
              {!!Form::label('Hora inicio y final:')!!}
              <div class="input-group col-md-3">
              {!! Form::select('periodos[]',$hora,$horas,['class'=>'form-control input-sm select-tag','multiple','required']) !!}
              </div>
        </div>

                <div class="box-header">
              {!!Form::label('Dias:')!!}
              <div class="input-group col-md-5">

                        <input type="checkbox" name="lunes" value="Lunes" checked="checked">Lunes<br>

                        <input type="checkbox" name="martes" value="Martes" checked="checked">Martes<br>

                        <input type="checkbox" name="miercoles" value="Miercoles" checked="checked">Miercoles<br>

                        <input type="checkbox" name="jueves" value="Jueves" checked="checked">Jueves<br>

                        <input type="checkbox" name="viernes" value="Viernes" checked="checked">Viernes<br>
                        <input type="checkbox" name="sabado" value="Sabado" checked="checked">Sábado<br>
                        <input type="checkbox" name="sabado" value="Domingo" checked="checked">Domingo<br>

              </div>
        </div>

        <div class="box-header">
              {!!Form::label('Hora inicio y final:')!!}
              <div class="input-group col-md-3">
              {!! Form::select('periodos[]',$hora,$horas,['class'=>'form-control input-sm select-tag','multiple','required']) !!}
              </div>
        </div>

        <div class="box-header">

            <td>

                {!!Form::submit('Editar Reserva',['class'=>'btn btn-primary'])!!}

            </td>

        </div>

        {!!Form::close()!!}
    </div>
    <a href="{{ url('reservas') }}"><button class="btn btn-primary">Cancelar</button></a>

@endsection

@section('js')
<script>
  $('.select-tag').chosen({
    placeholder_text_multiple:'Seleccione los periodos de reserva'
  });

   $('.select-category').chosen({
    placeholder_text_single:'Seleccione el ambiente'
  });

</script>
@endsection
