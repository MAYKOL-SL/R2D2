@extends('app')

@section('htmlheader_title')
   User
@endsection


@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-11 col-md-12">
            <div class="panel panel-default box box-primary">
                <!--div class="panel-heading">User </div-->

                <div class="panel-body">
                <div class="table-responsive">

    <h1>Editar User {{ $user->id }}</h1>
    <hr/>
    {!! Form::model($user, [
        'method' => 'PATCH',
        'url' => ['/admin/users', $user->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', trans('users.name'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', trans('users.email'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                {!! Form::label('password', trans('users.password'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


                <div class="form-group">
                {!! Form::label('roles', 'Roles: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">

                {!! Form::select('role_id[]', $roles, isset($roles_user) ? $roles_user : null, array(
                'multiple' => true, 'class' => 'multi-select', 'id' => 'roleSelect')) !!}

                </div>
            </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Actulizar', ['class' => 'btn btn-primary form-control']) !!}
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
