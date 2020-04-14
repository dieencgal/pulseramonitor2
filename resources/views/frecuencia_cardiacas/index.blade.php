@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Frecuencia cardiaca</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'frecuencia_cardiacas.create', 'method' => 'get']) !!}
                        {!!     Form::submit('Crear frecuencia cardiaca', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Fecha</th>
                                <th>Frecuencia cardiaca media</th>
                                <th>Frecuencia cardiaca max</th>
                                <th>Frecuencia cardiaca min</th>
                                <th>Paciente</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($frecuencia_cardiacas as $frecuencia_cardiaca)


                                <tr>
                                    <td>{{ $frecuencia_cardiaca->fecha}}</td>
                                    <td>{{ $frecuencia_cardiaca->frec_cardiaca_media }}</td>
                                    <td>{{ $frecuencia_cardiaca->frec_cardiaca_max }}</td>
                                    <td>{{ $frecuencia_cardiaca->frec_cardiaca_min }}</td>
                                    <td>{{ $frecuencia_cardiaca->paciente->apellidos }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['frecuencia_cardiacas.edit',$frecuencia_cardiaca->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['frecuencia_cardiacas.destroy',$frecuencia_cardiaca->id], 'method' => 'delete']) !!}
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
