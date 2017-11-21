@extends('app')

@section('htmlheader_title')
   Confirmar Reservas
@endsection


@section('main-content')

<div class="box box-primary">
  <div class="box-header with-border">
  <label class = "box-title">Reservas por Confirmar </label>
  </div>
{{-- <div class="box-header">
                <h1 class="box-title">Añadir nueva reserva<a href="{{ url('reservas/create') }}" class="btn btn-primary btn-xs" title="Registrar reseva"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
            </div> --}}

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table {{-- table-striped --}} table-bordered table-condensed table-hover" >
                <thead>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Ambiente</th>
                    <th>Fecha</th>
                    <th>periodo</th>
                    <th>Libre</th>
                   {{--  <th>Opciones</th> --}}
                </thead>
                <tbody>
                @foreach ($reservas as $res)
                    <tr class="success">
                       
                        <td>{{ $res->id_reserva}}</td>
                        <td>{{ $res->usuario}}</td>
                        <td>{{ $res->nombre_aula}}</td>
                        <td>{{ $res->Fecha}}</td>
                        <td>{{ $res->hora}}</td>
                        <td><i class="fa fa-thumbs-up " aria-hidden="true" ></i></td>
                        {{-- <td>
                          
                            <a href="" data-target="#modal-delete-{{$res->id_detalle}}" data-toggle="modal"><button class="btn btn-sm btn-danger">Eliminar</button></a>
                        </td> --}}
                       

                    </tr>
                   
                @endforeach
                    <tr>


                @foreach($conflictos as $con)
                    <tr class="danger">
                        <td>{{$con->conflicto_id}}</td>
                        <td>{{$con->name}}</td>
                        <td>{{$con->title}}</td>
                        <td>{{$con->Fconflicto}}</td>
                        <td>{{$con->horaconflicto}}</td>
                        <td><i class="fa fa-times" aria-hidden="true"></i></td>
                        
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="box-footer">


     <a href="" data-target="#modal-delete-{{$id_reserva}}" data-toggle="modal"><button class="btn btn-danger">Cancelar</button></a>

     @if(!empty($reservas))
        <a href="{{ route('Confirm.store', $id_reserva) }}" ><button class="btn btn-primary"> Reservar de todas formas</button></a>
    @endif


</div>
 @include('ConfirmarReserva.modal2') 
 

</div>
@endsection

