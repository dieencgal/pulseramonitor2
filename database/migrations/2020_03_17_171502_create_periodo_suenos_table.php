<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodoSuenosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo_suenos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('fases_sueno', ['REM', 'ligero','profundo']);
            $table->dateTime('tiempo_inicio')->nullable();
            $table->dateTime('tiempo_fin')->nullable();
            $table->unsignedInteger('registro_id')->nullable();
            $table->foreign('registro_id')->references('id')->on('registro_suenos')->onDelete('restrict');
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
        Schema::dropIfExists('periodo_suenos');
    }
}
