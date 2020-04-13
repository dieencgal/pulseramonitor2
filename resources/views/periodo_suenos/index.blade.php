@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Periodo sueño</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'periodo_suenos.create', 'method' => 'get']) !!}
                        {!!     Form::submit('Crear periodo sueño', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Fases del sueño</th>
                                <th>Tiempo de inicio</th>
                                <th>Tiempo de fin</th>
                                <th>Registro de sueño</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($periodo_suenos as $periodo_sueno)


                                <tr>
                                    <td>{{ $periodo_sueno->fases_sueno }}</td>
                                    <td>{{ $periodo_sueno->tiempo_inicio }}</td>
                                    <td>{{ $periodo_sueno->tiempo_fin }}</td>
                                    <td>{{ $periodo_sueno->registro_sueno->full_name }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['periodo_suenos.edit',$periodo_sueno->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['periodo_suenos.destroy',$periodo_sueno->id], 'method' => 'delete']) !!}
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
