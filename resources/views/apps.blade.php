@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
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