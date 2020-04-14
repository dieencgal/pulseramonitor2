<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrecuenciaCardiacasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frecuencia_cardiacas', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->integer('frec_cardiaca_media')->nullable();
            $table->integer('frec_cardiaca_max')->nullable();
            $table->integer('frec_cardiaca_min')->nullable();
            $table->unsignedInteger('paciente_id')->nullable();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('restrict');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frecuencia_cardiacas');
    }
}

