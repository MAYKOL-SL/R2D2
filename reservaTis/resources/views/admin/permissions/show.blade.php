@extends('app')

@section('htmlheader_title')
    Permission
@endsection


@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Permission</div>

                <div class="panel-body">
                <div class="table-responsive">

    <h1>Permission {{ $permission->id }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID.</th><td>{{ $permission->id }}</td>
                </tr>
                <tr><th> {{ trans('permissions.name') }} </th><td> {{ $permission->name }} </td></tr><tr><th> {{ trans('permissions.display_name') }} </th><td> {{ $permission->display_name }} </td></tr><tr><th> {{ trans('permissions.description') }} </th><td> {{ $permission->description }} </td></tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="{{ url('admin/permissions/' . $permission->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Permission"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/permissions', $permission->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Permission',
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
