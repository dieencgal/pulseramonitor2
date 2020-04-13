@extends('layouts.app')

@section('content')
    @if(Auth::user()->hasRole('admin'))
        <li>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar pasos</div>

                        <div class="panel-body">
                            @include('flash::message')

                            {!! Form::model($paso, [ 'route' => ['pasos.update',$paso->id], 'method'=>'PUT']) !!}

                            <div class="form-group">
                                {!! Form::label('num_pasos', 'Pasos dados') !!}
                                {!! Form::text('num_pasos',$paso->paso,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tiempo_inicio', 'Fecha y hora inicio de los pasos') !!}
                                <input type="datetime-local" id="tiempo_inicio" name="tiempo_inicio" class="form-control"
                                       value="{{Carbon\Carbon::createFromDate($paso->tiempo_inicio)->format('Y-m-d\TH:i')}}"/>
                            </div>
                            <div class="form-group">
                                {!! Form::label('tiempo_fin', 'Fecha y hora fin de los pasos') !!}

                                <input type="datetime-local" id="tiempo_fin" name="tiempo_fin" class="form-control"
                                       value="{{Carbon\Carbon::createFromDate($paso->tiempo_fin)->format('Y-m-d\TH:i')}}"/>
                            </div>
                            <div class="form-group">
                                {!!Form::label('paciente_id', 'Paciente') !!}
                                <br>
                                {!! Form::select('paciente_id', $paciente, $paso->paciente_id, ['class' => 'form-control']) !!}
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
