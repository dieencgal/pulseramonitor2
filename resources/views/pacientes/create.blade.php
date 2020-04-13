@extends('layouts.app')
'pass' ->  Auth::user()->password
dd('pass);
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear datos del paciente</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}


                        {!! Form::open(['route' => 'pacientes.store']) !!}
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre del paciente') !!}
                            {!! Form::text('nombre',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('apellidos', 'Apellidos del paciente') !!}
                            {!! Form::text('apellidos',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('edad', 'edad') !!}
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
                            {!! Form::label('tipo_paciente', 'tipo de paciente') !!}
                            {!! Form::text('tipo_paciente',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!Form::label('medico_id', ' medico') !!}
                            <br>
                            {!! Form::select('medico_id', $medicos, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
