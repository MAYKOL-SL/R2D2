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

    <h1>Crear nuevo Ambiente</h1>
    <hr/>

    {!! Form::open(['url' => 'ReservaAmbiente', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
                {!! Form::label('nombre', trans('nombre'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('capacidad') ? 'has-error' : ''}}">
                {!! Form::label('capacidad', trans('capacidad'), ['class' => 'col-sm-3 control-label']) !!}


                <div class="col-sm-6 " >
                
                    {!! Form::number('capacidad', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('capacidad', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('ubicacion') ? 'has-error' : ''}}">
                {!! Form::label('ubicacion', trans('ubicacion'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('ubicacion',null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('ubicacion', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

          
           <div class="form-group {{ $errors->has('complementos') ? 'has-error' : ''}}">
               {!! Form::label('complementos', trans('complementos'), ['class' => 'col-sm-3 control-label']) !!}
                <div class=" col-sm-6"> 
                {!! Form::select('complementos',$complementos,null,['class'=>'form-control input-sm select-tag','multiple','required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('tipo ambiente') ? 'has-error' : ''}}">
               
                 {!! Form::label('tipoambiente', trans('tipoambiente'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
               
                {!! Form::select('state',$tipos,null,['id'=>'state','class'=>'form-control input-sm'
                       ,'placeholder'=>'Seleccione','required'=>'required']) !!}
              
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
@section('js')
<script>
  $('.select-tag').chosen({
    placeholder_text_multiple:'Seleccione los complementos del ambiente'
  });

</script>
@endsection