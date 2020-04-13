@extends('layouts.app')
$email = Auth::user()->email;

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pasos del Paciente </div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'pasos.create', 'method' => 'get']) !!}
                        {!!     Form::submit('Crear pasos', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Pasos</th>
                                <th>Tiempo_inicio</th>
                                <th>Tiempo_fin</th>
                                <th>Paciente</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($pasos as $paso)


                                <tr>
                                    <td>{{ $paso->num_pasos }}</td>
                                    <td>{{ $paso->tiempo_inicio }}</td>
                                    <td>{{ $paso->tiempo_fin }}</td>
                                    <td>{{ $paso->paciente->nombre}}</td>
                                    <td>
                                        {!! Form::open(['route' => ['pasos.edit',$paso->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['pasos.destroy',$paso->id], 'method' => 'delete']) !!}
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
