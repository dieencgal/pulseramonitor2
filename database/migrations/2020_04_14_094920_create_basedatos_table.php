<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasedatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basedatos', function (Blueprint $table) {
            $table->bigIncrements('id');
            /*Fecha,Calorías (kcal),Distancia (m),Frecuencia cardiaca media (ppm),Frecuencia cardiaca máxima (ppm),Frecuencia cardíaca mínima (ppm),
            Velocidad media (m/s),Velocidad máxima (m/s),Velocidad mínima (m/s),Recuento de pasos,Peso medio (kg)
            ,Peso máximo (kg),Peso mínimo (kg),Recuento de Minutos Activos,Andar duración (ms),Dormir duración (ms)*/
            $table  -> date('fecha');
            $table  -> integer('distancia');
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
            $table  -> integer('dormir_duracion')->nullable();
            $table->string('paciente_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basedatos');
    }
}
