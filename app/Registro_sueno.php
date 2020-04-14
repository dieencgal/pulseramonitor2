<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Paciente;

class Registro_sueno extends Model
{
    use SoftDeletes;
    protected $fillable = ['fecha','horas_sueno','paciente_id'];
    //
    public function paciente()
    {
        return $this->hasOne('App\Paciente', 'id', 'paciente_id');
    }
    public function periodo_sueno(){
        return $this -> hasMany('App\Periodo_sueno');
    }

    public function getFullNameAttribute()
    {
        $pac = Paciente::where('id', $this->paciente_id)->get(['nombre']);



        return $this->fecha. '  //  ' . $this->horas_sueno . '      Perteneciente al paciente '.$this->paciente_id . '  con  '  . $pac;
    }
    }


