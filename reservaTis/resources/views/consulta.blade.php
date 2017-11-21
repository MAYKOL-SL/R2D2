@extends('app')

@section('htmlheader_title')
    Insertar Fechas Conmemorativas 
@endsection

@section('contentheader_description')
    Insertar Fechas Conmemorativas 
@endsection

@section('main-content')

<link href='fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />

<link href='fullcalendar/bootstrap/css/bootstrap.min.css' rel='stylesheet' />
<link href='fullcalendar/bootstrap-datetimepicker/css/bootstrap-material-datetimepicker.css' rel='stylesheet' />
<link href='fullcalendar/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css' rel='stylesheet' />



<script src='fullcalendar/bootstrap/js/bootstrap.min.js'></script>

<script src='fullcalendar/lib/moment.min.js'></script>
<script src='fullcalendar/fullcalendar.min.js'></script>
<script src='fullcalendar/jquery-1.9.1.js'></script>

<script src='fullcalendar/bootstrap-datetimepicker/js/bootstrap-material-datetimepicker.js'></script>
<script src='fullcalendar/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'></script>


<html>
	<div class="box box-primary">

		<div class="box-header with-border">
				
			<label class = "box-title">Insertar Fechas</label>

			<div class="box-header">
			<div class="responsive">

				{!! Form::open(['route' => 'consulta.store', 'method' => 'post', 'role' => 'form']) !!}


				<div class="form-group col-md-4">
		               	{!!Form::label('Descripción')!!}
		                    	<div class="input-group col-md-12"> 
		                                <div class="form-group">
		                                <input type="text" name="description" class="form-control" placeholder="descripción..." required>
		                        </div>
		                </div>
		        </div>


				<div class="form-group col-md-4">
		                {!! Form::label('date_end', 'Fecha') !!}
		                {!! Form::text('date_end', old('date_end'), ['class' => 'form-control']) !!}
				</div>

				<div class="form-group col-md-12">

		                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
		                        
		        </div>

				{!! Form::close() !!}

			</div>
		</div>
		</div>
		
	</div>

	
	
</html>

<script>

  $('#date_end').bootstrapMaterialDatePicker({ 
    date: true,
    shortTime: false,
    time: false,
    format: 'YYYY-MM-DD'
  });


</script>

	
@endsection
