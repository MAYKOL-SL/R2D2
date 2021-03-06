@extends('app')

@section('contentheader_title')
    TIPOS DE RESERVAS
@endsection

@section('main-content')
<div class="box box-primary">
    <div class="box-header with-border">
    <label class = "box-title">Seleccione su tipo de reserva: </label>
    </div>
    <div class="box-body">
<body>
  <div class="container" style="margin-top: 60px;">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#aula" data-toggle = "tab">Aula</a></li>
      <li><a href="#ambiente" data-toggle = "tab">Ambiente</a></li>
      <li><a href="#capacidad" data-toggle = "tab">Capacidad</a></li>
      <li><a href="#dias" data-toggle = "tab">Dias</a></li>
      <li><a href="#horas" data-toggle = "tab">Hora</a></li>
    </ul>
<div class="tab-content">
    <div class="tab-pane fade in active" id="aula" >
                 <div class="box-body">
          <div class="row">
            <div class="col-md-3">
            <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
                 {!!Form::label('Tipo de ambiente')!!}
            {!! Form::select('state',$states,null,['id'=>'state','class'=>'form-control input-sm'
                    ,'placeholder'=>'Seleccione','required'=>'required']) !!}

            {!!Form::label('Lista de ambientes disponibles a reservar:')!!}
            <div class="btn-group" id="town">
            </div>
            <div class="table">
              <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Aulas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
             <tbody>
              @foreach($towns as $townes)
                <tr>
                    <td>{{$townes->nombre_aula}}</td>
                    <td>
                        <a href="" class="btn btn-success btn-xs" title="View User"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
              </div>
              </div>
              </div>
              </div>
              </div>
</div>
      <div class="tab-pane fade" id="ambiente"><div class="tab-content">
            <div class="form-group" {{ $errors->has('name') ? 'has-error' : ''}}>
              <td>
          {!!Form::submit('Crear reserva',['class'=>'btn btn-primary'])!!}
        </td>
      </div>
    </div>
    </div>
      <div class="tab-pane fade" id="capacidad"><h4>CONFIGURACIONES</h4>l>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>

      <div class="tab-pane fade" id="dias">
        <h4>MI CUENTA</h4>
        @section('contentheader_title')
            TIPOS DE RESERVAS
        @endsection

      </div>

      <div class="tab-pane fade" id="horas"><h4>MI CUENTA</h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
</body>
</div>

@endsection
