@extends('app')
@section('contentheader_title')
    Registrar Reserva
@endsection

@section('main-content')
 
    <div class="box box-primary">

        <div class="box-header with-border">
            <label class="box-title">Editar Reserva</label>

        </div>
        
        {!!Form::open(['route'=>['ConfirmarReserva.update',$dreserva],'method'=>'PUT'])!!}

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
            {!!Form::label('Fecha de Reserva:')!!}
            <div class="input-group col-md-5">
                        
                 <i class="fa fa-calendar col-md-1"></i>
                 <input type="date" name="fecha" min={{$fechaActual}} class="col-md-5" value={{$fechaSel->Fecha}}>
                                
                    
            </div>
        </div>
        

        <div class="box-header">
              {!!Form::label('Hora inicio y final:')!!}
              <div class="input-group col-md-3"> 
              {!! Form::select('periodos',$hora,$horas,['class'=>'form-control input-sm select-tag','required']) !!}
              </div>
        </div>



        <div class="box-header">
        <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
        </div>
        {!!Form::close()!!}
    </div>

@endsection

@section('js')
<script>
  $('.select-tag').chosen({
    placeholder_text_single:'Seleccione los periodos de reserva'
  });

   $('.select-category').chosen({
    placeholder_text_single:'Seleccione el ambiente'
  });


</script>
@endsection