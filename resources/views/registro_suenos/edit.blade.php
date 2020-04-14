@extends('layouts.app')

@section('content')
    @if(Auth::user()->hasRole('admin'))
        <li>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar registro sueño</div>

                        <div class="panel-body">
                            @include('flash::message')

                            {!! Form::model($registro_sueno, [ 'route' => ['registro_suenos.update',$registro_sueno->id], 'method'=>'PUT']) !!}

                            <div class="form-group">
                                {!! Form::label('fecha', 'Fecha y hora ') !!}
                                <input type="datetime-local" id="fecha" name="fecha" class="form-control"
                                       value="{{Carbon\Carbon::createFromDate($registro_sueno->fecha)->format('Y-m-d\TH:i')}}"/>
                            </div>
                            <div class="form-group">
                                {!! Form::label('horas_sueno', 'Horas de sueño') !!}
                                {!! Form::text('horas_sueno',$registro_sueno->horas_sueno,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('paciente_id', 'Paciente') !!}
                                <br>
                                {!! Form::select('paciente_id', $paciente, $registro_sueno->paciente_id, ['class' => 'form-control']) !!}
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
