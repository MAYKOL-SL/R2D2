@extends('app')

@section('htmlheader_title')
    User
@endsection


@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-11 col-md-12">
            <div class="panel panel-default box box-primary">
                <!--div class="panel-heading">User</div-->

                <div class="panel-body">
                <div class="table-responsive">

    <h1>Usuario {{ $user->name }}</h1>
   <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID.</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                  <th> {{ trans('Nombre :') }} </th>
                  <td> {{ $user->name }} </td>
                </tr>
                <tr>
                  <th> {{ trans('Apellido :') }} </th>
                  <td> {{ $user->apellido }} </td>
                </tr>
                <tr>
                  <th> {{ trans('Telefono :') }} </th>
                  <td> {{ $user->telefono }} </td>
                </tr>
                <tr>
                  <th> {{ trans('Direccion :') }} </th>
                  <td> {{ $user->direccion }} </td>
                </tr>
                <tr>
                  <th> {{ trans('Email :') }} </th>
                  <td> {{ $user->email }} </td>
                </tr>


            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="{{ url('admin/users/' . $user->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/users', $user->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete User',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
