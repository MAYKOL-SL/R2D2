@extends('app')

@section('htmlheader_title')
    Role
@endsection


@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-11 col-md-12">
            <div class="panel panel-default box box-primary">
                <!--div class="panel-heading">Role</div-->

                <div class="panel-body">
                <div class="table-responsive">

    <h1>Role {{ $role->id }}</h1>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID.</th><td>{{ $role->id }}</td>
                </tr>
                <tr><th> {{ trans('roles.name') }} </th><td> {{ $role->name }} </td></tr><tr><th> {{ trans('roles.display_name') }} </th><td> {{ $role->display_name }} </td></tr><tr><th> {{ trans('roles.description') }} </th><td> {{ $role->description }} </td></tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="{{ url('admin/roles/' . $role->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Role"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/roles', $role->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Role',
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
