{!! Form::open(array('url'=>'porHora','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

<div class="form-group">
	<div class="input-group">

		<div class="box-header">
	      {!!Form::label('Hora inicio y final:')!!}
	      <div class="input-group col-md-8">
	      	{!! Form::select('periodos[]',$hora,null,['class'=>'form-control input-sm select-tag','multiple','required']) !!}
	      </div>
 		</div>



		<div class="box-header">
		{!!Form::label('Capacidad:')!!}
		<div class="input-group">
			<input type="text" class="form-control" name="capacidad" placeholder="Buscar..." value="{{$capacidad}}" required="">
		</div>
		</div>



		<div class="box-header">
			{!!Form::label('Fecha Inicio y Fin:')!!}
		<div class="input-group col-md-12">
			<i class="fa fa-calendar col-md-1"></i>
        	<input type="date" name="fechaIni" min={{$fechaActual}}  value={{$fechaActual}} class="col-md-5" required="">
        	<input type="date" name="fechaFin" min={{$fechaActual}} value={{$fechaActual}} class="col-md-5" required="">
        </div>
    	</div>

		<div class="box-header">
      {!!Form::label('Dias:')!!}
      <div class="input-group col-md-5">
                <input type="checkbox" name="lunes" value="lunes">Lunes<br>

                <input type="checkbox" name="martes" value="martes">Martes<br>

                <input type="checkbox" name="miercoles" value="miercoles">Miercoles<br>

                <input type="checkbox" name="jueves" value="jueves">Jueves<br>

                <input type="checkbox" name="viernes" value="viernes">Viernes<br>

                <input type="checkbox" name="sabado" value="sabado">Sabado<br>

      </div>
		</div>

        
		<div class="box-header">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary">Buscar</button>
			</span>
		</div>
	</div>
</div>
