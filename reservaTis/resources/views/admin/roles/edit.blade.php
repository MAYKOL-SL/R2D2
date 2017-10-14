@extends('app')

@section('htmlheader_title')
   Role
@endsection


@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-11 col-md-12">
            <div class="panel panel-default box box-primary">
                <!--div class="panel-heading">Role </div-->

                <div class="panel-body">
                <div class="table-responsive">

    <h1>Editar Rol {{ $role->id }}</h1>
   <hr/>
    {!! Form::model($role, [
        'method' => 'PATCH',
        'url' => ['/admin/roles', $role->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', trans('roles.name'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('display_name') ? 'has-error' : ''}}">
                {!! Form::label('display_name', trans('roles.display_name'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('display_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('display_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description', trans('roles.description'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('description', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
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
