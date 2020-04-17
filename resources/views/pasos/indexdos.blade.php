@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'pasos.store']) !!}
                    </div>
                    <div class="panel-heading">Pasos</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'pasos.create', 'method' => 'get']) !!}
                        {!!     Form::submit('Crear pasos', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>

        <th>Fecha</th>
        <th>Distancia</th>
        <th>Recuento pasos</th>
        <th>Paciente</th>

    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>

            <td>{{$item->fecha}}</td>
            <td>{{$item->distancia}}</td>
            <td>{{$item->recuento_pasos}}</td>
            <td>{{(Auth::user()->id)-1}}</td>
            <td>


                {!! Form::open(['route' => ['pasos.edit',$item->id], 'method' => 'get']) !!}
                {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open(['route' => ['pasos.destroy',$item->id], 'method' => 'delete']) !!}
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
