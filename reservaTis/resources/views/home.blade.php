@extends('app')

@section('htmlheader_title')
    Home
@endsection


@section('contentheader_title')
    hola
@endsection

@section('contentheader_description')
    hola decerip
@endsection


@section('main-content')
<div class="container fondoDos">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h1 class="text-primary">BIENVENIDOS A LA RESERVA DE AMBIENTES</h1></div>

				<div class="panel-body">
					<a href="#"><img src="img/principalImagen.jpg" alt="" width="910px"></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
