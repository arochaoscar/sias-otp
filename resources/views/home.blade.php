@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel bg-gray-light">
                    <div class="panel-heading">Datos del Propietario</div>
                    <div class="panel-body">
                        <pre>
                            {{ var_dump($role) }}
                        </pre>
                    </div>
                </div>

            </div>
        </div>

    </div>



@endsection