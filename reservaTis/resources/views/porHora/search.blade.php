{!! Form::open(array('url'=>'porHora','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

<div class="form-group">
	<div class="input-group">
		<div class="box-header">
		<div class="input-group col-md-12">
			<i class="fa fa-calendar col-md-1"></i>
        	<input type="date" name="fechaIni" min={{$fechaActual}} class="col-md-5">
        	<input type="date" name="fechaFin" min={{$fechaActual}} class="col-md-5">
        </div>
    	</div>
        <div class="box-header">
	        <div class="input-group col-md-12">
	        	<i class="fa fa-safari col-md-1"></i>
	        	<select type="text" name="periodo_id" class="col-md-4" required>
	        		@foreach ($periodo as $per)
	        		<option value="{{$per->id}}" selected="selected">
	        			{{$per->hora}}
	        		</option>
	        		@endforeach
	        	</select>
			</div>
		</div>
		<div class="box-header">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary">Buscar</button>
			</span>
		</div>
	</div>
</div>

