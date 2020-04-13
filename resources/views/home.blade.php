@extends('layouts.app')


@section('content')
    <style>
        html, body {
            background-color: darkcyan;
            color: black /*#636b6f*/;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;

            /*background: transparent url('img/xia.jpg') no-repeat center center;
            background-repeat: no-repeat;
            background-position: fixed;
            -webkit-background-size: cover;
            -webkit-filter: cover;
            background-size: cover;
*/
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: black;
            /*#636b6f;*/
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .panel > .panel-heading {
            background-image: none;
            background-color: white;
            color: darkcyan;

        }



    </style>

    <body>



    <div class="container">

        <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading">Pulsera Monitor</div>
                    <br>


                    @if ((Auth::user()->hasRole('user')))


                        @include('flash::message')

                        {!!     Form::submit('Mis datos', ['class'=> 'btn btn-primary'])!!}
                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Edad</th>
                                <th>Peso</th>
                                <th>Sexo</th>
                                <th>Altura</th>


                            </tr>

                            @foreach ($pacientes as $paciente)


                                <tr>
                                    <td>{{ $paciente->nombre }}</td>
                                    <td>{{ $paciente->apellidos }}</td>
                                    <td>{{ $paciente->edad }}</td>
                                    <td>{{ $paciente->peso }}</td>
                                    <td>{{ $paciente->sexo }}</td>
                                    <td>{{ $paciente->altura }}</td>




                                </tr>
                            @endforeach
                        </table>
                    @endif







                    <br><br>

                    <div class="panel-body">

                        Use el desplegable para ver sus avances.

                    </div>
                    <a href="{{  url('import') }}" class="btn btn-primary">Importar</a>




                </div>
            </div>

    </div>
    </body>


@endsection
