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
                                    <a class="btn btn-sm btn-info" href="{{ route('apps.details',$app->id) }}">
                                        <i class="glyphicon glyphicon-th-list"></i> Detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(\Auth::user()->role ==  "owner")
                        <div class="panel-body text-right">
                            <a class="btn btn-sm btn-success" href="#"  id="btn-modal">Agregar Aplicación</a>
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
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar App</button>
                </div>
            </div>
            {!! Form::close() !!}
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
        });
    </script>

@endsection