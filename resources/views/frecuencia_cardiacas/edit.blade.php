@extends('layouts.app')

@section('content')
    @if(Auth::user()->hasRole('admin'))
        <li>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar frecuencia cardiaca</div>

                        <div class="panel-body">
                            @include('flash::message')

                            {!! Form::model($frecuencia_cardiaca, [ 'route' => ['frecuencia_cardiacas.update',$frecuencia_cardiaca->id], 'method'=>'PUT']) !!}
                            <div class="form-group">
                                {!! Form::label('fecha', 'Fecha y hora') !!}
                                <input type="datetime-local" id="fecha" name="fecha" class="form-control"
                                       value="{{Carbon\Carbon::createFromDate($frecuencia_cardiaca->fecha)->format('Y-m-d\TH:i')}}"/>
                            </div>
                            <div class="form-group">
                                {!! Form::label('frec_cardiaca_media', 'frecuencia cardiaca media') !!}
                                {!! Form::text('frec_cardiaca_media',$frecuencia_cardiaca->frec_cardiaca_media,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('frec_cardiaca_max', 'frecuencia cardiaca máxima') !!}
                                {!! Form::text('frec_cardiaca:max',$frecuencia_cardiaca->frec_cardiaca_max,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('frec_cardiaca_min', 'frecuencia cardiaca minima') !!}
                                {!! Form::text('frec_cardiaca_min',$frecuencia_cardiaca->frec_cardiaca_min,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </div>


                            <div class="form-group">
                                {!!Form::label('paciente_id', 'Paciente') !!}
                                <br>
                                {!! Form::select('paciente_id', $pacientes, $frecuencia_cardiaca->paciente_id, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </li>
    @else
        <div class="panel-heading">Solo puede editar los datos un médico.</div>
    @endif
@endsection
