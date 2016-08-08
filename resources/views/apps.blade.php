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
                                    <a class="btn btn-sm bg-blue-light" href="{{ route('apps.details',$app->id) }}">
                                        <i class="glyphicon glyphicon-th-list"></i> Detalles
                                    </a>
                                    @if(\Auth::user()->role ==  "owner")
                                    <a class="btn btn-sm bg-black btn-delete" href="{{ route('apps.delete',$app->id) }}">
                                        <i class="glyphicon glyphicon-remove-circle"></i> Eliminar
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(\Auth::user()->role ==  "owner")
                        <div class="panel-body text-right">
                            <a class="btn btn-sm bg-blue" href="#"  id="btn-modal">Agregar Aplicación</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(\Auth::user()->role ==  "owner")
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            {!! Form::open(array('route' => 'apps.add')) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Nueva Aplicación</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="control-label">Aplicación:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Aplicación" required />
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">URL:</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="http://aplicacion.dominio.com" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn bg-gray-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-blue">Registrar App</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(['route' => ['apps.delete','END'],'method' => 'DELETE','id' => 'form-delete' ]) !!}
                <div class="modal-body">
                    <div class="alert alert-info">Confirma Eliminar Aplicación</div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn bg-gray-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-blue">Eliminar App</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endif
@endsection

@section('scripts')
    <script>
        $(function(){
            var btn = $('#btn-modal');
            btn.click(function(e){
                e.preventDefault();
                $('#modal').modal('show');
            });

            var btnDelete = $('.btn-delete');
            var modalDelete = $('#modal-delete');
            var formDelete = $('#form-delete');

            btnDelete.click(function(e){
                e.preventDefault();
                var url = $(this).attr('href');
                modalDelete.modal('show');
                formDelete.attr('action',url);
            });


        });
    </script>

@endsection