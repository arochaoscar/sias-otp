@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Detalle de Usuario</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Nombre:</label> {{ $user->name }}
                            </li>
                            <li class="list-group-item">
                                <label>Correo:</label> {{ $user->email }}
                            </li>
                            <li class="list-group-item">
                                <label>Creado:</label> {{ $user->created_at }}
                            </li>
                            <li class="list-group-item">
                                <label>Modificado:</label> {{ $user->updated_at }}
                            </li>
                            <li class="list-group-item text-right">
                                <a href="#" class="btn btn-sm btn-info">
                                    <i class="glyphicon glyphicon-edit"></i> Editar
                                </a>
                                <a href="#" class="btn btn-sm btn-success">
                                    <i class="glyphicon glyphicon-refresh"></i> Reiniciar Clave
                                </a>
                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="glyphicon glyphicon-lock"></i> Bloquear
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Lista de Aplicaciones
                    </div>
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Aplicación</th>
                            <th class="text-center">URL</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($apps as $app)
                            <tr>
                                <td>{{ $app->name }}</td>
                                <td>{{ $app->uri }}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


