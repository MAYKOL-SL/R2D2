@extends('app')

@section('htmlheader_title')
   Permissions 
@endsection


@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Permissions </div>
                     @if(Session::has('flash_message1'))
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> {{Session::get('flash_message1')}} </h4>
                    </div>
                    @endif
                    @if(Session::has('flash_message2'))
                    <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> {{Session::get('flash_message2')}}</h4>
                    </div>
                    @endif
                    @if(Session::has('flash_message3'))
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i>  {{Session::get('flash_message3')}}</h4>
                    </div>
                    @endif
                <div class="panel-body">
                <div class="table-responsive">

    <h1>Permissions <a href="{{ url('/admin/permissions/create') }}" class="btn btn-primary btn-xs" title="Add New Permission"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> {{ trans('permissions.name') }} </th><th> {{ trans('permissions.display_name') }} </th><th> {{ trans('permissions.description') }} </th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($permissions as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->name }}</td><td>{{ $item->display_name }}</td><td>{{ $item->description }}</td>
                    <td>
                        <a href="{{ url('/admin/permissions/' . $item->id) }}" class="btn btn-success btn-xs" title="View Permission"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/permissions/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Permission"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/permissions', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Permission" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Permission',
                                    'onclick'=>'return confirm("Confirma Eliminar?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $permissions->render() !!} </div>
    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
