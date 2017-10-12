@extends('app')

@section('htmlheader_title')

    
@endsection


@section('contentheader_title')
   
@endsection

@section('contentheader_description')
    
@endsection


@section('enlaces')
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
@endsection



@section('main-content')

<div class="container">
 
			<div class="row main">
				<div class="main-login main-center">
				<h5>Registra las aulas de manera eficiente.</h5>
					<form class="" method="post" action="#">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Numero de Aula</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-university fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" id="name"  placeholder="655"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="capacity" class="cols-sm-2 control-label">Capacidad de Estudiantes</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-graduation-cap fa" aria-hidden="true"></i></span>
									<input type="number" class="form-control" name="capacity" id="capacity"  placeholder="123"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="ubication" class="cols-sm-2 control-label">Ubicacion del Aula</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
									<input type="textarea" rows="4" cols="4" class="form-control" name="ubication" id="ubication"  placeholder="Edificio nuevo 3er piso"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="description" class="cols-sm-2 control-label">Descripcion</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-commenting fa-lg" aria-hidden="true"></i></span>
									<input type="textarea" class="form-control" name="description" id="description"  placeholder="Descripcion del aula"/>
								</div>
							</div>
						</div>

						<div class="form-group">
						<label for="description" class="cols-sm-2 control-label">Selecciona los Complementos</label>
						 <div class="form-check">
						    <label class="form-check-label">
						      <input type="checkbox" class="form-check-input">
						      Data<br/>
						      <input type="checkbox" class="form-check-input">
						      Computadora<br/>
						      <input type="checkbox" class="form-check-input">
						      Ventiladora<br/>
						      <input type="checkbox" class="form-check-input">
						      Pizarra Tactil<br/>
						    </label>
						  </div>
						  </div>

						<div class="form-group ">
							<a href="#" target="_blank" type="button" id="button" class="btn btn-primary btn-lg btn-block login-button">Registrar</a>
						</div>
						
					</form>
				</div>
			</div>
		</div>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
@endsection
