@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro sueño</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'registro_suenos.create', 'method' => 'get']) !!}
                        {!!     Form::submit('Crear registro de sueño', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Tiempo de inicio</th>
                                <th>Tiempo de fin</th>
                                <th>Paciente</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($registro_suenos as $registro_sueno)


                                <tr>
                                    <td>{{ $registro_sueno->tiempo_inicio }}</td>
                                    <td>{{ $registro_sueno->tiempo_fin }}</td>
                                    <td>{{ $registro_sueno->paciente->id }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['registro_suenos.edit',$registro_sueno->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['registro_suenos.destroy',$registro_sueno->id], 'method' => 'delete']) !!}
                                        {!!   Form::submit('Borrar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
