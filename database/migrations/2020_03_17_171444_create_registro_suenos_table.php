<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroSuenosTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::create('registro_suenos', function (Blueprint $table) {
$table->increments('id');
$table->dateTime('tiempo_inicio')->nullable();
$table->dateTime('tiempo_fin')->nullable();
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
Schema::dropIfExists('registro_suenos');
}
}
