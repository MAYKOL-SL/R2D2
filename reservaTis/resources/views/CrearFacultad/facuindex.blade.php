@extends('app')

@section('htmlheader_title')
   Lista Facultades
@endsection


@section('main-content')

  <div class="box box-primary">
    <div class="box-header with-border">
    <label class = "box-title">LISTA DE FACULTADES </label>
  </div>

      <div class="box-header">
            <h1 class="box-title">Añadir nueva reserva<a href="{{ url('facultad/create') }}" class="btn btn-primary btn-xs" title="Registrar reseva"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
      </div>


      <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="table-responsive">
                  <table class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Opciones</th>
                      </thead>

                      <tbody>
                        @foreach($facultades as $facu)
                             <tr>
                              <td>{{ $facu->id }}</td>
                              <td>{{ $facu->nombref }}</td>
                              <td>


                                  <a href="{{ route('facultad.edit', $facu->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
                                   <a href="{{ route('facultad.destroy',$facu->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                              </td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>

@endsection
