<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\basedatos;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('frecuencia_cardiacas', 'Frecuencia_cardiacaController');
Route::delete('medicos/destroyAll', 'MedicoController@destroyAll')->name('medicos.destroyAll');


Route::resource('medicos', 'MedicoController');
Route::resource('pacientes', 'PacienteController');
Route::resource('pasos', 'PasosController');
Route::resource('periodo_suenos', 'Periodo_suenoController');
Route::resource('registro_suenos', 'Registro_suenoController');


Route::get('login2','HomeController@login2');
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');


//Route::get('/prueba', 'HomeController@index');

Route::put('post/{id}', function ($id) {
    //
})->middleware('auth', 'role:admin');

Route::get('import',  'ContactsController@import');
Route::post('import', 'ContactsController@parseImport');



Route::get('welcomebased',  'basedatosController@datos');
Route::get('pasos.indexdos',  'PasosController@datos');
Route::get('paciente/filtro','Registro_suenoController@filtrarpaciente')->name('pacientes.filtro');








