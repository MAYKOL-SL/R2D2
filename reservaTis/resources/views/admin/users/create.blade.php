@extends('app')

@section('htmlheader_title')
    User
@endsection


@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-11 col-md-12">
            <div class="panel panel-default box box-primary">
                <!--div class="panel-heading">Usuario</div-->

                <div class="panel-body">
                <div class="table-responsive">

    <h1>Crear Nuevo Usuario</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/users', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', trans('Nombres :'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('apellido') ? 'has-error' : ''}}">
                {!! Form::label('apellido', trans('Apellidos :'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('apellido', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('apellido', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
              {!! Form::label('telefono', trans('Tel&eacute;fono :'), ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-6">
                <input type="number" id='telefono' name="telefono" class="form-control" id="inputEmail3"  required=""></input>

                {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}}">
              {!! Form::label('direccion', trans('Direcci&oacute;n :'), ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-6">
                {!! Form::text('direccion', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', trans('Email :'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                {!! Form::label('password', trans('Password :'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group ">
                {!! Form::label('roles', 'Roles: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">

                {!! Form::select('role_id[]', $roles, isset($roles_user) ? $roles_user : null, array(
                'multiple' => true, 'class' => 'multi-select', 'id' => 'roleSelect')) !!}

                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Crear', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
