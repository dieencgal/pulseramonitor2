<?php

namespace App\Http\Controllers;

use App\basedatos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use View;



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
        $files = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name.''), SCANDIR_SORT_DESCENDING);
        $newest_file= base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name.'/'.$files[0]);



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

            $csv_data->recuento_pasos = 0;
        }else {
            $csv_data->recuento_pasos= $data [9];
            }
        if($data [10]==''){

            $csv_data->peso_medio = 0;
        }else {
            $csv_data->peso_medio= $data [10];
        }
        if($data [11]==''){

            $csv_data->peso_max = 0;
        }else {
            $csv_data->peso_max= $data [11];
        }
        if($data [12]==''){

            $csv_data->peso_min = 0;
        }else {
            $csv_data->peso_min= $data [12];
        }
        if($data [13]==''){

            $csv_data->recuento_min_activos = 0;
        }else {
            $csv_data->recuento_min_activos = $data [13];
        }
        if($data [14]==''){

            $csv_data->andar_duracion = 0;
        }else {
            $csv_data->andar_duracion= $data [14];
        }
        if($data [15]==''){

            $csv_data->dormir_duracion = 0;
        }else {
            $csv_data->dormir_duracion = $data [15];
        }
            $csv_data->paciente_id = Auth::user()->id-1;
        $csv_data->save();
        }
        fclose($handle);
        }
        $finalData = $csv_data::all();

        View::share('finalData',$finalData);


        return view('welcomebased')->withData ( $finalData );

}


}
