@extends('layouts.app')

@section('content')
    @if(Auth::user()->hasRole('admin'))
        <li>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar periodo sueño</div>

                        <div class="panel-body">
                            @include('flash::message')

                            {!! Form::model($periodo_sueno, [ 'route' => ['periodo_suenos.update',$periodo_sueno->id], 'method'=>'PUT']) !!}

                            <div class="form-group">
                                {!! Form::label('fases_sueno', 'fases sueño') !!}
                                {!! Form::text('fases_sueno',$periodo_sueno->fases_sueno,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tiempo_inicio', 'Fecha y hora inicio del periodo sueño') !!}
                                <input type="datetime-local" id="tiempo_inicio" name="tiempo_inicio" class="form-control"
                                       value="{{Carbon\Carbon::createFromDate($periodo_sueno->tiempo_inicio)->format('Y-m-d\TH:i')}}"/>
                            </div>
                            <div class="form-group">
                                {!! Form::label('tiempo_fin', 'Fecha y hora fin del periodo sueño') !!}

                                <input type="datetime-local" id="tiempo_fin" name="tiempo_fin" class="form-control"
                                       value="{{Carbon\Carbon::createFromDate($periodo_sueno->tiempo_fin)->format('Y-m-d\TH:i')}}"/>
                            </div>
                            <div class="form-group">
                                {!!Form::label('registro_id', 'Registro del Paciente') !!}
                                <br>
                                {!! Form::select('registro_id', $registro_suenos, $periodo_sueno->registro_id, ['class' => 'form-control']) !!}
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
