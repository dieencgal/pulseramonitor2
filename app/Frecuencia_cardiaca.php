<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frecuencia_cardiaca extends Model
{
    use SoftDeletes;
    protected $fillable = ['fecha','frec_cardiaca_media', 'frec_cardiaca_max','frec_cardiaca_min','paciente_id'];
    //
    public function paciente()
    {
        return $this->hasOne('App\Paciente', 'id', 'paciente_id');
    }
    public function getFullNameAttribute()
    {
        return $this->frec_cardiaca_media;
    }
}
