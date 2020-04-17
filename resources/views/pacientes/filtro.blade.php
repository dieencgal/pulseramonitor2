@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Paciente</div>

                    <div class="panel-body">



                            <br><br>
                            <table class="table table-striped table-bordered">
                                <tr>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Edad</th>
                                        <th>Peso</th>
                                        <th>Sexo</th>
                                        <th>Altura</th>
                                        <th>Operacion</th>
                                        <th>Tipo de paciente</th>
                                        <th>Médico</th>
                                        <th colspan="2">Acciones</th>
                                    </tr>

                                    @foreach ($pacientes as $paciente)


                                        <tr>
                                            <td>{{ $paciente->nombre }}</td>
                                            <td>{{ $paciente->apellidos }}</td>
                                            <td>{{ $paciente->edad }}</td>
                                            <td>{{ $paciente->peso }}</td>
                                            <td>{{ $paciente->sexo }}</td>
                                            <td>{{ $paciente->altura }}</td>
                                            <td>{{ $paciente->operacion }}</td>
                                            <td>{{ $paciente->tipo_paciente }}</td>
                                            <td>{{ $paciente->medico->nombre}}</td>

                                    <td>
                                        {!! Form::open(['route' => ['pacientes.edit',$paciente->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['pacientes.destroy',$paciente->id], 'method' => 'delete']) !!}
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
    </div>
@endsection
