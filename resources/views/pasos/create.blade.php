@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear pasos</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'pasos.store']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('num_pasos', 'Pasos dados') !!}
                        {!! Form::text('num_pasos',null,['class'=>'form-control', 'required','autofocus']) !!}
                    </div>
                        <div class="form-group">
                        {!! Form::label('tiempo_inicio', 'Fecha y hora inicio pasos') !!}


                        <input type="datetime-local" id="tiempo_inicio" name="tiempo_inicio" class="form-control" value="{{Carbon\Carbon::now()->timezone('Europe/Madrid')->format('Y-m-d\Th:i')}}" />


                    </div>
                    <div class="form-group">
                        {!! Form::label('tiempo_fin', 'Fecha y hora fin pasos') !!}


                        <input type="datetime-local" id="tiempo_fin" name="tiempo_fin" class="form-control" value="{{Carbon\Carbon::now()->timezone('Europe/Madrid')->format('Y-m-d\Th:i')}}" />

                        <div class="form-group">
                            {!!Form::label('paciente_id', 'Paciente') !!}

                            {!! Form::text('paciente_id', $pacientes, ['class' => 'form-control','required','autofocus']) !!}
                        </div>


                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
