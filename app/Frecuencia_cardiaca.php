<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frecuencia_cardiaca extends Model
{
    use SoftDeletes;
    protected $fillable = ['frec_cardiaca', 'tiempo_inicio','tiempo_fin','paciente_id'];
    //
    public function paciente()
    {
        return $this->hasOne('App\Paciente', 'id', 'paciente_id');
    }
    public function getFullNameAttribute()
    {
        return $this->frec_cardiaca;
    }
}
