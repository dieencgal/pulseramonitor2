@extends('layouts.app')


@section('content')
    @if(Auth::user()->hasRole('admin'))
        <li>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar paciente</div>

                        <div class="panel-body">
                            @include('flash::message')

                            {!! Form::model($paciente, [ 'route' => ['pacientes.update',$paciente->id], 'method'=>'PUT']) !!}

                            <div class="form-group">
                                {!! Form::label('nombre', 'Nombre del paciente') !!}
                                {!! Form::text('nombre',$paciente->name,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('apellidos', 'Apellidos del paciente') !!}
                                {!! Form::text('apellidos',$paciente->apellidos,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('edad', 'edad del paciente') !!}
                                {!! Form::text('edad',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('peso', 'peso del paciente') !!}
                                {!! Form::text('peso',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('sexo', 'sexo del paciente') !!}
                                {!! Form::text('sexo',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('altura', 'altura del paciente') !!}
                                {!! Form::text('altura',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('operacion', 'operacion del paciente') !!}
                                {!! Form::text('operacion',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tipo_paciente', 'pacientes') !!}
                                {!! Form::text('tipo_paciente',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('medico_id', 'medico del paciente') !!}
                                {!! Form::text('medico_id',null,['class'=>'form-control', 'required']) !!}
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
