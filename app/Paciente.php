<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Paciente extends  Model
{

    use SoftDeletes;
    protected $fillable = ['nombre', 'apellidos', 'edad','peso', 'sexo','altura', 'operacion','tipo_paciente','medico_id'];
    /*operacion significa que tipo de operación ha sufrido, puede ser = ninguna*/
    /*tippaciente será sano o enfermo, se puede filtrar un paciente enfermo antes y despues de la operación mirando en
    operacion cuando padecia ninguna hasta la operacion*/

    //

    public function medico()
    {
        return $this->hasOne('App\Medico', 'id', 'medico_id');

    }
    public function paso()
    {
        return $this->hasMany('App\Paso');
    }
    public function frecuencia_cardiaca()
    {
        return $this->hasMany('App\Frecuencia_cardiaca');
    }
    public function Registro_sueno()
    {
        return $this->hasMany('App\Registro_sueno');
    }
    public function getFullNameAttribute()
    {
        return $this->nombre .' '.$this->apellidos;
    }

}
