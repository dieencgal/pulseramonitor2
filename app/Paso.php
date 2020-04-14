<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paso extends Model
{
    use SoftDeletes;
    protected $fillable = ['fecha', 'num_pasos','distancia','paciente_id'];
    //

    public function paciente()
    {
        return $this->hasOne('App\Paciente', 'id', 'paciente_id');
    }
    public function getFullNameAttribute()
    {
        return $this->num_pasos;
    }
}
