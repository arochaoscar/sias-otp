@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Lista de Usuarios</h3>
                    </div>
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    <a href="{{ route('user.details',$user->id) }}" class="btn btn-sm bg-blue-light">Detalles</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    <div class="panel-body text-right">
                        <a class="btn btn-sm bg-blue" href="#"  id="btn-modal">Agregar Usuario</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            {!! Form::open(array('route' => 'user.add')) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h4>
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
                    <button type="reset" class="btn bg-gray-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-blue">Registrar Usuario</button>
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