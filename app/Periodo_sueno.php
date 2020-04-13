<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periodo_sueno extends Model
{
    use SoftDeletes;
    protected $fillable = ['fases_sueno', 'tiempo_inicio','tiempo_fin','registro_id'];
    //
    //fases sueño es enumerado (REM, LIGERO Y PROFUDO)


    public function registro_sueno()
    {

        return $this->hasOne('App\Registro_sueno', 'id', 'registro_id');
    }

}
