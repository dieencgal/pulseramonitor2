<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Medico extends Model
{

    use SoftDeletes;
    protected $fillable = ['nombre','apellidos'];
    //


    public function paciente()
    {
        return $this->hasMany('App\Paciente');
    }

    public function getFullNameAttribute()
    {
        return $this->nombre .' '.$this->apellidos;
    }

}
