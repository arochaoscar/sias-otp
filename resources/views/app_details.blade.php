@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Detalle de Aplicación</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Aplicacion:</label> {{ $app->name }}
                            </li>
                            <li class="list-group-item">
                                <label>URL:</label> {{ $app->uri }}
                            </li>
                            <li class="list-group-item">
                                <label>Private Key:</label> {{ $app->private_key }}
                            </li>
                            <li class="list-group-item">
                                <label>Public Key:</label> {{ $app->public_key }}
                            </li>
                            <li class="list-group-item">
                                <label>Creado:</label> {{ $app->created_at }}
                            </li>
                            <li class="list-group-item">
                                <label>Modificado:</label> {{ $app->updated_at }}
                            </li>
                            <li class="list-group-item text-right">
                                <a href="#" class="btn btn-sm btn-info">
                                    <i class="glyphicon glyphicon-edit"></i> Editar
                                </a>
                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="glyphicon glyphicon-remove-circle"></i> Eliminar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Lista de Accesos
                    </div>
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-info"><i class="glyphicon glyphicon-minus"></i> Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="panel-body text-right">
                        <a class="btn btn-sm btn-success" href="#"  id="btn-modal">
                            <i class="glyphicon glyphicon-user"></i> Agregar Usuario
                        </a>
                    </div>
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
                    <h4 class="modal-title" id="exampleModalLabel">Nvo Usuario</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name" class="control-label">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre y Apellido" required />
                    </div>
                    <div>
                        <ul class="list-group" id="listName">
                        </ul>
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
                <input type="hidden" name="user_id" id="user_id" value=""/>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function(){
            var btn = $('#btn-modal');
            var user = $('#name');
            var email = $('#email');
            var id = $('#user_id');
            var listName = $('#listName');
            btn.click(function(e){
                e.preventDefault();
                $('#modal').modal('show');
            });

            user.keyup(function(){
                var base = '../clients/search/';
                var url = base+$(this).val();
                if($(this).val().length > 0 ){
                    $.get(url,function(r){
                        listName.children().remove();
                        if(r.length > 0){
                            eln = $('<a/>').text(r[0].name).attr('href','#').addClass('item')
                                    .data('name',r[0].name)
                                    .data('email',r[0].email)
                                    .data('id',r[0].id);
                            item = $('<li/>').addClass("list-group-item alert-success");
                            item.append(eln);
                            listName.append(item);
                        }else{
                            //user.val('');
                            email.val('');
                            id.val('');
                        }
                    },"JSON");
                }else{
                    user.val('');
                    email.val('');
                    id.val('');
                }
            });

            $(document).on('click','.item',function(e){
                e.preventDefault();
                user.val($(this).data('name'));
                email.val($(this).data('email'));
                id.val($(this).data('id'));
                listName.children().remove();
            });
        });
    </script>

@endsection


