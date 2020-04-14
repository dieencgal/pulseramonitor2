<?php

namespace App\Http\Controllers;

use App\basedatos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class basedatosController extends Controller
{
    //if (($handle = fopen ( public_path () . '/MOCK_DATA.csv', 'r' )) !== FALSE) {
    //    while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
    //
    //        //saving to db logic goes here
    //
    //    }
    //    fclose ( $handle );

    protected $table = 'basedatos';
    public $timestamps = false;
    public function datos(){
        $files = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name.''), SCANDIR_SORT_ASCENDING);
dd($files); //salen dos carpetas qno se porq. comparar x numero
        $newest_file = $files[0];

       /* $nam=base_path('/resources/carpetaPacientes/pendingcontacts/diego/diegobd.csv');
        $file=storage_path('resources/carpetaPacientes/pendingcontacts/diego/diegobd.csv');*/
        if (($handle = fopen($newest_file, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 2000, ',')) !== FALSE) {
        $csv_data = new basedatos ();
        $csv_data->fecha = $data [0];
        $csv_data->distancia = $data [2];
        if($data [3]==''){
        $csv_data->frec_cardiaca_media = 0;
        }else {
            $csv_data->frec_cardiaca_media = $data [3];
        }
        if($data [4]==''){
            $csv_data->frec_cardiaca_max = 0;
        }else {
            $csv_data->frec_cardiaca_max = $data [4];
        }
        if($data [5]==''){

            $csv_data->frec_cardiaca_min = 0;
        }else {
            $csv_data->frec_cardiaca_min = $data [5];
        }
        if($data [6]==''){

            $csv_data->velocidad_media = 0;
        }else {
            $csv_data->velocidad_media = $data [6];
        }
        if($data [7]==''){

            $csv_data->velocidad_max = 0;
        }else {
            $csv_data->velocidad_max = $data [7];
        }
        if($data [8]==''){

            $csv_data->velocidad_min = 0;
        }else {
            $csv_data->velocidad_min = $data [8];
        }
        if($data [9]==''){

            $csv_data->peso_medio = 0;
        }else {
            $csv_data->peso_medio= $data [9];
        }
        if($data [10]==''){

            $csv_data->peso_max = 0;
        }else {
            $csv_data->peso_max= $data [10];
        }
        if($data [11]==''){

            $csv_data->peso_min = 0;
        }else {
            $csv_data->peso_min= $data [9];
        }
        if($data [12]==''){

            $csv_data->recuento_min_activos = 0;
        }else {
            $csv_data->recuento_min_activos = $data [12];
        }
        if($data [13]==''){

            $csv_data->andar_duracion = 0;
        }else {
            $csv_data->andar_duracion= $data [13];
        }
        if($data [14]==''){

            $csv_data->dormir_duracion = 0;
        }else {
            $csv_data->dormir_duracion = $data [14];
        }
        $csv_data->save();
        }
        fclose($handle);
        }
        $finalData = $csv_data::all();
        return view('welcomebased')->withData ( $finalData );

}

   /* public function extraerdatos()
    {/*storage_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name.'/diegobd.csv')*/
        /*base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name.'/diegobd.csv')
        if (($handle = fopen(storage_path('resources/carpetaPacientes/pendingcontacts/diego/diegobd.csv'), 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 2000, ',')) !== FALSE) {
                $csv_data = new basedatos ();
                $csv_data->fecha = $data [0];
                $csv_data->distancia = $data [1];
                $csv_data->frec_cardiaca_media = $data [2];
                $csv_data->frec_cardiaca_max = $data [3];
                $csv_data->frec_cardiaca_min = $data [4];
                $csv_data->velocidad_media = $data [5];
                $csv_data->velocidad_max = $data [6];
                $csv_data->velocidad_min = $data [7];
                $csv_data->peso_medio= $data [8];
                $csv_data->peso_max = $data [9];
                $csv_data->peso_min = $data [10];
                $csv_data->recuento_min_activos = $data [11];
                $csv_data->andar_duracion = $data [12];
                $csv_data->dormir_duracion = $data [13];

                $csv_data->save();
            }
            fclose($handle);
        }
        $finalData = $csv_data::all();

        return view('welcomebased')->withData($finalData);
    }*/
}
/*$table  -> integer('distancia');
            $table  -> integer('frec_cardiaca_media')->nullable();
            $table  -> integer('frec_cardiaca_max')->nullable();
            $table  -> integer('frec_cardiaca_min')->nullable();
            $table  -> float('velocidad_media')->nullable();
            $table  -> float('velocidad_max')->nullable();
            $table  -> float('velocidad_min')->nullable();
            $table  -> integer('recuento_pasos')->nullable();
            $table  -> integer('peso_medio')->nullable();
            $table  -> integer('peso_max')->nullable();
            $table  -> integer('peso_min')->nullable();
            $table  -> integer('recuento_min_activos')->nullable();
            $table  -> integer('andar_duracion')->nullable();
            $table  -> float('dormir_duracion')->nullable();
            <td>{{$item->distancia}}</td>
            <td>{{$item->frec_cardiaca_media}}</td>
            <td>{{$item->frec_cardiaca_max}}</td>
            <td>{{$item->frec_cardiaca_min}}</td>
            <td>{{$item->velocidad_media}}</td>
            <td>{{$item->velocidad_max}}</td>
            <td>{{$item->velocidad_min}}</td>
            <td>{{$item->peso_medio}}</td>
            <td>{{$item->peso_max}}</td>
            <td>{{$item->recuento_min_activos}}</td>
            <td>{{$item->andar_duracion}}</td>
            <td>{{$item->dormir_duracion}}</td>
            <th>Distancia</th>
            <th>Frecuencia cardiaca media</th>
            <th>Frecuencia cardiaca max</th>
            <th>Frecuencia cardiaca min</th>
            <th>Velocidad media</th>
            <th>Velocidad max</th>
            <th>Velocidad min</th>
            <th>Peso medio</th>
            <th>Peso max</th>
            <th>Peso mi</th>
            <th>Recuento de minutos activos</th>
            <th>Andar duración</th>
            <th>Dormir duracion</th>*/
