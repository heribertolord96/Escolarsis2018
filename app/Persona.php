<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombre','tipo_documento','num_documento','direccion','telefono','cargo','email',
    'idcurso','apaterno','amaterno','num_alumno','birthday','num_ide','direccion',
    'telefono','email','sexo','edad','condicion'];

    public function provedor()
    {
        return $this->hasOne('App\Proveedor');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }


}
