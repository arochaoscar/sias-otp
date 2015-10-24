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

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            {!! Form::open(array('route' => 'user.edit')) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name" class="control-label">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre y Apellido" required />
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Correo:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="usuario@dominio.com" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function(){
            var btn = $('#btn-modal');
            btn.click(function(e){
                e.preventDefault();
                $('#modal').modal('show');
            });
        });
    </script>

@endsection


