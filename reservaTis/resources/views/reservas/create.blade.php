@extends('app')
@section('contentheader_title')
    Registrar Reserva
@endsection

@section('main-content')

  <div class="box box-primary">
    <div class="box-header with-border">
    <label class = "box-title">NUEVA RESERVA </label>
    </div>

  <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>


    {!!Form::open(array('url'=>'reservas','method'=>'POST','autocomplete'=>'off'))!!}
    <!--{{Form::token()}}-->
    
    <div class="row">
    
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Usuario</label>
                <select name="user_id" class="form-control">
                    $user=Auth::user()->name;
                    @foreach ($user as $us)
                        <option value="{{$us->id}}">
                            {{$us->name}}
                        </option>
                    @endforeach
                </select>
                
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Calendario</label>
                <select name="calendario_id" class="form-control">
                    @foreach ($calendario as $cal)
                        <option value="{{$cal->id}}">
                            {{$cal->dia}}
                        </option>
                    @endforeach
                </select>
                
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Dia</label>
                <select name="dia_id" class="form-control">
                    @foreach ($dia as $d)
                        <option value="{{$d->id}}">
                            {{$d->fecha_dia}}
                        </option>
                    @endforeach
                </select>
                
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Ambiente</label>
                <select name="ambiente_id" class="form-control">
                    @foreach ($ambiente as $amb)
                        <option value="{{$amb->id}}">
                            {{$amb->nombre_aula}}
                        </option>
                    @endforeach
                </select>
                
            </div>
        </div>
        
                    
    
    </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
</div>
      {!!Form::close()!!}
@endsection