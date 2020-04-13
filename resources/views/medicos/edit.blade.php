@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar medico</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::model($medico, [ 'route' => ['medicos.update',$medico->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre del medico') !!}
                            {!! Form::text('nombre',$medico->nombre,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('apellidos', 'Apellidos del medico') !!}
                            {!! Form::text('apellidos',$medico->apellidos,['class'=>'form-control', 'required']) !!}
                        </div>

                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
