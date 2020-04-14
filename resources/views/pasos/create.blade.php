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
                        {!! Form::label('Fecha', 'Fecha y hora') !!}


                        <input type="datetime-local" id="fecha" name="fecha" class="form-control" value="{{Carbon\Carbon::now()->timezone('Europe/Madrid')->format('Y-m-d\Th:i')}}" />
                    </div>
                    <div class="form-group">
                        {!! Form::label('num_pasos', 'Pasos dados') !!}
                        {!! Form::text('num_pasos',null,['class'=>'form-control', 'required','autofocus']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('distancia', 'distancia') !!}
                        {!! Form::text('distancia',null,['class'=>'form-control', 'required','autofocus']) !!}
                    </div>

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
@endsection
